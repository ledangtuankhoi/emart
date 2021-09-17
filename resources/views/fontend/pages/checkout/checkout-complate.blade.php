@extends('fontend.layouts.master')

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Shopping Checkout<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="cart">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12" id="cart-list">

                            
                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr> 
                                    <th>photo</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th> </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach (Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                                    
                                <tr>
                                    <td>
                                        {{-- <figure class="product-media"> --}}
                                            <a href="#">
                                                <img src="{{$item->model->photo}}" alt="{{$item->name}}" width="200">
                                            </a>
                                        {{-- </figure> --}}
                                    </td>
                                    <td class="product-col">
                                        <div class="product">
                                            <h3 class="product-title">
                                                <a href="{{route('product.detail',$item->model->slug)}}">
                                                    <figure class="product-media">
                                                    {{ucfirst ($item->name)}}
                                                    </figure>
                                                </a>
                                            </h3><!-- End .product-title -->
                                        </div><!-- End .product -->
                                    </td>
                                    <td class="price-col">{{number_format($item->price,2)}}</td>
                                    <td class="quantity-col">
                                        <div class="quatity cart-product-quantity">
                                            <p class="text-center " style="font-size: 3rem">{{$item->qty}}</p>
                                            
                                        </div><!-- End .cart-product-quantity -->
                                    </td>
                                    <td class="total-col">{{number_format($item->price*$item->qty,2)}}</td> 
                                </tr>
                                @endforeach
                             </tbody>
                        </table><!-- End .table table-wishlist -->

                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .cart -->
        </div><!-- End .page-content -->
        <div class="page-content">
            <div class="checkout">
                <div class="container">
                    <div class="checkout-discount">
                         
                    </div><!-- End .checkout-discount -->
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <div class="row"> 
                            <aside class="col-lg-7"></aside>


                            <aside class="col-lg-5">
                                <div class="summary p-2">
                                    <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->
                                    

                                    {{-- toongr bill --}}
                                    <div
                                        style="  border-top-style: solid; border-top-color: green; border-radius: 10px ">
                                        <table class="table table-summary">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr class="summary-subtotal">
                                                    <td>Subtotal:</td>
                                                    <td id="subtotal">
                                                        ${{ Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotal() }}
                                                    </td>
                                                </tr><!-- End .summary-subtotal -->
                                                <tr>
                                                    <td>Shipping:</td>
                                                    @if (Session::get('checkout') && session('checkout')['delivery_charge']>0)
                                                    <td id="price_shipping"><span class="text-danger font-weight-bold" style="font-size: 1.5rem">+</span>
                                                        ${{session('checkout')['delivery_charge']}}
                                                    </td>
                                                    {{-- <td id="price_shipping">ádfádf</td> --}}
                                                    @else
                                                    <td id="price_shipping">Free shipping</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td>Coupon:</td>
                                                    <td id="price_shipping"> 
                                                        @if (session()->has('coupon'))
                                                        <span class="text-success font-weight-bold" style="font-size: 1.5rem">-</span>
                                                            ${{ number_format(session('coupon')['value'], 2) }}
                                                        @else
                                                            <p>Not coupon</p>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr class="summary-total">
                                                    <td>Total:</td>
                                                    <td id="price_total">
                                                        @if (session()->has('coupon')) 
                                                            @php
                                                                $total = number_format(filter_var(Cart::subtotal(), FILTER_SANITIZE_NUMBER_INT) / 100 - session('coupon')['value'] + session('checkout')['delivery_charge'], 2);
                                                                echo $total;
                                                            @endphp
                                                        @else
                                                            @php
                                                                 $total = number_format(filter_var(Cart::subtotal(), FILTER_SANITIZE_NUMBER_INT) / 100   + session('checkout')['delivery_charge'], 2);
                                                                echo ("$ ".$total);
                                                            @endphp
                                                        @endif
                                                    </td>
                                                </tr><!-- End .summary-total -->
                                            </tbody>
                                        </table><!-- End .table table-summary -->
                                    </div>

                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                        <span class="btn-text">Place Order</span>
                                        <span class="btn-hover-text">Proceed to Checkout</span>
                                    </button>
                                </div><!-- End .summary -->
                            </aside><!-- End .col-lg-3 -->
                        </div><!-- End .row -->


                    </form>
                </div><!-- End .container -->
            </div><!-- End .checkout -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
