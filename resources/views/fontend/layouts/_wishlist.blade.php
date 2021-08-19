                <table class="table table-wishlist table-mobile">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quatity</th>
                            <th>Stock Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            use App\Models\Product;
                        @endphp
                        @if (Cart::instance('wishlist')->count() > 0)
                            @foreach (Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content() as $item)
                                <tr>
                                    <td class="product-col">
                                        <div class="product">
                                            <figure class="product-media">
                                                <a href="{{ route('product.detail', $item->model->slug) }}">
                                                    <img src="{{ $item->model->photo }}" alt="Product image">
                                                </a>
                                            </figure>

                                            <h3 class="product-title">
                                                <a href="{{ route('product.detail', $item->model->slug) }}">{{ ucfirst($item->name) }}</a>
                                            </h3><!-- End .product-title -->
                                        </div><!-- End .product -->
                                    </td>
                                    <td class="price-col">${{ $item->price }}</td>
                                    <td class="qutity-col">{{ $item->qty }}</td>
                                    @if ($item->model->stock = 0)
                                        <td class="stock-col"><span class="out-of-stock">Out In stock</span></td>
                                    @else
                                        <td colspan="5" class="stock-col"><span class="in-stock">In stock</span></td>
                                    @endif
                                    <td class="action-col"> 
                                        <a class="btn btn-move-wishlist btn-block btn-outline-primary-2"  data-id="{{$item->rowId}}" data-qty="{{$item->qty}}"
                                        aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-list-alt"></i>Move To Cart
                                        </a>
                                    </td>
                                    <td class="remove-col"><button class="btn-remove btn-remove-wishlist" data-id="{{ $item->rowId }}"><i
                                                class="icon-close"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <p>Bạn Không có sản phẩm nào trong Wishlist</p>
                        @endif
                    </tbody>
                </table><!-- End .table table-wishlist -->