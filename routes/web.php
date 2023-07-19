<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\GaleryController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoriesController;

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



$locale = Request::segment(1);

if(in_array($locale, ['az','en','ru'])){
    App::setLocale($locale);
}else{
    App::setLocale('az');

    $locale = '';
}
Route::fallback(function () {
    return redirect()->route('404');
});


Route::name('admin.')->prefix('/admin')->group(function () {

Route::group(['middleware' => 'isLogin'],function()
{

    Route::get('/login',[AuthController::class,'index'])->name('login');
    Route::post('/login-post',[AuthController::class,'signin_post'])->name('login_post');

});

Route::group(['middleware' => 'notLogin'],function()
{

    Route::get('/',[DashboardController::class,'index'])->name('index');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/profil-update',[AuthController ::class,'profil_update'])->name('profil_update');
    Route::post('/profil-update',[AuthController ::class,'profilupdate_post'])->name('profilupdate_post');

    //Categories
    Route::resource('categories', CategoriesController::class);

    //**** Setting ****/
    Route::get('/setting-index', [SettingController::class,'index'])->name('setting.index');
    Route::post('/setting-update/{id}', [SettingController::class,'update'])->name('setting.update');
    Route::post('/settingt/aktiv', [SettingController::class,'aktiv'])->name('setting_aktiv');

     //**** ABOUT ****/
     Route::get('/about-index', [AboutController::class,'index'])->name('about.index');
     Route::post('/about-update/{id}', [AboutController::class,'update'])->name('about.update');

    Route::resource('/partner', PartnerController::class);
    Route::get('/partner/delete/{id}', [PartnerController::class,'delete'])->name('partner.delete');

    //**** SLIDER ****/
    Route::resource('/slider', SliderController::class);
    Route::get('/slider/delete/{id}',[SliderController::class,'delete'])->name('slider.delete');

    
    //**** Region ****/
    Route::resource('/region', RegionController::class);
    Route::get('/region/delete/{id}',[RegionController::class,'delete'])->name('slider.delete');


    //**** GALERY ****/
    Route::resource('/galery', GaleryController::class);
    Route::get('/galery/delete/{id}', [GaleryController::class,'delete'])->name('galery.delete');


    //****SEO ****/
    Route::resource('/seo', SeoController::class);
    Route::get('/seo/delete/{id}',[SeoController::class,'delete'])->name('seo.delete');

});



});

Route::get('/error',[FrontController::class,'error'])->name('404');
