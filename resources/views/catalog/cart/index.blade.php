@extends('catalog.index')

@section('content')
    <nav class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <ol class="breadcrumb mb-0 font-size-xs text-gray-400">
                        <li class="breadcrumb-item">
                            <a class="text-gray-400" href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Shopping Cart
                        </li>
                    </ol>

                </div>
            </div>
        </div>
    </nav>

    <section class="pt-7 pb-12">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <h3 class="mb-10 text-center">Корзина</h3>
                </div>
            </div>
            <div class="row" id="cart-content">
                @include('catalog.cart.content')
                {{--<div class="js_preload" style="display: flex;justify-content: center;width: 100%;height: 30vh;align-content: center;align-items: center;">
                    <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>--}}
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        function cartIndex() {
            $.ajax({
                url: '{{ route('cart.index') }}',
                method: 'GET',
                cache: false,
                async: false,
            }).done(function (response) {

                $('#cart-content').html(response);

            }).fail(function (response) {
                console.log(response);
            })
        }

        // cartIndex();

        $('#cart-content').on('change', 'input[type=radio], select', function (event) {
            event.preventDefault();
            var $form = $(this).closest('form');
            var data = $form.serialize();
            $.ajax({
                url: '{{ route('cart.update') }}',
                method: 'POST',
                cache: false,
                async: false,
                data: data,
            }).done(function (response) {
                cartIndex();
            }).fail(function (response) {
                console.log(response);
            })
        });
    </script>
@endpush
