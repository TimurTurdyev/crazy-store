@extends('catalog.index')
@section('content')
    <section class="bg-light py-12" style="margin-top: -1rem;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 offset-md-3">

                    <div class="card card-lg mb-10 mb-md-0">
                        <div class="card-body">

                            <h6 class="mb-7">Сброс пароля / <a href="{{ route('login') }}">Вход</a> / <a href="{{ route('register') }}">Регистрация</a></h6>
                            @include('admin.master.message.success')
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
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
                                        <div class="form-group">
                                            <label class="sr-only" for="reset-password">
                                                Пароль *
                                            </label>
                                            <input class="form-control form-control-sm"
                                                   id="reset-password"
                                                   type="password"
                                                   placeholder="Пароль *"
                                                   name="password"
                                                   required>
                                            @include('admin.master.message.error', ['name' => 'password'])
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="sr-only" for="reset-password-confirm">
                                                Повторить пароль *
                                            </label>
                                            <input class="form-control form-control-sm"
                                                   id="reset-password-confirm"
                                                   type="password"
                                                   placeholder="Повторить пароль *"
                                                   name="password_confirmation"
                                                   required>
                                            @include('admin.master.message.error', ['name' => 'password_confirmation'])
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
