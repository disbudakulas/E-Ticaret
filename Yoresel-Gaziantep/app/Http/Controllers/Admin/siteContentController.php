<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SiteContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class siteContentController extends Controller
{
    public function yonlendirme($aut){
        if($aut == 1){
            return true;
        }else{
            return false;
        }
    }
    public function icerikayarla()
    {
        dd($_POST);
        if ($this->yonlendirme(Auth::user()->authority)) {
            if ($_POST['id']) {
                $ayar = SiteContent::Where('settingId',$_POST['id'])->Update([
                    'tanitim' => $_POST['tanitim'],
                    'misyon' => $_POST['misyon'],
                    'vizyon' => $_POST['vizyon'],
                ]);
                if($ayar){
                    $icerik = SiteContent::all();
                    return Redirect::to('/siteaciklama')->with(['icerik' => $icerik]);
                }else{
                    return view('/Admin/production/hata',['hatatur' => 'siteicerikeklenemedi']);
                }
            } else {
                $ayarlar = new SiteContent();
                $ayarlar->tanitim = $_POST['tanitim'];
                $ayarlar->misyon = $_POST['misyon'];
                $ayarlar->vizyon = $_POST['vizyon'];
                if($ayarlar->save()){
                    $icerik = SiteContent::all();
                    return Redirect::to('/siteaciklama')->with(['icerik' => $icerik]);
                }else{
                    return view('/Admin/production/hata',['hatatur' => 'siteicerikeklenemedi']);
                }
            }
        } else {
            return abort(404);
        }
    }
}
