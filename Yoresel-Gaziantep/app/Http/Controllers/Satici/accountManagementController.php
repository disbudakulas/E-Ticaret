<?php

namespace App\Http\Controllers\Satici;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use App\Models\Admin\District;
use App\Models\Seller;
use App\Models\SellerWait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class accountManagementController extends Controller
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
            return view('/admin/satici/index');
        }else{
            return abort(404);
        }
    }
    public function saticihesapkaydet(){
        if($this->yonlendirme(Auth::user()->authority)){
            if(User::Where('email',$_POST['mail'])->Where('id','!=',Auth::user()->id)->first()){
                return redirect()->back()->withErrors(['error'=>'Mail adresi zaten kullanımda !']);
            }
            $update = User::Where('id',Auth::user()->id)->Update([
                'city' => $_POST['sehir']??null,
                'district' => $_POST['ilce']??null,
                'residing' => $_POST['adres']??null,
                'tel' => $_POST['tel']??null,
                'gsm' => $_POST['gsm']??null,
                'faks' => $_POST['faks']??null,
                'email' => $_POST['mail']??null,
            ]);
            if($update){
                return Redirect::to('/saticihesap');
            }else{
                return view('/admin/production/hata',['hatatur' => 'saticibilgileriduzenlenemedi']);
            }

        }else{
            return abort(404);
        }
    }
    public function saticiodemekaydet(){
        if($this->yonlendirme(Auth::user()->authority)){
            $update = null;
            $wait = SellerWait::Where('userId',Auth::user()->id)->Where('status',3)->first();
            if($wait){
                $update = SellerWait::Where('userId',Auth::user()->id)->Where('status',3)->Update([
                    'sellerName' => $_POST['unvan'],
                    'accountName' => $_POST['hesapsahibi'],
                    'accountNumber' => $_POST['hesapno'],
                    'taxOffice' => $_POST['vergidairesi'],
                    'taxNumber' => $_POST['verginumarasi'],
                    'type' => 2,
                ]);
            }
            $seller = new SellerWait();
            $seller->userId = Auth::user()->id;
            $seller->sellerName = $_POST['unvan'];
            $seller->accountName = $_POST['hesapsahibi'];
            $seller->accountNumber = $_POST['hesapno'];
            $seller->taxOffice = $_POST['vergidairesi'];
            $seller->taxNumber = $_POST['verginumarasi'];
            $seller->status = 3;
            $seller->type = 2;

            if($update or $seller->save()){
                return Redirect::to('/saticiodeme');
            }else{
                return view('/admin/production/hata',['hatatur' => 'saticibilgilerigonderilemedi']);
            }

        }else{
            return abort(404);
        }
    }
}
