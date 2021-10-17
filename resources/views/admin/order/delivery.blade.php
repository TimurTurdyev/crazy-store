<p class="lead">Способ доставки</p>
<div class="row">
    <div class="col-12 col-md-8">
        <div class="form-group">
            <label for="form-address">Адрес *</label>
            <input type="text"
                   class="form-control form-control-sm"
                   id="form-address"
                   name="address"
                   placeholder="Адрес"
                   required=""
                   value="{{ old('address', $order->address) }}">
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
                   value="{{ old('post_code', $order->post_code) }}">
        </div>
    </div>
</div>
<div id="delivery-block"></div>

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
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru-RU&apikey=3e3fce61-e18b-4afa-bda8-b519cbcc99cd" defer></script>
    <script>
        var postal_code = '';
        var geoLocation = {};
        var tariffCode = '';
        var deliverySelectBlock = undefined;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#form-user').on('click', function (event) {
            event.preventDefault();
            var orderId = '{{ $order->id }}';

            if (!orderId) {
                alert('Сначала создайте заказ!');
                return;
            }
        });

        $('#delivery-block').on('change', 'input[type="radio"]', function () {
            $('input[name="totals[10][title]"]').val($(this).data('name'));
            $('input[name="totals[10][value]"]').val($(this).data('price'));
        });

        function formatSelected(suggestion) {
            if (suggestion.data.postal_code) {
                return suggestion.value;
            } else {
                return suggestion.value;
            }
        }

        function delivery(postal_code) {
            $('#delivery-block').html('Идет обращение к службам доставки...');
            $.ajax({
                method: 'GET',
                url: '{{ route('admin.deliveries') }}/' + postal_code,
            })
                .done(function (response) {
                    $('#delivery-block').html(response);
                });
        }

        $("#form-address").suggestions({
            token: "90bccef2f73253efbb4e8418dc8fd2d464d3a07a",
            type: "ADDRESS",
            formatSelected: formatSelected,
            /* Вызывается, когда пользователь выбирает одну из подсказок */
            onSelect: function (suggestion) {
                postal_code = suggestion.data.postal_code ?? '';
                if (postal_code === '') {
                    $('#delivery-block').html('Индекс не найден, допишите адрес для уточнения.');
                    return;
                }

                $('input[name="post_code"]').val(postal_code);
                geoLocation.lat = suggestion.data.geo_lat;
                geoLocation.lon = suggestion.data.geo_lon;
                delivery(postal_code);
            }
        });

        $('#modal-pvz').on('shown.bs.modal', function (event) {
            tariffCode = $(event.relatedTarget).data('code');
            deliverySelectBlock = $(event.relatedTarget).closest('li');
            ymaps.ready(init);
        });

        $('#modal-pvz').on('hidden.bs.modal', function (e) {
            $('#map').html('');
        })


        function init() {
            console.log(geoLocation)
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

            $('#modal-pvz').modal('hide');
            $(deliverySelectBlock).find('input[type="radio"]').data('name', data.delivery_name);
            $(deliverySelectBlock).find('.pvz-block').find('input[type="text"]').val(data.delivery_name);
            $(deliverySelectBlock).find('.pvz-block').attr('hidden', false).find('label').trigger('click');
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

            var address = 'ПВЗ[' + item.code + ']: ' + item.location.address_full;

            return {
                type: 'Feature',
                id: item.code,
                geometry: {'type': 'Point', 'coordinates': [item.location.latitude, item.location.longitude]},
                properties: {
                    balloonContentBody: balloonContentBody,
                    balloonContentFooter: '' +
                        '<button type="button" ' +
                        'onclick="handleClickBaloonChoice($(this));" ' +
                        'data-delivery_name="' + address + '" ' +
                        'class="btn btn-info btn-block btn-xxs">Выбрать</button>' +
                        '',
                    clusterCaption: '<strong>' + name + '</strong>',
                    hintContent: '<strong>' + name + '</strong>'
                }
            }
        }
    </script>
@endpush
