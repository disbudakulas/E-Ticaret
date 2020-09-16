<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use App\Models\Admin\District;
use App\Models\Admin\SiteSetting;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class sitesettingController extends Controller
{
    public function yonlendirme($aut){
        if($aut == 1){
            return true;
        }else{
            return false;
        }
    }
    public function siteayarlari()
    {
        if ($this->yonlendirme(Auth::user()->authority)) {
            if ($_POST['id']) {
                $ayar = SiteSetting::Where('settingId',$_POST['id'])->Update([
                    'settingTitle' => $_POST['baslik'],
                    'settingDescription' => $_POST['aciklama'],
                    'settingAuthor' => $_POST['yazar'],
                    'settingTel' => $_POST['tel'],
                    'settingGsm' => $_POST['gsm'],
                    'settingFaks' => $_POST['faks'],
                    'settingMail' => $_POST['mail'],
                    'settingCity' => $_POST['sehir'],
                    'settingDistrict' => $_POST['ilce'],
                    'settingAddress' => $_POST['adres'],
                    'settingFacebook' => $_POST['facebook'],
                    'settingTwitter' => $_POST['twitter'],
                    'settingGoogle' => $_POST['google'],
                    'settingYoutube' => $_POST['youtube'],
                ]);
                if($ayar){
                    $icerik = SiteSetting::all();
                    $iller = City::orderBy('name')->get();
                    $ilceler = District::orderBy('name')->get();
                    return Redirect::to('/siteaciklama')->with(['icerik' => $icerik,'iller'=>$iller,'ilceler'=>$ilceler]);
                }else{
                    return view('/Admin/production/hata',['hatatur' => 'siteayaralarıeklenemedi']);
                }
            } else {
                $ayarlar = new SiteSetting();
                $ayarlar->settingTitle = $_POST['baslik'];
                $ayarlar->settingDescription = $_POST['aciklama'];
                $ayarlar->settingAuthor = $_POST['yazar'];
                $ayarlar->settingTel = $_POST['tel'];
                $ayarlar->settingGsm = $_POST['gsm'];
                $ayarlar->settingFaks = $_POST['faks'];
                $ayarlar->settingMail = $_POST['mail'];
                $ayarlar->settingCity = $_POST['sehir'];
                $ayarlar->settingDistrict = $_POST['ilce'];
                $ayarlar->settingAddress = $_POST['adres'];
                $ayarlar->settingFacebook = $_POST['facebook'];
                $ayarlar->settingTwitter = $_POST['twitter'];
                $ayarlar->settingGoogle = $_POST['google'];
                $ayarlar->settingYoutube = $_POST['youtube'];
                if($ayarlar->save()){
                    $icerik = SiteSetting::all();
                    $iller = City::orderBy('name')->get();
                    $ilceler = District::orderBy('name')->get();
                    return Redirect::to('/siteaciklama')->with(['icerik' => $icerik,'iller'=>$iller,'ilceler'=>$ilceler]);
                }else{
                    return view('/Admin/production/hata',['hatatur' => 'siteayaralarıeklenemedi']);
                }
            }
        } else {
            return abort(404);
        }
    }
    public function ucretlendirmekaydet()
    {
        if ($this->yonlendirme(Auth::user()->authority)) {
            $kdv = Pricing::Where('name','kdv')->first();
            if(isset($kdv) and $kdv){
                $kdv->Update(['value' => $_POST['kdv']??0,
                ]);
            }else{
                $kdv = new Pricing();
                $kdv->name = 'kdv';
                $kdv->value = $_POST['kdv']??0;
                $kdv->save();
            }
            $komisyon  = Pricing::Where('name','komisyon')->first();
            if(isset($komisyon) and $komisyon){
                $komisyon->Update(['value' => $_POST['komisyon']??0,
                ]);
            }else{
                $komisyon = new Pricing();
                $komisyon->name = 'komisyon';
                $komisyon->value = $_POST['komisyon']??0;
                $komisyon->save();
            }
            return back();
        } else {
            return abort(404);
        }
    }
}
