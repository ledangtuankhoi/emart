@extends('fontend.layouts.master')
@section('content')

    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
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
                        <div class="col-lg-9" id="cart-list">

                    {{-- cart list --}}
                            @include('fontend.layouts._cart-list')
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
                                        <tr class="summary-shipping">
                                            <td>Shipping:</td>
                                            <td>&nbsp;</td>
                                        </tr>

                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="free-shipping" name="shipping"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label" for="free-shipping">Free
                                                        Save</label>
                                                </div><!-- End .custom-control -->
                                            </td>
                                            <td>$
                                                @if (Session::get('coupon'))
                                                    {{ Session::get('coupon')['value'] }}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                        </tr><!-- End .summary-shipping-row -->

                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="free-shipping" name="shipping"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label" for="free-shipping">Free
                                                        Shipping</label>
                                                </div><!-- End .custom-control -->
                                            </td>
                                            <td>$0.00</td>
                                        </tr><!-- End .summary-shipping-row -->

                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="standart-shipping" name="shipping"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="standart-shipping">Standart:</label>
                                                </div><!-- End .custom-control -->
                                            </td>
                                            <td>$10.00</td>
                                        </tr><!-- End .summary-shipping-row -->

                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="express-shipping" name="shipping"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="express-shipping">Express:</label>
                                                </div><!-- End .custom-control -->
                                            </td>
                                            <td>$20.00</td>
                                        </tr><!-- End .summary-shipping-row -->

                                        <tr class="summary-shipping-estimate">
                                            <td>Estimate for Your Country<br> <a href="dashboard.html">Change address</a>
                                            </td>
                                            <td>&nbsp;</td>
                                        </tr><!-- End .summary-shipping-estimate -->

                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>
                                                @if (session()->has('coupon'))
                                                    {{-- {{dd(gettype(session('coupon')['value']),gettype(Cart::subtotal()))}} --}}
                                                    {{ number_format(filter_var(Cart::subtotal(), FILTER_SANITIZE_NUMBER_INT) / 100 - session('coupon')['value'], 2) }}
                                                    {{ str_replace(',', '', Cart::subtotal()) - Session }}
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
    </main><!-- End .main -->

@endsection
@section('scripts')

    <script>
        $(document).on('click', '.coupon-btn', function(e) {
            e.preventDefault();
            var code = $('input[name=code]').val();
            $('.btn-coupon').html("<i class='fas fa-spinner fa-spin'></i><p>Loading...</p>")
            $('#coupon-form').submit();
            // alert(code);
        });
    </script>

    <script>
        $(document).on('click', '.cart-del', function(e) {
            e.preventDefault();
            var cart_id = $(this).data('id');

            var path = "{{ route('cart.delete') }}";
            var token = "{{ csrf_token() }}"

            $.ajax({
                type: "POST",
                url: path,
                dataType: "JSON",
                data: {
                    cart_id: cart_id,
                    _token: token,
                },
                success: function(data) {
                    $('body #header').html(data['header_render']);
                    $('#cart-count').html(data['cart_count']);
                    console.log(data, 'render');
                    if (data['status']) {
                        swal({
                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            button: "OK",
                        });
                    }
                },
                error: function(err) {
                    console.log('error', err);
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.qty-text', function() {
            var id = $(this).data('id');
            // alert(id);

            // spinner thay đổi giá trị bằng nút lên xuống
            var spinner = $(this),
                input = spinner.closest("div.quatity").find('input[type="number"]');
            // alert(spinner);
            if (input.val() == 1) {
                return false;
            }
            console.log((input.val()));
            if (input.val() != 1) {
                var newVal = parseFloat(input.val());
                $('#qyt-input-' + id).val(newVal);
            }

            var productQuatity = $('#update-cart-' + id).data('product-quatity');
            update_cart(id, productQuatity);


        });

        function update_cart(id, productQuatity) {
            var rowId = id;
            var product_qty = $('.qty-text').val();
            var path = "{{ route('cart.update') }}";
            var token = "{{ csrf_token() }}";

            $.ajax({
                type: "POST",
                url: path,
                data: {
                    _token: token,
                    rowId: rowId,
                    product_qty: product_qty,
                    productQuatity: productQuatity,
                },
                success: function(data) {
                    console.log(data);
                    $('body #header').html(data['header_render']);
                    $('body #cart-list').html(data['cart_list_render']);
                    $('#cart-count').html(data['cart_count']);
                    console.log(data, 'render');
                    if (data['status']) {
                        // alert(data['message']);  
                    } else {
                        alert(data['message']);
                    }
                },
                error: function(err) {
                    console.log(err);;
                }
            });

        }
    </script>
@endsection
