<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(["register" => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// admin dashboard
Route::group(['prefix' => 'admin', 'middelware' => 'auth'], function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');

    // banner section
    Route::resource('banner', BannerController::class);
    Route::get('banner_status',[BannerController::class,'bannerStatus'])->name('banner.status');
    
     // Category section
     Route::resource('category', CategoryController::class);
     Route::get('category_status',[CategoryController::class,'categoryStatus'])->name('category.status');

     // Brand section
     Route::resource('brand', BrandController::class);
     Route::get('brand_status',[BrandController::class,'brandStatus'])->name('brand.status');
});
 
