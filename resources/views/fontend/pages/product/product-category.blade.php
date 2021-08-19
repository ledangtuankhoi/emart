@extends('fontend.layouts.master')

@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('{{asset('fontend/assets/images/page-header-bg.jpg')}}')">
        <div class="container">
            <h1 class="page-title">{{strtoupper ($categories->title)}}<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Category</a></li> 
                <li class="breadcrumb-item active" aria-current="page">{{ucfirst($categories->title)}}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="toolbox">
                <div class="toolbox-left">
                    <a href="#" class="sidebar-toggler"><i class="icon-bars"></i>Filters</a>
                </div><!-- End .toolbox-left -->

                <div class="toolbox-center">
                    <div class="toolbox-info">
                        {{-- tinhs count product cos trong cate --}}
                        @php
                            $count = 0;
                            foreach($categories->products as $item){
                                if($item->status == 'active')
                                    $count ++;
                            }
                        @endphp
                        Showing <span>{{$count}}</span> Products
                    </div><!-- End .toolbox-info -->
                </div><!-- End .toolbox-center -->

                <div class="toolbox-right">
                    <div class="toolbox-sort">
                        <label for="sortBy">Sort by:</label>
                        <div class="select-custom">
                            <select name="sortBy" id="sortBy" class="form-control">
                                <option  selected>Default Sort</option>
                                <option value="priceAsc" {{old('sortBy')=='priceAsc'?'selected':''}}>Price - Lower to Higher</option>
                                <option value="priceDesc">Price - Higher to Lower</option>
                                <option value="titleAsc">Alphabetical Ascending</option>
                                <option value="titleDesc">Alphabetical Descending</option>
                                <option value="discAsc">Discount- Lower to Higher</option>
                                <option value="discDesc">Discount- Higher to Lower</option>
                            </select>
                        </div>
                    </div><!-- End .toolbox-sort -->
                </div><!-- End .toolbox-right -->
            </div><!-- End .toolbox -->

            <div class="products" >
                <div class="row" id="product-data">
                    @include('fontend.layouts._single-product')
                </div><!-- End .row -->
            </div><!-- End .products -->
            
                             <div class="ajax-load text-center" style="display: none">
                                 <img src="{{asset('fontend/giphy-unscreen.gif')}}"style="width: 6% !important;">
                             </div>

            <div class="sidebar-filter-overlay"></div><!-- End .sidebar-filter-overlay -->
            <aside class="sidebar-shop sidebar-filter">
                <div class="sidebar-filter-wrapper">
                    <div class="widget widget-clean">
                        <label><i class="icon-close"></i>Filters</label>
                        <a href="#" class="sidebar-filter-clear">Clean All</a>
                    </div><!-- End .widget -->
                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                Category
                            </a>
                        </h3><!-- End .widget-title -->
                        <div class="collapse show" id="widget-1">
                            <div class="widget-body">
                                <div class="filter-items filter-items-count">
                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cat-1">
                                            <label class="custom-control-label" for="cat-1">Dresses</label>
                                        </div><!-- End .custom-checkbox -->
                                        <span class="item-count">3</span>
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cat-2">
                                            <label class="custom-control-label" for="cat-2">T-shirts</label>
                                        </div><!-- End .custom-checkbox -->
                                        <span class="item-count">0</span>
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cat-3">
                                            <label class="custom-control-label" for="cat-3">Bags</label>
                                        </div><!-- End .custom-checkbox -->
                                        <span class="item-count">4</span>
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cat-4">
                                            <label class="custom-control-label" for="cat-4">Jackets</label>
                                        </div><!-- End .custom-checkbox -->
                                        <span class="item-count">2</span>
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cat-5">
                                            <label class="custom-control-label" for="cat-5">Shoes</label>
                                        </div><!-- End .custom-checkbox -->
                                        <span class="item-count">2</span>
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cat-6">
                                            <label class="custom-control-label" for="cat-6">Jumpers</label>
                                        </div><!-- End .custom-checkbox -->
                                        <span class="item-count">1</span>
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cat-7">
                                            <label class="custom-control-label" for="cat-7">Jeans</label>
                                        </div><!-- End .custom-checkbox -->
                                        <span class="item-count">1</span>
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cat-8">
                                            <label class="custom-control-label" for="cat-8">Sportwear</label>
                                        </div><!-- End .custom-checkbox -->
                                        <span class="item-count">0</span>
                                    </div><!-- End .filter-item -->
                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                                Size
                            </a>
                        </h3><!-- End .widget-title -->

                        <div class="collapse show" id="widget-2">
                            <div class="widget-body">
                                <div class="filter-items">
                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="size-1">
                                            <label class="custom-control-label" for="size-1">XS</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="size-2">
                                            <label class="custom-control-label" for="size-2">S</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked id="size-3">
                                            <label class="custom-control-label" for="size-3">M</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked id="size-4">
                                            <label class="custom-control-label" for="size-4">L</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="size-5">
                                            <label class="custom-control-label" for="size-5">XL</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="size-6">
                                            <label class="custom-control-label" for="size-6">XXL</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->
                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
                                Colour
                            </a>
                        </h3><!-- End .widget-title -->

                        <div class="collapse show" id="widget-3">
                            <div class="widget-body">
                                <div class="filter-colors">
                                    <a href="#" style="background: #b87145;"><span class="sr-only">Color Name</span></a>
                                    <a href="#" style="background: #f0c04a;"><span class="sr-only">Color Name</span></a>
                                    <a href="#" style="background: #333333;"><span class="sr-only">Color Name</span></a>
                                    <a href="#" class="selected" style="background: #cc3333;"><span class="sr-only">Color Name</span></a>
                                    <a href="#" style="background: #3399cc;"><span class="sr-only">Color Name</span></a>
                                    <a href="#" style="background: #669933;"><span class="sr-only">Color Name</span></a>
                                    <a href="#" style="background: #f2719c;"><span class="sr-only">Color Name</span></a>
                                    <a href="#" style="background: #ebebeb;"><span class="sr-only">Color Name</span></a>
                                </div><!-- End .filter-colors -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                Brand
                            </a>
                        </h3><!-- End .widget-title -->

                        <div class="collapse show" id="widget-4">
                            <div class="widget-body">
                                <div class="filter-items">
                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-1">
                                            <label class="custom-control-label" for="brand-1">Next</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-2">
                                            <label class="custom-control-label" for="brand-2">River Island</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-3">
                                            <label class="custom-control-label" for="brand-3">Geox</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-4">
                                            <label class="custom-control-label" for="brand-4">New Balance</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-5">
                                            <label class="custom-control-label" for="brand-5">UGG</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-6">
                                            <label class="custom-control-label" for="brand-6">F&F</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-7">
                                            <label class="custom-control-label" for="brand-7">Nike</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
                                Price
                            </a>
                        </h3><!-- End .widget-title -->

                        <div class="collapse show" id="widget-5">
                            <div class="widget-body">
                                <div class="filter-price">
                                    <div class="filter-price-text">
                                        Price Range:
                                        <span id="filter-price-range"></span>
                                    </div><!-- End .filter-price-text -->

                                    <div id="price-slider"></div><!-- End #price-slider -->
                                </div><!-- End .filter-price -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->
                </div><!-- End .sidebar-filter-wrapper -->
            </aside><!-- End .sidebar-filter -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection

@section('scripts')

    {{-- type sort  --}}
    <script>
        $('#sortBy').change(function (e) { 
            e.preventDefault();
            var sort = $('#sortBy').val();  
            window.location="{{url(''.$route.'')}}/{{$categories->slug}}?sort="+sort;
        });
    </script>

    {{-- load more product --}}
    <script>
        function loadmoreData (page) {
            $.ajax({
                type: "get",
                url: "?page="+page, 
                beforeSend:function(){
                    $('.ajax-load').show();
                }, 
            })
            .done(function(data){ 
                if(data.html==''){ 
                    $('.ajax-load').html('No more product availabe');
                    return;
                } 
                $('.ajax-load').hide();
                $('#product-data').append(data.html); 
            })
            .fail(function(){
                alert('somthing went wrong! please try again')
            });
          }
        var page = 1; 
        $(window).scroll(function(){
            if($(window).scrollTop()+$(window).height()+300 >= $(document).height()){
                page ++; 
                loadmoreData(page);
            }
        })
    </script>

    {{-- add product cart  --}}
    <script>
        $(document).on('click', '.add-to-cart', function(e) {
            e.preventDefault();
            var product_id = $(this).data('product-id');
            var product_qty = $(this).data('quatity');

            var path = "{{ route('cart.store') }}";
            var token = "{{ csrf_token() }}"

            $.ajax({
                type: "POST",
                url: path,
                dataType: "JSON",
                data: {
                    product_id: product_id,
                    product_qty: product_qty,
                    _token: token,
                },
                beforeSend: function() {
                    $('#add-to-cart-' + product_id).html(
                        "<i class='fas fa-spinner fa-spin'></i><p>Loading...</p>");
                },
                complete: function() {
                    $('#add-to-cart-' + product_id).html("<i class='fa-cart-plus'></i>");
                },
                success: function(data) { 
                    $('body #header').html(data['header_render']);
                    $('#cart-count').html(data['cart_count']);
                    if (data['status']) {
                        swal({
                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            button: "OK",
                        });
                    }
                },
                error:function (err){
                    console.log(err);
                }
            });
        });
    </script>

    
    {{-- add product wishlist  --}}
    <script>
        $(document).on('click', '.add-to-wishlist', function(e) {
            e.preventDefault();
            var product_id = $(this).data('product-id');
            var product_qty = $(this).data('quatity');
            // alert(product_id,product_qty);
            var path = "{{route('wishlist.store')}} ";
            var token = "{{ csrf_token() }}"

            $.ajax({
                type: "POST",
                url: path,
                dataType: "JSON",
                data: {
                    product_id: product_id,
                    product_qty: product_qty,
                    _token: token,
                },
                beforeSend: function() {
                    $('#add-to-wishlist-' + product_id).removeClass('btn-wishlist');
                    $('#add-to-wishlist-' + product_id).html(
                        "<i class='fas fa-spinner fa-spin'></i><span>Loading...</span>");
                },
                complete: function() {                    
                    $('#add-to-wishlist-' + product_id).addClass('btn-wishlist');
                    $('#add-to-wishlist-' + product_id).html(
                        "<span>add towishlist</span>"); 
                },
                success: function(data) { 
                    $('body #header').html(data['header_render']);
                    $('#wishlist-count').html(data['wishlist_count']);
                    if (data['status']) {
                        swal({
                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            button: "OK",
                        });
                    }else if (data['present']) {
                        swal({
                            title: "Opps!",
                            text: data['message'],
                            icon: "warning",
                            button: "OK",
                        });
                    }else{
                        swal({
                            title: "Sorry!",
                            text: " Sorry you don't add product to wishlist",
                            icon: "warning",
                            button: "OK",
                        });
                    }
                },
                error:function (err){
                    console.log(err);
                }
            });
        });
    </script>
@endsection