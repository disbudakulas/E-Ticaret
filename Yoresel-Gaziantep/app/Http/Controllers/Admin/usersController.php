<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use App\Models\Admin\District;
use App\Models\Admin\SiteSetting;
use App\Models\Notification;
use App\Models\Seller;
use App\Models\SellerWait;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class usersController extends Controller
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
    public function kullaniciduzenle(Request $id){
        if($this->yonlendirme(Auth::user()->authority)){
            if($_GET){
                $kullanici = User::Where('id',$_GET['id'])->first();
                if($kullanici){
                    $returnArray =[
                        'id'=> $kullanici->id ?? null,
                        'ad' => $kullanici->name ?? null,
                        'sad' => $kullanici->surname ?? null,
                        'mail' => $kullanici->email ?? null,
                        'yetki' => $kullanici->authority ?? null,
                        'tc' => $kullanici->tcNo ?? null,
                        'gsm' => $kullanici->gsm ?? null,
                        'resim' => $kullanici->picture?'storage/uploads/users/profileimagecrop/'.$kullanici->picture:null,
                        'sehir' => $kullanici->city ?? null,
                        'ilce' => $kullanici->district ?? null,
                        'ikamet' => $kullanici->residing ?? null,
                        'cinsiyet' => $kullanici->gender ?? null,
                        'dogumtarihi' => $kullanici->birthDate ?? null,
                        'kampanyabilgi' => $kullanici->campaignInfo ?? null,
                        'bakiye' => $kullanici->purse ?? null,
                        'durum' => $kullanici->blocked ?? null,
                        'duzenleme' => $kullanici->updated_at ?? null,
                        'olusturma' => $kullanici->created_at ?? null,
                    ];
                    $iller = City::orderBy('name')->get();
                    $ilceler = District::orderBy('name')->get();
                    return view('/Admin/production/kullaniciduzenle',['icerik' => $returnArray,'iller'=>$iller,'ilceler'=>$ilceler]);
                }else{
                    return Redirect::to('/kullanicilar');
                }
            }else{
                $iller = City::orderBy('name')->get();
                $ilceler = District::orderBy('name')->get();
                return view('/Admin/production/kullaniciduzenle',['iller'=>$iller,'ilceler'=>$ilceler]);
            }
        }else{
            return abort(404);
        }
    }
    public function kullanicisil(){
        if($this->yonlendirme(Auth::user()->authority)){
            if($_GET['id']){
                $kullanici = User::Where('id',$_GET['id'])->first();
                if($kullanici){
                    if(User::Where('id',$_GET['id'])->Update(['blocked' => 1])){
                        return Redirect::to('/kullanicilar');
                    }else{
                        return view('/Admin/production/hata',['hatatur' => 'kullanacisilinemedi']);
                    }
                }else{
                    return Redirect::to('/kullanicilar');
                }
            }else{
                return Redirect::to('/kullanicilar');
            }
        }else{
            return abort(404);
        }
    }
    public function kullanicigerial(){
        if($this->yonlendirme(Auth::user()->authority)){
            if($_GET['id']){
                $kullanici = User::Where('id',$_GET['id'])->first();
                if($kullanici){
                    if(User::Where('id',$_GET['id'])->Update(['blocked' => 0])){
                        return Redirect::to('/kullanicilar');
                    }else{
                        return view('/Admin/production/hata',['hatatur' => 'kullanacisilinemedi']);
                    }
                }else{
                    return Redirect::to('/kullanicilar');
                }
            }else{
                return Redirect::to('/kullanicilar');
            }
        }else{
            return abort(404);
        }
    }
    public function kullaniciekle(Request $request)
    {
        if($this->yonlendirme(Auth::user()->authority)){
            $name = str_replace('.','',$_POST['mail']).str_replace([' ','-',':'],'',substr(Carbon::now(),0,19));
            if($_POST['id']){
                $nameold = User::Where('id',$_POST['id'])->first()->picture;
                if(User::Where('email',$_POST['mail'])->Where('id','!=',$_POST['id'])->first()){
                    return redirect()->back()->withErrors(['error'=>'Mail adresi zaten kullanımda !']);
                }
                $kullaniciduzenle = User::Where('id',$_POST['id'])->Update([
                    'name' => $_POST['ad'] ?? null,
                    'surname' => $_POST['sad'] ?? null,
                    'email' => $_POST['mail'] ?? null,
                    'authority' => $_POST['yetki'] ?? null,
                    'tcNo' => $_POST['tc'] ?? null,
                    'gsm' => $_POST['gsm'] ?? null,
                    'picture' => ($request->file())?$name.'.jpg':null,
                    'city' => $_POST['sehir'] ?? null,
                    'district' => $_POST['ilce'] ?? null,
                    'residing' => $_POST['ikamet'] ?? null,
                    'gender' => $_POST['cinsiyet'] ?? null,
                    'birthDate' => $_POST['dogumtarihi'] ?? null,
                    'campaignInfo' => $_POST['kampanyabilgi'] ?? null,
                    'purse' => str_replace(',','',$_POST['bakiye']??0),
                    'blocked' => $_POST['durum'] ?? null,
                ]);
                if(!$kullaniciduzenle){
                    return view('/Admin/production/hata',['hatatur' => 'kullaniciduzenlenemedi']);
                }
            }else{
                if(User::Where('email',$_POST['mail'])->first()){
                    return redirect()->back()->withErrors(['error'=>'Mail adresi zaten kullanımda !']);
                }
                $time = Carbon::now();
                $combing = $time.$_POST['mail'];
                $token = md5(sha1($combing));
                $kullanici = new User();
                $kullanici->name = $_POST['ad'] ?? null;
                $kullanici->surname = $_POST['sad'] ?? null;
                $kullanici->email = $_POST['mail'] ?? null;
                $kullanici->token = $token;
                $kullanici->password = Hash::make($_POST['sifre']) ?? null;
                $kullanici->authority = $_POST['yetki'] ?? null;
                $kullanici->tcNo = $_POST['tc'] ?? null;
                $kullanici->gsm = $_POST['gsm'] ?? null;
                $kullanici->picture = ($request->file())?$name.'.jpg':null;
                $kullanici->city = $_POST['sehir'] ?? null;
                $kullanici->district = $_POST['ilce'] ?? null;
                $kullanici->residing = $_POST['ikamet'] ?? null;
                $kullanici->gender = $_POST['cinsiyet'] ?? null;
                $kullanici->birthDate = $_POST['dogumtarihi'] ?? null;
                $kullanici->campaignInfo = $_POST['kampanyabilgi'] ?? null;
                $kullanici->purse = str_replace(',','',$_POST['bakiye']??0);
                $kullanici->blocked = $_POST['durum'] ?? null;
                if(!$kullanici->save()){
                    return view('/Admin/production/hata',['hatatur' => 'kullaniciduzenlenemedi']);
                }

            }

            if($request->file()){
                $resim = $_FILES['logo']['tmp_name'];
                $baslangic_x = $_POST['x'];
                $baslangic_y = $_POST['y'];
                $genislik = $_POST['w'];
                $yukseklik = $_POST['h'];
                header("Content-type: picture/jpeg");
                dd($resim);
                $img_orig = imagecreatefrompng($resim);
                $img_kes = imagecreatetruecolor($genislik,$yukseklik);
                list($gen, $yuk) = getimagesize($resim);
                imagecopyresized($img_kes, $img_orig, 0, 0, $baslangic_x, $baslangic_y, $gen, $yuk, $gen, $yuk);

                $g_img = imagecreatetruecolor($genislik, $yukseklik);

                if($nameold){
                    Storage::delete('public/uploads/users/profileimage/'.$nameold);
                    Storage::delete('public/uploads/users/profileimagecrop/'.$nameold);
                }
                $request->file('logo')->storeAs('public/uploads/users/profileimage/',$name.'.jpg');
                imagepng($img_kes,'../storage/app/public/uploads/users/profileimagecrop/'.$name.'.jpg');
            }
            return Redirect::to('/kullanicilar');


        }else{
            return abort(404);
        }
    }
    public function basvurudetay($id=null){
        if($this->yonlendirme(Auth::user()->authority) and $id){
            $basvuru = SellerWait::Where('id',$id);
            if(isset($basvuru) and $basvuru){
                $array = $basvuru->first()->toarray();
                $array['mail'] = User::Where('id',$basvuru->first()->userId)->first()?User::Where('id',$basvuru->first()->userId)->first()->email:null;
                return $array;
            }else{
                return false;
            }
        }else{
            return abort(404);
        }
    }
    public function basvuruonay(){
        if($this->yonlendirme(Auth::user()->authority) and $_POST['id']){
            $basvuru = SellerWait::Where('id',$_POST['id']);
            if(isset($basvuru) and $basvuru){
                $update = $basvuru->Update([
                    'status' => 1,
                ]);
                if($update){
                    $mevcutmu = Seller::Where('userId',$basvuru->first()->userId);
                    if(isset($mevcutmu) and $mevcutmu){
                        $satici = $mevcutmu->Update([
                            'userId' => $basvuru->first()->userId,
                            'sellerName' => $basvuru->first()->sellerName,
                            'accountNumber' => $basvuru->first()->accountNumber,
                            'accountName' => $basvuru->first()->accountName,
                            'taxOffice' => $basvuru->first()->taxOffice,
                            'taxNumber' => $basvuru->first()->taxNumber,
                        ]);
                        if($satici){
                            $bildirim = new Notification();
                            $bildirim->sender = Auth::user()->id;
                            $bildirim->receiver = $basvuru->first()->userId;
                            $bildirim->title = Lang::get('kullanicilar.basvuruonaylandi');
                            $bildirim->text = $_POST['onayaciklama'];
                            $bildirim->view = 0;
                            $bildirim->save();
                            User::Where('id',$basvuru->first()->userId)?User::Where('id',$basvuru->first()->userId)->Update(['authority'=>4]):null;
                            return back();
                        }else{
                            $basvuru->Update([
                                'status' => 3,
                            ]);
                            return view('/Admin/production/hata',['hatatur' => 'saticitanimlanamadi']);
                        }
                    }else{
                        $satici = new Seller();
                        $satici->userId = $basvuru->first()->userId;
                        $satici->sellerName = $basvuru->first()->sellerName;
                        $satici->accountNumber = $basvuru->first()->accountNumber;
                        $satici->accountName = $basvuru->first()->accountName;
                        $satici->taxOffice = $basvuru->first()->taxOffice;
                        $satici->taxNumber = $basvuru->first()->taxNumber;
                        if($satici->save()){
                            $bildirim = new Notification();
                            $bildirim->sender = Auth::user()->id;
                            $bildirim->receiver = $basvuru->first()->userId;
                            $bildirim->title = Lang::get('kullanicilar.basvuruonaylandi');
                            $bildirim->text = $_POST['onayaciklama'];
                            $bildirim->view = 0;
                            $bildirim->save();
                            User::Where('id',$basvuru->first()->userId)?User::Where('id',$basvuru->first()->userId)->Update(['authority'=>4]):null;
                            return back();
                        }else{
                            $basvuru->Update([
                                'status' => 3,
                            ]);
                            return view('/Admin/production/hata',['hatatur' => 'saticitanimlanamadi']);
                        }
                    }
                }else{
                    return view('/Admin/production/hata',['hatatur' => 'saticitanimlanamadi']);
                }
            }else{
                return view('/Admin/production/hata',['hatatur' => 'saticitanimlanamadi']);
            }
        }else{
            return abort(404);
        }
    }
    public function basvurureddet(){
        if($this->yonlendirme(Auth::user()->authority) and $_POST['id']){
            $basvuru = SellerWait::Where('id',$_POST['id']);
            if(isset($basvuru) and $basvuru){
                $update = $basvuru->Update([
                    'status' => 2,
                ]);
                if($update){
                    $bildirim = new Notification();
                    $bildirim->sender = Auth::user()->id;
                    $bildirim->receiver = $basvuru->first()->userId;
                    $bildirim->title = Lang::get('kullanicilar.basvurureddedildi');
                    $bildirim->text = $_POST['reddetaciklama'];
                    $bildirim->view = 0;
                    $bildirim->save();
                    return back();
                }else{
                    return view('/Admin/production/hata',['hatatur' => 'saticitanimlanamadi']);
                }
            }else{
                return view('/Admin/production/hata',['hatatur' => 'saticitanimlanamadi']);
            }
        }else{
            return abort(404);
        }
    }
    public function basvurueksikveri(){
        if($this->yonlendirme(Auth::user()->authority) and $_POST['id']){
            $basvuru = SellerWait::Where('id',$_POST['id']);
            if(isset($basvuru) and $basvuru){
                $update = $basvuru->Update([
                    'status' => 4,
                ]);
                if($update){
                    $bildirim = new Notification();
                    $bildirim->sender = Auth::user()->id;
                    $bildirim->receiver = $basvuru->first()->userId;
                    $bildirim->title = Lang::get('kullanicilar.basvurueksikveri');
                    $bildirim->text = $_POST['eksikveriaciklama'];
                    $bildirim->view = 0;
                    $bildirim->save();
                    return back();
                }else{
                    return view('/Admin/production/hata',['hatatur' => 'saticitanimlanamadi']);
                }
            }else{
                return view('/Admin/production/hata',['hatatur' => 'saticitanimlanamadi']);
            }
        }else{
            return abort(404);
        }
    }

}
