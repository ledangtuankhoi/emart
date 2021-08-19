<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Console\DumpCommand;

class WishlistController extends Controller
{
    public function wishlist()
    {
        return view('fontend.pages.wishlist');
    }

    public function wishlistStore(Request $request)
    {
        $product_qty = $request->input('product_qty');
        $product_id = $request->input('product_id');
        
        $product = Product::getProductByCart($product_id);
        $price = $product[0]['offer_price'];
        $wishlist_array=[];

        foreach(Cart::instance('wishlist')->content() as $item){
            $wishlist_array[] = $item->id;
        }
        if(in_array($product_id,$wishlist_array)){
            $response['present']=true;
            $response['message'] = "Item add to your wishlist";

        }
        else{
            $result = Cart::instance('wishlist')->add($product_id,$product[0]['title'], $product_qty,$price)->associate('App\Models\Product');
            if($result){
                $response['status']=true;
                $response['message'] = "Item add to your wishlist";
                $response['wishlist_count'] = Cart::instance('wishlist')->count();
            }
        }
        return json_encode($response);
    }

    public function wishlistMoveToCart(Request $request){
        $id = $request->input('id');
        $product_qty = $request->input('product_qty');

        // dd($request->all(),$id);
        if($id){
            $item = Cart::instance('wishlist')->get($id);
            $removeItem = Cart::instance('wishlist')->remove($id);
            $result = Cart::instance('shopping')->add($item);
            if($result){
                $response['status'] = true;
                $response['message'] = "Product move to your cart";
                $response['wishlist_count'] = Cart::instance('wishlist')->count();
                $response['cart_count'] = Cart::instance('shopping')->count();
            }
    
            if($request->ajax()){
                $header_ajax = view('fontend.layouts.header')->render();
                $wishlist_ajax = view('fontend.layouts._wishlist')->render();
    
                $response['header_render']=$header_ajax;
                $response['wishlist_render']=$wishlist_ajax;
            }
        }else{
            $response['message'] = "Không tin thấy sản phẩm";
        }
        return $response;
    }

    public function wishlistDelete(Request $request){
        $id = $request->input('id');

        // dd($request->all(),$id);
        if($id){

            $result = Cart::instance('wishlist')->remove($id);
            if(!$result){
                $response['status'] = true;
                $response['message'] = "Product remove in your wishlist";
                $response['wishlist_count'] = Cart::instance('wishlist')->count();
            } 
    
            if($request->ajax()){
                $header_ajax = view('fontend.layouts.header')->render();
                $wishlist_ajax = view('fontend.layouts._wishlist')->render();
    
                $response['header_render']=$header_ajax;
                $response['wishlist_render']=$wishlist_ajax;
            }
        }else{
            $response['message'] = "Không tin thấy sản phẩm";
        }
        return $response;
    }
}
