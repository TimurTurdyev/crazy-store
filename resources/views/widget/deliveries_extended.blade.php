<div class="card">
    <div class="card-header">
        Варианты доставки для индекса: {{ $postal_code }}
    </div>
    <ul class="list-group list-group-flush">
        @foreach( $deliveries->groupBy('group') as $name => $group )
            <li class="list-group-item">
                <p class="lead">{{ $name }}</p>
                <ul class="list-unstyled">
                    @foreach($group as $delivery)
                        <li>
                            @if(Str::is('cdek.pvz.*', $delivery['code']) === false)
                                <div class="custom-control custom-radio">
                                    <input type="radio"
                                           class="custom-control-input"
                                           name="widget_delivery_code"
                                           value="{{ $delivery['code'] }}"
                                           id="delivery-code-{{ $loop->index }}-{{ $delivery['code'] }}"
                                           data-price="{{ $delivery['price'] }}"
                                           data-name="{{ $delivery['name'] }}"
                                    >
                                    <label class="custom-control-label text-body text-nowrap"
                                           for="delivery-code-{{ $loop->index }}-{{ $delivery['code'] }}">
                                        {{ $delivery['name'] }} -
                                        {{ $delivery['price'] }} руб.

                                    </label>
                                </div>

                                <div>
                                    <small>{{ $delivery['description'] }}</small>
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
                            <div>
                                <small>{{ $delivery['description'] }}</small>
                            </div>
                            <div class="pvz-block mb-2" hidden>
                                <div class="custom-control custom-radio mb-2">
                                    <input type="radio"
                                           class="custom-control-input"
                                           name="widget_delivery_code"
                                           value="{{ $delivery['code'] }}"
                                           data-price="{{ $delivery['price'] }}"
                                           data-name="{{ $delivery['name'] }}"
                                           id="delivery-code-{{ $loop->index }}-{{ $delivery['code'] }}"
                                    >
                                    <label class="custom-control-label text-body text-nowrap"
                                           for="delivery-code-{{ $loop->index }}-{{ $delivery['code'] }}"
                                    >
                                        До пункта выдачи:
                                    </label>
                                </div>

                                <input type="text" class="form-control form-control-xxs" readonly>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>
