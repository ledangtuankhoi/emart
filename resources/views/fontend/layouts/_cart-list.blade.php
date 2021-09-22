<div class="page-content">
    <div class="cart">
        <div class="container">
            <div class="row" id="cart-list">
                <div class="col-lg-9">
                    {{-- cart list --}}
                    <table class="table table-cart table-mobile">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach (Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)

                                <tr>
                                    <td class="product-col">
                                        <div class="product">
                                            <figure class="product-media">
                                                <a href="#">
                                                    <img src="{{ $item->model->photo }}" alt="{{ $item->name }}">
                                                </a>
                                            </figure>

                                            <h3 class="product-title">
                                                <a
                                                    href="{{ route('product.detail', $item->model->slug) }}">{{ ucfirst($item->name) }}</a>
                                            </h3><!-- End .product-title -->
                                        </div><!-- End .product -->
                                    </td>
                                    <td class="price-col">{{ number_format($item->price, 2) }}</td>
                                    <td class="quantity-col">
                                        <div class="quatity cart-product-quantity">
                                            <input type="number" class="qty-text form-control"
                                                value="{{ $item->qty }}" data-id="{{ $item->rowId }}"
                                                id="qty-input-{{ $item->rowId }}" min="1"
                                                max="{{ $item->model->stock }}" step="1" data-decimals="0" required>
 
                                            <input type="hidden" data-id="{{ $item->rowId }}"
                                                data-product-quatity="{{ $item->model->stock }}"
                                                id="update-cart-{{ $item->rowId }}">
                                        </div><!-- End .cart-product-quantity -->
                                    </td>
                                    <td class="total-col">{{ number_format($item->price * $item->qty, 2) }}</td>
                                    <td class="remove-col"><button class="btn-remove cart-del"
                                            data-id="{{ $item->rowId }}"><i class="icon-close"></i></button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><!-- End .table table-wishlist -->
                    {{-- END cart list --}}

                    <div class="cart-bottom">
                        <div class="cart-discount">
                            <form action="{{ route('coupon.add') }}" id="coupon-form" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="code" class="form-control" required
                                        placeholder="coupon code">
                                    <div class="input-group-append">
                                        <button class="btn coupon-btn btn-outline-primary-2" type="submit"><i
                                                class="icon-long-arrow-right"></i></button>
                                    </div><!-- .End .input-group-append -->
                                </div><!-- End .input-group -->
                            </form>
                        </div><!-- End .cart-discount -->

                        <a href="#" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i
                                class="icon-refresh"></i></a>
                    </div><!-- End .cart-bottom -->
                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3">
                    <div class="summary summary-cart">
                        <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->
                        <table class="table table-summary">
                            <tbody>
                                <tr class="summary-subtotal">
                                    <td>Subtotal:</td>
                                    <td>{{ Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}</td>
                                </tr><!-- End .summary-subtotal -->

                                <tr class=" ">
                                    <td>
                                        <div class="">
                                            <p>coupon</p>
                                        </div><!-- End .custom-control -->
                                    </td>
                                    <td>$
                                        @if (Session::get('coupon'))
                                            {{ Session::get('coupon')['value'] }}
                                        @else
                                            0
                                        @endif</td>
                                </tr><!-- End .summary-shipping-row -->
 
                                <tr class="
                                            summary-total">
                                    <td>Total:</td>
                                    <td>
                                        @if (session()->has('coupon'))
                                            {{-- {{dd(gettype(session('coupon')['value']),gettype(Cart::subtotal()))}} --}}
                                            {{ number_format(filter_var(Cart::subtotal(), FILTER_SANITIZE_NUMBER_INT) / 100 - session('coupon')['value'], 2) }}
                                        @else
                                            {{ Cart::subtotal() }}
                                        @endif
                                    </td>
                                </tr><!-- End .summary-total -->
                            </tbody>
                        </table><!-- End .table table-summary -->

                        <a href="{{ route('checkout1') }}"
                            class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO
                            CHECKOUT</a>
                    </div><!-- End .summary -->

                    <a href="category.html" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE
                            SHOPPING</span><i class="icon-refresh"></i></a>
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cart -->
</div><!-- End .page-content -->
