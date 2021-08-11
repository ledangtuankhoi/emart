<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(){
        $banners = Banner::where(['status'=>'active','condition'=>'banner'])->orderBy('id','DESC')->limit('3')->get();
        $categories = Category::where(['status'=>'active','is_parent'=>1])->orderBy('id','DESC')->limit('3')->get();
        $brands = Brand::where(['status'=>'active'])->orderBy('id','DESC')->limit('10')->get();
        // dd($categories);

        return view('fontend.index',compact(['banners','brands','categories']));
    }

    public function productCategory($slug){
        $categories = Category::with(['products'])->where('slug',$slug)->first();
        return view('fontend.pages.product.product-category',compact('categories'));
    }

    public function productDetail($slug){
        $product = Product::with('rel_prods')->where('slug',$slug)->first();
        // return $product;
        if($product){
            return view('fontend.pages.product.product-detail',compact('product'));
        }else{
            return 'Product detail not found';
        }
    }


    public function userAuth(){
        return view('fontend.auth.auth');
    }
}
