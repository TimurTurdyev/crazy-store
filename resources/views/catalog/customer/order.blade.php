@extends('catalog.index')
@section('content')
    <section class="pt-7 pb-12">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="mb-10">Заказ #{{ $order->id }}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    @include('catalog.customer.navbar')
                </div>
                <div class="col-12 col-md-9 col-lg-8 offset-lg-1">
                    @include('catalog.partials.order_detail')
                </div>
            </div>
        </div>
    </section>
@endsection
