<?php

namespace App\Http\Controllers\Admin;

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
    public function urunduzenle(Request $request)
    {
        if($this->yonlendirme(Auth::user()->authority)){
            $saticilar = Seller::all();
            $kategoriler = Kategori::Where('categoryTop','!=',0)->get();

            if($_GET){
                $urun = Product::Where('productId',$_GET['id'])->first();
                if($urun){
                    $resimkatalog = Picture::Where('productId',$urun->productId)->Where('pictureType',1)->first();
                    return view('/Admin/production/urunduzenle',['icerik' => $urun,'saticilar' => $saticilar,'kategoriler' => $kategoriler, 'resimkatalog'=>$resimkatalog?'storage/uploads/products/picturecrop/'.Product::Where('productId',$urun->productId)->first()->productSeller.'/'.$resimkatalog->pictureUrl:null]);
                }else{
                    return Redirect::to('/urunler');
                }
            }else{
                return view('/Admin/production/urunduzenle',['saticilar' => $saticilar,'kategoriler' => $kategoriler, 'resimkatalog'=>null]);
            }
        }else{
            return abort(404);
        }
    }
    public function urunresmiduzenle(Request $request)
    {
        if($this->yonlendirme(Auth::user()->authority)){
            $urun = Product::Where('productId',$_POST['id'])->first();
            $picname = str_replace([' ',':','.','-'],'',substr(Carbon::now(),0,19)).'.jpg';
            if($urun){
                $update = Product::Where('productId',$_POST['id'])->Update([
                    'productSeller' => $_POST['satici'],
                    'productName' => $_POST['urunadi'],
                    'productCatalog' => ($request->file())?$picname:$urun->productCatalog,
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
                    return view('/Admin/production/hata',['hatatur' => 'uruneklenemedi']);
                }
                $id = $_POST['id'];
            }else{
                $yeniurun = new Product();
                $yeniurun->productSeller = $_POST['satici'];
                $yeniurun->productName = $_POST['urunadi'];
                $yeniurun->productCatalog = ($request->file())?$picname:null;
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
                    return view('/Admin/production/hata',['hatatur' => 'uruneklenemedi']);
                }
                $id = Product::orderBy('created_at','desc')->first()->productId;
            }
            if($request->file()){
                $nameold=null;
                $picture = Picture::Where('productId',$id)->Where('pictureType',1)->first();
                if($picture){
                    $nameold = $picture->pictureUrl;
                    $pupdate = Picture::Where('productId',$id)->Where('pictureType',1)->Update([
                        'pictureUrl' => ($request->file())?$picname:null,
                    ]);
                    if(!$pupdate){
                        return view('/Admin/production/hata',['hatatur' => 'urunresmieklenemedi']);
                    }
                }else{
                    $picturenew = new Picture();
                    $picturenew->productId = $id;
                    $picturenew->pictureType = 1;
                    $picturenew->pictureUrl = ($request->file())?$picname:null;
                    if(!$picturenew->save()){
                        return view('/Admin/production/hata',['hatatur' => 'urunresmieklenemedi']);
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
                    Storage::delete('public/uploads/products/picture/'.$_POST['satici'].'/'.$nameold);
                    Storage::delete('public/uploads/products/picturecrop/'.$_POST['satici'].'/'.$nameold);
                }


                $request->file('urunkatalog')->storeAs('public/uploads/products/picture/'.$_POST['satici'].'/',$picname);
                if(!file_exists('../storage/app/public/uploads/products/picturecrop/'.$_POST['satici'])){
                    Storage::makeDirectory('public/uploads/products/picturecrop/'.$_POST['satici']);
                }
                imagepng($img_kes,'../storage/app/public/uploads/products/picturecrop/'.$_POST['satici'].'/'.$picname);
            }
            $resimliste = Picture::Where('productId',$id)->Where('pictureType','!=',1)->get();
            return view('/Admin/production/urunresmiduzenle',['id'=>$id, 'resimliste'=>$resimliste, 'page'=>1]);
        }else{
            return abort(404);
        }
    }
    public function urunresimekle(Request $request)
    {
        if($this->yonlendirme(Auth::user()->authority)){
            $urun = Product::Where('productId',$_POST['id'])->first();
            $id = $_POST['id'];
            if($urun){
                if($request->file()){
                    $picname = str_replace([' ',':','.','-'],'',substr(Carbon::now(),0,19)).'.jpg';
                    $picturenew = new Picture();
                    $picturenew->productId = $id;
                    $picturenew->pictureType = 2;
                    $picturenew->pictureUrl = ($request->file())?$picname:null;
                    if(!$picturenew->save()){
                        return view('/Admin/production/hata',['hatatur' => 'urunresmieklenemedi']);
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
                return redirect()->route('urunresimlistesi',['id'=>$_POST['id']]);

            }else{
                return Redirect::to('/urunler');
            }

        }else{
            return abort(404);
        }
    }
    public function urunresimlistesi(){
        if($this->yonlendirme(Auth::user()->authority)){
            $urun = Product::Where('productId',$_GET['id'])->get();
            if($urun)
            {
                $resimliste = Picture::Where('productId',$_GET['id'])->Where('pictureType','!=',1)->get();
                return view('/Admin/production/urunresmiduzenle',['id'=>$_GET['id'], 'resimliste'=>$resimliste, 'page'=>1]);
            }else{
                return Redirect::to('/urunler');
            }
        }else{
            return abort(404);
        }
    }
    public function urunresmisil(){
        if($this->yonlendirme(Auth::user()->authority)){
            $resimliste = Picture::Where('pictureId',$_GET['id'])->first();
            if($resimliste)
            {
                $seller = Product::Where('productId',$resimliste->productId)->first()->productSeller;
                Storage::delete('public/uploads/products/picture/'.$seller.'/'.$resimliste->pictureUrl);
                Storage::delete('public/uploads/products/picturecrop/'.$seller.'/'.$resimliste->pictureUrl);
                $delete = Picture::Where('pictureId',$_GET['id'])->Delete();
                if($delete){
                    return redirect()->route('urunresimlistesi',['id'=>$resimliste->productId]);
                }else{
                    return view('/Admin/production/hata',['hatatur' => 'urunresmisilinemedi']);
                }
            }else{
                return Redirect::to('/urunler');
            }
        }else{
            return abort(404);
        }
    }
    public function indirimliurunduzenle(){
        if($this->yonlendirme(Auth::user()->authority)){
            if($_GET){
                $urun = Product::Where('productId',$_GET['id'])->Where('discountType','!=',0)->first();
                if($urun){
                    $array = array();
                    $array[$urun->productId] = [
                        'id' => $urun->productId,
                        'ad' => $urun->productName,
                        'indirimturu' => $urun->discountType,
                        'indirim' => $urun->productDiscount,
                    ];
                    return view('/Admin/production/indirimliurunduzenle',['urunler' => $array]);
                }else{
                    return Redirect::to('/indirimliurunler');
                }
            }else{
                $urunler = Product::Where('discountType',0)->get();
                $array = array();
                foreach ($urunler as $urun){
                    $array[$urun->productId] = [
                        'id' => $urun->productId,
                        'ad' => $urun->productName,
                        'indirimturu' => null,
                        'indirim' => null,
                    ];
                }
                return view('/Admin/production/indirimliurunduzenle',['urunler' => $array]);
            }
        }else{
            return abort(404);
        }
    }
    public function indirimliurunekle(){
        if($this->yonlendirme(Auth::user()->authority)){
            $urun = Product::Where('productId',$_POST['urun'])->first();
            if($urun){
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
                    return Redirect::to('/indirimliurunler');
                }else{
                    return view('/Admin/production/hata',['hatatur' => 'urunindirimeklenemedi']);
                }
            }else{
                return Redirect::to('/indirimliurunler');
            }
        }else{
            return abort(404);
        }
    }
    public function indirimliurunsil(){
        if($this->yonlendirme(Auth::user()->authority)){
            $urun = Product::Where('productId',$_GET['id'])->first();
            if($urun){
                $update = Product::Where('productId',$_GET['id'])->Update([
                    'discountType' => 0,
                    'productDiscount' => null,
                ]);
                if($update){
                    return Redirect::to('/indirimliurunler');
                }else{
                    return view('/Admin/production/hata',['hatatur' => 'urunindirimeklenemedi']);
                }
            }else{
                return Redirect::to('/indirimliurunler');
            }
        }else{
            return abort(404);
        }
    }
    public function saticiurunler($id=null){
        if($this->yonlendirme(Auth::user()->authority) and $id){
            $urun = Product::Where('productSeller',$id)->get()->toarray();
            return $urun;
        }else{
            return abort(404);
        }
    }
    public function urunyorumlari(){
        if($this->yonlendirme(Auth::user()->authority) and $_GET['urun']){
            $yorumlar = Comment::Where('productId',$_GET['urun'])->get()->toarray();
            return view('/Admin/production/yorumlistesi',['yorumlar' => $yorumlar,'page'=>$_GET['page']??1]);
        }else{
            return abort(404);
        }
    }
    public function adminyorumdetay($id=null){
        if($this->yonlendirme(Auth::user()->authority) and $id){
            $seller = Seller::Where('userId',Auth::user()->id)->first();
            $yorum = Comment::Where('productSeller',$seller?$seller->sellerId:null)->Where('commentId',$id)->first();
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
    public function adminyorumreddet(){
        if($this->yonlendirme(Auth::user()->authority) and $_POST['id']){
            $yorum = Comment::Where('commentId',$_POST['id']);
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
    public function adminyorumonayla(){
        if($this->yonlendirme(Auth::user()->authority) and $_POST['id']){
            $yorum = Comment::Where('commentId',$_POST['id']);
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
