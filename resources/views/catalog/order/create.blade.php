@extends('catalog.index')

@section('content')
    <section class="pt-7 pb-12">
        <div class="container">
            <a class="btn btn-link btn-sm px-0 text-body" href="{{ route('cart.index') }}">
                <i class="fe fe-arrow-left mr-2"></i> Вернуться в корзину
            </a>
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="mb-4">Оформление</h3>

                    <p class="mb-10">
                        Уже есть аккаунт? <a class="font-weight-bold text-reset" href="checkout.html#!">Войти</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <form id="form-order" action="{{ route('order.store') }}" method="post">
                        @CSRF
                        <h6 class="mb-7">Контактные данные</h6>
                        <div class="row mb-9">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="checkoutBillingFirstName">Имя *</label>
                                    <input type="text"
                                           class="form-control form-control-sm"
                                           id="checkoutBillingFirstName"
                                           name="firstname"
                                           placeholder="Имя"
                                           required
                                           value="{{ old('firstname', auth()->user()?->firstname) }}">
                                    @include('admin.master.message.error', ['name' => 'first_name'])
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="checkoutBillingLastName">Фамилия *</label>
                                    <input type="text"
                                           class="form-control form-control-sm"
                                           id="checkoutBillingLastName"
                                           name="lastname"
                                           placeholder="Фамилия"
                                           required
                                           value="{{ old('lastname', auth()->user()?->lastname) }}">
                                    @include('admin.master.message.error', ['name' => 'lastname'])
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
                                           required
                                           value="{{ old('email', auth()->user()?->email) }}">
                                    @include('admin.master.message.error', ['name' => 'email'])
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group mb-0">
                                    <label for="checkoutBillingPhone">Телефон *</label>
                                    <input type="tel"
                                           class="form-control form-control-sm"
                                           id="checkoutBillingPhone"
                                           name="phone"
                                           placeholder="Телефон"
                                           required
                                           value="{{ old('phone', auth()->user()?->phone) }}">
                                    @include('admin.master.message.error', ['name' => 'phone'])
                                </div>
                            </div>
                        </div>
                        <h6 class="mb-7">Доставка</h6>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="checkoutBillingAddress">Адрес *</label>
                                    <input type="text"
                                           class="form-control form-control-sm"
                                           id="checkoutBillingAddress"
                                           name="address"
                                           placeholder="Адрес"
                                           required
                                           value="{{ old('address', session('address', '')) }}">
                                    @include('admin.master.message.error', ['name' => 'address'])
                                </div>
                            </div>
                        </div>

                        @include('admin.master.message.error', ['name' => 'delivery_code'])

                        <div id="shipping-block"></div>
                        <p class="mb-7 font-size-xs text-gray-500">
                            Оплатить заказ вы можете после оформления заказа.
                        </p>
                        <button type="submit" href="{{ route('cart.index') }}" class="btn btn-block btn-dark">
                            Оформить заказ
                        </button>
                    </form>
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
        var tariffCode = '';

        function formatSelected(suggestion) {
            if (suggestion.data.postal_code) {
                return suggestion.value;
            } else {
                return suggestion.value;
            }
        }

        @if( $postal_code = old('post_code', '') )
        var coordinates = sessionStorage.getItem('coordinates');

        postal_code = '{{ $postal_code }}';

        if (coordinates) {
            geoLocation = JSON.parse(coordinates);
        }

        delivery(postal_code);
        @endif

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
                postal_code = suggestion.data.postal_code ?? '';
                if (postal_code === '') {
                    $('#shipping-block').html('Индекс не найден, допишите адрес для уточнения.');
                    return;
                }
                delivery(postal_code);
                geoLocation.lat = suggestion.data.geo_lat;
                geoLocation.lon = suggestion.data.geo_lon;
                sessionStorage.setItem('coordinates', JSON.stringify(geoLocation));
            }
        });

        $('#modal-pvz').on('shown.bs.modal', function (event) {
            tariffCode = $(event.relatedTarget).data('code');
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
                        type: 'FeatureCollection',
                        features: points
                    })
                });

        }

        function handleClickBaloonChoice(button) {
            var data = $(button).data();

            for (var key in data) {
                $('#pvz-block input[name="pvz_' + key + '"]').val(data[key]);
            }
            $('#modal-pvz').modal('hide');
            $('#pvz-block').attr('hidden', false).find('label').trigger('click');
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

            balloonContentBody += '<div class="mb-2"><a href="https://yandex.ru/maps/?rtext=~' + item.location.latitude + ',' + item.location.longitude + '&amp;rtt=auto&amp;z=6" target="_blank" rel="nofollow noopener noreferrer">Построить маршрут</a></div>';
            balloonContentBody += '<h6 class="mb-2 mt-1">Режим работы</h6>';
            balloonContentBody += '<div>' + item.work_time + '</div>';
            balloonContentBody += '<div>Код пвз: ' + item.code + '</div>';

            return {
                type: 'Feature',
                id: item.code,
                geometry: {'type': 'Point', 'coordinates': [item.location.latitude, item.location.longitude]},
                properties: {
                    //balloonContentHeader: '',
                    balloonContentBody: balloonContentBody,
                    balloonContentFooter: '' +
                        '<button type="button" ' +
                        'onclick="handleClickBaloonChoice($(this));" ' +
                        'data-code="' + item.code + '" ' +
                        'data-city_code="' + item.location.city_code + '" ' +
                        'data-address="' + item.location.address_full + '" ' +
                        'data-postal_code="' + item.location.postal_code + '" ' +
                        'class="btn btn-info btn-block btn-xxs">Выбрать</button>' +
                        '',
                    clusterCaption: '<strong>' + name + '</strong>',
                    hintContent: '<strong>' + name + '</strong>'
                }
            }
        }
    </script>

@endpush
