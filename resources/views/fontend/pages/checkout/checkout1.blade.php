    @extends('fontend.layouts.master')

    @section('content')

        <main class="main">
            <div class="page-header text-center"
                style="background-image: url('{{ asset('fontend/assets/images/page-header-bg.jpg') }}')">
                <div class="container">
                    <h1 class="page-title">Checkout<span>Shop</span></h1>
                </div><!-- End .container -->
            </div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="checkout">
                    <div class="container">
                        <div class="checkout-discount">
                            <form action="#">
                                <input type="text" class="form-control" required id="checkout-discount-input">
                                <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here
                                        to
                                        enter your code</span></label>
                            </form>
                        </div><!-- End .checkout-discount -->
                        <form action="{{ route('checkout.review') }}" method="POST">
                            @csrf
                            <div class="row col-sm-12">
                                <div class="col-sm-12"> 
                                    @if ($errors->any())
                                        <div class="alert alert-danger text-white">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif 
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-7">
                                    {{-- address-defauft --}}
                                    <div id="address-defauft">
                                        <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                                        @php
                                            $name = explode(' ', $user->full_name);
                                        @endphp
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>First Name *</label>
                                                <input type="text" class="form-control" name="first_name" value="{{ $name[0] }}"
                                                    readonly>
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>Last Name *</label>
                                                <input type="text" class="form-control" name="last_name" value="{{ $name[1] }}"
                                                    readonly>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->
                                        <label>Country *</label>
                                        <input type="text" class="form-control" name="country"
                                            value="{{ $user->country }}" required>

                                        <label>Street address *</label>
                                        <input type="text" class="form-control" placeholder="House number and Street name"
                                            name="address" value="{{ $user->address }}" required>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Town / City *</label>
                                                <input type="text" class="form-control" name="city"
                                                    value="{{ $user->city }}" required>
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>State / County *</label>
                                                <input type="text" class="form-control" name="state"
                                                    value="{{ $user->state }}" required>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Postcode / ZIP *</label>
                                                <input type="text" class="form-control" name="postcode"
                                                    value="{{ $user->postcode }}" required>
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>Phone *</label>
                                                <input type="tel" class="form-control" name="phone"
                                                    value="{{ $user->phone }}" required>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <label>Email address *</label>
                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                                            readonly>


                                        <label>Order notes (optional)</label>
                                        <textarea class="form-control" cols="30" rows="4"
                                            placeholder="Notes about your order, e.g. special notes for delivery"
                                            name="note"></textarea>
                                    </div> {{-- END  address-defauft --}}

                                    {{-- address-ship --}}
                                    <style>
                                        #address-ship\  input {
                                            border-radius: 25px;
                                        }

                                    </style>
                                    {{-- ship va nhaanj cùng 1 địa điểm --}}
                                    <div id="address-ship " class="list-group-item-success px-2 pb-1 "
                                        style="  border-top-style: solid; border-top-color: green; border-radius: 10px ">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkout-create-acc">
                                            <label class="custom-control-label" for="checkout-create-acc">Create an
                                                account?</label>
                                        </div><!-- End .custom-checkbox -->

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkout-diff-address">
                                            <label class="custom-control-label" for="checkout-diff-address">Ship to a
                                                different
                                                address?</label>
                                        </div><!-- End .custom-checkbox -->
                                        <h2 class="checkout-title">Ship to a same address </h2><!-- End .checkout-title -->
                                        @php
                                            $sname = explode(' ', $user->full_name);
                                        @endphp
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>First Name *</label>
                                                <input type="text" class="form-control" name="sfirst_name" value="{{ $sname[0] }}"
                                                     >
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>Last Name *</label>
                                                <input type="text" class="form-control" name="slast_name" value="{{ $sname[1] }}"
                                                     >
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <label>Country *</label>
                                        <input type="text" class="form-control" name="scountry"
                                            value="{{ $user->scountry }}" required>

                                        <label>Street address *</label>
                                        <input type="text" class="form-control" placeholder="House number and Street name"
                                            name="saddress" value="{{ $user->saddress }}" required>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Town / City *</label>
                                                <input type="text" class="form-control" name="scity"
                                                    value="{{ $user->scity }}" required>
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>State / County *</label>
                                                <input type="text" class="form-control" name="sstate"
                                                    value="{{ $user->sstate }}" required>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Postcode / ZIP *</label>
                                                <input type="text" class="form-control" name="spostcode"
                                                    value="{{ $user->spostcode }}" required>
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>Phone *</label>
                                                <input type="number" class="form-control" name="sphone"
                                                    value="{{ $user->phone }}" required>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <label>Email address *</label>
                                        <input type="email" class="form-control" name="semail" value="{{ $user->email }}"
                                            readonly>


                                        <label>Order notes (optional)</label>
                                        <textarea class="form-control" cols="30" rows="4"
                                            placeholder="Notes about your order, e.g. special notes for delivery"
                                            name=" note"></textarea>
                                    </div>{{-- END  address-ship --}}
                                </div><!-- End .col-lg-9 -->


                                <aside class="col-lg-5">
                                    <div class="summary p-2">
                                        <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->
                                        {{-- chon dichj vuj ship --}}
                                        <div
                                            style="  border-top-style: solid; border-top-color: green; border-radius: 10px ">

                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">First</th>
                                                        <th scope="col">Last</th>
                                                        <th scope="col">Handle</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($shippings) > 0)
                                                        @foreach ($shippings as $key => $item)
                                                            <tr id="tr_{{ $key }}">
                                                                <div class="form-check">
                                                                    <th scope="row" class="px-2">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="delivery_charge"
                                                                            id="exampleRadios{{ $key }}"
                                                                            value="{{ $item->delivery_charge, 2 }}"
                                                                            required>
                                                                    <th>
                                                                        <label class="form-check-label"
                                                                            for="exampleRadios{{ $key }}">
                                                                            {{ $item->shipping_address }}
                                                                        </label>
                                                                    </th>
                                                                    <th>
                                                                        <label class="form-check-label"
                                                                            for="exampleRadios{{ $key }}">
                                                                            {{ $item->delivery_time }}
                                                                        </label>
                                                                    </th>
                                                                    <th>
                                                                        <label class="form-check-label"
                                                                            for="exampleRadios{{ $key }}">
                                                                            ${{ number_format($item->delivery_charge, 2) }}
                                                                        </label>
                                                                    </th>
                                                                </div>
                                                                </th>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <p>No Shipping method found </p>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        {{-- phuongw thucws thanh toasn --}}

                                        <div
                                            style="  border-top-style: solid; border-top-color: green; border-radius: 10px ">
                                            <div class="accordion-summary" id="accordion-payment">

                                                <div class="card">
                                                    <div class="card-header">
                                                        <h2 class="card-title">
                                                            <div>
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" id="DBT" value="DBT" name="payment_method"
                                                                        class="custom-control-input" role="button"
                                                                        data-toggle="collapse" href="#collapse-DBT"
                                                                        aria-expanded="true" aria-controls="collapse-DBT">
                                                                    <label class="custom-control-label"
                                                                        for="DBT">Direct bank transfer
                                                                    </label> 
                                                                    <div id="collapse-DBT" class="collapse"
                                                                        aria-labelledby="heading-3"
                                                                        data-parent="#accordion-payment">
                                                                        <div class="card-body p-0">
                                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus ad quia doloremque odit quam magnam, officiis adipisci? Aperiam non tempore officia, accusantium quia pariatur delectus consequatur quis aspernatur blanditiis excepturi!

                                                                        </div><!-- End .card-body -->
                                                                    </div><!-- End .collapse -->
                                                                </div>

                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" id="CP" value="CP" name="payment_method"
                                                                        class="custom-control-input" role="button"
                                                                        data-toggle="collapse" href="#collapse-CP"
                                                                        aria-expanded="true" aria-controls="collapse-CP">
                                                                    <label class="custom-control-label"
                                                                        for="CP">Check payments
                                                                    </label> 
                                                                    <div id="collapse-CP" class="collapse"
                                                                        aria-labelledby="heading-3"
                                                                        data-parent="#accordion-payment">
                                                                        <div class="card-body p-0">
                                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus ad quia doloremque odit quam magnam, officiis adipisci? Aperiam non tempore officia, accusantium quia pariatur delectus consequatur quis aspernatur blanditiis excepturi!

                                                                        </div><!-- End .card-body -->
                                                                    </div><!-- End .collapse -->
                                                                </div>

                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" id="COD" value="COD" name="payment_method" 
                                                                        class="custom-control-input" role="button"
                                                                        data-toggle="collapse" href="#collapse-COD"
                                                                        aria-expanded="true" aria-controls="collapse-COD" checked>
                                                                        <input  name="payment_status" value="paid" hidden>
                                                                    <label class="custom-control-label"
                                                                        for="COD">Cash on delivery
                                                                    </label> 
                                                                    <div id="collapse-COD" class="collapse show"
                                                                        aria-labelledby="heading-3"
                                                                        data-parent="#accordion-payment">
                                                                        <div class="card-body p-0">
                                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus ad quia doloremque odit quam magnam, officiis adipisci? Aperiam non tempore officia, accusantium quia pariatur delectus consequatur quis aspernatur blanditiis excepturi!

                                                                        </div><!-- End .card-body -->
                                                                    </div><!-- End .collapse -->
                                                                </div>

                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" id="PIP" value="PIP" name="payment_method"
                                                                        class="custom-control-input" role="button"
                                                                        data-toggle="collapse" href="#collapse-PIP"
                                                                        aria-expanded="true" aria-controls="collapse-PIP">
                                                                    <label class="custom-control-label"
                                                                        for="PIP">PayPalWhat is PayPal?
                                                                    </label> 
                                                                    <div id="collapse-PIP" class="collapse"
                                                                        aria-labelledby="heading-3"
                                                                        data-parent="#accordion-payment">
                                                                        <div class="card-body p-0">
                                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus ad quia doloremque odit quam magnam, officiis adipisci? Aperiam non tempore officia, accusantium quia pariatur delectus consequatur quis aspernatur blanditiis excepturi!

                                                                        </div><!-- End .card-body -->
                                                                    </div><!-- End .collapse -->
                                                                </div>

                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" id="CC" value="CC" name="payment_method"
                                                                        class="custom-control-input" role="button"
                                                                        data-toggle="collapse" href="#collapse-CC"
                                                                        aria-expanded="true" aria-controls="collapse-CC">
                                                                    <label class="custom-control-label"
                                                                        for="CC">Credit Card (Stripe)
                                                                    </label> 
                                                                    <div id="collapse-CC" class="collapse"
                                                                        aria-labelledby="heading-3"
                                                                        data-parent="#accordion-payment">
                                                                        <div class="card-body p-2">
                                                                             <div class="form-group">
                                                                               <label for="card-number">Card number</label>
                                                                               <input type="number"
                                                                                 class="form-control" name="card-number" id="card-number" aria-describedby="helpId" placeholder="number">

                                                                                 <label for="card-number">Card number</label>
                                                                               <input type="number"
                                                                                 class="form-control" name="card-number" id="card-number" aria-describedby="helpId" placeholder="number">

                                                                                 <label for="card-number">Card number</label>
                                                                               <input type="number"
                                                                                 class="form-control" name="card-number" id="card-number" aria-describedby="helpId" placeholder="number">

                                                                             </div>
                                                                        </div><!-- End .card-body -->
                                                                    </div><!-- End .collapse -->
                                                                </div>
 
                                                            </div>
                                                        </h2>
                                                    </div>
                                                </div>


                                            </div><!-- End .accordion -->
                                        </div>

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
                                                        <td id="price_shipping">Free shipping</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Coupon:</td>
                                                        <td id="coupon">
                                                            @if (session()->has('coupon'))
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
                                                                // Cart::subtotal($decimals, $decimalSeperator, $thousandSeperator);

                                                                    $total = number_format(filter_var(Cart::subtotal(), FILTER_SANITIZE_NUMBER_INT) / 100 - session('coupon')['value'], 2);
                                                                    echo $total;
                                                                @endphp
                                                            @else
                                                                {{ Cart::subtotal() }}
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


    @section('scripts')
        <script>
            $(document).on('change', '#checkout-diff-address', function(e) {
                e.preventDefault();
                if ($(this).is(':checked')) {
                    $("[name='sfirst_name']").val($("[name='first_name']").val());
                    $("[name='slast_name']").val($("[name='last_name']").val());
                    $("[name='scountry']").val($("[name='country']").val());
                    $("[name='saddress']").val($("[name='address']").val());
                    $("[name='scity']").val($("[name='city']").val());
                    $("[name='sstate']").val($("[name='state']").val());
                    $("[name='spostcode']").val($("[name='postcode']").val());
                    $("[name='sphone']").val($("[name='phone']").val());
                    $("[name='semail']").val($("[name='email']").val());
                    // alert($("[name='city']").val());
                } else {
                    $("[name='sfirst_name']").val('');
                    $("[name='slast_name']").val('');
                    $("[name='scountry']").val('');
                    $("[name='saddress']").val('');
                    $("[name='scity']").val('');
                    $("[name='sstate']").val('');
                    $("[name='spostcode']").val('');
                    $("[name='sphone']").val('');
                    $("[name='semail']").val('');
                }

            });
        </script>

        {{-- tổng tiền cho total với ship - coupon - subtotal --}}
        <script>
            var inputCheck = $("table tbody tr th input").toArray();
            var array = $("#price_total").text().split(" ");
            // console.log((Math.round(222.11 * 100) / 100).toFixed(2));
            var total;
            // alert(array);
            array.forEach(item => {
                if (parseFloat(item)) {
                    total = item;
                }
            });

            total = total.replaceAll(",", "");
            total = (Math.round(total * 100) / 100).toFixed(2);
            $(inputCheck).change(function(e) {
                e.preventDefault();
                var shipping;
                $.each(inputCheck, function(key, value) {
                    // console.log($(value).val() * 100);
                    if ($(value).prop("checked")) {
                        $("#tr_" + key).addClass("list-group-item-success");
                        shipping = (Math.round($(value).val() * 100) / 100).toFixed(2);
                        $('#price_shipping').html("$" + shipping);
                        var total_1 = (Math.round((parseFloat(total) + parseFloat(shipping)) * 100) / 100)
                            .toFixed(2);
                        total_1 = addCommas(total_1);
                        $("#price_total").html("$" + total_1);
                    } else {
                        $("#tr_" + key).removeClass("list-group-item-success");

                    }
                });
            });
            // them dau thap phan cho soos
            function addCommas(nStr) {
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }
        </script>

        <script>
            $("#cb").click(function(e) {
                e.preventDefault();
                $('#mode').click(function(e) {
                    e.stopPropagation();
                })
                $("#mode").prop("checked", !$("#mode").prop("checked"));
            })
        </script>
    @endsection
