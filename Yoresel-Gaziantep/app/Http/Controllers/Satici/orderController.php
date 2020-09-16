<?php

namespace App\Http\Controllers\Satici;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Pricing;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    public function yonlendirme($aut){
        if($aut == 1 or $aut == 4){
            return true;
        }else{
            return false;
        }
    }
    public function siparisdetay(Request $request,$id=null){
        $siparis = Order::Where('id',$id)->first();
        if($this->yonlendirme(Auth::user()->authority) and isset($siparis)){
            $detay = OrderDetail::Where('id',$siparis->orderNo)->first();
            $urun = Product::Where('productId',$siparis->productId)->first();
            $array = null;
            $ulkeler = Country::Where('id',$detay->country)->first();
            $ulke = null;
            if(isset($ulkeler) and $ulkeler){ $ulke= $ulkeler->name; }
            if(isset($detay) and  $detay){
                $array['name'] = $detay->name;
                $array['surname'] = $detay->surname;
                $array['tel'] = $detay->tel;
                $array['adress'] = $detay->adress;
                $array['location'] = $ulke.'/'.$detay->location;
                $array['adet'] = $siparis->productNumber;
                $array['stok'] = isset($urun)?$urun->productNumber:0;
                $array['kargoadi'] = $siparis->cargoName;
                $array['takipno'] = $siparis->cargoTracking;
            }
            return $array;
        }else{
            return abort(404);
        }
    }
    public function siparisonay(Request $request){
        if($this->yonlendirme(Auth::user()->authority) and $_POST){
           $siparis = Order::Where('id',$_POST['id']);
           $urun = Product::Where('productId',$siparis->first()->productId);
           if(isset($siparis) and $siparis and isset($urun) and $urun){
               if($urun->first()->productNumber >= $siparis->first()->productNumber)
               {
                   $urun->Update([
                       'productNumber' => $urun->first()->productNumber-$siparis->first()->productNumber,
                   ]);
                   $komisyon = Pricing::Where('name','komisyon')->first();
                   $siparis->Update([
                       'orderStatus' => 3,
                       'orderDesc' => $_POST['onayaciklama'],
                       'comission' => isset($komisyon)?$komisyon->value:0,
                   ]);
                   return back();
               }
               return view('/admin/satici/hata',['hatatur' => 'stokyetersiz']);
           }
            return view('/admin/satici/hata',['hatatur' => 'siparisonaylanamadi']);
        }else{
            return abort(404);
        }
    }
    public function siparisiptal(Request $request){
        if($this->yonlendirme(Auth::user()->authority) and $_POST){
            $siparis = Order::Where('id',$_POST['id']);
            if(isset($siparis) and $siparis){
                $siparis->Update([
                    'orderStatus' => 2,
                    'orderDesc' => $_POST['iptalaciklama'],
                ]);
                return back();
            }
            return view('/admin/satici/hata',['hatatur' => 'siparisonaylanamadi']);
        }else{
            return abort(404);
        }
    }
    public function kargoyaverildi(Request $request){
        if($this->yonlendirme(Auth::user()->authority) and $_POST){
            $siparis = Order::Where('id',$_POST['id']);
            if(isset($siparis) and $siparis){
                $siparis->Update([
                    'orderStatus' => 4,
                    'cargoName' => $_POST['kargoadi'],
                    'cargoTracking' => $_POST['takipno'],
                    'cargoDate' => Carbon::now(),
                ]);
                return back();
            }
            return view('/admin/satici/hata',['hatatur' => 'kargotanimlanamadi']);
        }else{
            return abort(404);
        }
    }
}
