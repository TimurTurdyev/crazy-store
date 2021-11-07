@extends('catalog.index')
@section('content')
    <section class="bg-light py-12" style="margin-top: -1rem;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 offset-md-3">

                    <div class="card card-lg mb-10 mb-md-0">
                        <div class="card-body">
                            <h6 class="mb-7"><a href="{{ route('login') }}">Вход</a> / <a href="{{ route('register') }}">Регистрация</a></h6>
                            @include('admin.master.message.success')
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="sr-only" for="login-email">
                                                Email *
                                            </label>
                                            <input class="form-control form-control-sm"
                                                   id="login-email"
                                                   type="email"
                                                   placeholder="Email *"
                                                   required
                                                   name="email"
                                                   value="{{ old('email') }}"
                                            >
                                            @include('admin.master.message.error', ['name' => 'email'])
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-sm btn-dark" type="submit">
                                            Сбросить
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

