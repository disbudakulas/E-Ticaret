<?php

namespace App\Http\Controllers\Satici;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Kategori;
use App\Models\Picture;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class productController extends Controller
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
    public function saticiurunduzenle(Request $request)
    {
        if($this->yonlendirme(Auth::user()->authority)){
            $saticilar = Seller::all();
            $kategoriler = Kategori::Where('categoryTop','!=',0)->get();

            if($_GET){
                $urun = Product::Where('productId',$_GET['id'])->first();
                if($urun and $urun->productSeller==Seller::Where('userId',Auth::user()->id)->first()->sellerId){
                    $resimkatalog = Picture::Where('productId',$urun->productId)->Where('pictureType',1)->first();
                    return view('/admin/satici/saticiurunduzenle',['icerik' => $urun,'saticilar' => $saticilar,'kategoriler' => $kategoriler, 'resimkatalog'=>$resimkatalog?'storage/uploads/products/picturecrop/'.Product::Where('productId',$urun->productId)->first()->productSeller.'/'.$resimkatalog->pictureUrl:null]);
                }else{
                    return Redirect::to('/saticiurunler');
                }
            }else{
                return view('/admin/satici/saticiurunduzenle',['saticilar' => $saticilar,'kategoriler' => $kategoriler, 'resimkatalog'=>null]);
            }
        }else{
            return abort(404);
        }
    }
    public function saticiurunsil(Request $request)
    {
        if($this->yonlendirme(Auth::user()->authority)){
            if($_GET){
                $seller = Seller::Where('userId',Auth::user()->id)->first();
                $urun = Product::Where('productId',$_GET['id'])->Where('productSeller',$seller?$seller->sellerId:null);
                if(isset($urun) and $urun){
                    $urun->update([
                        'productStatus' => 1,
                    ]);
                    return back();
                }else{
                    return back();
                }
            }else{
                return back();
            }
        }else{
            return abort(404);
        }
    }
    public function saticiurunresmiduzenle(Request $request)
    {
        if($this->yonlendirme(Auth::user()->authority)){
            $urun = Product::Where('productId',$_POST['id'])->first();
            if($urun and $urun->productSeller==Seller::Where('userId',Auth::user()->id)->first()->sellerId){
                $update = Product::Where('productId',$_POST['id'])->Update([
                    'productName' => $_POST['urunadi'],
                    'productCategory' => $_POST['kategori'],
                    'productUnit' => $_POST['birim'],
                    'productNumber' => $_POST['stok'],
                    'productPrice' => str_replace(',','',$_POST['birimfiyati']??0),
                    'productExplanation' => $_POST['urunaciklama'],
                    'discountType' => $_POST['indirimturu'],
                    'productDiscount' => ($_POST['indirimturu'] == 1)?$_POST['indirim']%100:$_POST['indirim'],
                    'shippingFee' => $_POST['kargoucreti'],
                    'productStatus' => $_POST['durum'],
                ]);
                if(!$update){
                    return view('/admin/satici/hata',['hatatur' => 'uruneklenemedi']);
                }
                $id = $_POST['id'];
            }else{
                $yeniurun = new Product();
                $yeniurun->productSeller = Seller::Where('userId',Auth::user()->id)->first()->sellerId;
                $yeniurun->productName = $_POST['urunadi'];
                $yeniurun->productCategory = $_POST['kategori'];
                $yeniurun->productUnit = $_POST['birim'];
                $yeniurun->productNumber = $_POST['stok'];
                $yeniurun->productPrice = str_replace(',','',$_POST['birimfiyati']);
                $yeniurun->productExplanation = $_POST['urunaciklama'];
                $yeniurun->discountType = $_POST['indirimturu'];
                $yeniurun->productDiscount = ($_POST['indirimturu'] == 1)?$_POST['indirim']%100:$_POST['indirim'];
                $yeniurun->shippingFee = $_POST['kargoucreti'];
                $yeniurun->productStatus = $_POST['durum'];
                if(!$yeniurun->save()){
                    return view('/admin/satici/hata',['hatatur' => 'uruneklenemedi']);
                }
                $id = Product::Where('productSeller',Seller::Where('userId',Auth::user()->id)->first()->sellerId)->orderBy('created_at','desc')->first()->productId;
            }
            if($request->file()){
                $nameold=null;
                $picture = Picture::Where('productId',$id)->Where('pictureType',1)->first();
                $picname = str_replace([' ',':','.','-'],'',substr(Carbon::now(),0,19)).'.jpg';
                if($picture){
                    $nameold = $picture->pictureUrl;
                    $pupdate = Picture::Where('productId',$id)->Where('pictureType',1)->Update([
                        'pictureUrl' => ($request->file())?$picname:null,
                    ]);
                    if(!$pupdate){
                        return view('/admin/satici/hata',['hatatur' => 'urunresmieklenemedi']);
                    }
                }else{
                    $picturenew = new Picture();
                    $picturenew->productId = $id;
                    $picturenew->pictureType = 1;
                    $picturenew->pictureUrl = ($request->file())?$picname:null;
                    if(!$picturenew->save()){
                        return view('/admin/satici/hata',['hatatur' => 'urunresmieklenemedi']);
                    }
                }

                $resim = $_FILES['urunkatalog']['tmp_name'];
                $baslangic_x = $_POST['x'];
                $baslangic_y = $_POST['y'];
                $genislik = $_POST['w'];
                $yukseklik = $_POST['h'];
                switch (mime_content_type ($resim)){
                    case "image/jpeg": $img_orig = imagecreatefromjpeg($resim);break;
                    case "image/gif": $img_orig = imagecreatefromgif($resim);break;
                    case "image/png": $img_orig = imagecreatefrompng($resim);break;
                    case "image/webp": $img_orig = imagecreatefromwebp($resim);break;
                    case "image/x-ms-bmp": $img_orig = imagecreatefrombmp($resim);break;
                    default : return view('/Admin/production/hata',['hatatur' => 'resimformatidesteklenmemektedir']);
                }
                header("Content-type: picture/jpeg");
                $img_kes = imagecreatetruecolor($genislik,$yukseklik);
                list($gen, $yuk) = getimagesize($resim);
                imagecopyresized($img_kes, $img_orig, 0, 0, $baslangic_x, $baslangic_y, $gen, $yuk, $gen, $yuk);

                $g_img = imagecreatetruecolor($genislik, $yukseklik);

                if($nameold){
                    Storage::delete('public/uploads/products/picture/'.Seller::Where('userId',Auth::user()->id)->first()->sellerId.'/'.$nameold);
                    Storage::delete('public/uploads/products/picturecrop/'.Seller::Where('userId',Auth::user()->id)->first()->sellerId.'/'.$nameold);
                }


                $request->file('urunkatalog')->storeAs('public/uploads/products/picture/'.Seller::Where('userId',Auth::user()->id)->first()->sellerId.'/',$picname);
                if(!file_exists('../storage/app/public/uploads/products/picturecrop/'.Seller::Where('userId',Auth::user()->id)->first()->sellerId)){
                    Storage::makeDirectory('public/uploads/products/picturecrop/'.Seller::Where('userId',Auth::user()->id)->first()->sellerId);
                }
                imagepng($img_kes,'../storage/app/public/uploads/products/picturecrop/'.Seller::Where('userId',Auth::user()->id)->first()->sellerId.'/'.$picname);
            }
            $resimliste = Picture::Where('productId',$id)->Where('pictureType','!=',1)->get();
            return view('/admin/satici/saticiurunresmiduzenle',['id'=>$id, 'resimliste'=>$resimliste, 'page'=>1]);
        }else{
            return abort(404);
        }
    }
    public function saticiurunresimekle(Request $request)
    {
        if($this->yonlendirme(Auth::user()->authority)){
            $urun = Product::Where('productId',$_POST['id'])->first();
            $id = $_POST['id'];
            if($urun and Seller::Where('sellerId',$urun->productSeller)->first()->userId == Auth::user()->id){
                if($request->file()){
                    $picname = str_replace([' ',':','.','-'],'',substr(Carbon::now(),0,19)).'.jpg';
                    $picturenew = new Picture();
                    $picturenew->productId = $id;
                    $picturenew->pictureType = 2;
                    $picturenew->pictureUrl = ($request->file())?$picname:null;
                    if(!$picturenew->save()){
                        return view('/admin/satici/hata',['hatatur' => 'urunresmieklenemedi']);
                    }

                    $resim = $_FILES['urunresim']['tmp_name'];
                    $baslangic_x = $_POST['x'];
                    $baslangic_y = $_POST['y'];
                    $genislik = $_POST['w'];
                    $yukseklik = $_POST['h'];
                    switch (mime_content_type ($resim)){
                        case "image/jpeg": $img_orig = imagecreatefromjpeg($resim);break;
                        case "image/gif": $img_orig = imagecreatefromgif($resim);break;
                        case "image/png": $img_orig = imagecreatefrompng($resim);break;
                        case "image/webp": $img_orig = imagecreatefromwebp($resim);break;
                        case "image/x-ms-bmp": $img_orig = imagecreatefrombmp($resim);break;
                        default : return view('/Admin/production/hata',['hatatur' => 'resimformatidesteklenmemektedir']);
                    }
                    header("Content-type: picture/jpeg");
                    $img_kes = imagecreatetruecolor($genislik,$yukseklik);
                    list($gen, $yuk) = getimagesize($resim);
                    imagecopyresized($img_kes, $img_orig, 0, 0, $baslangic_x, $baslangic_y, $gen, $yuk, $gen, $yuk);

                    $g_img = imagecreatetruecolor($genislik, $yukseklik);

                    $request->file('urunresim')->storeAs('public/uploads/products/picture/'.$urun->productSeller.'/',$picname);
                    if(!file_exists('../storage/app/public/uploads/products/picturecrop/'.$urun->productSeller)){
                        Storage::makeDirectory('public/uploads/products/picturecrop/'.$urun->productSeller);
                    }
                    imagepng($img_kes,'../storage/app/public/uploads/products/picturecrop/'.$urun->productSeller.'/'.$picname);
                }
                return redirect()->route('saticiurunresimlistesi',['id'=>$id]);

            }else{
                return Redirect::to('/saticiurunler');
            }

        }else{
            return abort(404);
        }
    }
    public function saticiurunresimlistesi(){
        if($this->yonlendirme(Auth::user()->authority)){
            $urun = Product::Where('productId',$_GET['id'])->first();
            if($urun and Seller::Where('sellerId',$urun->productSeller)->first()->userId == Auth::user()->id)
            {
                $resimliste = Picture::Where('productId',$_GET['id'])->Where('pictureType','!=',1)->get();
                return view('/admin/satici/saticiurunresmiduzenle',['id'=>$_GET['id'], 'resimliste'=>$resimliste, 'page'=>1]);
            }else{
                return Redirect::to('/saticiurunler');
            }
        }else{
            return abort(404);
        }
    }
    public function saticiurunresmisil(){
        if($this->yonlendirme(Auth::user()->authority)){
            $resimliste = Picture::Where('pictureId',$_GET['id'])->first();
            if($resimliste and Seller::Where('sellerId',Product::Where('productId',$resimliste->productId)->first()->productSeller)->first()->userId == Auth::user()->id)
            {
                $seller = Product::Where('productId',$resimliste->productId)->first()->productSeller;
                Storage::delete('public/uploads/products/picture/'.$seller.'/'.$resimliste->pictureUrl);
                Storage::delete('public/uploads/products/picturecrop/'.$seller.'/'.$resimliste->pictureUrl);
                $delete = Picture::Where('pictureId',$_GET['id'])->Delete();
                if($delete){
                    return redirect()->route('urunresimlistesi',['id'=>$resimliste->productId]);
                }else{
                    return view('/admin/satici/hata',['hatatur' => 'urunresmisilinemedi']);
                }
            }else{
                return Redirect::to('/saticiurunler');
            }
        }else{
            return abort(404);
        }
    }
    public function saticiindirimliurunduzenle(){
        if($this->yonlendirme(Auth::user()->authority)){
            if($_GET){
                $urun = Product::Where('productId',$_GET['id'])->Where('discountType','!=',0)->first();
                if($urun and Seller::Where('sellerId',$urun->productSeller)->first()->userId == Auth::user()->id){
                    $array = array();
                    $array[$urun->productId] = [
                        'id' => $urun->productId,
                        'ad' => $urun->productName,
                        'indirimturu' => $urun->discountType,
                        'indirim' => $urun->productDiscount,
                    ];
                    return view('/admin/satici/saticiindirimliurunduzenle',['urunler' => $array]);
                }else{
                    return Redirect::to('/saticiindirimliurunler');
                }
            }else{
                $urunler = Product::Where('productSeller',Seller::Where('userId',Auth::user()->id)->first()->sellerId)->Where('discountType',0)->get();
                $array = array();
                foreach ($urunler as $urun){
                    $array[$urun->productId] = [
                        'id' => $urun->productId,
                        'ad' => $urun->productName,
                        'indirimturu' => null,
                        'indirim' => null,
                    ];
                }
                return view('/admin/satici/saticiindirimliurunduzenle',['urunler' => $array]);
            }
        }else{
            return abort(404);
        }
    }
    public function saticiindirimliurunekle(){
        if($this->yonlendirme(Auth::user()->authority)){
            $urun = Product::Where('productId',$_POST['urun'])->first();
            if($urun and Seller::Where('sellerId',$urun->productSeller)->first()->userId == Auth::user()->id){
                switch ($_POST['indirimturu']){
                    case 1: $indirim = $_POST['indirim']%100;break;
                    case 2: $indirim = ($_POST['indirim'] > $urun->productPrice)?$urun->productPrice:$_POST['indirim'];break;
                   default: $indirim = null;break;
                }
                $update = Product::Where('productId',$_POST['urun'])->Update([
                    'discountType' => $_POST['indirimturu'],
                    'productDiscount' => $indirim,
                ]);
                if($update){
                    return Redirect::to('/saticiindirimliurunler');
                }else{
                    return view('/admin/satici/hata',['hatatur' => 'urunindirimeklenemedi']);
                }
            }else{
                return Redirect::to('/saticiindirimliurunler');
            }
        }else{
            return abort(404);
        }
    }
    public function saticiindirimliurunsil(){
        if($this->yonlendirme(Auth::user()->authority)){
            $urun = Product::Where('productId',$_GET['id'])->first();
            if($urun and Seller::Where('sellerId',$urun->productSeller)->first()->userId == Auth::user()->id){
                $update = Product::Where('productId',$_GET['id'])->Update([
                    'discountType' => 0,
                    'productDiscount' => null,
                ]);
                if($update){
                    return Redirect::to('/saticiindirimliurunler');
                }else{
                    return view('/admin/satici/hata',['hatatur' => 'urunindirimsilinemedi']);
                }
            }else{
                return Redirect::to('/saticiindirimliurunler');
            }
        }else{
            return abort(404);
        }
    }
    public function saticiyorumlistesi(Request $request){
        if($this->yonlendirme(Auth::user()->authority) and $_GET['id']){
            $seller = Seller::Where('userId',Auth::user()->id)->first();
            $yorumlar = Comment::Where('productSeller',$seller?$seller->sellerId:null)->Where('productId',$_GET['id'])->Where('checked',1)->get()->toarray();
            $urun = Product::Where('productId',$_GET['id'])->get()->toarray();
            return view('/admin/satici/saticiyorumlistesi',['yorumlar' => $yorumlar,'urun'=>$urun,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function yorumdetay($id=null){
        if($this->yonlendirme(Auth::user()->authority) and $id){
            $seller = Seller::Where('userId',Auth::user()->id)->first();
            $yorum = Comment::Where('productSeller',$seller?$seller->sellerId:null)->Where('commentId',$id)->Where('checked',1)->first();
            $array = null;
            if(isset($yorum) and $yorum){
                $user = User::Where('id',$yorum->userId)->first();
                $array['ad'] = isset($user)?$user->name.' '.$user->surname:null;
                $array['puan'] = $yorum->point;
                $array['yorum'] = $yorum->commentDetail;
            }
            return $array;
        }else{
            return abort(404);
        }
    }
    public function yorumreddet(){
        if($this->yonlendirme(Auth::user()->authority) and $_POST['id']){
            $seller = Seller::Where('userId',Auth::user()->id)->first();
            $yorum = Comment::Where('productSeller',$seller?$seller->sellerId:null)->Where('commentId',$_POST['id'])->Where('checked',1);
            if(isset($yorum) and $yorum){
                $yorum->Update([
                    'checked' => 3,
                ]);
            }
            return back();
        }else{
            return abort(404);
        }
    }
    public function yorumonayla(){
        if($this->yonlendirme(Auth::user()->authority) and $_POST['id']){
            $seller = Seller::Where('userId',Auth::user()->id)->first();
            $yorum = Comment::Where('productSeller',$seller?$seller->sellerId:null)->Where('commentId',$_POST['id'])->Where('checked',1);
            if(isset($yorum) and $yorum){
                $yorum->Update([
                    'checked' => 2,
                ]);
            }
            return back();
        }else{
            return abort(404);
        }
    }

}

