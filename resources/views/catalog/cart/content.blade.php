<div class="col-12 col-md-7">
    <ul class="list-group list-group-lg list-group-flush-x mb-6">
        @foreach( $cart->getItems() as $cart_item)
            <li class="list-group-item">
                <form class="row align-items-center">
                    <input type="hidden" name="cart" value="{{ $cart_item->cart_id }}">
                    <div class="col-3">

                        <a href="{{ route('catalog.product', $cart_item->product_id) }}?variant={{ $cart_item->variant_id }}">
                            <img src="{{ $cart_item->photo }}"
                                 alt="{{ $cart_item->name }}"
                                 class="img-fluid">
                        </a>

                    </div>
                    <div class="col">
                        <div class="d-flex mb-2 font-weight-bold">
                            <a class="text-body"
                               href="{{ route('catalog.product', $cart_item->product_id) }}?variant={{ $cart_item->variant_id }}">
                                {{ $cart_item->name }}
                            </a>
                            <div class="ml-auto text-right">
                                @if($cart_item->price->discount_price < $cart_item->price->price)
                                    <div class="d-inline-block text-gray-350 text-decoration-line-through">
                                        {{ $cart_item->price->price }} <i class="fas fa-ruble-sign"></i>
                                    </div>
                                    <div class="d-inline-block ml-1">
                                        {{ $cart_item->price->discount_price }} <i class="fas fa-ruble-sign"></i>
                                    </div>
                                @else
                                    {{ $cart_item->price->discount_price }} <i class="fas fa-ruble-sign"></i>
                                @endif
                            </div>
                        </div>
                        <p class="mb-3 font-size-sm text-muted">
                            На складе:
                            <strong>
                                {{ $cart_item->price->quantity > 10 ? 'достаточно' : $cart_item->price->quantity }}
                                шт.
                            </strong>
                            <br>
                            @if( $size_name = $cart_item->price->name )
                                Размер: <strong>{{ $size_name }}</strong>
                            @endif
                        </p>
                        @if( $cart_item->prices->count() )
                            <div class="mb-2">
                                @foreach( $cart_item->prices as $item_price )
                                    <div
                                        class="custom-control custom-control-inline custom-control-size mb-2">
                                        @if( (int)$item_price->id === (int)$cart_item->price_id)
                                            <input type="radio" class="custom-control-input"
                                                   name="price[{{ $cart_item->cart_id }}]"
                                                   value="{{ $item_price->id }}"
                                                   id="size_radio_{{ $cart_item->cart_id }}-{{ $item_price->id }}"
                                                   checked
                                                   @if( $item_price->quantity < 1 ) disabled @endif
                                            >
                                        @else
                                            <input type="radio" class="custom-control-input"
                                                   name="price[{{ $cart_item->cart_id }}]"
                                                   value="{{ $item_price->id }}"
                                                   id="size_radio_{{ $cart_item->cart_id }}-{{ $item_price->id }}"
                                                   @if( $item_price->quantity < 1 ) disabled @endif
                                            >
                                        @endif
                                        <label class="custom-control-label"
                                               for="size_radio_{{ $cart_item->cart_id }}-{{ $item_price->id }}">{{ $item_price->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="d-flex align-items-center">

                            <select class="custom-select custom-select-xxs w-auto" name="quantity">
                                <option value="{{ $cart_item->quantity }}" selected
                                >
                                    Кол-во: {{ $cart_item->quantity }} шт.
                                </option>
                                @for( $i = 1; $i <= ($cart_item->price->quantity > 10 ? 10 : $cart_item->price->quantity); $i++ )
                                    <option value="{{ $i }}"
                                    >
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>

                            <a class="font-size-xs text-gray-400 ml-auto"
                               href="{{ route('cart.destroy', $cart_item->cart_id) }}">
                                <i class="fe fe-x"></i> Удалить
                            </a>

                        </div>

                        @if( $cart_item->message )
                            <div
                                class="alert alert-warning alert-dismissible fade show small py-1 px-2 mt-1"
                                role="alert">
                                {!! $cart_item->message !!}
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
    @if($cart->promo_error)
        <div
            class="alert alert-warning alert-dismissible fade show small py-1 px-2 mt-1"
            role="alert">
            {{ $cart->promo_error }}
            <button type="button" class="close py-0 px-1" data-dismiss="alert"
                    aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    @if($cart->promo_success)
        <div
            class="alert alert-success alert-dismissible fade show small py-1 px-2 mt-1"
            role="alert">
            {{ $cart->promo_success }}
            <button type="button" class="close py-0 px-1" data-dismiss="alert"
                    aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <div class="row align-items-end justify-content-between mb-10 mb-md-0">
        <div class="col-12 col-md-7">
            <form class="mb-7 mb-md-0" id="cartCouponCode">
                <label class="font-size-sm font-weight-bold" for="cartCouponCode">
                    Промокод:
                </label>
                <div class="row form-row">
                    <div class="col">

                        <input class="form-control form-control-sm" type="text" name="promo_code"
                               placeholder="Промокод*"
                               value="{{ $cart->promoCode()?->code }}"
                        >

                    </div>
                    <div class="col-auto">

                        <button class="btn btn-sm btn-dark" type="submit">
                            Применить
                        </button>

                    </div>
                </div>
            </form>

        </div>
        @if($cart->promoCode())
            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-sm btn-outline-dark promo-remove"><i class="fe fe-trash-2"></i> Удалить купон</button>
            </div>
        @endif

    </div>

</div>
<div class="col-12 col-md-5 col-lg-4 offset-lg-1 position-relative">
    <div class="position-sticky" style="top: 1rem;">
        <h6 class="mb-3">Кол-во ({{ $cart->getCount() }})</h6>
        <hr class="my-3">
        <div class="card mb-7 bg-light">
            <div class="card-body">
                <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                    <li class="list-group-item d-flex">
                        <span>Сумма</span>
                        @if($cart->getProductDiscountTotal() !== $cart->getProductPriceTotal())
                            <span class="ml-auto font-size-sm">(<s>{{ $cart->getProductPriceTotal() }}</s>) / {{ $cart->getProductDiscountTotal() }} <i class="fas fa-ruble-sign"></i></span>
                        @else
                            <span class="ml-auto font-size-sm">{{ $cart->getProductDiscountTotal() }} <i class="fas fa-ruble-sign"></i></span>
                        @endif
                    </li>
                    <li class="list-group-item d-flex">
                        <span>Промокод</span>
                        <span class="ml-auto font-size-sm">{{ $cart->promoCode()?->discount ?? 0 }} <i class="fas fa-ruble-sign"></i></span>
                    </li>
                    <li class="list-group-item d-flex font-size-lg font-weight-bold">
                        <span>Итого</span> <span class="ml-auto font-size-sm">{{ $cart->getProductDiscountTotal() + $cart->promoCode()?->discount ?? 0 }} <i class="fas fa-ruble-sign"></i></span>
                    </li>
                    <li class="list-group-item font-size-sm text-center text-gray-500">
                        Точная стоимость доставки будет рассчитана после оформления заказа *
                    </li>
                </ul>
            </div>
        </div>

        <a class="btn btn-block btn-dark mb-2" href="{{ route('order.create') }}">Перейти к оформлению</a>
    </div>

</div>
