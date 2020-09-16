<?php

namespace App\Http\Controllers\Satici;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use App\Models\Admin\District;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Picture;
use App\Models\Product;
use App\Models\Seller;
use App\Models\SellerWait;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class saticiPageController extends Controller
{
    public function yonlendirme($aut){
        if($aut == 1 or $aut == 4){
            return true;
        }else{
            return false;
        }
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        if($this->yonlendirme(Auth::user()->authority)){
            $seller = Seller::Where('userId',Auth::user()->id)->first();
            $tomorrow = substr(Carbon::tomorrow(),0,10);
            $yester = substr(Carbon::yesterday(),0,10);
            $satislar = Order::Where('productSeller',$seller->sellerId)->WhereIn('orderStatus',["3","4","5"])->Where('updated_at','<',$tomorrow)->Where('updated_at','>',$yester)->orderBy('updated_at','desc')->get();
            $array = null;
            if(isset($satislar) and $satislar){
                foreach ($satislar as $item) {
                    $urun = null;
                    $urun = Product::Where('productId',$item->productId)->first();
                    $array[$item->id] = [
                        'adi' => isset($urun)?$urun->productName:null,
                        'durum' => $item->orderStatus,
                        'kazanc' => (double)((((double)$item->productNumber*(double)$item->orderPrice)+(double)$item->sheepingFee)*(double)$item->comission)/100,
                    ];
                }
            }
            return view('/admin/satici/index')->with(['satislar'=>$array,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function saticihesap(){
        if($this->yonlendirme(Auth::user()->authority)){
            $iller = City::orderBy('name')->get();
            $ilceler = District::orderBy('name')->get();
            $icerik = [
                'name' => Seller::Where('userId',Auth::user()->id)->first()->sellerName,
                'city' => Auth::user()->city,
                'district' => Auth::user()->district,
                'residing' => Auth::user()->residing,
                'tel' => Auth::user()->tel,
                'gsm' => Auth::user()->gsm,
                'faks' => Auth::user()->faks,
                'mail' => Auth::user()->email,
            ];
            return view('/admin/satici/saticihesap',['icerik' => $icerik,'iller'=>$iller,'ilceler'=>$ilceler]);
        }else{
            return abort(404);
        }
    }
    public function saticiodeme(){
        if($this->yonlendirme(Auth::user()->authority)){
            $seller = Seller::Where('userId',Auth::user()->id)->first();
            if($seller){
                $icerik = [
                    'sellerName' => $seller->sellerName,
                    'accountName' => $seller->accountName,
                    'accountNumber' => $seller->accountNumber,
                    'taxOffice' => $seller->taxOffice,
                    'taxNumber' => $seller->taxNumber,
                ];
            }
            $seller2 = SellerWait::Where('userId',Auth::user()->id)->Where('status',3)->first();
            if($seller2){
                $icerik2 = [
                    'sellerName' => $seller2->sellerName,
                    'accountName' => $seller2->accountName,
                    'accountNumber' => $seller2->accountNumber,
                    'taxOffice' => $seller2->taxOffice,
                    'taxNumber' => $seller2->taxNumber,
                ];
            }
            return view('/admin/satici/saticiodeme',['icerik' => $icerik??null, 'icerik2' => $icerik2??null]);
        }else{
            return abort(404);
        }
    }
    public function saticiurunleri(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $urunler = Product::Where('productSeller',Seller::Where('userId',Auth::user()->id)->first()->sellerId)->Where('productStatus','!=',"1")->get();
            $satici = Seller::Where('userId',Auth::user()->id)->first()->sellerName;
            $array = array();
            foreach ($urunler as $urun){
                switch ($urun->discountType){
                    case 1: $indirimlifiyat = $urun->productPrice-($urun->productPrice*$urun->productDiscount)/100;break;
                    case 2: $indirimlifiyat = $urun->productPrice-$urun->productDiscount;break;
                    default : $indirimlifiyat = null;break;
                }
                $resim = Picture::Where('productId',$urun->productId)->Where('pictureType',1)->first();
                $array[$urun->productId] = [
                    'id' => $urun->productId,
                    'resim' => $resim?'storage/uploads/products/picturecrop/'.$urun->productSeller.'/'.$resim->pictureUrl:'storage/uploads/products/picture/no-Image.png',
                    'ad' => $urun->productName,
                    'satici' => $satici,
                    'birim' => $urun->productUnit,
                    'stok' => $urun->productNumber,
                    'fiyat' => $urun->productPrice,
                    'indirimlifiyat' => $indirimlifiyat,
                    'durum' => $urun->productStatus,
                ];
            }
            return view('/admin/satici/saticiurunleri',['urunler' => $array,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function saticiindirimliurunler(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $urunler = Product::Where('productSeller',Seller::Where('userId',Auth::user()->id)->first()->sellerId)->Where('discountType','!=',0)->get();
            $array = array();
            foreach ($urunler as $urun){
                $indirimlifiyat = ($urun->discountType==1)?$urun->productPrice-($urun->productPrice*$urun->productDiscount)/100:($urun->productPrice-$urun->productDiscount);
                $resim = Picture::Where('productId',$urun->productId)->Where('pictureType',1)->first();
                $array[$urun->productId] = [
                    'id' => $urun->productId,
                    'resim' => $resim?'storage/uploads/products/picturecrop/'.$urun->productSeller.'/'.$resim->pictureUrl:'storage/uploads/products/picture/no-Image.png',
                    'ad' => $urun->productName,
                    'birim' => $urun->productUnit,
                    'stok' => $urun->productNumber,
                    'fiyat' => $urun->productPrice,
                    'indirimlifiyat' => $indirimlifiyat,
                    'durum' => $urun->productStatus,
                ];
            }
            return view('/Admin/satici/saticiindirimliurunler',['urunler' => $array,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function saticisiparisler(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $siparisler = Order::Where('productSeller',Auth::user()->id)->Where('orderStatus',1)->get();
            $array = null;
            if(isset($siparisler) and $siparisler){
                foreach ($siparisler as $siparis){
                    $user = User::Where('id',$siparis->userId)->first();
                    $urun = Product::Where('productId',$siparis->productId)->first();
                    $array[$siparis->id] = [
                        'urunid' => isset($urun)?$urun->productName:null,
                        'id' => $siparis->id,
                        'alici' => isset($user)?$user->email:null,
                        'adet' => $siparis->productNumber,
                        'tutar' => ((double)$siparis->productNumber*(double)$siparis->orderPrice)+(double)$siparis->sheepingFee+(double)$siparis->kdv,
                        'tarih' => substr($siparis->created_at,0,10),
                    ];
                }
            }
            return view('/admin/satici/saticisiparisler',['siparisler' => $array,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function saticikargoyaverilecekler(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $siparisler = Order::Where('productSeller',Auth::user()->id)->Where('orderStatus',3)->get();
            $array = null;
            if(isset($siparisler) and $siparisler){
                foreach ($siparisler as $siparis){
                    $user = User::Where('id',$siparis->userId)->first();
                    $urun = Product::Where('productId',$siparis->productId)->first();
                    $array[$siparis->id] = [
                        'urunid' => isset($urun)?$urun->productName:null,
                        'id' => $siparis->id,
                        'alici' => isset($user)?$user->email:null,
                        'adet' => $siparis->productNumber,
                        'tutar' => ((double)$siparis->productNumber*(double)$siparis->orderPrice)+(double)$siparis->sheepingFee+(double)$siparis->kdv,
                        'tarih' => substr($siparis->created_at,0,10),
                    ];
                }
            }
            return view('/admin/satici/saticikargoyaverilecekler',['siparisler' => $array,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function saticiyapilansatislar(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $seller = Seller::Where('userId',Auth::user()->id)->first();
            $siparisler = Order::Where('productSeller',$seller?$seller->sellerId:null)->WhereIn('orderStatus',[4,5])->get();
            $array = null;
            if(isset($siparisler) and $siparisler){
                foreach ($siparisler as $siparis){
                    $user = User::Where('id',$siparis->userId)->first();
                    $urun = Product::Where('productId',$siparis->productId)->first();
                    $array[$siparis->id] = [
                        'urunid' => isset($urun)?$urun->productName:null,
                        'id' => $siparis->id,
                        'alici' => isset($user)?$user->email:null,
                        'adet' => $siparis->productNumber,
                        'tutar' => ((double)$siparis->productNumber*(double)$siparis->orderPrice)+(double)$siparis->sheepingFee,
                        'tarih' => substr($siparis->created_at,0,10),
                        'durum' => $siparis->orderStatus,
                    ];
                }
            }
            return view('/admin/satici/saticiyapilansatislar',['siparisler' => $array,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function saticibekleyenyorumlar(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $seller = Seller::Where('userId',Auth::user()->id)->first();
            $yorumlar = Comment::select('productId')->Where('productSeller',$seller?$seller->sellerId:null)->Where('checked',1)->groupBy('productId')->get()->toarray();
            $array = null;
            if(isset($yorumlar) and $yorumlar){
                foreach ($yorumlar as $yorum){
                    $urun = Product::Where('productId',$yorum['productId'])->first();
                    $array[$yorum['productId']] = [
                        'adi' => $urun->productName,
                    ];
                }
            }
            return view('/admin/satici/saticibekleyenyorumlar',['yorumlar' => $array,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
}
