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
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        function cartUpdate(self) {
            var $form = $(self).closest('form');
            var data = $form.serialize();
            $.post('{{ route('cart.update') }}', data, function (response) {
                $('#cart-content').html(response);
            });
        }
    </script>
@endpush
