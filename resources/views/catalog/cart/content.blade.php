<div class="col-12 col-md-7">
    <ul class="list-group list-group-lg list-group-flush-x mb-6">
        @foreach( $cartCollection as $cart)
            <li class="list-group-item">
                <form class="row align-items-center">
                    <input type="hidden" name="cart" value="{{ $cart['cart_id'] }}">
                    <div class="col-3">

                        <a href="{{ route('catalog.product', $cart['product_id']) }}?variant={{ $cart['variant_id'] }}">
                            <img src="{{ $cart['photo'] }}"
                                 alt="{{ $cart['name'] }}"
                                 class="img-fluid">
                        </a>

                    </div>
                    <div class="col">
                        <div class="d-flex mb-2 font-weight-bold">
                            <a class="text-body"
                               href="{{ route('catalog.product', $cart['product_id']) }}?variant={{ $cart['variant_id'] }}">
                                {{ $cart['name'] }}
                            </a>
                            <span class="ml-auto">{{ $cart['price']->discount_price }} р.</span>
                        </div>
                        <p class="mb-3 font-size-sm text-muted">
                            На складе:
                            <strong>
                                {{ $cart['price']->quantity > 10 ? 'достаточно' : $cart['price']->quantity }}
                                шт.
                            </strong>
                            <br>
                            @if( $size_name = $cart['price']->size?->name )
                                Размер: <strong>{{ $size_name }}</strong>
                            @endif
                        </p>
                        @if( $cart['prices']->count() )
                            <div class="mb-2">
                                @foreach( $cart['prices'] as $item_price )
                                    <div
                                        class="custom-control custom-control-inline custom-control-size mb-2">
                                        @if( (int)$item_price->id === (int)$cart['price_id'])
                                            <input type="radio" class="custom-control-input"
                                                   name="price[{{ $cart['cart_id'] }}]"
                                                   value="{{ $item_price->id }}"
                                                   id="size_radio_{{ $cart['cart_id'] }}-{{ $item_price->id }}"
                                                   onchange="cartUpdate($(this))"
                                                   checked
                                                   @if( $item_price->quantity < 1 ) disabled @endif
                                            >
                                        @else
                                            <input type="radio" class="custom-control-input"
                                                   name="price[{{ $cart['cart_id'] }}]"
                                                   value="{{ $item_price->id }}"
                                                   id="size_radio_{{ $cart['cart_id'] }}-{{ $item_price->id }}"
                                                   onchange="cartUpdate($(this))"
                                                   @if( $item_price->quantity < 1 ) disabled @endif
                                            >
                                        @endif
                                        <label class="custom-control-label"
                                               for="size_radio_{{ $cart['cart_id'] }}-{{ $item_price->id }}">{{ $item_price->size->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="d-flex align-items-center">

                            <select class="custom-select custom-select-xxs w-auto" name="quantity"
                                    onchange="cartUpdate($(this))">
                                @for( $i = 1; $i <= ($cart['price']->quantity > 10 ? 10 : $cart['price']->quantity); $i++ )
                                    <option value="{{ $i }}"
                                            @if($cart['quantity'] === $i) selected @endif
                                    >
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>

                            <a class="font-size-xs text-gray-400 ml-auto"
                               href="{{ route('cart.destroy', $cart['cart_id']) }}">
                                <i class="fe fe-x"></i> Удалить
                            </a>

                        </div>
                        @isset( $message )
                            <div
                                class="alert alert-warning alert-dismissible fade show small py-1 px-2 mt-1"
                                role="alert">
                                {!! $message !!}
                                <button type="button" class="close py-0 px-1" data-dismiss="alert"
                                        aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif

                    </div>
                </form>
            </li>
        @endforeach
    </ul>

    <div class="row align-items-end justify-content-between mb-10 mb-md-0">
        <div class="col-12 col-md-7">

            <form class="mb-7 mb-md-0">
                <label class="font-size-sm font-weight-bold" for="cartCouponCode">
                    Coupon code:
                </label>
                <div class="row form-row">
                    <div class="col">

                        <input class="form-control form-control-sm" id="cartCouponCode" type="text"
                               placeholder="Enter coupon code*">

                    </div>
                    <div class="col-auto">

                        <button class="btn btn-sm btn-dark" type="submit">
                            Apply
                        </button>

                    </div>
                </div>
            </form>

        </div>
        <div class="col-12 col-md-auto">

            <button class="btn btn-sm btn-outline-dark">Update Cart</button>

        </div>
    </div>

</div>
<div class="col-12 col-md-5 col-lg-4 offset-lg-1 position-relative">

    <div class="position-sticky" style="top: 1rem;">
        <div class="card mb-7 bg-light">
            <div class="card-body">
                <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                    <li class="list-group-item d-flex">
                        <span>Subtotal</span> <span class="ml-auto font-size-sm">$89.00</span>
                    </li>
                    <li class="list-group-item d-flex">
                        <span>Tax</span> <span class="ml-auto font-size-sm">$00.00</span>
                    </li>
                    <li class="list-group-item d-flex font-size-lg font-weight-bold">
                        <span>Total</span> <span class="ml-auto font-size-sm">$89.00</span>
                    </li>
                    <li class="list-group-item font-size-sm text-center text-gray-500">
                        Shipping cost calculated at Checkout *
                    </li>
                </ul>
            </div>
        </div>

        <!-- Button -->
        <a class="btn btn-block btn-dark mb-2" href="checkout.html">Proceed to Checkout</a>

        <!-- Link -->
        <a class="btn btn-link btn-sm px-0 text-body" href="shop.html">
            <i class="fe fe-arrow-left mr-2"></i> Continue Shopping
        </a>
    </div>

</div>
