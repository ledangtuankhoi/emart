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

        @include('fontend.layouts._cart-list')

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
        $(document).on('click', '.qty-text', function(e) {
            e.preventDefault();
            var id = $(this).data('id'); 

            // spinner thay đổi giá trị bằng nút lên xuống
            var spinner = $(this),
                input = spinner.closest("div.quatity").find('input[type="number"]');
            // alert(spinner);
            if (input.val() == 1) {
                return false;
            }
            // console.log((input.val()));
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
            console.log(rowId,"rq",product_qty,"stock",productQuatity);
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
                    // console.log(data);
                    $('body #header').html(data['header_render']);
                    $('body #cart-list').html(data['cart_list_render']);
                    $('#cart-count').html(data['cart_count']);
                    // console.log(data, 'render');
                    if (data['status']) {
                        // alert(data['message']);  
                        console.log(data['message']);
                    } else {
                        // alert(data['message']);
                        console.log(data['message']);
                    }
                },
                error: function(err) {
                     console.log(err);;
                }
            });
        }
    </script>
@endsection
