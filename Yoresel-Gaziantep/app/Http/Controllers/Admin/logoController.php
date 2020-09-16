<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class logoController extends Controller
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
    public function logoyukle(Request  $request)
    {

        if($this->yonlendirme(Auth::user()->authority)){

            $logo = SiteSetting::all();
            $logourl = $logo->first()->settingLogo ? 'storage/uploads/logo/'.$logo->first()->settingLogo : 'storage/uploads/logo/no-Image.png';
            return view('/Admin/production/logoAYARLA',[
                'logo'=>$logourl,
                'id' => $logo->first()->settingId??null,
            ]);
        }else{
            return abort(404);
        }
    }
    public function logokaydet(Request $request){
        if($this->yonlendirme(Auth::user()->authority)){
            if($request->file()){
                $resim = $_FILES['logo']['tmp_name'];
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
                header("Content-type: image/png");
                $img_kes = imagecreatetruecolor($genislik,$yukseklik);
                imagesavealpha($img_kes, true );
                $transparent = imagecolorallocatealpha($img_kes, 0, 0, 0, 127);
                imagefill($img_kes, 0, 0, $transparent);
                list($gen, $yuk) = getimagesize($resim);
                imagecopyresized($img_kes, $img_orig, 0, 0, $baslangic_x, $baslangic_y, $gen, $yuk, $gen, $yuk);

                Storage::delete('public/uploads/logo/logo.png');
                Storage::delete('public/uploads/logocrop/logo.png');
                SiteSetting::Where('settingId',$_POST['id'])->Update(['settingLogo' => 'logo.png']);
                $request->file('logo')->storeAs('public/uploads/logo/','logo.png');
                imagepng($img_kes,'../storage/app/public/uploads/logocrop/logo.png');
            }else{
                $vtLogo = SiteSetting::all()->first()?SiteSetting::all()->first()->settingLogo:null;
                $logo = $vtLogo?$vtLogo:'no-image.png';
                if(SiteSetting::Where('settingId',$_POST['id'])->first()->settingLogo)$logo = 'logo.png';
                $resim = '../storage/app/public/uploads/logo/'.$logo;
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
                header("Content-type: image/png");
                $img_kes = imagecreatetruecolor($genislik,$yukseklik);
                imagesavealpha($img_kes, true );
                $transparent = imagecolorallocatealpha($img_kes, 0, 0, 0, 127);
                imagefill($img_kes, 0, 0, $transparent);
                list($gen, $yuk) = getimagesize($resim);
                imagecopyresized($img_kes, $img_orig, 0, 0, $baslangic_x, $baslangic_y, $gen, $yuk, $gen, $yuk);

                Storage::delete('public/uploads/logocrop/logo.png');
                SiteSetting::Where('settingId',$_POST['id'])->Update(['settingLogo' => 'logo.png']);
                if($logo == 'no-image.png'){
                    Storage::copy('public/uploads/logo/no-image.png', 'public/uploads/logo/logo.png');
                }
                imagepng($img_kes,'../storage/app/public/uploads/logocrop/logo.png');
            }
            return Redirect::to('/logo');
        }else{
            return abort(404);
        }

    }
}
