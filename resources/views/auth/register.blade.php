@extends('catalog.index')
@section('content')
    <section class="bg-light py-12" style="margin-top: -1rem;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card card-lg">
                        <div class="card-body">
                            <h6 class="mb-7"><a href="{{ route('login') }}">Вход</a> / Регистрация</h6>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="sr-only" for="register-firstname">
                                                Имя *
                                            </label>
                                            <input class="form-control form-control-sm"
                                                   id="register-firstname"
                                                   type="text"
                                                   placeholder="Имя *"
                                                   name="firstname"
                                                   value="{{ old('firstname') }}"
                                                   required>
                                            @include('admin.master.message.error', ['name' => 'firstname'])
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="sr-only" for="register-lastname">
                                                Фамилия *
                                            </label>
                                            <input class="form-control form-control-sm"
                                                   id="register-lastname"
                                                   type="text"
                                                   placeholder="Фамилия *"
                                                   name="lastname"
                                                   value="{{ old('lastname') }}"
                                                   required>
                                            @include('admin.master.message.error', ['name' => 'lastname'])
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="sr-only" for="register-phone">
                                                Телефон *
                                            </label>
                                            <input class="form-control form-control-sm"
                                                   id="register-phone"
                                                   type="tel"
                                                   placeholder="Телефон *"
                                                   name="phone"
                                                   value="{{ old('phone') }}"
                                                   required>
                                            @include('admin.master.message.error', ['name' => 'phone'])
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="sr-only" for="register-email">
                                                Email *
                                            </label>
                                            <input class="form-control form-control-sm"
                                                   id="register-email"
                                                   type="email"
                                                   placeholder="Email *"
                                                   name="email"
                                                   value="{{ old('email') }}"
                                                   required>
                                            @include('admin.master.message.error', ['name' => 'email'])
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="register-password">
                                                Пароль *
                                            </label>
                                            <input class="form-control form-control-sm"
                                                   id="register-password"
                                                   type="password"
                                                   placeholder="Пароль *"
                                                   name="password"
                                                   autocomplete="new-password"
                                                   required>
                                            @include('admin.master.message.error', ['name' => 'password'])
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="register-password-confirm">
                                                Повторить пароль *
                                            </label>
                                            <input class="form-control form-control-sm"
                                                   id="register-password-confirm"
                                                   type="password"
                                                   placeholder="Повторить пароль *"
                                                   name="password_confirmation"
                                                   required>
                                            @include('admin.master.message.error', ['name' => 'password_confirmation'])
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <div class="form-group font-size-sm text-muted">
                                            Регистрируя свои данные, вы соглашаетесь с нашими Условиями использования, а
                                            также Политикой конфиденциальности и использования файлов cookie.
                                        </div>

                                    </div>
                                    <div class="col-12 col-md">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input"
                                                       id="register-newsletter"
                                                       type="checkbox">
                                                <label class="custom-control-label" for="register-newsletter">
                                                    Подписаться на рассылку новостей!
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-sm btn-dark" type="submit">
                                            Зарегистрироваться
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
