<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{
    public function index()
    {
        return view('fontend.pages.wishlist');
    }

    public function store(Request $request)
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
            $respose['present']=true;
            $respose['message'] = "Item add to your wishlist";

        }
        else{
            $result = Cart::instance('wishlist')->add($product_id,$product[0]['title'], $product_qty,$price)->associate('App\Models\Product');
            if($result){
                $respose['status']=true;
                $respose['message'] = "Item add to your wishlist";
                $respose['wishlist_cout'] = Cart::instance('wishlist')->count();
            }
        }
        return json_encode($respose);

    }
}
