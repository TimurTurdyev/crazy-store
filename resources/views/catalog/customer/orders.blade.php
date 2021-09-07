@extends('catalog.index')
@section('content')
    <section class="pt-7 pb-12">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="mb-10">Заказы</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    @include('catalog.customer.navbar')
                </div>
                <div class="col-12 col-md-9 col-lg-8 offset-lg-1">
                    @if( $orders->count() )
                        @foreach( $orders as $order )
                            <div class="card card-lg mb-5 border">
                                <div class="card-body pb-0">
                                    <div class="card card-sm">
                                        <div class="card-body bg-light">
                                            <div class="row">
                                                <div class="col-6 col-lg-3">
                                                    <h6 class="heading-xxxs text-muted">Номе заказа:</h6>
                                                    <p class="mb-lg-0 font-size-sm font-weight-bold">
                                                        {{ $order->id }}
                                                    </p>
                                                </div>
                                                <div class="col-6 col-lg-3">
                                                    <h6 class="heading-xxxs text-muted">Дата создания:</h6>
                                                    <p class="mb-lg-0 font-size-sm font-weight-bold">
                                                        <time datetime="2019-10-01">
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
                                                    <h6 class="heading-xxxs text-muted">Сумма:</h6>
                                                    <p class="mb-0 font-size-sm font-weight-bold">
                                                        {{ $order->total }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-lg-6">
                                            <div class="form-row mb-4 mb-lg-0">
                                                @foreach( $order->items->take(3) as $order_item )
                                                    <div class="col-3">
                                                        <div class="embed-responsive embed-responsive-1by1 bg-cover"
                                                             style="background-image: url('{{ asset($order_item->photo) }}');"></div>
                                                    </div>
                                                @endforeach
                                                @if($order->items->count() > 3)
                                                    <div class="col-3">
                                                        <div class="embed-responsive embed-responsive-1by1 bg-light">
                                                            <a class="embed-responsive-item embed-responsive-item-text text-reset">
                                                                <div class="font-size-xxs font-weight-bold">
                                                                    +{{ $order->items->count() - 3 }}
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <a class="btn btn-sm btn-block btn-outline-dark"
                                               href="{{ route('customer.order', [$order]) }}">
                                                Информация
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $orders->links() }}
                    @else
                        <div class="card card-xl">
                            <div class="card-body border">Сделайте заказ и получите накопительную скидку!</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
