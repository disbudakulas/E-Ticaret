<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use App\Models\Admin\District;
use App\Models\Admin\SiteContent;
use App\Models\Admin\SiteSetting;
use App\Models\Admin\Slide;
use App\Models\Comment;
use App\Models\Kategori;
use App\Models\Order;
use App\Models\Picture;
use App\Models\Pricing;
use App\Models\Product;
use App\Models\Seller;
use App\Models\SellerWait;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminPageController extends Controller
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
    public function index(){
        if($this->yonlendirme(Auth::user()->authority)){
            $kullanicilar = User::get();
            $istatistik = null;
            if(isset($kullanicilar) and $kullanicilar){
                $istatistik = [
                    'kadin' => $kullanicilar->Where('blocked',"0")->Where('gender',"0")->count(),
                    'erkek' => $kullanicilar->Where('blocked',"0")->Where('gender',"1")->count(),
                    'belirsiz' => $kullanicilar->Where('blocked',"0")->WhereIn('gender',[null,"3"])->count(),
                    'toplamaktif' => $kullanicilar->Where('blocked',"0")->count(),
                    'toplamsatis' => Order::WhereIn('orderStatus',["3","4","5"])->count(),
                    'engelli' => $kullanicilar->Where('blocked',"1")->count(),
                ];
            }
            $tomorrow = substr(Carbon::tomorrow(),0,10);
            $yester = substr(Carbon::yesterday(),0,10);
            $satislar = Order::WhereIn('orderStatus',["3","4","5"])->Where('updated_at','<',$tomorrow)->Where('updated_at','>',$yester)->orderBy('updated_at','desc')->get();
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
            return view('/admin/production/index')->with(['istatistik' => $istatistik,'satislar'=>$array,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function kategoriler(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $kategoriler = Kategori::all();
            return view('/admin/production/kategoriler',['kategoriler'=>$kategoriler,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function logoayarla(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $logo = SiteSetting::all();
            $logourl = $logo->first()->settingLogo ? 'storage/uploads/logocrop/'.$logo->first()->settingLogo : 'storage/uploads/logo/no-Image.png';
            return view('/admin/production/logo',[
                'logo'=>$logourl,
                'id' => $logo->first()->settingId??null
            ]);
        }else{
            return abort(404);
        }
    }
    public function siteaciklama(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $icerik = SiteSetting::all();
            $iller = City::orderBy('name')->get();
            $ilceler = District::orderBy('name')->get();
            return view('/admin/production/siteaciklama',['icerik' => $icerik,'iller'=>$iller,'ilceler'=>$ilceler]);
        }else{
            return abort(404);
        }
    }
    public function icerikduzenle(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $icerik = SiteContent::all();
            return view('/admin/production/icerikduzenle',['icerik' => $icerik]);
        }else{
            return abort(404);
        }
    }
    public function kullanicilar(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $kullanicilar = User::Where('authority','!=',1)->get();
            return view('/admin/production/kullanicilar',['kullanicilar' => $kullanicilar,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function saticibasvurulari(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $basvurular = null;
            $basvurular = SellerWait::Where('status',3)->get();
            return view('/Admin/production/saticibasvurulari',['basvurular' => $basvurular,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function yapilacakodemeler(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            return view('/Admin/production/yapilacakodemeler',['page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function urunler(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $urunler = Product::all();
            $array = array();
            foreach ($urunler as $urun){

                $indirimlifiyat = ($urun->discountType!=0)?(($urun->discountType==1)?$urun->productPrice-($urun->productPrice*$urun->productDiscount)/100:($urun->productPrice-$urun->productDiscount)):null;
                $resim = Picture::Where('productId',$urun->productId)->Where('pictureType',1)->first();
                $array[$urun->productId] = [
                    'id' => $urun->productId,
                    'resim' => $resim?'storage/uploads/products/picturecrop/'.$urun->productSeller.'/'.$resim->pictureUrl:'storage/uploads/products/picture/no-Image.png',
                    'ad' => $urun->productName,
                    'satici' => Seller::Where('sellerId',$urun->productSeller)->first()->sellerName,
                    'birim' => $urun->productUnit,
                    'stok' => $urun->productNumber,
                    'fiyat' => $urun->productPrice,
                    'indirimlifiyat' => $indirimlifiyat,
                    'durum' => $urun->productStatus,
                ];
            }
            return view('/Admin/production/urunler',['urunler' => $array,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function indirimliurunler(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $urunler = Product::Where('discountType','!=',0)->get();
            $array = array();
            foreach ($urunler as $urun){
                $indirimlifiyat = ($urun->discountType==1)?$urun->productPrice-($urun->productPrice*$urun->productDiscount)/100:($urun->productPrice-$urun->productDiscount);
                $resim = Picture::Where('productId',$urun->productId)->Where('pictureType',1)->first();
                $array[$urun->productId] = [
                    'id' => $urun->productId,
                    'resim' => $resim?'storage/uploads/products/picturecrop/'.$urun->productSeller.'/'.$resim->pictureUrl:'storage/uploads/products/picture/no-Image.png',
                    'ad' => $urun->productName,
                    'satici' => Seller::Where('sellerId',$urun->productSeller)->first()?Seller::Where('sellerId',$urun->productSeller)->first()->sellerName:null,
                    'birim' => $urun->productUnit,
                    'stok' => $urun->productNumber,
                    'fiyat' => $urun->productPrice,
                    'indirimlifiyat' => $indirimlifiyat,
                    'durum' => $urun->productStatus,
                ];
            }
            return view('/Admin/production/indirimliurunler',['urunler' => $array,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function slide(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $slide = Slide::get();
            return view('/Admin/production/slide',['resimler' => $slide,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function ucretlendirme(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $kdv = Pricing::Where('name','kdv')->first();
            $komisyon = Pricing::Where('name','komisyon')->first();
            return view('/Admin/production/ucretlendirme',['kdv' => isset($kdv)?$kdv->value:0,'komisyon'=>isset($komisyon)?$komisyon->value:0]);
        }else{
            return abort(404);
        }
    }
    public function toplamsiparisler(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $siparisler = Order::Where('orderStatus',1)->orderBy('created_at','desc')->get();
            $array = null;
            if(isset($siparisler) and $siparisler){
                foreach ($siparisler as $siparis){
                    $user = Seller::Where('sellerId',$siparis->productSeller)->first();
                    $urun = Product::Where('productId',$siparis->productId)->first();
                    $array[$siparis->id] = [
                        'urun' => isset($urun)?$urun->productName:null,
                        'satici' => isset($user)?$user->sellerName:null,
                        'adet' => $siparis->productNumber,
                        'tutar' => ((double)$siparis->productNumber*(double)$siparis->orderPrice)+(double)$siparis->sheepingFee+(double)$siparis->kdv,
                        'tarih' => substr($siparis->created_at,0,10),
                    ];
                }
            }
            return view('/Admin/production/toplamsiparisler')->with(['siparisler'=>$array,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function toplamkargoyaverilecekler(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            if($this->yonlendirme(Auth::user()->authority)){
                $siparisler = Order::Where('orderStatus',3)->orderBy('created_at','desc')->get();
                $array = null;
                if(isset($siparisler) and $siparisler){
                    foreach ($siparisler as $siparis){
                        $user = Seller::Where('sellerId',$siparis->productSeller)->first();
                        $urun = Product::Where('productId',$siparis->productId)->first();
                        $array[$siparis->id] = [
                            'urun' => isset($urun)?$urun->productName:null,
                            'satici' => isset($user)?$user->sellerName:null,
                            'adet' => $siparis->productNumber,
                            'tutar' => ((double)$siparis->productNumber*(double)$siparis->orderPrice)+(double)$siparis->sheepingFee+(double)$siparis->kdv,
                            'tarih' => substr($siparis->created_at,0,10),
                        ];
                    }
                }
                return view('/Admin/production/toplamkargoyaverilecekler')->with(['siparisler'=>$array,'page'=>$_GET['page']??1]);
            }else{
                return abort(404);
            }
        }else{
            return abort(404);
        }
    }
    public function toplamyapilansatislar(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $siparisler = Order::WhereIn('orderStatus',[4,5])->get();
            $array = null;
            if(isset($siparisler) and $siparisler){
                foreach ($siparisler as $siparis){
                    $urun = Product::Where('productId',$siparis->productId)->first();
                    $user = Seller::Where('sellerId',$urun->productSeller)->first();
                    $array[$siparis->id] = [
                        'urunid' => isset($urun)?$urun->productName:null,
                        'id' => $siparis->id,
                        'satici' => isset($user)?$user->sellerName:null,
                        'adet' => $siparis->productNumber,
                        'tutar' => ((double)$siparis->productNumber*(double)$siparis->orderPrice)+(double)$siparis->sheepingFee,
                        'tarih' => substr($siparis->created_at,0,10),
                        'durum' => $siparis->orderStatus,
                    ];
                }
            }
            return view('/Admin/production/toplamyapilansatislar',['siparisler' => $array,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function toplamyorumlar(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $saticilar = Seller::get()->toarray();
            return view('/Admin/production/toplamyorumlar',['saticilar' => $saticilar]);
        }else{
            return abort(404);
        }
    }
}
