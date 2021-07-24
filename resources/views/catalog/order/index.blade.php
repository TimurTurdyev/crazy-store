@extends('catalog.index')

@section('content')
    <section class="pt-7 pb-12">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <h3 class="mb-10 text-center">Корзина</h3>
                </div>
            </div>
            <div class="row" id="cart-content">
                @include('catalog.cart.content')
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
                $('#cart-content').html(response);
            }).fail(function (response) {
                console.log(response);
            });
        });

        $('#cart-content').on('submit', '#cartCouponCode', function (event) {
            event.preventDefault();
            var $form = $(this).closest('form');
            var data = $form.serialize();
            $.ajax({
                url: '{{ route('cart.coupon.add') }}',
                method: 'POST',
                cache: false,
                async: false,
                data: data,
            }).done(function (response) {
                $('#cart-content').html(response);
            }).fail(function (response) {
                console.log(response);
            })
        });

        $('#cart-content').on('click', '.coupon-remove', function (event) {
            event.preventDefault();
            $.ajax({
                url: '{{ route('cart.coupon.remove') }}',
                method: 'GET',
                cache: false,
                async: false,
            }).done(function (response) {
                $('#cart-content').html(response);
            }).fail(function (response) {
                console.log(response);
            })
        });
    </script>
@endpush
