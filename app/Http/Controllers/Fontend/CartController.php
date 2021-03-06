<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use phpDocumentor\Reflection\Types\Null_;

class CartController extends Controller
{

    public function cart(){ 
        return view('fontend.pages.cart.index');
    }
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

    public function cartUpdate(Request $request){

        $this->validate($request,[
            'product_qty'=>'required|numeric',
        ]);
        $rowId = $request->input('rowId');
        $request_quatity = $request->input('product_qty');
        $productQuatity = $request->input('productQuatity');
        if($request_quatity > $productQuatity){
            $response['status']=false;
            $message="Ch??ng t??i kh??ng c?? ????? s???n ph???m y??u c???u";
        }elseif($request_quatity < 1){
            $response['status']=false;
            $message="S??? l?????ng kh??ng ???????c nh??? h??n 1";
        }else{
            
            $result = Cart::instance('shopping')->update($rowId,$request_quatity);
            if($result){
                $response['status']=true;
                $message="C???p nh???t gi??? h??ng th??nh c??ng"; 
                $response['total']=Cart::subtotal();  
                $response['cart_count'] = Cart::instance('shopping')->count();
            }else{
                $message="C???p nh???t gi??? h??ng KHOONG th??nh c??ng"; 
            }

        }

        
        if($request->ajax()){
            $header = view('fontend.layouts.header')->render();
            $cart_list = view('fontend.layouts._cart-list')->render();
            $response['header_render']=$header;
            $response['cart_list_render']=$cart_list;
            $response['message'] = $message;
        }
        return $response; 

    }

    public function couponAdd(Request $request){
        $coupon = Coupon::where('code',$request->input('code'))->first();
        // return $coupon;
        if(!$coupon){
            return back()->with('error','Kh??ng t??m th???y m?? gi???m gi??'); 
        }elseif($coupon){
            $total_price = Cart::instance('shopping')->subtotal('0');
            session()->put('coupon',[
                'id'=>$coupon->id,
                'code'=>$coupon->code,
                'type'=>$coupon->type,
                'value'=>$coupon->discount($total_price),
            ]);
            return back()->with('success','??p d???ng m?? th??nh c??ng'); 
        }
        return $coupon;
    }
}
