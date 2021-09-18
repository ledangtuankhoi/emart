
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
                                @foreach (Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->  ntent() as $item)
                                    
                                <tr>
                                    <td class="product-col">
                                        <div class="product">
                                            <figure class="product-media">
                                                <a href="#">
                                                    <img src="{{$item->model->photo}}" alt="{{$item->name}}">
                                                </a>
                                            </figure>

                                            <h3 class="product-title">
                                                <a href="{{route('product.detail',$item->model->slug)}}">{{ucfirst ($item->name)}}</a>
                                            </h3><!-- End .product-title -->
                                        </div><!-- End .product -->
                                    </td>
                                    <td class="price-col">{{number_format($item->price,2)}}</td>
                                    <td class="quantity-col">
                                        <div class="quatity cart-product-quantity">
                                            <input type="number" data-id="{{$item->rowId}}" class="qty-text form-control" value="{{$item->qty}}" id="qty-input-{{$item->rowId}}" min="1" max="10" step="1" data-decimals="0" required>
                                            <input type="hidden" data-id="{{$item->rowId}}"  data-product-quatity="{{$item->model->stock}}"  id="update-cart-{{$item->rowId}}">
                                        </div><!-- End .cart-product-quantity -->
                                    </td>
                                    <td class="total-col">{{number_format($item->price*$item->qty,2)}}</td>
                                    <td class="remove-col"><button class="btn-remove cart-del" data-id="{{$item->rowId}}"><i class="icon-close"></i></button></td>
                                </tr>
                                @endforeach
                             </tbody>
                        </table><!-- End .table table-wishlist -->