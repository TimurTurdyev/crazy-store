@extends('catalog.index')
@section('content')
    <section class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">

                    <div class="mb-7 font-size-h1">🙁</div>

                    <h2 class="mb-5">404. Страница не найдена.</h2>

                    <p class="mb-7 text-gray-500">
                        К сожалению, нам не удалось найти страницу, которую вы искали.
                    </p>

                    <a class="btn btn-dark" href="{{ route('category.index') }}">
                        На главную
                    </a>

                </div>
            </div>
        </div>
    </section>
@endsection
