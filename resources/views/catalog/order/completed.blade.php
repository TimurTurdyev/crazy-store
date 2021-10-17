@extends('catalog.index')

@section('content')
    <section class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">

                    <div class="mb-7 font-size-h1">❤️</div>
                    <h2 class="mb-5">Заказ успешно создан!</h2>
                    <div class="mb-7 text-gray-500">
                        Здравствуйте <span class="text-body text-decoration-underline">{{ $order->firstname }}</span>.
                        Спасибо что выбрали наш интернет-магазин.
                        @if( $order->payment_status === 'pending' )
                            <hr>
                            Заказ успешно создан и ожидает <span
                                class="text-body text-decoration-underline">оплаты.</span>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    @include('catalog.partials.order_detail')
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

@endpush
