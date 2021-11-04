@extends('catalog.index')
@section('content')
    <section class="bg-light py-12" style="margin-top: -1rem;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 offset-md-3">

                    <div class="card card-lg mb-10 mb-md-0">
                        <div class="card-body">

                            <h6 class="mb-7">Вход / <a href="{{ route('register') }}">Регистрация</a></h6>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                {{ $errors }}
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
                                                   value="{{ old('login.email') }}"
                                            >
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="sr-only" for="login-password">
                                                Пароль *
                                            </label>
                                            <input class="form-control form-control-sm"
                                                   id="login-password"
                                                   type="password"
                                                   placeholder="Пароль *"
                                                   name="password"
                                                   required>
                                        </div>

                                    </div>
                                    <div class="col-12 col-md">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="login-remember" type="checkbox">
                                                <label class="custom-control-label" for="login-remember">
                                                    Запомнить меня
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <div class="form-group">
                                            <a class="font-size-sm text-reset" data-toggle="modal"
                                               href="auth.html#modalPasswordReset">Забыли пароль?</a>
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-sm btn-dark" type="submit">
                                            Войти
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
