<div class="card">
    <div class="card-header">
        Варианты доставки для индекса: {{ $postal_code }}
        <input type="hidden" name="post_code" value="{{ $postal_code }}">
    </div>
    <ul class="list-group list-group-flush">
        @foreach( $deliveries as $delivery )
            <li class="list-group-item">
                <input type="hidden" name="delivery_price" value="{{ $delivery['price'] }}">
                <input type="hidden" name="delivery_name" value="{{ $delivery['name'] }}">
                @if(Str::is('cdek.pvz.*', $delivery['code']) === false)
                    <div class="custom-control custom-radio">
                        <input type="radio"
                               class="custom-control-input"
                               name="delivery_code"
                               value="{{ $delivery['code'] }}"
                               id="delivery-code-{{ $delivery['code'] }}"
                        >
                        <label class="custom-control-label text-body text-nowrap"
                               for="delivery-code-{{ $delivery['code'] }}">
                            {{ $delivery['name'] }} -
                            {{ $delivery['price'] }} руб.
                        </label>
                    </div>
                    @continue
                @endif

                <label for="field-pvz">
                    {{ $delivery['name'] }} -
                    {{ $delivery['price'] }} руб.
                </label>
                <button type="button"
                        class="btn btn-info btn-xxs float-end"
                        data-toggle="modal"
                        data-target="#modal-pvz"
                        data-code="{{ $delivery['code'] }}">Выбрать
                </button>

                <div id="pvz-block" class="mb-2 " hidden>
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio"
                               class="custom-control-input"
                               name="delivery_code"
                               value="{{ $delivery['code'] }}"
                               id="delivery-code-{{ $delivery['code'] }}"
                        >
                        <label class="custom-control-label text-body text-nowrap"
                               for="delivery-code-{{ $delivery['code'] }}"
                        >
                            До пункта выдачи:
                        </label>
                    </div>

                    <input id="field-pvz" type="text" class="form-control form-control-xxs" readonly
                           name="pvz_address">
                    <input type="hidden" name="pvz_code">
                    <input type="hidden" name="pvz_city_code">
                    <input type="hidden" name="pvz_postal_code">
                </div>
            </li>
        @endforeach
    </ul>
</div>

<textarea class="form-control form-control-sm mb-9 mb-md-0 font-size-xs"
          rows="5"
          name="notes"
          placeholder="Комментарий к заказу (не обязательное поле)"></textarea>
