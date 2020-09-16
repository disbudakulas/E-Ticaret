<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class kategoriController extends Controller
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
    public function kategoriduzenle(Request $id){
        if($this->yonlendirme(Auth::user()->authority)){
            if($_GET){
                $kategori = Kategori::Where('categoryId',$_GET['id'])->first();
                if($kategori){
                    $returnArray =[
                        'id'=> $kategori->categoryId ?? null,
                        'ad' => $kategori->categoryName ?? null,
                        'ust' => $kategori->categoryTop ?? null,
                        'ikon' => $kategori->icon ?? null,
                        'aciklama' => $kategori->description ?? null,
                    ];
                    $ustkategoriler = Kategori::Where('categoryTop',0)->Where('categoryId','!=',$_GET['id'])->get();
                    return view('/Admin/production/kategoriduzenle',['icerik' => $returnArray,'ustkategoriler'=>$ustkategoriler]);
                }else{
                    $kategoriler = Kategori::all();
                    return view('/Admin/production/kategoriler',['kategoriler'=>$kategoriler,'page'=>1]);
                }
            }else{
                $ustkategoriler = Kategori::Where('categoryTop',0)->get();
                return view('/Admin/production/kategoriduzenle',['ustkategoriler'=>$ustkategoriler]);
            }
        }else{
            return abort(404);
        }
    }
    public function kategoriekle()
    {
        if($this->yonlendirme(Auth::user()->authority)){
            if($_POST['id']){
                $kategoriduzenle = Kategori::Where('categoryId',$_POST['id'])->Update([
                    'categoryName' => $_POST['ad']!="" ? $_POST['ad']: "İsimsiz",
                    'categoryTop' => $_POST['ust']!="" ? $_POST['ust']:0,
                    'icon' => $_POST['ikon'] ?? null,
                    'description' => $_POST['aciklama'] ?? null,
                    'status' => $_POST['durum'] ?? null,
                ]);
                if($kategoriduzenle){
                    $kategoriler = Kategori::all();
                    return Redirect::to('/kategoriler')->with(['kategoriler'=>$kategoriler,'page' => 1]);
                }else{
                    return view('/Admin/production/hata',['hatatur' => 'kategoriduzenlenemedi']);
                }
            }else{
                $kategori = new Kategori();
                $kategori->categoryName = $_POST['ad']!="" ? $_POST['ad']: "İsimsiz";
                $kategori->categoryTop =$_POST['ust']!="" ? $_POST['ust']:0;
                $kategori->icon = $_POST['ikon'] ?? null;
                $kategori->description = $_POST['aciklama'] ?? null;
                $kategori->status = $_POST['durum'];
                if($kategori->save()){
                    $kategoriler = Kategori::all();
                    return Redirect::to('/kategoriler');
                }else{
                    return view('/Admin/production/hata',['hatatur' => 'kategorieklenemedi']);
                }
            }
        }else{
            return abort(404);
        }
    }
    public function kategoriSil(){
        if($this->yonlendirme(Auth::user()->authority)){
            if($_GET['id']){
                $kategori = Kategori::Where('categoryId',$_GET['id'])->first();
                if($kategori){
                    if(Kategori::Where('categoryId',$_GET['id'])->Delete()){
                        $kategoriler = Kategori::all();
                        return Redirect::to('/kategoriler');
                    }else{
                        return view('/Admin/production/hata',['hatatur' => 'kategorisilinemedi']);
                    }
                }else{
                    $kategoriler = Kategori::all();
                    return Redirect::to('/kategoriler')->with(['kategoriler'=>$kategoriler,'page' => 1]);
                }
            }else{
                return view('/Admin/production/kategoriduzenle');
            }
        }else{
            return abort(404);
        }
    }
}
