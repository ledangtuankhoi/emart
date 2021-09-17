<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function checkout1()
    {
        if (Cart::instance('shopping')->count() > 0) {
            // return Session
            $user = Auth::user();
            $shippings  = Shipping::where('status', 'active')->orderBy('shipping_address', 'ASC')->get();
            return view('fontend.pages.checkout.checkout1', compact('user', 'shippings'));
        } else { 
            $banners = Banner::where(['status' => 'active', 'condition' => 'banner'])->orderBy('id', 'DESC')->limit('3')->get();
            $categories = Category::where(['status' => 'active', 'is_parent' => 1])->orderBy('id', 'DESC')->limit('3')->get();
            $brands = Brand::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('10')->get();
            // dd($categories);

            $user = Auth::user();
            return view('fontend.index', compact(['banners', 'brands', 'categories', 'user']));
        }
    }

    public function checkoutReview(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'phone' => 'numeric|required',
            'email' => 'email|required|exists:users,email',
            'postcode' => 'numeric|nullable',
            'country' => 'string|nullable',
            'address' => 'string|nullable',
            'city' => 'string|nullable',
            'state' => 'string|nullable',
            'note' => 'nullable',

            'sfirst_name' => 'string|required',
            'slast_name' => 'string|required',
            'sphone' => 'numeric|required',
            'semail' => 'email|required|exists:users,email',
            'spostcode' => 'numeric|nullable',
            'scountry' => 'string|nullable',
            'saddress' => 'string|nullable',
            'scity' => 'string|nullable',
            'sstate' => 'string|nullable',


            'payment_method' => 'required',
            'delivery_charge' => 'numeric|required', 
        ]);
        // return dd($request->all(),session('coupon')['value']);
        session()->put('checkout', [

            'last_name' => $request->input('last_name'),
            'first_name' => $request->input('first_name'),
            'country' => $request->input('country'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'postcode' => $request->input('postcode'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'note' => $request->input('note'),


            'slast_name' => $request->input('slast_name'),
            'sfirst_name' => $request->input('sfirst_name'),
            'scountry' => $request->input('scountry'),
            'saddress' => $request->input('saddress'),
            'scity' => $request->input('scity'),
            'sstate' => $request->input('sstate'),
            'spostcode' => $request->input('spostcode'),
            'sphone' => $request->input('sphone'),
            'semail' => $request->input('semail'),

            'delivery_charge' => $request->input('delivery_charge'),
            'payment_method' => $request->input('payment_method'),
            'payment_status' => $request->input('payment_status'),

            'sub_total' => Cart::instance('shopping')->subtotal(),

            // 'total_amount'=>$request->input('payment_method') + $request->input('delivery_charge') - session('coupon')['value'],


        ]);

        return view('fontend.pages.checkout.checkout-complate');
    }

    public function checkoutStore(Request $request)
    {
        //  return Session::get('checkout');
        $order = new Order();

        $order['user_id'] = auth()->user()->id;
        $order['order_number'] =  Str::upper("ORD-" . Str::random(6));
        $sub_total = filter_var(Cart::subtotal(), FILTER_SANITIZE_NUMBER_INT) / 100;
        $order['sub_total'] = $sub_total;

        $total_amout = filter_var(
            Cart::instance('shopping')->subtotal(),
            FILTER_SANITIZE_NUMBER_INT
        ) / 100
            -  Session::get('coupon')['value']
            +  Session::get('checkout')['delivery_charge'];
        $order['total_amout'] =  $total_amout;
        // return $order['total_amout'] ;
        if (Session::has('coupon')) {
            $order['coupon'] =  Session::get('coupon')['value'];
        } else {
            $order['coupon'] = 0;
        }
        $order['payment_method'] =  Session::get('checkout')['payment_method'];
        $order['payment_status'] =  Session::get('checkout')['payment_status'];
        $order['delivery_charge'] =  Session::get('checkout')['delivery_charge'];

        // $name = explode(auth()->user()->full_name)
        $order['first_name'] =  Session::get('checkout')['first_name'];
        $order['last_name'] =  Session::get('checkout')['last_name'];
        // $order['last_name'] =  auth()->user()->first_name;
        $order['email'] =  Session::get('checkout')['email'];
        $order['phone'] =  Session::get('checkout')['phone'];
        $order['country'] =  Session::get('checkout')['country'];
        $order['address'] =  Session::get('checkout')['address'];
        $order['city'] =  Session::get('checkout')['city'];
        $order['state'] =  Session::get('checkout')['state'];
        $order['note'] =  Session::get('checkout')['note'];

        $order['sfirst_name'] =  Session::get('checkout')['sfirst_name'];
        $order['slast_name'] =  Session::get('checkout')['slast_name'];
        $order['semail'] =  Session::get('checkout')['semail'];
        $order['sphone'] =  Session::get('checkout')['sphone'];
        $order['scountry'] =  Session::get('checkout')['scountry'];
        $order['saddress'] =  Session::get('checkout')['saddress'];
        $order['scity'] =  Session::get('checkout')['scity'];
        $order['sstate'] =  Session::get('checkout')['sstate'];



        $status = $order->save();
        if ($status) {
            return redirect()->route('user.order')->with('success', 'order Succsessfully create');
        } else {
            return back()->with('errors', 'Somthing went wrong');
        }
        return dd($request->all(), Session::get('checkout'), $order);
    }
}
