<?php

namespace App\Http\Controllers;

use App\Models\Admin\City;
use App\Models\Admin\District;
use App\Models\Admin\SiteSetting;
use App\Models\Admin\Slide;
use App\Models\Basket;
use App\Models\Country;
use App\Models\FakeBasket;
use App\Models\Kategori;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Picture;
use App\Models\Pricing;
use App\Models\Product;
use App\Models\ProductComment;
use App\Models\ProductPoint;
use App\Models\Seller;
use App\Models\SellerWait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Comment;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return array
     */
    public function header(){

        $siteinfo = SiteSetting::all()->first();
        $array = null;
        $sepet = 0;
        if(Auth::user()){
            $urun = Basket::Where('userId',Auth::user()->id)->get();
            (isset($urun))?$sepet=count($urun):0;
            $satici = Seller::Where('userId',Auth::user()->id)->first();
            $bildirimler = Notification::Where('receiver',Auth::user()->id)->Where('view',0);
        }
        if(isset($siteinfo)){
            $array = [
                'logo' => isset($siteinfo->settingLogo)?'storage/uploads/logocrop/'.$siteinfo->settingLogo:null,
                'gsm' => isset($siteinfo->settingGsm)?$siteinfo->settingGsm:null,
                'mail' => isset($siteinfo->settingMail)?$siteinfo->settingMail:null,
                'facebook' => isset($siteinfo->settingFacebook)?$siteinfo->settingFacebook:null,
                'twitter' => isset($siteinfo->settingTwitter)?$siteinfo->settingTwitter:null,
                'google' => isset($siteinfo->settingGoogle)?$siteinfo->settingGoogle:null,
                'youtube' => isset($siteinfo->settingYoutube)?$siteinfo->settingYoutube:null,
                'sepet' => $sepet,
                'satici' => (isset($satici))?true:false,
                'toplambildirim' => isset($bildirimler)?count($bildirimler->get()->toarray()):null,
                'bildirimler' => isset($bildirimler)?$bildirimler->limit(3)->get()->toarray():null,
            ];
        }
        return $array;
    }
    public function kategori(){
        $ktg = Kategori::Where('status',1)->get();
        $kategoriler = null;
        if($ktg){
            foreach ($ktg as $kategori){
                if($kategori->categoryTop == 0 and Kategori::Where('categoryTop',$kategori->categoryId)->first()){
                    $kategoriler['ust'][$kategori->categoryId] = [
                        'id' => $kategori->categoryId,
                        'ad' => $kategori->categoryName,
                        'url' => $kategori->categoryUrl,
                        'icon' => $kategori->icon,
                        'aciklama' => $kategori->description,
                    ];
                }else{
                    $kategoriler[$kategori->categoryTop][$kategori->categoryId] =[
                        'id' => $kategori->categoryId,
                        'ad' => $kategori->categoryName,
                        'url' => $kategori->categoryUrl,
                        'icon' => $kategori->icon,
                        'aciklama' => $kategori->description,
                    ];
                }
            }
        }
        return $kategoriler;
    }
    public function indirimliurunler(){
        $iurunler = Product::Where('discountType','!=',0)->Where('productStatus',0)->get();
        $indirimliurunler = null;
        $count = 0;
        foreach ($iurunler as $urun){
            $indirimlifiyat = ($urun['discountType']!=0)?(($urun['discountType']==1)?$urun['productPrice']-($urun['productPrice']*$urun['productDiscount'])/100:($urun['productPrice']-$urun['productDiscount'])):null;
            $resim = Picture::Where('productId',$urun->productId)->Where('pictureType','1')->first();
            $indirimliurunler[$count] = [
                'id' => $urun['productId'],
                'ad' => $urun['productName'],
                'fiyat' => $urun['productPrice'],
                'indirimturu' => $urun['discountType'],
                'indirim' => $urun['productDiscount'],
                'indirimlifiyat' => $indirimlifiyat,
                'resim' => $resim?'storage/uploads/products/picturecrop/'.$urun->productSeller.'/'.$resim->pictureUrl:'storage/uploads/noImage/item-no-image.jpg',
            ];
            $count++;
        }

        return $indirimliurunler;
    }
    public function urunresimleri($id=null,$seller=null){
        $urunresimleri = null;
        if($id){
            $urun = Picture::Where('productId',$id)?Picture::Where('productId',$id)->get():null;
            if($urun){
                $count = 0;
                foreach ($urun as $item){
                    $urunresimleri[$count] = [
                        'id' => $item['pictureId'],
                        'resim' => $item['pictureUrl']?'storage/uploads/products/picturecrop/'.$seller.'/'.$item['pictureUrl']:'storage/uploads/noImage/item-no-image.jpg',

                    ];
                    $count++;
                }
            }
        }
        return $urunresimleri;
    }
    public function index()
    {
        $slide = Slide::all();
        $urunler = Product::orderBy('created_at','desc')->Where('productStatus',0)->limit(6)->get();
        $yeniurunler = null;
        foreach ($urunler as $urun){
            $indirimlifiyat = ($urun['discountType']!=0)?(($urun['discountType']==1)?$urun['productPrice']-($urun['productPrice']*$urun['productDiscount'])/100:($urun['productPrice']-$urun['productDiscount'])):null;
            $resim = Picture::Where('productId',$urun['productId'])->Where('pictureType','1')->first();
            $yeniurunler[$urun['productId']] = [
                'ad' => $urun['productName'],
                'aciklama' => $urun['productExplanation'],
                'fiyat' => $urun['productPrice'],
                'indirimturu' => $urun['discountType'],
                'indirim' => $urun['productDiscount'],
                'indirimlifiyat' => $indirimlifiyat,
                'resim' => $resim?'storage/uploads/products/picturecrop/'.$urun['productSeller'].'/'.$resim->pictureUrl:'storage/uploads/noImage/item-no-image.jpg',
            ];
        }
        return view('shopping/index')->with([
            'slide'=>$slide,
            'kategoriler'=> $this->kategori(),
            'header' => $this->header(),
            'yeniurunler'=>$yeniurunler,
            'indirimliurunler'=> $this->indirimliurunler(),
        ]);
    }
    public function urundetay()
    {
        if(isset($_GET) and isset($_GET['urun'])){
            $urun = Product::Where('productId',$_GET['urun'])->first();
            if(isset($urun)){
                $indirimlifiyat = ($urun->discountType!=0)?(($urun->discountType==1)?$urun->productPrice-($urun->productPrice*$urun->productDiscount)/100:($urun->productPrice-$urun->productDiscount)):null;
                $satici = Seller::Where('sellerId',$urun->productSeller)->first();
                $urundetay = [
                    'id' => isset($urun->productId)?$urun->productId:null,
                    'ad' => isset($urun->productName)?$urun->productName:null,
                    'aciklama' => isset($urun->productExplanation)?$urun->productExplanation:null,
                    'satici' => isset($satici)?$satici->sellerName:null,
                    'fiyat' => isset($urun->productPrice)?$urun->productPrice:null,
                    'stok' => isset($urun->productNumber)?$urun->productNumber:null,
                    'birim' => isset($urun->productUnit)?$urun->productUnit:null,
                    'indirimturu' => isset($urun->discountType)?$urun->discountType:null,
                    'indirim' => isset($urun->productDiscount)?$urun->productDiscount:null,
                    'indirimlifiyat' => $indirimlifiyat,
                    'kargoucret' => isset($urun->shippingFee)?$urun->shippingFee:null,
                    'resim' => $urun['productCatalog']?'storage/uploads/products/picturecrop/'.$urun['productSeller'].'/'.$urun['productCatalog']:'storage/uploads/products/picture/no-image.png',
                ];

                $urunyorumlari = ProductComment::Where('productId',$urun->productId)->Where('checked',2)->get();
                $urunyorum = null;
                $urunpuan = 0;
                if(isset($urunyorumlari)){
                    foreach ($urunyorumlari as $value){
                        $yorumyapan = User::Where('id',$value->userId)->first();
                        $urunyorum[$value->commentId] = [
                            'yorumyapan' => isset($yorumyapan)?$yorumyapan->name.' '.$yorumyapan->surname:null,
                            'yorum' => isset($value->commentDetail)?$value->commentDetail:null,
                            'puan' => isset($value->point)?$value->point:null,
                            'tarih' =>  isset($value->created_at)?substr($value->created_at,0,10):null,
                            'resim' => (isset($yorumyapan) and isset($yorumyapan->picture))?'storage/uploads/users/profileimagecrop/'.$yorumyapan->picture:'storage/uploads/users/profileimage/no-image.jpg',
                        ];
                        $urunpuan += (int)($value->point);
                    }
                    $urunpuan = $urunpuan!=0?(float)($urunpuan/count($urunyorumlari)):0;
                }
                return view('shopping/urun-detay')->with([
                    'kategoriler'=> $this->kategori(),
                    'header' => $this->header(),
                    'indirimliurunler'=> $this->indirimliurunler(),
                    'urundetay' => $urundetay,
                    'urunresimleri' => $this->urunresimleri($urun->productId,$urun->productSeller),
                    'urunyorum' => $urunyorum,
                    'urunpuan' => $urunpuan,
                ]);
            }else{
                return Redirect::to('/');
            }
        }else{
            return Redirect::to('/');
        }

    }
    public function urunlistedata($urunliste=null){
        if($urunliste){
            $urunler = null;
            foreach ($urunliste as $item) {
                $indirimlifiyat = ($item->discountType!=0)?(($item->discountType==1)?$item->productPrice-($item->productPrice*$item->productDiscount)/100:($item->productPrice-$item->productDiscount)):null;
                $resim = Picture::Where('productId',$item->productId)->Where('pictureType','1')->first();
                $urunler[$item->productId] = [
                    'id' => (isset($item->productId))?$item->productId:null,
                    'ad' => (isset($item->productName))?$item->productName:null,
                    'aciklama' => (isset($item->productExplanation))?$item->productExplanation:null,
                    'fiyat' => (isset($item->productPrice))?$item->productPrice:null,
                    'indirimturu' => (isset($item->discountType))?$item->discountType:null,
                    'indirim' => (isset($item->productDiscount))?$item->productDiscount:null,
                    'indirimlifiyat' => (isset($indirimlifiyat))?$indirimlifiyat:null,
                    'resim' => $resim?'storage/uploads/products/picturecrop/'.$item->productSeller.'/'.$resim->pictureUrl:'storage/uploads/noImage/item-no-image.jpg',

                ];
            }
            return $urunler;
        }else{
            return false;
        }
    }
    public function urunliste()
    {
        if ($_GET['kategori']) {
            $kategori = Kategori::Where('categoryId',$_GET['kategori'])->first();
            if (isset($kategori) and $kategori->categoryTop == 0) {
                $kategoriler = Kategori::Where('categoryTop',$_GET['kategori'])->get();
                if(isset($kategoriler)){
                    $list = array();
                    foreach ($kategoriler as $item){
                        array_push($list,$item->categoryId);
                    }
                    $urunler = Product::Where('productStatus',0)->WhereIn('productCategory',$list)->get();
                    if (isset($urunler)) {
                        return view('shopping/urun-liste')->with([
                            'kategoriler' => $this->kategori(),
                            'header' => $this->header(),
                            'urunler' => $this->urunlistedata($urunler),
                            'page' => $_GET['sayfa']??1,
                            'kategori' => $_GET['kategori'],
                        ]);
                    }else{
                        return Redirect::to('/');
                    }
                }else {
                    return Redirect::to('/');
                }
            } else if (isset($kategori) and $kategori->categoryTop != 0) {
                $urunler = Product::Where('productStatus',0)->Where('productCategory',$_GET['kategori'])->get();
                if (isset($urunler)) {
                    return view('shopping/urun-liste')->with([
                        'kategoriler' => $this->kategori(),
                        'header' => $this->header(),
                        'urunler' => $this->urunlistedata($urunler),
                        'page' => $_GET['sayfa']??1,
                        'kategori' => $_GET['kategori'],
                    ]);
                }else{
                    return Redirect::to('/');
                }
            }else{
                return Redirect::to('/');
            }
        }
    }
    public function sepet(){
        if(Auth::user()){
            $sepet = null;
            $toplam = 0;
            $sepeturunler = Basket::Where('userId',Auth::user()->id)->get();
            if(isset($sepeturunler)){
                foreach($sepeturunler as $item){
                    $urun = Product::Where('productId',$item->productId)->first();
                    if(isset($urun)){
                        $fiyat = ($urun->discountType!=0)?(($urun->discountType==1)?$urun->productPrice-($urun->productPrice*$urun->productDiscount)/100:($urun->productPrice-$urun->productDiscount)):$urun->productPrice;
                        $satici = Seller::Where('sellerId',$urun->productSeller)->first();
                        $sepet[$item->id] = [
                            'ad' => $urun->productName,
                            'fiyat' => $fiyat,
                            'resim' => isset($urun->productCatalog)?'storage/uploads/products/picturecrop/'.$urun->productSeller.'/'.$urun->productCatalog:'storage/uploads/products/picture/no-image.jpg',
                            'satici' => isset($satici)?$satici->sellerName:null,
                            'kargo' => isset($urun->shippingFee)?$urun->shippingFee:0,
                            'adet' => $item->productNumber,
                        ];
                        $toplam += ((isset($fiyat)?(double)($fiyat):0)*(isset($item->productNumber)?(double)($item->productNumber):0))+(isset($urun->shippingFee)?(double)$urun->shippingFee:0);
                    }
                }
            }
            $kdv = Pricing::Where('name','kdv')->first()?Pricing::Where('name','kdv')->first()->value:0;
            $sepethesap =  $this->sepethesapla();
            $kdvtutar = isset($kdv)?((double)$kdv*(double)$sepethesap)/100:0;
            return view('shopping/sepet')->with([
                'kategoriler' => $this->kategori(),
                'header' => $this->header(),
                'sepet' => $sepet,
                'kdv' => $kdvtutar,
                'kdvoran'=> $kdv,
                'geneltoplam' => (double)$kdvtutar+(double)$sepethesap,
                'toplam' => $sepethesap,
                'indirimliurunler'=> $this->indirimliurunler(),
            ]);
        }
        return back();
    }
    public function sepeteekle($id=null)
    {
        if(Auth::user() and $id){
            $mevcutmu = Basket::Where('userId',Auth::user()->id)->Where('productId',$id)->first();
            if(!isset($mevcutmu)){
                $sepet = new Basket();
                $sepet->userId = Auth::user()->id?Auth::user()->id:null;
                $sepet->productId = $id?$id:null;
                $sepet->productNumber = 1;
                if(!$sepet->save()){
                    return view('/shopping/hata',['hatatur' => 'sepeteeklenemedi']);
                }
                return Redirect::to('/sepet');
            }else{
                $sayi = isset($mevcutmu->productNumber)?$mevcutmu->productNumber:0;
                $sepet = $mevcutmu->Update([
                    'productNumber' => $sayi+1,
                ]);
                if(!$sepet){
                    return view('/shopping/hata',['hatatur' => 'sepeteeklenemedi']);
                }
                return Redirect::to('/sepet');
            }
        }
        return back();
    }
    public function sepethesapla(){
        $sepet =Basket::Where('userId',Auth::user()->id)->get();
        $tutar = 0;
        if(isset($sepet)){
            foreach ($sepet as $item) {
                $sayi = isset($item->productNumber)?$item->productNumber:0;
                $urun = Product::Where('productId',$item->productId)->first();
                $fiyat = ($urun->discountType!=0)?(($urun->discountType==1)?$urun->productPrice-($urun->productPrice*$urun->productDiscount)/100:($urun->productPrice-$urun->productDiscount)):$urun->productPrice;
                $tutar += (double)$sayi*(isset($fiyat)?(double)$fiyat:0)+(isset($urun->shippingFee)?(double)$urun->shippingFee:0);
            }
        }
        return $tutar;
    }
    public function odemehesapla(){
        $sepet =Basket::Where('userId',Auth::user()->id)->get();
        $tutar = 0;
        if(isset($sepet)){
            foreach ($sepet as $item) {
                $sayi = isset($item->productNumber)?$item->productNumber:0;
                $urun = Product::Where('productId',$item->productId)->first();
                $fiyat = ($urun->discountType!=0)?(($urun->discountType==1)?$urun->productPrice-($urun->productPrice*$urun->productDiscount)/100:($urun->productPrice-$urun->productDiscount)):$urun->productPrice;
                $tutar += (double)$sayi*(isset($fiyat)?(double)$fiyat:0)+(isset($urun->shippingFee)?(double)$urun->shippingFee:0);
            }
        }
        $kdv = Pricing::Where('name','kdv')->first()?Pricing::Where('name','kdv')->first()->value:0;
        $kdvtutar = isset($kdv)?((double)$kdv*(double)$tutar)/100:0;
        $geneltop = number_format((double)$kdvtutar+(double)$tutar,2);
        return $geneltop;
    }
    public function urunfiyathesapla($id=null){
        $urun = Product::Where('productId',$id)->first();
        $fiyat = ($urun->discountType!=0)?(($urun->discountType==1)?$urun->productPrice-($urun->productPrice*$urun->productDiscount)/100:($urun->productPrice-$urun->productDiscount)):$urun->productPrice;
        return $fiyat;
    }
    public function sepetguncelle($id=null)
    {
        if(Auth::user() and $id and $_GET['adet']){
            $mevcutmu = Basket::Where('userId',Auth::user()->id)->Where('id',$id)->first();
            $urun = Product::Where('productId',$mevcutmu->productId)->first();
            if(isset($mevcutmu) and isset($urun)){
                $adet = (int)$_GET['adet'];
                if($_GET['adet'] == "-1") { $adet = -1; }
                $sayi = (isset($mevcutmu->productNumber)?(int)$mevcutmu->productNumber:0)+$adet;
                if($sayi > 0){
                    $fiyat = ($urun->discountType!=0)?(($urun->discountType==1)?$urun->productPrice-($urun->productPrice*$urun->productDiscount)/100:($urun->productPrice-$urun->productDiscount)):$urun->productPrice;
                    $data = null;
                    $kdv = Pricing::Where('name','kdv')->first()?Pricing::Where('name','kdv')->first()->value:0;
                    if($sayi <= $urun->productNumber){
                        $sepet = $mevcutmu->Update([
                            'productNumber' => $sayi,
                        ]);
                        if($sepet){
                            $sepethesap =  $this->sepethesapla();
                            $kdvtutar = isset($kdv)?((double)$kdv*(double)$sepethesap)/100:0;
                            $data = [
                                'artifiyat' => number_format($sepethesap,2),
                                'adet' => $sayi,
                                'kdv' => number_format($kdvtutar,2),
                                'geneltoplam' =>  number_format((double)$kdvtutar+(double)$sepethesap,2),
                            ];
                            return json_encode($data);
                        }
                    }else{
                        $sepet = $mevcutmu->Update([
                            'productNumber' => $urun->productNumber,
                        ]);
                        if($sepet){
                            $sepethesap =  $this->sepethesapla();
                            $kdvtutar = isset($kdv)?((double)$kdv*(double)$sepethesap)/100:0;
                            $data = [
                                'artifiyat' => number_format($sepethesap,2),
                                'adet' => isset($mevcutmu->productNumber)?$mevcutmu->productNumber:0,
                                'kdv' => number_format($kdvtutar,2),
                                'geneltoplam' => number_format((double)$kdvtutar+(double)$sepethesap,2),
                            ];
                        }
                        return json_encode($data);
                    }

                }

            }
        }
    }
    public function sepetguncelle2($id=null)
    {
        if(Auth::user() and $id and $_GET['adet']){
            $mevcutmu = Basket::Where('userId',Auth::user()->id)->Where('id',$id)->first();
            $urun = Product::Where('productId',$mevcutmu->productId)->first();
            if(isset($mevcutmu) and isset($urun)){
                $sayi = (int)$_GET['adet'];
                if($sayi > 0){
                    $fiyat = ($urun->discountType!=0)?(($urun->discountType==1)?$urun->productPrice-($urun->productPrice*$urun->productDiscount)/100:($urun->productPrice-$urun->productDiscount)):$urun->productPrice;
                    $kdv = Pricing::Where('name','kdv')->first()?Pricing::Where('name','kdv')->first()->value:0;
                    $data = null;
                    if($sayi <= $urun->productNumber){
                        $sepet = $mevcutmu->Update([
                            'productNumber' => $sayi,
                        ]);
                        if($sepet){
                            $sepethesap =  $this->sepethesapla();
                            $kdvtutar = isset($kdv)?((double)$kdv*(double)$sepethesap)/100:0;
                            $data = [
                                'artifiyat' => number_format($sepethesap,2),
                                'adet' => $sayi,
                                'kdv' => number_format($kdvtutar,2),
                                'geneltoplam' =>  number_format((double)$kdvtutar+(double)$sepethesap,2),
                            ];
                            return json_encode($data);
                        }
                    }else{
                        $sepet = $mevcutmu->Update([
                            'productNumber' => $urun->productNumber,
                        ]);
                        if($sepet){
                            $sepethesap =  $this->sepethesapla();
                            $kdvtutar = isset($kdv)?((double)$kdv*(double)$sepethesap)/100:0;
                            $data = [
                                'artifiyat' => number_format($sepethesap,2),
                                'adet' => isset($mevcutmu->productNumber)?$mevcutmu->productNumber:0,
                                'kdv' => number_format($kdvtutar,2),
                                'geneltoplam' =>  number_format((double)$kdvtutar+(double)$sepethesap,2),
                            ];
                        }
                        return json_encode($data);
                    }
                }
            }
        }
    }
    public function sepetsil($id=null)
    {
        if(Auth::user() and $id){
            $mevcutmu = Basket::Where('userId',Auth::user()->id)->Where('id',$id)->first();
            $urun = Product::Where('productId',$mevcutmu->productId)->first();
            if(isset($mevcutmu) and isset($urun)){
                $data = null;
                $delete = $mevcutmu->Delete();
                if($delete){
                    return true;
                }
            }
        }
    }
    public function sepeturunleri(){
        $sepet =Basket::Where('userId',Auth::user()->id)->get();
        $urunler = null;
        $count = 0;
        if(isset($sepet)){
            foreach ($sepet as $item) {
                $urun = Product::Where('productId',$item->productId)->first();
                $urunler[$count] =[
                    'sayi' => isset($item->productNumber)?$item->productNumber:0,
                    'urun' => isset($item->productId)?$item->productId:0,
                    'kargo' => isset($urun->shippingFee)?(double)$urun->shippingFee:0,
                    'fiyat' => ($urun->discountType!=0)?(($urun->discountType==1)?$urun->productPrice-($urun->productPrice*$urun->productDiscount)/100:($urun->productPrice-$urun->productDiscount)):$urun->productPrice,
                ];
                $count++;
            }
        }
        return $urunler;
    }
    public function alisveristamamla(){
        if(Auth::user()){
            $sepet =Basket::Where('userId',Auth::user()->id)->get();
            FakeBasket::Where('userId',Auth::user()->id)->Delete();
            if(isset($sepet) and $sepet){
                foreach ($sepet as $item) {
                    $fakebasket = new FakeBasket();
                    $fakebasket->userId = isset($item->userId)?$item->userId:null;
                    $fakebasket->productId = isset($item->productId)?$item->productId:null;
                    $fakebasket->productNumber = isset($item->productNumber)?$item->productNumber:1;
                    $fakebasket->save();
                }
            }
            return view('shopping/alisveris-tamamla')->with([
                'ulkeler' => Country::get(),
                'sepeturunler' => ($sepet->first())?true:false,
                'kategoriler' => $this->kategori(),
                'header' => $this->header(),
                'indirimliurunler'=> $this->indirimliurunler(),
            ]);
        }
        return Redirect::to('/girisyap');
    }
    public function odemeonayla(){
        $konum = null;
        if(isset($_POST['ulke']) and  $_POST['ulke'] == 223){
            $sehirler = City::Where('cityId',$_POST['il'])->first();
            $sehir = isset($sehirler)?$sehirler->name:null;
            $ilceler = District::Where('districtId',$_POST['ilce'])->first();
            $ilce = isset($ilceler)?$ilceler->name:null;
            $konum = $sehir.'/'.$ilce;
        }else{
            $konum = $_POST['il2'];
        }
        if(Auth::user()){
            $ordersdetail = new OrderDetail();
            $ordersdetail->userId = Auth::user()->id;
            $ordersdetail->name = $_POST['ad'];
            $ordersdetail->surname = $_POST['sad'];
            $ordersdetail->country = $_POST['ulke'];
            $ordersdetail->location	 = $konum;
            $ordersdetail->adress = $_POST['adres'];
            $ordersdetail->tel = $_POST['tel'];
            $ordersdetail->cartNo = $_POST['kartno'];
            $ordersdetail->cartName = $_POST['kartad'];
            $ordersdetail->moon = $_POST['ay'];
            $ordersdetail->year = $_POST['yil'];
            $ordersdetail->cvv = $_POST['cvv'];
            if($ordersdetail->save()){
                $id = OrderDetail::Where('userId',Auth::user()->id)->orderBy('created_at','desc')->first();
                if(isset($id)){
                    $fakebasket = FakeBasket::Where('userId',Auth::user()->id)->get();
                    if(isset($fakebasket) and $fakebasket){
                        $kdv = Pricing::Where('name','kdv')->first()?Pricing::Where('name','kdv')->first()->value:0;
                        foreach ($fakebasket as $item){
                            $urun = Product::Where('productId',$item->productId)->first();
                            $fiyat = (double)(isset($urun)?$urun->shippingFee?$urun->shippingFee:0:0)+(double)$this->urunfiyathesapla($item->productId);
                            $kdvtutar = isset($kdv)?((double)$kdv*(double)$fiyat)/100:0;
                            $order = new Order();
                            $order->userId = Auth::user()->id;
                            $order->orderNo = $id->id;
                            $order->orderStatus = 1;
                            $order->productId = $item->productId;
                            $order->productSeller = isset($urun)?$urun->productSeller:null;
                            $order->productNumber = $item->productNumber;
                            $order->orderPrice = $this->urunfiyathesapla($item->productId);
                            $order->kdv = (double)$kdvtutar;
                            $order->sheepingFee = isset($urun)?$urun->shippingFee?$urun->shippingFee:0:0;
                            $order->save();
                        }
                    }
                }
                FakeBasket::Where('userId',Auth::user()->id)->Delete();
                Basket::Where('userId',Auth::user()->id)->Delete();
                return Redirect::to('/siparisler');
            }else{
                return view('/shopping/hata',['hatatur' => 'siparisonaylanmadi']);
            }

        }
    }
    public function ulkesec(){
        $sehirler = City::select('cityId','name')->get();
        return json_encode($sehirler);
    }
    public function sehirsec($id=null){
        if($id){
            $ilceler = District::select('districtId','name')->Where('cityId',$id)->get();
            return json_encode($ilceler);
        }
    }
    public function siparisler(){
        if(Auth::user()){
            $siparisler = Order::Where('userId',Auth::user()->id)->Where('orderStatus','!=',5)->orderBy('created_at','desc')->get();
            $array = null;
            if(isset($siparisler) and $siparisler){
                foreach ($siparisler as $item) {
                    $urun = Product::Where('productId',$item->productId)->first();
                    $resim = Picture::Where('productId',$item->productId)->Where('pictureType','1')->first();
                    $array[$item->id] = [
                        'resim' => $resim?'storage/uploads/products/picturecrop/'.$item->productSeller.'/'.$resim->pictureUrl:'storage/uploads/noImage/item-no-image.jpg',
                        'ad' => $urun?$urun->productName:null,
                        'durum' => $item->orderStatus,
                        'adet' => $item->productNumber,
                        'tutar' => ((double)($item->orderPrice)*(double)($item->productNumber))+(double)($item->sheepingFee?$item->sheepingFee:0)+(double)($item->kdv?$item->kdv:0),
                    ];
                }
            }
            return view('shopping/siparisler')->with([
                'siparisler' => $array,
                'kategoriler' => $this->kategori(),
                'header' => $this->header(),
                'indirimliurunler'=> $this->indirimliurunler(),
            ]);
        }else{
            return Redirect::to('/');
        }
    }
    public function hesabim(){
        if(Auth::user()){
            $returnArray = null;
            $returnArray =[
                'id'=> Auth::user()->id ?? null,
                'ad' => Auth::user()->name ?? null,
                'sad' => Auth::user()->surname ?? null,
                'mail' => Auth::user()->email ?? null,
                'yetki' => Auth::user()->authority ?? null,
                'tc' => Auth::user()->tcNo ?? null,
                'tel' => Auth::user()->tel ?? null,
                'gsm' => Auth::user()->gsm ?? null,
                'resim' => Auth::user()->picture?'storage/uploads/users/profileimagecrop/'.Auth::user()->picture:'storage/uploads/users/profileimage/no-image.jpg',
                'ulke' => Auth::user()->country ?? null,
                'sehir' => Auth::user()->city ?? null,
                'ilce' => Auth::user()->district ?? null,
                'ikamet' => Auth::user()->residing ?? null,
                'cinsiyet' => Auth::user()->gender ?? null,
                'dogumtarihi' => Auth::user()->birthDate ?? null,
            ];
            return view('shopping/hesabim')->with([
                'hesap' => $returnArray,
                'kategoriler' => $this->kategori(),
                'header' => $this->header(),
            ]);
        }
        return Redirect::to('/');
    }
    public function hesapkaydet(){
        $user = User::Where('id',Auth::user()->id);
        if(Auth::user() and isset($user)){
            $user->Update([
                'name' => $_POST['ad'],
                'surname' => $_POST['sad'],
                'tcNo' => $_POST['tc'],
                'tel' => $_POST['tel'],
                'gsm' => $_POST['gsm'],
                'gender' => $_POST['cinsiyet']??null,
            ]);
            return back();
        }
        return Redirect::to('/');
    }
    public function yorumlarim(){
        if(Auth::user()){
            return view('shopping/yorumlarim')->with([
                'kategoriler' => $this->kategori(),
                'header' => $this->header(),
            ]);
        }
        return Redirect::to('/');
    }
    public function mesajlarim(){
        if(Auth::user()){
            $mesajlar = Notification::Where('receiver',Auth::user()->id)->get()->toarray();
            return view('shopping/mesajlarim')->with([
                'mesajlar' => isset($mesajlar)?$mesajlar:null,
                'kategoriler' => $this->kategori(),
                'header' => $this->header(),
            ]);
        }
        return Redirect::to('/');
    }
    public function mesajgoruntule(){
        if(Auth::user() and $_GET['id']){
            $mesaj = Notification::Where('id',$_GET['id'])->Where('receiver',Auth::user()->id);
            (isset($mesaj))?$mesaj->Update([
                'view' => 1,
            ]):null;
            return view('shopping/mesajgoruntule')->with([
                'mesaj' => isset($mesaj)?$mesaj->first()->toarray():null,
                'kategoriler' => $this->kategori(),
                'header' => $this->header(),
            ]);
        }
        return Redirect::to('/');
    }
    public function saticiBeklemeKontrol($id=null){
        $wait = SellerWait::Where('userId',$id)->orderBy('created_at','desc')->first();
        $durum = '0';
        if(isset($wait)){
            switch ($wait->status){
                case 1: $durum='1';break;
                case 2: $durum='2';break;
                case 3: $durum='3';break;
                case 4: $durum='4';break;
                default:$durum='0';break;
            }
        }
        return $durum;
    }
    public function saticiol(){
        $id = (Auth::user())?Auth::user()->id:null;
        if($id){
            $seller = Seller::Where('userId',$id)->first();
            if(!isset($seller)){
                return view('shopping/saticiol')->with([
                    'durum' => $this->saticiBeklemeKontrol($id),
                    'kategoriler' => $this->kategori(),
                    'header' => $this->header(),
                ]);
            }else{
                return Redirect::to('/satici');
            }
        }
        return Redirect::to('/');
    }
    public function saticibasvuru(){
        $id = (Auth::user())?Auth::user()->id:null;
        if($id){
            $seller = new SellerWait();
            $seller->userId = $id;
            $seller->sellerName	 = $_POST['saticiunvan'];
            $seller->accountName = $_POST['hesapsahibi'];
            $seller->accountNumber = $_POST['hesapno'];
            $seller->taxOffice = $_POST['vergidairesi'];
            $seller->taxNumber = $_POST['vergino'];
            $seller->status = 3;
            $seller->type = 1;
            if($seller->save()){
                return Redirect::to('/basvurularim');
            }
            return view('/shopping/hata',['hatatur' => 'basvuruolusturulamadi']);
        }
        return Redirect::to('/');
    }
    public function basvurularim(){
        $id = (Auth::user())?Auth::user()->id:null;
        if($id){
            $wait = SellerWait::Where('userId',$id)->get();
            return view('shopping/basvurularim')->with([
                'basvurular' => isset($wait)?$wait:null,
                'kategoriler' => $this->kategori(),
                'header' => $this->header(),
            ]);
        }
        return Redirect::to('/');
    }
    public function urunara($text=null){
        if($text){
            $urunler = Product::Select('productCatalog','productName','productSeller','productId')->Where('productName','Like',"%{$text}%")->limit(5)->get()->toarray();
            return $urunler;
        }
    }
    public function yorumyap(){
        $id = (Auth::user())?Auth::user()->id:null;
        if($id and $_POST['id']){
            $yorum = new ProductComment();
            $yorum->userId = $id;
            $yorum->productId = $_POST['id'];
            $yorum->productSeller =Product::Where('productId',$_POST['id'])->first()?Product::Where('productId',$_POST['id'])->first()->productSeller:null;
            $yorum->point = $_POST['rating2'];
            $yorum->commentDetail = $_POST['yorum'];
            $yorum->checked = 1;
            $yorum->save();
            return back();
        }
        return back();
    }
    public function girisyap()
    {
        if(!Auth::user()){
            return view('shopping/girisyap')->with([
                'kategoriler' => $this->kategori(),
                'header' => $this->header(),
            ]);
        }
        return back();
    }
}
