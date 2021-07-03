@extends('catalog.index')

@section('content')
    <section class="py-11">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">

                    <!-- Filters -->
                    <form class="mb-10 mb-md-0">
                        @include('catalog.partials.catalog_filter')
                    </form>

                </div>
                <div class="col-12 col-md-8 col-lg-9">

                    <!-- Slider -->
                @include('catalog.partials.catalog_slider')

                <!-- Header -->
                    <div class="row align-items-center mb-7">
                        <div class="col-12 col-md">

                            <!-- Heading -->
                            <h3 class="mb-1">{{ $group->name }}</h3>

                            <!-- Breadcrumb -->
                            <ol class="breadcrumb mb-md-0 font-size-xs text-gray-400">
                                <li class="breadcrumb-item">
                                    <a class="text-gray-400" href="index.html">Главная</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    {{ $group->name }}
                                </li>
                            </ol>

                        </div>
                        <div class="col-12 col-md-auto">
                            <!-- Select -->
                            <select class="custom-select custom-select-xs">
                                <option selected>Most popular</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="row mb-7">
                        <div class="col-12">
                            <span class="btn btn-xs btn-light font-weight-normal text-muted mr-3 mb-3">
                              Shift dresses <a class="text-reset ml-2" href="shop.html#!" role="button">
                                <i class="fe fe-x"></i></a>
                            </span>
                        </div>
                    </div>

                    <!-- Products -->
                    <div class="row">
                        @foreach( $products->items() as $item )
                                <div class="col-6 col-md-4">
                                    @include('catalog.partials.catalog_card')
                                </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <nav class="d-flex justify-content-center justify-content-md-end">
                        <ul class="pagination pagination-sm text-gray-400">
                            <li class="page-item">
                                <a class="page-link page-link-arrow" href="shop.html#">
                                    <i class="fa fa-caret-left"></i>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="shop.html#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="shop.html#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="shop.html#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="shop.html#">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="shop.html#">5</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="shop.html#">6</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link page-link-arrow" href="shop.html#">
                                    <i class="fa fa-caret-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
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
