<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();
Route::get('welcome/{locale}', function ($locale) {
    App::setLocale($locale);

    //
});
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('index');

Route::get('/admin', array('as' => 'adminindex', 'uses' => 'App\Http\Controllers\admin\adminPageController@index'));
Route::get('/kategoriler', array('as' => 'kategoriler', 'uses' => 'App\Http\Controllers\admin\adminPageController@kategoriler'));
Route::get('/logo', array('as' => 'logo', 'uses' => 'App\Http\Controllers\admin\adminPageController@logoayarla'));
Route::get('/siteaciklama', array('as' => 'siteaciklama', 'uses' => 'App\Http\Controllers\admin\adminPageController@siteaciklama'));
Route::get('/icerikduzenle', array('as' => 'icerikduzenle', 'uses' => 'App\Http\Controllers\admin\adminPageController@icerikduzenle'));
Route::get('/kullanicilar', array('as' => 'kullanicilar', 'uses' => 'App\Http\Controllers\admin\adminPageController@kullanicilar'));
Route::get('/saticibasvurulari', array('as' => 'saticibasvurulari', 'uses' => 'App\Http\Controllers\admin\adminPageController@saticibasvurulari'));
Route::get('/yapilacakodemeler', array('as' => 'yapilacakodemeler', 'uses' => 'App\Http\Controllers\admin\adminPageController@yapilacakodemeler'));
Route::get('/urunler', array('as' => 'urunler', 'uses' => 'App\Http\Controllers\admin\adminPageController@urunler'));
Route::get('/indirimliurunler', array('as' => 'indirimliurunler', 'uses' => 'App\Http\Controllers\admin\adminPageController@indirimliurunler'));
Route::get('/slide', array('as' => 'slide', 'uses' => 'App\Http\Controllers\admin\adminPageController@slide'));
Route::get('/ucretlendirme', array('as' => 'ucretlendirme', 'uses' => 'App\Http\Controllers\admin\adminPageController@ucretlendirme'));
Route::get('/toplamsiparisler', array('as' => 'toplamsiparisler', 'uses' => 'App\Http\Controllers\admin\adminPageController@toplamsiparisler'));
Route::get('/toplamkargoyaverilecekler', array('as' => 'toplamkargoyaverilecekler', 'uses' => 'App\Http\Controllers\admin\adminPageController@toplamkargoyaverilecekler'));
Route::get('/toplamyapilansatislar', array('as' => 'toplamyapilansatislar', 'uses' => 'App\Http\Controllers\admin\adminPageController@toplamyapilansatislar'));
Route::get('/toplamyorumlar', array('as' => 'toplamyorumlar', 'uses' => 'App\Http\Controllers\admin\adminPageController@toplamyorumlar'));

Route::get('/tumsiparisdetay/{id?}', array('as' => 'tumsiparisdetay', 'uses' => 'App\Http\Controllers\admin\orderController@tumsiparisdetay'));

Route::get('/kategoriduzenle/{id}', array('as' => 'kategoriduzenle', 'uses' => 'App\Http\Controllers\admin\kategoriController@kategoriduzenle'));
Route::get('/kategoriduzenle', array('as' => 'kategoriduzenle', 'uses' => 'App\Http\Controllers\admin\kategoriController@kategoriduzenle'));
Route::post('/kategoriekle', array('as' => 'kategoriekle', 'uses' => 'App\Http\Controllers\admin\kategoriController@kategoriekle'));
Route::get('/kategorisil', array('as' => 'kategorisil', 'uses' => 'App\Http\Controllers\admin\kategoriController@kategorisil'));

Route::get('/logoyukle', array('as' => 'logoyukle', 'uses' => 'App\Http\Controllers\admin\logoController@logoyukle'));
Route::post('/logokaydet', array('as' => 'logokaydet', 'uses' => 'App\Http\Controllers\admin\logoController@logokaydet'));

Route::post('/siteayarlari', array('as' => 'siteayarlari', 'uses' => 'App\Http\Controllers\admin\sitesettingController@siteayarlari'));

Route::post('/icerikayarla', array('as' => 'icerikayarla', 'uses' => 'App\Http\Controllers\admin\siteContentController@icerikayarla'));

Route::post('/slideekle', array('as' => 'slideekle', 'uses' => 'App\Http\Controllers\admin\slideController@slideekle'));
Route::get('/slidesil', array('as' => 'slidesil', 'uses' => 'App\Http\Controllers\admin\slideController@slidesil'));
Route::get('/slidedetay', array('as' => 'slidedetay', 'uses' => 'App\Http\Controllers\admin\slideController@slidedetay'));


Route::get('/kullaniciduzenle/{id}', array('as' => 'kullaniciduzenle', 'uses' => 'App\Http\Controllers\admin\usersController@kullaniciduzenle'));
Route::get('/kullaniciduzenle', array('as' => 'kullaniciduzenle', 'uses' => 'App\Http\Controllers\admin\usersController@kullaniciduzenle'));
Route::post('/kullaniciekle', array('as' => 'kullaniciekle', 'uses' => 'App\Http\Controllers\admin\usersController@kullaniciekle'));
Route::get('/kullanicisil', array('as' => 'kullanicisil', 'uses' => 'App\Http\Controllers\admin\usersController@kullanicisil'));
Route::get('/kullanicigerial', array('as' => 'kullanicigerial', 'uses' => 'App\Http\Controllers\admin\usersController@kullanicigerial'));
Route::get('/basvurudetay/{id?}', array('as' => 'basvurudetay', 'uses' => 'App\Http\Controllers\admin\usersController@basvurudetay'));
Route::post('/basvuruonay', array('as' => 'basvuruonay', 'uses' => 'App\Http\Controllers\admin\usersController@basvuruonay'));
Route::post('/basvurureddet', array('as' => 'basvurureddet', 'uses' => 'App\Http\Controllers\admin\usersController@basvurureddet'));
Route::post('/basvurueksikveri', array('as' => 'basvurueksikveri', 'uses' => 'App\Http\Controllers\admin\usersController@basvurueksikveri'));

Route::get('/urunduzenle/{id}', array('as' => 'urunduzenle', 'uses' => 'App\Http\Controllers\admin\productController@urunduzenle'));
Route::get('/urunduzenle', array('as' => 'urunduzenle', 'uses' => 'App\Http\Controllers\admin\productController@urunduzenle'));
Route::post('/urunresmiduzenle', array('as' => 'urunresmiduzenle', 'uses' => 'App\Http\Controllers\admin\productController@urunresmiduzenle'));
Route::post('/urunresimekle', array('as' => 'urunresimekle', 'uses' => 'App\Http\Controllers\admin\productController@urunresimekle'));
Route::get('/urunresimlistesi', array('as' => 'urunresimlistesi', 'uses' => 'App\Http\Controllers\admin\productController@urunresimlistesi'));
Route::get('/urunresmisil', array('as' => 'urunresmisil', 'uses' => 'App\Http\Controllers\admin\productController@urunresmisil'));
Route::get('/saticiurunler/{id?}', array('as' => 'saticiurunler', 'uses' => 'App\Http\Controllers\admin\productController@saticiurunler'));
Route::get('/urunyorumlari', array('as' => 'urunyorumlari', 'uses' => 'App\Http\Controllers\admin\productController@urunyorumlari'));
Route::post('/adminyorumreddet', array('as' => 'adminyorumreddet', 'uses' => 'App\Http\Controllers\admin\productController@adminyorumreddet'));
Route::post('/adminyorumonayla', array('as' => 'adminyorumonayla', 'uses' => 'App\Http\Controllers\admin\productController@adminyorumonayla'));
Route::get('/adminyorumdetay/{id?}', array('as' => 'adminyorumdetay', 'uses' => 'App\Http\Controllers\admin\productController@adminyorumdetay'));

Route::get('/indirimliurunduzenle/{id}', array('as' => 'indirimliurunduzenle', 'uses' => 'App\Http\Controllers\admin\productController@indirimliurunduzenle'));
Route::get('/indirimliurunduzenle', array('as' => 'indirimliurunduzenle', 'uses' => 'App\Http\Controllers\admin\productController@indirimliurunduzenle'));
Route::post('/indirimliurunekle', array('as' => 'indirimliurunekle', 'uses' => 'App\Http\Controllers\admin\productController@indirimliurunekle'));
Route::get('/indirimliurunsil', array('as' => 'indirimliurunsil', 'uses' => 'App\Http\Controllers\admin\productController@indirimliurunsil'));


Route::post('/ucretlendirmekaydet', array('as' => 'ucretlendirmekaydet', 'uses' => 'App\Http\Controllers\admin\sitesettingController@ucretlendirmekaydet'));


Route::get('/satici', array('as' => 'saticiindex', 'uses' => 'App\Http\Controllers\satici\saticiPageController@index'));
Route::get('/saticihesap', array('as' => 'saticihesap', 'uses' => 'App\Http\Controllers\satici\saticiPageController@saticihesap'));
Route::get('/saticiodeme', array('as' => 'saticiodeme', 'uses' => 'App\Http\Controllers\satici\saticiPageController@saticiodeme'));
Route::get('/saticiurunleri', array('as' => 'saticiurunleri', 'uses' => 'App\Http\Controllers\satici\saticiPageController@saticiurunleri'));
Route::get('/saticiindirimliurunler', array('as' => 'saticiindirimliurunler', 'uses' => 'App\Http\Controllers\satici\saticiPageController@saticiindirimliurunler'));
Route::get('/saticisiparisler', array('as' => 'saticisiparisler', 'uses' => 'App\Http\Controllers\satici\saticiPageController@saticisiparisler'));
Route::get('/saticikargoyaverilecekler', array('as' => 'saticikargoyaverilecekler', 'uses' => 'App\Http\Controllers\satici\saticiPageController@saticikargoyaverilecekler'));
Route::get('/saticiyapilansatislar', array('as' => 'saticiyapilansatislar', 'uses' => 'App\Http\Controllers\satici\saticiPageController@saticiyapilansatislar'));
Route::get('/saticibekleyenyorumlar', array('as' => 'saticibekleyenyorumlar', 'uses' => 'App\Http\Controllers\satici\saticiPageController@saticibekleyenyorumlar'));

Route::post('/saticihesapkaydet', array('as' => 'saticihesapkaydet', 'uses' => 'App\Http\Controllers\satici\accountManagementController@saticihesapkaydet'));
Route::post('/saticiodemekaydet', array('as' => 'saticiodemekaydet', 'uses' => 'App\Http\Controllers\satici\accountManagementController@saticiodemekaydet'));

Route::get('/saticiurunduzenle/{id}', array('as' => 'saticiurunduzenle', 'uses' => 'App\Http\Controllers\satici\productController@saticiurunduzenle'));
Route::get('/saticiurunsil', array('as' => 'saticiurunsil', 'uses' => 'App\Http\Controllers\satici\productController@saticiurunsil'));
Route::get('/saticiurunduzenle', array('as' => 'saticiurunduzenle', 'uses' => 'App\Http\Controllers\satici\productController@saticiurunduzenle'));
Route::post('/saticiurunresmiduzenle', array('as' => 'saticiurunresmiduzenle', 'uses' => 'App\Http\Controllers\satici\productController@saticiurunresmiduzenle'));
Route::get('/saticiurunresmisil', array('as' => 'saticiurunresmisil', 'uses' => 'App\Http\Controllers\satici\productController@saticiurunresmisil'));
Route::post('/saticiurunresimekle', array('as' => 'saticiurunresimekle', 'uses' => 'App\Http\Controllers\satici\productController@saticiurunresimekle'));
Route::get('/saticiurunresimlistesi', array('as' => 'saticiurunresimlistesi', 'uses' => 'App\Http\Controllers\satici\productController@saticiurunresimlistesi'));

Route::get('/saticiindirimliurunduzenle/{id}', array('as' => 'saticiindirimliurunduzenle', 'uses' => 'App\Http\Controllers\satici\productController@saticiindirimliurunduzenle'));
Route::get('/saticiindirimliurunduzenle', array('as' => 'saticiindirimliurunduzenle', 'uses' => 'App\Http\Controllers\satici\productController@saticiindirimliurunduzenle'));
Route::post('/saticiindirimliurunekle', array('as' => 'saticiindirimliurunekle', 'uses' => 'App\Http\Controllers\satici\productController@saticiindirimliurunekle'));
Route::get('/saticiindirimliurunsil', array('as' => 'saticiindirimliurunsil', 'uses' => 'App\Http\Controllers\satici\productController@saticiindirimliurunsil'));

Route::get('/siparisdetay/{id?}', array('as' => 'siparisdetay', 'uses' => 'App\Http\Controllers\satici\orderController@siparisdetay'));
Route::post('/siparisonay', array('as' => 'siparisonay', 'uses' => 'App\Http\Controllers\satici\orderController@siparisonay'));
Route::post('/siparisiptal', array('as' => 'siparisiptal', 'uses' => 'App\Http\Controllers\satici\orderController@siparisiptal'));
Route::post('/kargoyaverildi', array('as' => 'kargoyaverildi', 'uses' => 'App\Http\Controllers\satici\orderController@kargoyaverildi'));

Route::get('/saticiyorumlistesi', array('as' => 'saticiyorumlistesi', 'uses' => 'App\Http\Controllers\satici\productController@saticiyorumlistesi'));
Route::get('/yorumdetay/{id?}', array('as' => 'yorumdetay', 'uses' => 'App\Http\Controllers\satici\productController@yorumdetay'));
Route::post('/yorumreddet', array('as' => 'yorumreddet', 'uses' => 'App\Http\Controllers\satici\productController@yorumreddet'));
Route::post('/yorumonayla', array('as' => 'yorumonayla', 'uses' => 'App\Http\Controllers\satici\productController@yorumonayla'));


Route::get('/urundetay', array('as' => 'urundetay', 'uses' => 'App\Http\Controllers\HomeController@urundetay'));
Route::get('/urunliste', array('as' => 'urunliste', 'uses' => 'App\Http\Controllers\HomeController@urunliste'));
Route::get('/girisyap', array('as' => 'girisyap', 'uses' => 'App\Http\Controllers\HomeController@girisyap'));
Route::get('/sepeteekle/{id?}', array('as' => 'sepeteekle', 'uses' => 'App\Http\Controllers\HomeController@sepeteekle'));
Route::get('/sepetguncelle/{id?}', array('as' => 'sepetguncelle', 'uses' => 'App\Http\Controllers\HomeController@sepetguncelle'));
Route::get('/sepetguncelle2/{id?}', array('as' => 'sepetguncelle2', 'uses' => 'App\Http\Controllers\HomeController@sepetguncelle2'));
Route::get('/sepetsil/{id?}', array('as' => 'sepetsil', 'uses' => 'App\Http\Controllers\HomeController@sepetsil'));
Route::get('/sepet', array('as' => 'sepet', 'uses' => 'App\Http\Controllers\HomeController@sepet'));
Route::get('/sepethesapla', array('as' => 'sepethesapla', 'uses' => 'App\Http\Controllers\HomeController@sepethesapla'));
Route::get('/odemehesapla', array('as' => 'odemehesapla', 'uses' => 'App\Http\Controllers\HomeController@odemehesapla'));
Route::get('/alisveristamamla', array('as' => 'alisveristamamla', 'uses' => 'App\Http\Controllers\HomeController@alisveristamamla'));
Route::post('/odemeonayla', array('as' => 'odemeonayla', 'uses' => 'App\Http\Controllers\HomeController@odemeonayla'));
Route::get('/ulkesec', array('as' => 'ulkesec', 'uses' => 'App\Http\Controllers\HomeController@ulkesec'));
Route::get('/sehirsec/{id?}', array('as' => 'sehirsec', 'uses' => 'App\Http\Controllers\HomeController@sehirsec'));
Route::get('/siparisler', array('as' => 'siparisler', 'uses' => 'App\Http\Controllers\HomeController@siparisler'));
Route::get('/hesabim', array('as' => 'hesabim', 'uses' => 'App\Http\Controllers\HomeController@hesabim'));
Route::post('/hesapkaydet', array('as' => 'hesapkaydet', 'uses' => 'App\Http\Controllers\HomeController@hesapkaydet'));
Route::get('/yorumlarim', array('as' => 'yorumlarim', 'uses' => 'App\Http\Controllers\HomeController@yorumlarim'));
Route::get('/mesajlarim', array('as' => 'mesajlarim', 'uses' => 'App\Http\Controllers\HomeController@mesajlarim'));
Route::get('/saticiol', array('as' => 'saticiol', 'uses' => 'App\Http\Controllers\HomeController@saticiol'));
Route::post('/saticibasvuru', array('as' => 'saticibasvuru', 'uses' => 'App\Http\Controllers\HomeController@saticibasvuru'));
Route::get('/basvurularim', array('as' => 'basvurularim', 'uses' => 'App\Http\Controllers\HomeController@basvurularim'));
Route::get('/mesajlarim', array('as' => 'mesajlarim', 'uses' => 'App\Http\Controllers\HomeController@mesajlarim'));
Route::get('/mesajgoruntule', array('as' => 'mesajgoruntule', 'uses' => 'App\Http\Controllers\HomeController@mesajgoruntule'));
Route::get('/urunara/{text?}', array('as' => 'urunara', 'uses' => 'App\Http\Controllers\HomeController@urunara'));
Route::post('/yorumyap', array('as' => 'yorumyap', 'uses' => 'App\Http\Controllers\HomeController@yorumyap'));


