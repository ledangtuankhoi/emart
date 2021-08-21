<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout1(){

        $user = Auth::user();
        return view('fontend.pages.checkout.checkout1',compact('user')); 
    }
}
