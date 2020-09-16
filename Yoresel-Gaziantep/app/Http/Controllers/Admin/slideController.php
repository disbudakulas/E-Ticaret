<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Slide;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Null_;

class slideController extends Controller
{
    public function yonlendirme($aut){
        if($aut == 1){
            return true;
        }else{
            return false;
        }
    }
    public function slideekle(Request $request)
    {
        if($this->yonlendirme(Auth::user()->authority)){
            $slide = Slide::Where('id',$_POST['id'])->first();
            $id = $_POST['id'];
            if($slide){
                $picname = str_replace([' ', ':', '.', '-'], '', substr(Carbon::now(), 0, 19)) . '.png';
                $eskipicture = $slide->picture;
                $slide->picture = ($request->file())?$picname:$eskipicture;
                $slide->url = $_POST['url'] ?? null;
                $slide->title = $_POST['slidebasligi'] ?? null;
                $slide->slogan = $_POST['slideslogani'] ?? null;
                $slide->description = $_POST['slideaciklama'] ?? null;

                if ($slide->save()) {
                    if($request->file()) {
                        $resim = $_FILES['slideresim']['tmp_name'];
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
                        $img_kes = imagecreatetruecolor($genislik, $yukseklik);
                        list($gen, $yuk) = getimagesize($resim);
                        imagecopyresized($img_kes, $img_orig, 0, 0, $baslangic_x, $baslangic_y, $gen, $yuk, $gen, $yuk);

                        $g_img = imagecreatetruecolor($genislik, $yukseklik);

                        $request->file('slideresim')->storeAs('public/uploads/slide/picture/', $picname);
                        if (!file_exists('../storage/app/public/uploads/slide/picturecrop/')) {
                            Storage::makeDirectory('public/uploads/slide/picturecrop/');
                        }
                        imagepng($img_kes, '../storage/app/public/uploads/slide/picturecrop/' . $picname);
                        Storage::delete('public/uploads/slide/picture/'. $eskipicture);
                        Storage::delete('public/uploads/slide/picturecrop/'. $eskipicture);

                        return redirect()->route('slide');
                    }
                    return redirect()->route('slide');
                } else {
                    return view('/Admin/production/hata', ['hatatur' => 'slideeklenemedi']);
                }

            }else{
                if($request->file()) {
                    $picname = str_replace([' ',':','.','-'],'',substr(Carbon::now(),0,19)).'.png';
                    $slide = new Slide();
                    $slide->picture = $picname;
                    $slide->url = $_POST['url'] ?? null;
                    $slide->title = $_POST['slidebasligi'] ?? null;
                    $slide->slogan = $_POST['slideslogani'] ?? null;
                    $slide->description = $_POST['slideaciklama'] ?? null;

                    if($slide->save()){
                        $resim = $_FILES['slideresim']['tmp_name'];
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

                        $request->file('slideresim')->storeAs('public/uploads/slide/picture/',$picname);
                        if(!file_exists('../storage/app/public/uploads/slide/picturecrop/')){
                            Storage::makeDirectory('public/uploads/slide/picturecrop/');
                        }
                        imagepng($img_kes,'../storage/app/public/uploads/slide/picturecrop/'.$picname);

                        return redirect()->route('slide');
                    }else{
                        return view('/Admin/production/hata',['hatatur' => 'slideeklenemedi']);
                    }
                }else{
                    return redirect()->route('slide');
                }
            }

        }else{
            return abort(404);
        }
    }
    public function slidesil(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $slide = Slide::Where('id',$_GET['id'])->first();
            $eskipicture = $slide?$slide->picture:null;
            if($slide){
                $delete = $slide->Delete();
                if($delete){
                    $eskipicture?Storage::delete('public/uploads/slide/picture/'. $eskipicture):null;
                    $eskipicture?Storage::delete('public/uploads/slide/picturecrop/'. $eskipicture):null;
                    return redirect()->route('slide');
                }else {
                    return view('/Admin/production/hata', ['hatatur' => 'slidesilinemedi']);
                }
            }else{
                return redirect()->route('slide');
            }
        }else{
            return abort(404);
        }
    }
    public function slidedetay(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            $slide = Slide::Where('id',$_GET['id'])->first();
            if($slide){
                $array = array();
                $array[0] = $slide->title;
                $array[1] = $slide->slogan;
                $array[2] = $slide->description;
                $array[3] = $slide->picture;
                $array[4] = $slide->url;
                return json_encode($array);
            }else{
                return redirect()->route('slide');
            }
        }else{
            return abort(404);
        }
    }
}
