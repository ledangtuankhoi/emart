@extends('fontend.layouts.master')
@section('content')
    <style>
        .btn-product:hover span {
            color: white;
        }

        .add-to-wishlist:hover span {
            color: black;
        }

    </style>
    <main class="main">
        <div class="page-content">
            <div class="product-details-top">
                <div class="bg-light pb-5 mb-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                        <div class="container d-flex align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Products</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Gallery</li>
                            </ol>

                            <nav class="product-pager ml-auto" aria-label="Product">
                                <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous"
                                    tabindex="-1">
                                    <i class="icon-angle-left"></i>
                                    <span>Prev</span>
                                </a>

                                <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                                    <span>Next</span>
                                    <i class="icon-angle-right"></i>
                                </a>
                            </nav><!-- End .pager-nav -->
                        </div><!-- End .container -->
                    </nav><!-- End .breadcrumb-nav -->
                    <div class="container">
                        <div class="product-gallery-carousel owl-carousel owl-full owl-nav-dark">
                            @php
                                $photo = explode(',', $product->photo);
                                // dd($product);
                            @endphp
                            @if ($product)
                                @if ($photo)

                                    @foreach ($photo as $item)
                                        <figure class="product-gallery-image">
                                            <img src="{{ $item }}" data-zoom-image="{{ $item }}"
                                                alt="product image">
                                        </figure><!-- End .product-gallery-image -->
                                    @endforeach
                                @else
                                    <p>not photo</p>
                                @endif
                            @else
                                <p>not fountd data</p>
                            @endif
                        </div><!-- End .owl-carousel -->
                    </div><!-- End .container -->
                </div><!-- End .bg-light pb-5 -->

                <div class="product-details product-details-centered product-details-separator">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="product-title">{{ ucfirst($product->title) }}</h1><!-- End .product-title -->

                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                                </div><!-- End .rating-container -->

                                <div class="product-price">
                                    ${{ number_format($product->offer_price, 2) }} (<small><del
                                            class="text-danger">${{ number_format($product->price, 2) }}</del></small>)
                                </div><!-- End .product-price -->

                                <div class="product-content">
                                    <p>{{ $product->summary }}</p>
                                </div><!-- End .product-content -->

                                <div class="details-filter-row details-row-size">
                                    <label>Color:</label>

                                    <div class="product-nav product-nav-dots">
                                        <a href="#" class="active" style="background: #cc9966;"><span
                                                class="sr-only">Color name</span></a>
                                        <a href="#" style="background: #7fc5ed;"><span class="sr-only">Color
                                                name</span></a>
                                        <a href="#" style="background: #e8c97a;"><span class="sr-only">Color
                                                name</span></a>
                                    </div><!-- End .product-nav -->
                                </div><!-- End .details-filter-row -->

                                <div class="details-filter-row details-row-size mb-md-1">
                                    <label>Size:</label>

                                    <div class="product-size">
                                        <a href="#" title="Small" class="{{ $product->size == 'S' ? 'active' : '' }}">S</a>
                                        <a href="#" title="Medium" class="{{ $product->size == 'S' ? 'active' : '' }}">M</a>
                                        <a href="#" title="Large" class="{{ $product->size == 'S' ? 'active' : '' }}">L</a>
                                        <a href="#" title="Extra Large"
                                            class="{{ $product->size == 'S' ? 'active' : '' }}">XL</a>
                                    </div><!-- End .product-size -->

                                    <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
                                </div><!-- End .details-filter-row -->
                            </div><!-- End .col-md-6 -->

                            <div class="col-md-6">
                                <div class="product-details-action">
                                    <div class="details-action-col">
                                        <div class="product-details-quantity">
                                            <input type="number" id="qty" class="form-control" value="1" min="1" max="10"
                                                step="1" data-decimals="0" required>
                                        </div><!-- End .product-details-quantity -->

                                        {{-- <a href="#" class="btn-product btn-cart add-to-cart"><span>add to cart</span></a> --}}
                                        <a href="#" class="btn-product btn-cart add-to-cart"
                                            data-product-id="{{ $product->id }}" id="add-to-cart-{{ $product->id }}">
                                            <span>add to cart</span>
                                        </a>
                                    </div><!-- End .details-action-col -->

                                    <div class="details-action-wrapper">
                                        {{-- <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a> --}}

                                        <a href="#" class="add-to-wishlist btn-product btn-wishlist" title="Wishlist"
                                            data-quatity="1" data-product-id="{{ $product->id }}"
                                            id="add-to-wishlist-{{ $product->id }}">
                                            <span>Add to Wishlist</span>
                                        </a>

                                        <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to
                                                Compare</span></a>
                                    </div><!-- End .details-action-wrapper -->
                                </div><!-- End .product-details-action -->

                                <div class="product-details-footer details-footer-col">
                                    <div class="product-cat">
                                        <span>Category:</span>
                                        <a href="#">Women</a>,
                                        <a href="#">Dresses</a>,
                                        <a href="#">Yellow</a>
                                    </div><!-- End .product-cat -->

                                    <div class="social-icons social-icons-sm">
                                        <span class="social-label">Share:</span>
                                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                                class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                                class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                                class="icon-instagram"></i></a>
                                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                                class="icon-pinterest"></i></a>
                                    </div>
                                </div><!-- End .product-details-footer -->
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End .product-details -->
            </div><!-- End .product-details-top -->

            <div class="container">
                <div class="product-details-tab">
                    <ul class="nav nav-pills justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab"
                                role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab"
                                role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-shipping-link" data-toggle="tab"
                                href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab"
                                aria-selected="false">Shipping & Returns</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab"
                                role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (2)</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
                            aria-labelledby="product-desc-link">
                            <div class="product-desc-content">
                                <h3>Product Information</h3>
                                {{ $product->description }}

                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat
                                    mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper
                                    suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam
                                    porttitor mauris sit amet orci. Aenean dignissim pellentesque felis. Phasellus ultrices
                                    nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique
                                    cursus. </p>
                            </div><!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="product-info-tab" role="tabpanel"
                            aria-labelledby="product-info-link">
                            <div class="product-desc-content">
                                <h3>Information</h3>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat
                                    mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper
                                    suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam
                                    porttitor mauris sit amet orci. </p>

                                <h3>Fabric & care</h3>
                                <ul>
                                    <li>Faux suede fabric</li>
                                    <li>Gold tone metal hoop handles.</li>
                                    <li>RI branding</li>
                                    <li>Snake print trim interior </li>
                                    <li>Adjustable cross body strap</li>
                                    <li> Height: 31cm; Width: 32cm; Depth: 12cm; Handle Drop: 61cm</li>
                                </ul>

                                <h3>Size</h3>
                                <p>one size</p>
                            </div><!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel"
                            aria-labelledby="product-shipping-link">
                            <div class="product-desc-content">
                                <h3>Delivery & returns</h3>
                                <p>We deliver to over 100 countries around the world. For full details of the delivery
                                    options we offer, please view our <a href="#">Delivery information</a><br>
                                    We hope you???ll love every purchase, but if you ever need to return an item you can do so
                                    within a month of receipt. For full details of how to make a return, please view our <a
                                        href="#">Returns information</a></p>
                            </div><!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="product-review-tab" role="tabpanel"
                            aria-labelledby="product-review-link">
                            <div class="reviews">
                                <h3>Reviews (2)</h3>
                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">Samanta J.</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 80%;"></div>
                                                    <!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                            </div><!-- End .rating-container -->
                                            <span class="review-date">6 days ago</span>
                                        </div><!-- End .col -->
                                        <div class="col">
                                            <h4>Good, perfect size</h4>

                                            <div class="review-content">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum
                                                    dolores assumenda asperiores facilis porro reprehenderit animi culpa
                                                    atque blanditiis commodi perspiciatis doloremque, possimus, explicabo,
                                                    autem fugit beatae quae voluptas!</p>
                                            </div><!-- End .review-content -->

                                            <div class="review-action">
                                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                            </div><!-- End .review-action -->
                                        </div><!-- End .col-auto -->
                                    </div><!-- End .row -->
                                </div><!-- End .review -->

                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">John Doe</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 100%;"></div>
                                                    <!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                            </div><!-- End .rating-container -->
                                            <span class="review-date">5 days ago</span>
                                        </div><!-- End .col -->
                                        <div class="col">
                                            <h4>Very good</h4>

                                            <div class="review-content">
                                                <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis
                                                    laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi,
                                                    quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
                                            </div><!-- End .review-content -->

                                            <div class="review-action">
                                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                            </div><!-- End .review-action -->
                                        </div><!-- End .col-auto -->
                                    </div><!-- End .row -->
                                </div><!-- End .review -->
                            </div><!-- End .reviews -->
                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .product-details-tab -->
            </div><!-- End .container -->

            <div class="container">
                <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                        "nav": false, 
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":1
                            },
                            "480": {
                                "items":2
                            },
                            "768": {
                                "items":3
                            },
                            "992": {
                                "items":4
                            },
                            "1200": {
                                "items":4,
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>

                    @php
                        $productByCat = App\Models\Product::where('cat_id', $product->cat_id)
                            ->limit(2)
                            ->get();
                        $productByBrand = App\Models\Product::where('brand_id', $product->brand_id)
                            ->limit(2)
                            ->get();
                        $productByChild_Cat = App\Models\Product::where('cat_id', $product->child_cat_id)
                            ->limit(2)
                            ->get();
                        $productByVendor = App\Models\Product::where('vendor_id', $product->vendor_id)
                            ->limit(2)
                            ->get();
                        
                        $productSuggest = $productByVendor
                            ->concat($productByChild_Cat)
                            ->concat($productByBrand)
                            ->concat($productByCat);
                        
                        // dd($productByVendor,$productByChild_Cat,$productByBrand,$productByCat,$s);
                        
                    @endphp
                    @if (count($productSuggest) > 0)

                        @foreach ($productSuggest as $key => $item)
                            @php
                                $photo = explode(',', $item->photo);
                            @endphp
                            <div class="product product-7 text-center">
                                <figure class="product-media">
                                    <span
                                        class="product-label label-new {{ $item->condition != 'new' ? 'd-none' : '' }}">{{ $item->condition == 'new' ? 'New' : '' }}</span>
                                    <a href="{{ route('product.detail', $item->slug) }}">
                                        <img src="{{ $photo[0] }}" alt="Product image" class="product-image">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                                wishlist</span></a>
                                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview"
                                            title="Quick view"><span>Quick view</span></a>
                                        <a href="#" class="btn-product-icon btn-compare"
                                            title="Compare"><span>Compare</span></a>
                                    </div><!-- End .product-action-vertical -->

                                    <div class="product-action">
                                        {{-- <a href="#" class="btn-product btn-cart"><span>add to cart</span></a> --}}
                                        <a href="#" class="btn-product btn-cart add-to-cart" data-quatity="1"
                                            data-product-id="{{ $item->id }}" id="add-to-cart-{{ $item->id }}">
                                            <span>add to cart</span>
                                        </a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a
                                            href="#">{{ ucfirst(App\Models\Brand::where('id', $item->brand_id)->value('title')) }}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a
                                            href="{{ route('product.detail', $item->slug) }}">{{ ucfirst($item->title) }}</a>
                                    </h3><!-- End .product-title -->
                                    <div class="product-price">
                                        ${{ number_format($item->offer_price, 2) }} (<small><del
                                                class="text-danger">${{ number_format($item->price, 2) }}</del></small>)
                                    </div><!-- End .product-price -->
                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        <span class="ratings-text">( 2 Reviews )</span>
                                    </div><!-- End .rating-container -->

                                    <div class="product-nav product-nav-dots">
                                        <a href="#" class="active" style="background: #cc9966;"><span
                                                class="sr-only">Color name</span></a>
                                        <a href="#" style="background: #7fc5ed;"><span class="sr-only">Color
                                                name</span></a>
                                        <a href="#" style="background: #e8c97a;"><span class="sr-only">Color
                                                name</span></a>
                                    </div><!-- End .product-nav -->
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->
                        @endforeach
                    @else
                        <p>not suggest</p>
                    @endif
                </div><!-- End .owl-carousel -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->

@endsection

@section('scripts')

    {{-- add product cart --}}
    <script>
        $(document).on('click', '.add-to-cart', function(e) {
            e.preventDefault();
            var product_id = $(this).data('product-id');
            console.log(product_id);

            if($(this).data('quatity')){
                var product_qty = $(this).data('quatity');
            }else{
                var product_qty = $("#qty").val();
            }

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
                    $('#add-to-cart-' + product_id).html("<span >add to cart</span>");
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
                error: function(err) {
                    console.log(err);
                }
            });
        });
    </script>


    {{-- add product wishlist --}}
    <script>
        $(document).on('click', '.add-to-wishlist', function(e) {
            e.preventDefault();
            var product_id = $(this).data('product-id');
            console.log(product_id);
            var product_qty = $(this).data('quatity');
            // alert(product_id,product_qty);
            var path = "{{ route('wishlist.store') }} ";
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
                    } else if (data['present']) {
                        swal({
                            title: "Opps!",
                            text: data['message'],
                            icon: "warning",
                            button: "OK",
                        });
                    } else {
                        swal({
                            title: "Sorry!",
                            text: " Sorry you don't add product to wishlist",
                            icon: "warning",
                            button: "OK",
                        });
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
    </script>
@endsection
