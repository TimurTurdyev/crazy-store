@extends('catalog.index')

@section('content')
    <section class="pt-7 pb-12">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="mb-4">Оформление</h3>

                    <p class="mb-10">
                        Уже есть аккаунт? <a class="font-weight-bold text-reset" href="checkout.html#!">Войти</a>
                    </p>

                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-7">
                    <form>
                        <h6 class="mb-7">Контактные данные</h6>
                        <div class="row mb-9">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="checkoutBillingFirstName">Имя *</label>
                                    <input class="form-control form-control-sm" id="checkoutBillingFirstName"
                                           type="text" placeholder="Имя" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="checkoutBillingLastName">Фамилия *</label>
                                    <input class="form-control form-control-sm" id="checkoutBillingLastName" type="text"
                                           placeholder="Фамилия" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="checkoutBillingEmail">Email *</label>
                                    <input class="form-control form-control-sm" id="checkoutBillingEmail" type="email"
                                           placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group mb-0">
                                    <label for="checkoutBillingPhone">Телефон *</label>
                                    <input class="form-control form-control-sm" id="checkoutBillingPhone" type="tel"
                                           placeholder="Телефон" required>
                                </div>
                            </div>
                        </div>
                        <h6 class="mb-7">Доставка</h6>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="checkoutBillingAddress">Адрес *</label>
                                    <input class="form-control form-control-sm" id="checkoutBillingAddress" type="text"
                                           placeholder="Адрес" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="checkoutBillingTown">Населенный пункт *</label>
                                    <input class="form-control form-control-sm" id="checkoutBillingTown" type="text"
                                           placeholder="Город / Село" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="checkoutBillingZIP">Индекс</label>
                                    <input class="form-control form-control-sm" id="checkoutBillingZIP" type="text"
                                           placeholder="Индекс" required>
                                </div>
                            </div>
                        </div>
                        <div id="shipping-block"></div>
                    </form>
                </div>
                <div class="col-12 col-md-5 col-lg-4 offset-lg-1">
                    <h6 class="mb-7">Кол-во ({{ $cart->getCount() }})</h6>
                    <hr class="my-7">
                    <ul class="list-group list-group-lg list-group-flush-y list-group-flush-x mb-7">
                        @foreach( $cart->getItems() as $item )
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <a href="https://yevgenysim.github.io/shopper/product.html">
                                            <img src="{{ $item->photo }}" alt="{{ $item->name }}" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <div class="mb-4 font-size-sm font-weight-bold">
                                            <a class="text-body"
                                               href="https://yevgenysim.github.io/shopper/product.html">{{ $item->name }}</a>
                                            <br>
                                            @if($item->price->discount_price < $item->price->price)
                                                <div class="d-inline-block text-gray-350 text-decoration-line-through">
                                                    {{ $item->price->price }} р.
                                                </div>
                                                <div class="d-inline-block ml-1">
                                                    {{ $item->price->discount_price }} р.
                                                </div>
                                            @else
                                                <span class="text-muted">{{ $item->price->discount_price }} р.</span>
                                            @endif
                                        </div>
                                        <div class="font-size-sm text-muted">
                                            @if( $size_name = $item->price->name )
                                                Размер: <strong>{{ $size_name }}</strong><br>
                                            @endif
                                                Кол-во: <strong>{{ $item->quantity }} шт.</strong>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="card mb-9 bg-light">
                        <div class="card-body">
                            <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                                <li class="list-group-item d-flex">
                                    <span>Сумма</span>
                                    @if( $cart->getProductDiscountTotal() !== $cart->getProductPriceTotal() )
                                        <span class="ml-auto font-size-sm">(<s>{{ $cart->getProductPriceTotal() }}</s>) / {{ $cart->getProductDiscountTotal() }} руб.</span>
                                    @else
                                        <span
                                            class="ml-auto font-size-sm">{{ $cart->getProductDiscountTotal() }} руб.</span>
                                    @endif
                                </li>
                                <li class="list-group-item d-flex">
                                    <span>Промокод</span>
                                    <span
                                        class="ml-auto font-size-sm">{{ $cart->promoCode()?->discount ?? 0 }} руб.</span>
                                </li>
                                <li class="list-group-item d-flex font-size-lg font-weight-bold">
                                    <span>Итого</span> <span class="ml-auto font-size-sm">{{ $cart->getProductDiscountTotal() + $cart->promoCode()?->discount ?? 0 }} руб.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <p class="mb-7 font-size-xs text-gray-500">
                        Оплатить заказ вы можете после оформления заказа.
                    </p>
                    <a href="{{ route('cart.index') }}" class="btn btn-block btn-dark">
                        Вернуться в корзину
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>

    </script>
@endpush
