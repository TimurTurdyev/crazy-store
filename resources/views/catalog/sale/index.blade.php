@extends('catalog.index')

@section('content')
    <section class="pt-3 pb-7">
        <div class="container">
            <div class="row align-items-center mb-7">
                <div class="col-12 col-md">
                    <h3 class="mb-1">Распродажа</h3>

                    <ol class="breadcrumb mb-md-0 font-size-xs text-gray-400">
                        <li class="breadcrumb-item">
                            <a class="text-gray-400" href="{{ route('home') }}">Главная</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Товары со скидкой
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">

                    <div class="mb-10 mb-md-0">
                        @include('catalog.partials.catalog_filter')
                    </div>

                </div>
                <div class="col-12 col-md-8 col-lg-9">

                    <div class="row">
                        @foreach( $products->items() as $item )
                            <div class="col-6 col-md-4">
                                @include('catalog.partials.catalog_card')
                            </div>
                        @endforeach
                    </div>

                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')

@endpush

@push('scripts')
    <script src="{{ asset('catalog/js/theme_catalog.js') }}"></script>
@endpush
