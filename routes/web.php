<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Fontend\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Category;
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
// fontend section
// authentication
Route::get('user/auth',[IndexController::class,'userAuth'])->name('user.auth');

// home
Route::get('/',[IndexController::class,'home'])->name('home');

// product by category
Route::get('product-category/{slug}',[IndexController::class,'productCategory'])->name('product.category');


// Product Detail
Route::get('product-detail/{slug}',[IndexController::class,'productDetail'])->name('product.detail');
// End fontend section

 

Auth::routes(["register" => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// admin dashboard
Route::group(['prefix' => 'admin', 'middelware' => 'auth','admin'], function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');

    // banner section
    Route::resource('banner', BannerController::class);
    Route::post('banner_status',[BannerController::class,'bannerStatus'])->name('banner.status');
    
     // Category section
     Route::resource('category', CategoryController::class);
     Route::post('category/category_status',[CategoryController::class,'categoryStatus'])->name("category.status");

     Route::post('category/{id}/child',[CategoryController::class,'getChildByParentID']);

     // Brand section
     Route::resource('brand', BrandController::class);
     Route::post('brand_status',[BrandController::class,'brandStatus'])->name('brand.status');
     
     // Product section
     Route::resource('product', ProductController::class);
     Route::post('product_status',[ProductController::class,'productStatus'])->name('product.status');
     
     // user section
     Route::resource('user', UserController::class);
     Route::post('user_status',[UserController::class,'userStatus'])->name('user.status');
});
 

// admin dashboard
Route::group(['prefix' => 'seller', 'middelware' => 'auth','seller'], function () {
    Route::get('/', [AdminController::class, 'admin'])->name('seller');
});