<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

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
        dd($product);
    }
}
