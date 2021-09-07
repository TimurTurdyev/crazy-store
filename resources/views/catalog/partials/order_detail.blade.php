<div class="card card-lg mb-5 border">
    <div class="card-body pb-0">
        <div class="card card-sm">
            <div class="card-body bg-light">
                <div class="row">
                    <div class="col-6 col-lg-3">

                        <h6 class="heading-xxxs text-muted">Номер заказа:</h6>

                        <p class="mb-lg-0 font-size-sm font-weight-bold">
                            {{ $order->id }}
                        </p>

                    </div>
                    <div class="col-6 col-lg-3">

                        <h6 class="heading-xxxs text-muted">Дата создания:</h6>

                        <p class="mb-lg-0 font-size-sm font-weight-bold">
                            <time datetime="{{ $order->created_at }}">
                                {{ $order->created_at }}
                            </time>
                        </p>

                    </div>
                    <div class="col-6 col-lg-3">

                        <h6 class="heading-xxxs text-muted">Статус:</h6>

                        <p class="mb-0 font-size-sm font-weight-bold">
                            {{ $order->status }}
                        </p>

                    </div>
                    <div class="col-6 col-lg-3">

                        <h6 class="heading-xxxs text-muted">Сумма заказа:</h6>

                        <p class="mb-0 font-size-sm font-weight-bold">
                            {{ $order->total }} <i class="fas fa-ruble-sign"></i>
                        </p>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card-footer">
        <h6 class="mb-7">Кол-во ({{ $order->items->count() }})</h6>
        <hr class="my-5">
        <ul class="list-group list-group-lg list-group-flush-y list-group-flush-x">
            @foreach( $order->items as $item )
                <li class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-4 col-md-3 col-xl-2">
                            <a href="{{ route('catalog.product', $item->product_id) }}?variant={{ $item->variant_id }}">
                                <img src="{{ $item->photo }}" alt="{{ $item->name }}"
                                     class="img-fluid">
                            </a>
                        </div>
                        <div class="col">
                            <div class="mb-4 font-size-sm font-weight-bold">
                                <a class="text-body"
                                   href="{{ route('catalog.product', $item->product_id) }}?variant={{ $item->variant_id }}">{{ $item->name }}</a>
                                <br>

                                <div class="mt-2">
                                    @if($item->price_old < $item->price)
                                        <div
                                            class="d-inline-block text-gray-350 text-decoration-line-through">
                                            {{ $item->price_old }} <i class="fas fa-ruble-sign"></i>
                                        </div>
                                        <div class="d-inline-block ml-1">
                                            {{ $item->price }} <i class="fas fa-ruble-sign"></i>
                                        </div>
                                    @else
                                        <div class="text-muted">{{ $item->price }} <i
                                                class="fas fa-ruble-sign"></i></div>
                                    @endif
                                </div>
                                <div class="font-size-sm text-muted">
                                    Кол-во: <strong>{{ $item->quantity }} шт.</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="card card-lg mb-5 border">
    <div class="card-body">

        <h6 class="mb-7">Сумма заказа</h6>

        <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
            <li class="list-group-item d-flex">
                <span>Сумма</span>
                <span class="ml-auto">{{ $order->sub_total }} <i
                        class="fas fa-ruble-sign"></i></span>
            </li>
            <li class="list-group-item d-flex">
                <span>Скидка</span>
                <span class="ml-auto">{{ $order->promo_value }} <i
                        class="fas fa-ruble-sign"></i></span>
            </li>
            <li class="list-group-item d-flex">
                <span>Доставка</span>
                <span class="ml-auto">{{ $order->delivery_value }} <i class="fas fa-ruble-sign"></i></span>
            </li>
            <li class="list-group-item d-flex font-size-lg font-weight-bold">
                <span>Итого</span>
                <span class="ml-auto">{{ $order->total }} <i class="fas fa-ruble-sign"></i></span>
            </li>
        </ul>

    </div>
</div>

<div class="card card-lg border">
    <div class="card-body">

        <h6 class="mb-7">Доставка и оплата</h6>

        <div class="row">

            <div class="col-12 col-md-6">

                <p class="mb-4 font-weight-bold">
                    Адрес доставки:
                </p>

                <p class="mb-7 mb-md-0 text-gray-500">
                    {{ $order->firstname }} {{ $order->lastname }} <br>
                    {{ $order->phone }} <br>
                    {{ $order->delivery_name }}
                </p>

            </div>
            <div class="col-12 col-md-6">

                <p class="mb-4 font-weight-bold">
                    Оплата:
                </p>

                @if( $order->payment_name )
                    <p class="mb-7 mb-md-0 text-gray-500">
                        {{ $order->payment_name }}
                    </p>
                @endif
            </div>
        </div>

    </div>
</div>
