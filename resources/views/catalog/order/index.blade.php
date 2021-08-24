@extends('catalog.index')

@section('content')
    <section class="pt-7 pb-12">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="mb-4">Оформление</h3>

                    <p class="mb-10">
                        Уже есть аккаунт? <a class="font-weight-bold text-reset" href="checkout.html#!">Войти</a>
                    </p>

                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-7">
                    <form>
                        <h6 class="mb-7">Контактные данные</h6>
                        <div class="row mb-9">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="checkoutBillingFirstName">Имя *</label>
                                    <input class="form-control form-control-sm" id="checkoutBillingFirstName"
                                           type="text" placeholder="Имя" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="checkoutBillingLastName">Фамилия *</label>
                                    <input class="form-control form-control-sm" id="checkoutBillingLastName" type="text"
                                           placeholder="Фамилия" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="checkoutBillingEmail">Email *</label>
                                    <input class="form-control form-control-sm" id="checkoutBillingEmail" type="email"
                                           placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group mb-0">
                                    <label for="checkoutBillingPhone">Телефон *</label>
                                    <input class="form-control form-control-sm" id="checkoutBillingPhone" type="tel"
                                           placeholder="Телефон" required>
                                </div>
                            </div>
                        </div>
                        <h6 class="mb-7">Доставка</h6>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="checkoutBillingAddress">Адрес *</label>
                                    <input class="form-control form-control-sm" id="checkoutBillingAddress" type="text"
                                           placeholder="Адрес" required>
                                </div>
                            </div>
                        </div>
                        <div id="shipping-block"></div>
                    </form>
                </div>
                <div class="col-12 col-md-5 col-lg-4 offset-lg-1">
                    <h6 class="mb-7">Кол-во ({{ $cart->getCount() }})</h6>
                    <hr class="my-7">
                    <ul class="list-group list-group-lg list-group-flush-y list-group-flush-x mb-7">
                        @foreach( $cart->getItems() as $item )
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <a href="https://yevgenysim.github.io/shopper/product.html">
                                            <img src="{{ $item->photo }}" alt="{{ $item->name }}" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <div class="mb-4 font-size-sm font-weight-bold">
                                            <a class="text-body"
                                               href="https://yevgenysim.github.io/shopper/product.html">{{ $item->name }}</a>
                                            <br>
                                            @if($item->price->discount_price < $item->price->price)
                                                <div class="d-inline-block text-gray-350 text-decoration-line-through">
                                                    {{ $item->price->price }} р.
                                                </div>
                                                <div class="d-inline-block ml-1">
                                                    {{ $item->price->discount_price }} р.
                                                </div>
                                            @else
                                                <span class="text-muted">{{ $item->price->discount_price }} р.</span>
                                            @endif
                                        </div>
                                        <div class="font-size-sm text-muted">
                                            @if( $size_name = $item->price->name )
                                                Размер: <strong>{{ $size_name }}</strong><br>
                                            @endif
                                            Кол-во: <strong>{{ $item->quantity }} шт.</strong>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="card mb-9 bg-light">
                        <div class="card-body">
                            <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                                <li class="list-group-item d-flex">
                                    <span>Сумма</span>
                                    @if( $cart->getProductDiscountTotal() !== $cart->getProductPriceTotal() )
                                        <span class="ml-auto font-size-sm">(<s>{{ $cart->getProductPriceTotal() }}</s>) / {{ $cart->getProductDiscountTotal() }} руб.</span>
                                    @else
                                        <span
                                            class="ml-auto font-size-sm">{{ $cart->getProductDiscountTotal() }} руб.</span>
                                    @endif
                                </li>
                                <li class="list-group-item d-flex">
                                    <span>Промокод</span>
                                    <span
                                        class="ml-auto font-size-sm">{{ $cart->promoCode()?->discount ?? 0 }} руб.</span>
                                </li>
                                <li class="list-group-item d-flex font-size-lg font-weight-bold">
                                    <span>Итого</span> <span class="ml-auto font-size-sm">{{ $cart->getProductDiscountTotal() + $cart->promoCode()?->discount ?? 0 }} руб.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <p class="mb-7 font-size-xs text-gray-500">
                        Оплатить заказ вы можете после оформления заказа.
                    </p>
                    <a href="{{ route('cart.index') }}" class="btn btn-block btn-dark">
                        Вернуться в корзину
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-pvz" aria-labelledby="modal-pvz" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Выбор точек самовывоза CDEK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="map" style="height: 70vh;">
                </div>
            </div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.6.0/dist/css/suggestions.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.6.0/dist/js/jquery.suggestions.min.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru-RU&apikey=3e3fce61-e18b-4afa-bda8-b519cbcc99cd"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        var postal_code = '';
        var geoLocation = {};

        function formatSelected(suggestion) {
            if (suggestion.data.postal_code) {
                return suggestion.data.postal_code + ', ' + suggestion.value;
            } else {
                return suggestion.value;
            }
        }

        function delivery(postal_code) {
            $('#shipping-block').html('Идет обращение к службам доставки...');
            $.ajax({
                method: 'GET',
                url: '{{ route('order.deliveries') }}/' + postal_code,
            })
                .done(function (response) {
                    $('#shipping-block').html(response);
                });
        }

        $("#checkoutBillingAddress").suggestions({
            token: "90bccef2f73253efbb4e8418dc8fd2d464d3a07a",
            type: "ADDRESS",
            formatSelected: formatSelected,
            /* Вызывается, когда пользователь выбирает одну из подсказок */
            onSelect: function (suggestion) {
                console.log(suggestion);
                postal_code = suggestion.data.postal_code ?? '';
                if (postal_code === '') {
                    $('#shipping-block').html('Индекс не найден, допишите адрес для уточнения.');
                    return;
                }
                delivery(postal_code);
                geoLocation.lat = suggestion.data.geo_lat;
                geoLocation.lon = suggestion.data.geo_lon;
            }
        });

        $('#modal-pvz').on('shown.bs.modal', function () {
            ymaps.ready(init);
        });

        $('#modal-pvz').on('hidden.bs.modal', function (e) {
            $('#map').html('');
        })


        function init() {
            var myMap = new ymaps.Map('map', {
                    center: [geoLocation.lat, geoLocation.lon],
                    zoom: 10
                }),
                objectManager = new ymaps.ObjectManager({
                    // Чтобы метки начали кластеризоваться, выставляем опцию.
                    clusterize: true,
                    // ObjectManager принимает те же опции, что и кластеризатор.
                    gridSize: 32,
                    clusterDisableClickZoom: true
                });

            // Чтобы задать опции одиночным объектам и кластерам,
            // обратимся к дочерним коллекциям ObjectManager.
            objectManager.objects.options.set('preset', 'islands#greenDotIcon');
            objectManager.clusters.options.set('preset', 'islands#greenClusterIcons');
            myMap.geoObjects.add(objectManager);

            $.ajax({
                method: 'POST',
                url: '{{ route('cdek-api', 'deliverypoints') }}',
                data: {
                    postal_code: postal_code,
                    type: 'PVZ',
                    country_code: 'RU'
                },
            })
                .done(function (response) {
                    var points = [];
                    $.each(response, function (i, item) {
                        points.push(generatePoints(item));
                    });
                    objectManager.add({
                        "type": "FeatureCollection",
                        "features": points
                    })
                });
        }

        function generatePoints(item) {
            var name = item.code + ' ' + item.name;
            var balloonContentBody = '<h6 class="mb-2">Как добраться</h6>';

            balloonContentBody += '<div>Адрес: ' + item.location.city + ', ' + item.location.address + '</div>';

            if (item.nearest_metro_station) {
                balloonContentBody += '<div>Метро: ' + item.nearest_metro_station + '</div>';
            }
            if (item.address_comment) {
                balloonContentBody += '<div>' + item.address_comment + '</div>';
            }
/*
            balloonContentBody += '<div class="mb-2"><a href="https://yandex.ru/maps/?rtext=~' + item.location.latitude + ',' + item.location.longitude + '&amp;rtt=auto&amp;z=6" target="_blank" rel="nofollow noopener noreferrer">Построить маршрут</a></div>';
*/
            balloonContentBody += '<h6 class="mb-2 mt-1">Режим работы</h6>';
            balloonContentBody += '<div>' + item.work_time + '</div>';
            /*balloonContentBody += '<h6>Контакты</h6>';
            balloonContentBody += '<a href="mailto:' + item.email + '">' + item.email + '</a>';*/
            balloonContentBody += '<div>Код пвз: ' + item.code + '</div>';
            return {
                type: 'Feature',
                id: item.code,
                geometry: {'type': 'Point', 'coordinates': [item.location.latitude, item.location.longitude]},
                properties: {
                    //balloonContentHeader: '',
                    balloonContentBody: balloonContentBody,
                    balloonContentFooter: '<button type="button" class="btn btn-info btn-block btn-xxs">Выбрать</button>',
                    clusterCaption: '<strong>' + name + '</strong>',
                    hintContent: '<strong>' + name + '</strong>'
                }
            }
        }
    </script>

@endpush
