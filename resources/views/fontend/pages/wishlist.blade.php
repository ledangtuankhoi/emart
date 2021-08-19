@extends('fontend.layouts.master')
@section('content')

    <main class="main">
        <div class="page-header text-center"
            style="background-image: url('{{ asset('fontend/assets/images/page-header-bg.jpg') }}')">
            <div class="container">
                <h1 class="page-title">Wishlist<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container" id="wishlist">

                @include('fontend.layouts._wishlist')

                <div class="wishlist-share">
                    <div class="social-icons social-icons-sm mb-2">
                        <label class="social-label">Share on:</label>
                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                        <a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                    </div><!-- End .soial-icons -->
                </div><!-- End .wishlist-share -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->

@endsection


@section('scripts')
{{-- move wishlist --}}
    <script>
        $(document).on('click', '.btn-move-wishlist', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var product_qty = $(this).data('qty');
            // alert(id);
            var path = "{{ route('wishlist.move') }}";
            var token = "{{ csrf_token() }}";

            $.ajax({
                type: "POST",
                url: path,
                // dataType: "JSON",
                data: {
                    _token: token,
                    id: id,
                    product_qty: product_qty,
                },
                success: function(data) {
                    $('body #header').html(data['header_render']);
                    $('body #wishlist').html(data['wishlist_render']);
                    $('#wishlist-count').html(data['wishlist_count']); 
                    console.log(data['status']);
                    if (data['status']) {
                    console.log('as 4');
                        swal({
                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            button: "OK",
                        });
                    }else{
                        swal({
                            title: "Opps!",
                            text: data['message'],
                            icon: "warning",
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
 
{{-- delect wishlist --}}
<script>
    $(document).on('click', '.btn-remove-wishlist', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        // alert(id);
        var path = "{{ route('wishlist.delete') }}";
        var token = "{{ csrf_token() }}";

        $.ajax({
            type: "POST",
            url: path,
            // dataType: "JSON",
            data: {
                _token: token,
                id: id,
            },
            success: function(data) {
                $('body #header').html(data['header_render']);
                $('body #wishlist').html(data['wishlist_render']);
                $('#wishlist-count').html(data['wishlist_count']); 
                console.log(data['status']);
                if (data['status']) {
                console.log('as 4');
                    swal({
                        title: "Good job!",
                        text: data['message'],
                        icon: "success",
                        button: "OK",
                    });
                }else{
                    swal({
                        title: "Opps!",
                        text: data['message'],
                        icon: "warning",
                        button: "OK",
                    });
                }
            },
            error: function(err) {
                swal({
                        title: "Good job!",
                        text: "Đợi xúi",
                        icon: "info",
                        button: "OK",
                    });
                console.log('error', err);
            }
        });
    });
</script>

@endsection
