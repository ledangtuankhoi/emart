<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use phpDocumentor\Reflection\Types\Null_;

class CartController extends Controller
{
    public function cartStore(Request $request){
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        $product = Product::getProductByCart($product_id);
        $price = $product[0]['offer_price'];
        $cart_array = [];
         

        foreach (Cart::instance('shopping')->content() as $key => $item) {
            $cart_array[]=$item->id;
        }

        $result = Cart::add($product_id,$product[0]['title'],$product_qty,$price)->associate('App\Models\Product');
        if($result){
            // dd($result);
            $response['status']=true;
            $response['product_id']=$product_id;
            $response['total;']=Cart::subtotal(); 
            $response['message']="Product add yout cart success";
            $response['cart_count'] = Cart::instance('shopping')->count();
        }
        if($request->ajax()){
            $header_ajax = view('fontend.layouts.header')->render();
            $response['header_render']=$header_ajax;
        }

        return json_encode($response);
    }

    public function  cartDelete( Request $request){
        $id= $request->input('cart_id');
        Cart::instance('shopping'); 
        $result= Cart::remove($id); 
        if(!$result){
            $response['status']=true; 
            $response['total;']=Cart::subtotal(); 
            $response['message']="Product remove your cart success";
            $response['cart_count'] = Cart::instance('shopping')->count();
        }
        if($request->ajax()){
            $header_ajax = view('fontend.layouts.header')->render();
            $response['header_render']=$header_ajax;
        }
        return json_encode($response); 
    }
}
