<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\Fontend\CartController;
use App\Http\Controllers\Fontend\CheckoutController;
use App\Http\Controllers\Fontend\IndexController;
use App\Http\Controllers\Fontend\ShippingController;
use App\Http\Controllers\Fontend\WishlistController;
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
Route::get('user/logout',[IndexController::class,'userLogout'])->name('user.logout');

Route::post('user/login',[IndexController::class,'loginSumit'])->name('login.submit');
Route::post('user/regiter',[IndexController::class,'regiterSumit'])->name('regiter.submit');







// home
Route::get('/',[IndexController::class,'home'])->name('home');

// product by category
Route::get('product-category/{slug}',[IndexController::class,'productCategory'])->name('product.category');


// Product Detail
Route::get('product-detail/{slug}',[IndexController::class,'productDetail'])->name('product.detail');

// cart add
Route::get('cart/',[CartController::class,'cart'])->name('cart');
Route::post('cart/store',[CartController::class,'cartStore'])->name('cart.store');
Route::post('cart/delete',[CartController::class,'cartDelete'])->name('cart.delete');
Route::post('cart/update',[CartController::class,'cartUpdate'])->name('cart.update');

// coupon section
Route::post('coupon/add',[CartController::class,'couponAdd'])->name('coupon.add');

// wishlist section
Route::get('wishlist',[WishlistController::class,'wishlist'])->name('wishlist');
Route::post('wishlist/store',[WishlistController::class,'wishlistStore'])->name('wishlist.store');
Route::post('wishlist/move',[WishlistController::class,'wishlistMoveToCart'])->name('wishlist.move');
Route::post('wishlist/delete',[WishlistController::class,'wishlistDelete'])->name('wishlist.delete');

// Checkout section
Route::get('checkout1',[CheckoutController::class,'checkout1'])->name('checkout1')->middleware('user');
Route::post('checkout1/review',[CheckoutController::class,'checkoutReview'])->name('checkout.review')->middleware('user');
Route::post('checkout/store',[CheckoutController::class,'checkoutStore'])->name('checkout.store')->middleware('user');

// End fontend section

 

Auth::routes(["register" => false]);
 

// admin dashboard
// Route::group(['prefix' => 'admin', 'middelware' => ['auth','admin']], function () {
Route::prefix('admin')->middleware(['auth','admin'])->group(function(){
    // dd(auth());
    Route::get('/', [AdminController::class, 'admin'])->name('admin') ;

    // banner section
    Route::resource('/banner', BannerController::class);
    Route::post('banner_status',[BannerController::class,'bannerStatus'])->name('banner.status');
    
     // Category section
     Route::resource('/category', CategoryController::class);
     Route::post('category/category_status',[CategoryController::class,'categoryStatus'])->name("category.status");

     Route::post('category/{id}/child',[CategoryController::class,'getChildByParentID']);

     // Brand section
     Route::resource('/brand', BrandController::class);
     Route::post('brand_status',[BrandController::class,'brandStatus'])->name('brand.status');
     
     // Product section
     Route::resource('/product', ProductController::class);
     Route::post('product_status',[ProductController::class,'productStatus'])->name('product.status');
     
     // user section
     Route::resource('/user', UserController::class);
     Route::post('user_status',[UserController::class,'userStatus'])->name('user.status');

     
     // coupon section
     Route::resource('/coupon', CouponController::class);
     Route::post('coupon_status',[CouponController::class,'couponStatus'])->name('coupon.status');
          
     // shipping section
     Route::resource('/shipping', ShippingController::class);
     Route::post('shipping_status',[ShippingController::class,'shippingStatus'])->name('shipping.status');

});
 

// seller dashboard 
Route::prefix('seller')->middleware(['auth','seller'])->group(function(){ 
    Route::get('/', [AdminController::class, 'admin'])->name('admin');
});


// user dashboard
Route::group(['prefix'=>'user'],function(){
    Route::get('/dashboard',[IndexController::class,'userDashboard'])->name('user.dashboard');
    Route::get('/order',[IndexController::class,'userOrder'])->name('user.order');
    Route::get('/address',[IndexController::class,'userAddress'])->name('user.address');
    Route::get('/account-detail',[IndexController::class,'userAccount'])->name('user.account');
    Route::get('/order',[IndexController::class,'userOrder'])->name('user.order');
    
    Route::post('/billing/address/{id}',[IndexController::class,'billingAddress'])->name('billing.address');
    Route::post('/shiping/address/{id}',[IndexController::class,'shipingAddress'])->name('shiping.address');
    Route::post('/update/account/{id}',[IndexController::class,'accountUpdate'])->name('account.update');

});