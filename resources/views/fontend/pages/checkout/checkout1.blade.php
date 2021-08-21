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
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-9">
                                    {{-- address-defauft --}}
                                    <div id="address-defauft">
                                        <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                                        @php
                                            $name = explode(' ', $user->full_name);
                                        @endphp
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>First Name *</label>
                                                <input type="text" class="form-control" value="{{ $name[0] }}"
                                                    readonly>
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>Last Name *</label>
                                                <input type="text" class="form-control" value="{{ $name[1] }}"
                                                    readonly>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <label>Company Name (Optional)</label>
                                        <input type="text" class="form-control">

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
                                        #address-ship\  input{
                                            border-radius: 25px;
                                        }
                                    </style>
                                    <div id="address-ship " class="list-group-item-success px-2 pb-1 " style="  border-top-style: solid; border-top-color: green; border-radius: 10px ">
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
                                        <h2 class="checkout-title">Ship Billing Details</h2><!-- End .checkout-title -->
                                        @php
                                            $sname = explode(' ', $user->full_name);
                                        @endphp
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>First Name *</label>
                                                <input type="text" class="form-control" value="{{ $sname[0] }}"
                                                    readonly>
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>Last Name *</label>
                                                <input type="text" class="form-control" value="{{ $sname[1] }}"
                                                    readonly>
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
                                                <input type="tel" class="form-control" name="sphone"
                                                    value="{{ $user->sphone }}" required>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <label>Email address *</label>
                                        <input type="email" class="form-control" name="semail" value="{{ $user->semail }}"
                                            readonly>


                                        <label>Order notes (optional)</label>
                                        <textarea class="form-control" cols="30" rows="4"
                                            placeholder="Notes about your order, e.g. special notes for delivery"
                                            name="snote"></textarea>
                                    </div>{{-- END  address-ship --}}
                                </div><!-- End .col-lg-9 -->


                                <aside class="col-lg-3">
                                    <div class="summary">
                                        <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                                        <table class="table table-summary">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td><a href="#">Beige knitted elastic runner shoes</a></td>
                                                    <td>$84.00</td>
                                                </tr>

                                                <tr>
                                                    <td><a href="#">Blue utility pinafore denimdress</a></td>
                                                    <td>$76,00</td>
                                                </tr>
                                                <tr class="summary-subtotal">
                                                    <td>Subtotal:</td>
                                                    <td>$160.00</td>
                                                </tr><!-- End .summary-subtotal -->
                                                <tr>
                                                    <td>Shipping:</td>
                                                    <td>Free shipping</td>
                                                </tr>
                                                <tr class="summary-total">
                                                    <td>Total:</td>
                                                    <td>$160.00</td>
                                                </tr><!-- End .summary-total -->
                                            </tbody>
                                        </table><!-- End .table table-summary -->

                                        <div class="accordion-summary" id="accordion-payment">
                                            <div class="card">
                                                <div class="card-header" id="heading-1">
                                                    <h2 class="card-title">
                                                        <a role="button" data-toggle="collapse" href="#collapse-1"
                                                            aria-expanded="true" aria-controls="collapse-1">
                                                            Direct bank transfer
                                                        </a>
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse-1" class="collapse show" aria-labelledby="heading-1"
                                                    data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        Make your payment directly into our bank account. Please use your
                                                        Order
                                                        ID as the payment reference. Your order will not be shipped until
                                                        the
                                                        funds have cleared in our account.
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->

                                            <div class="card">
                                                <div class="card-header" id="heading-2">
                                                    <h2 class="card-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse"
                                                            href="#collapse-2" aria-expanded="false"
                                                            aria-controls="collapse-2">
                                                            Check payments
                                                        </a>
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse-2" class="collapse" aria-labelledby="heading-2"
                                                    data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        Ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio.
                                                        Quisque
                                                        volutpat mattis eros. Nullam malesuada erat ut turpis.
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->

                                            <div class="card">
                                                <div class="card-header" id="heading-3">
                                                    <h2 class="card-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse"
                                                            href="#collapse-3" aria-expanded="false"
                                                            aria-controls="collapse-3">
                                                            Cash on delivery
                                                        </a>
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse-3" class="collapse" aria-labelledby="heading-3"
                                                    data-parent="#accordion-payment">
                                                    <div class="card-body">Quisque volutpat mattis eros. Lorem ipsum dolor
                                                        sit
                                                        amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat
                                                        mattis
                                                        eros.
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->

                                            <div class="card">
                                                <div class="card-header" id="heading-4">
                                                    <h2 class="card-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse"
                                                            href="#collapse-4" aria-expanded="false"
                                                            aria-controls="collapse-4">
                                                            PayPal <small class="float-right paypal-link">What is
                                                                PayPal?</small>
                                                        </a>
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse-4" class="collapse" aria-labelledby="heading-4"
                                                    data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non,
                                                        semper suscipit, posuere a, pede. Donec nec justo eget felis
                                                        facilisis
                                                        fermentum.
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->

                                            <div class="card">
                                                <div class="card-header" id="heading-5">
                                                    <h2 class="card-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse"
                                                            href="#collapse-5" aria-expanded="false"
                                                            aria-controls="collapse-5">
                                                            Credit Card (Stripe)
                                                            <img src="{{asset('fontend/assets/images/payments-summary.png')}}"
                                                                alt="payments cards">
                                                        </a>
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse-5" class="collapse" aria-labelledby="heading-5"
                                                    data-parent="#accordion-payment">
                                                    <div class="card-body"> Donec nec justo eget felis facilisis
                                                        fermentum.Lorem
                                                        ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio.
                                                        Quisque
                                                        volutpat mattis eros. Lorem ipsum dolor sit ame.
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->
                                        </div><!-- End .accordion -->

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
                if($(this).is(':checked')){
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
                }else{
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
    @endsection
