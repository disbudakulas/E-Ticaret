<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    public function yonlendirme($aut){
        if($aut == 1){
            return true;
        }else{
            return false;
        }
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function tumsiparisdetay(Request $request,$id=null){
        $siparis = Order::Where('id',$id)->first();
        if($this->yonlendirme(Auth::user()->authority) and isset($siparis)){
            $detay = OrderDetail::Where('id',$siparis->orderNo)->first();
            $urun = Product::Where('productId',$siparis->productId)->first();
            $array = null;
            $ulkeler = Country::Where('id',$detay->country)->first();
            $ulke = null;
            if(isset($ulkeler) and $ulkeler){ $ulke= $ulkeler->name; }
            if(isset($detay) and  $detay){
                $satici = Seller::Where('sellerId',$siparis->productSeller)->first();
                $array['name'] = $detay->name;
                $array['surname'] = $detay->surname;
                $array['tel'] = $detay->tel;
                $array['adress'] = $detay->adress;
                $array['location'] = $ulke.'/'.$detay->location;
                $array['adet'] = $siparis->productNumber;
                $array['tutar'] = ((double)$siparis->orderPrice*(double)$siparis->productNumber)+(double)$siparis->sheepingFee+(double)$siparis->kdv;
                $array['satici'] = $satici?$satici->sellerName:null;
                $array['mail'] = User::Where('id',$satici->userId)->first()?User::Where('id',$satici->userId)->first()->email:null;
                $array['kargo'] = $siparis->cargoName;
                $array['takipno'] = $siparis->cargoTracking;
            }
            return $array;
        }else{
            return abort(404);
        }
    }
}
