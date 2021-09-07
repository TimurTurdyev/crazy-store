@extends('admin.app')

@section('content')

    <form class="invoice p-3 mb-3"
          action="@if( $order->id ) {{ route('admin.order.update', $order) }} @else {{ route('admin.order.store') }} @endif"
          method="post">
        @CSRF
        @if( $order->id )
            @method('put')
        @endif
        <div class="row">
            <div class="col-12">
                <h4>
                    #{{ $order->id }}
                    <small class="float-right">Date: {{ $order->created_at }}</small>
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p class="lead">Товары</p>
                <ul class="list-group list-group-lg list-group-flush-x mb-6">
                    @foreach( $order->items as $item )
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <a href="http://127.0.0.1:8000/product/252?variant=252">
                                        <img src="{{ $item->photo }}" alt="{{ $item->name }}" class="img-fluid">
                                    </a>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label>Имя *</label>
                                            <button type="button" class="btn btn-xs btn-outline-danger mb-2" onclick="$(this).closest('li').remove();">Удалить</button>
                                        </div>
                                        <input type="text"
                                               class="form-control form-control-sm"
                                               name="price[{{ $item->id }}][name]"
                                               required=""
                                               value="{{ $item->name }}">
                                    </div>
                                    <div class="row">
                                        <input type="hidden" name="price[{{ $item->id }}][photo]" value="{{ $item->photo }}">
                                        <input type="hidden" name="price[{{ $item->id }}][variant_id]" value="{{ $item->variant_id }}">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Старая цена *</label>
                                                <input type="text"
                                                       class="form-control form-control-sm"
                                                       name="price[{{ $item->id }}][price_old]"
                                                       required=""
                                                       value="{{ $item->price_old }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Цена *</label>
                                                <input type="text"
                                                       class="form-control form-control-sm"
                                                       name="price[{{ $item->id }}][price]"
                                                       required=""
                                                       value="{{ $item->price }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Кол-во *</label>
                                                <input type="text"
                                                       class="form-control form-control-sm"
                                                       name="price[{{ $item->id }}][quantity]"
                                                       required=""
                                                       value="{{ $item->quantity }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    {{ $item->variant->prices }}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-6">
                <p class="lead">Информация</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="checkoutBillingFirstName">Имя *</label>
                            <input type="text"
                                   class="form-control form-control-sm"
                                   id="checkoutBillingFirstName"
                                   name="firstname" placeholder="Имя"
                                   required=""
                                   value="{{ $order->firstname }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="checkoutBillingLastName">Фамилия *</label>
                            <input type="text" class="form-control form-control-sm"
                                   id="checkoutBillingLastName"
                                   name="lastname"
                                   placeholder="Фамилия" r
                                   equired=""
                                   value="{{ $order->lastname }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="checkoutBillingEmail">Email *</label>
                            <input type="email"
                                   class="form-control form-control-sm"
                                   id="checkoutBillingEmail"
                                   name="email"
                                   placeholder="Email"
                                   required=""
                                   value="{{ $order->email }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="checkoutBillingPhone">Телефон *</label>
                            <input type="tel"
                                   class="form-control form-control-sm"
                                   id="checkoutBillingPhone"
                                   name="phone"
                                   placeholder="Телефон"
                                   required="" value="{{ $order->phone }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="form-group">
                            <label for="form-address">Адрес *</label>
                            <input type="text"
                                   class="form-control form-control-sm"
                                   id="form-address"
                                   name="address"
                                   placeholder="Адрес"
                                   required=""
                                   value="{{ $order->address }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="form-post_code">Индекс *</label>
                            <input type="text"
                                   class="form-control form-control-sm"
                                   id="form-post_code"
                                   name="post_code"
                                   placeholder="Индекс"
                                   required=""
                                   value="{{ $order->post_code }}">
                        </div>
                    </div>
                </div>
                <p class="lead">Способ доставки</p>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="form-delivery_name">Доставка *</label>
                            <input type="text"
                                   class="form-control form-control-sm"
                                   id="form-delivery_name"
                                   name="delivery_name"
                                   placeholder="Доставка"
                                   required=""
                                   value="{{ $order->delivery_name }}">
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="form-delivery_code">Код доставки *</label>
                            <input type="text"
                                   class="form-control form-control-sm"
                                   id="form-delivery_code"
                                   name="delivery_code"
                                   placeholder="Доставка"
                                   required=""
                                   value="{{ $order->delivery_code }}">
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="form-delivery_value">Сумма доставки *</label>
                            <input type="text"
                                   class="form-control form-control-sm"
                                   id="form-delivery_value"
                                   name="delivery_value"
                                   placeholder="Доставка"
                                   required=""
                                   value="{{ $order->delivery_value }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')

@endpush
