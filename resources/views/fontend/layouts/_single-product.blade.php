@if(count($products)>0)
                    @foreach ($products as $item)
                    @php
                        $photo = explode(',',$item->photo);
                    @endphp
                    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                        <div class="product">
                            <figure class="product-media">
                                <span class="product-label label-new">{{ucfirst($item->condition)}}</span>
                                <a href="product.html">
                                    <img src="{{$photo[0]}}" alt="Product image" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action action-icon-top">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                                    <a href="#" class="btn-product btn-compare" title="Compare"><span>compare</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">{{ucfirst(App\Models\Brand::where('id',$item->brand_id)->value('title'))}}</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="{{route('product.detail',$item->slug)}}">{{ucfirst($item->title)}}</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    ${{number_format($item->offer_price,2)}} (<small><del class="text-danger">${{number_format($item->price,2)}}</del></small>)
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 0%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 0 Reviews )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" style="background: #cc9966;"><span class="sr-only">Color name</span></a>
                                    <a href="#" class="active" style="background: #ebebeb;"><span class="sr-only">Color name</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                    @endforeach
                    @else
                    <p>Product not found</p>
                    @endif 