<div class="table-responsive mb-6">
    <table class="table table-bordered table-sm table-hover mb-0">
        <thead>
        <tr>
            <th colspan="2">Варианты доставки для индекса: {{ $postal_code }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $deliveries as $delivery )
            <tr>
                <td class="d-flex justify-content-between">
                    <div class="custom-control custom-radio">
                        <input type="radio"
                               class="custom-control-input"
                               name="shipping"
                               value="{{ $delivery['type'] }}.{{ $delivery['code'] }}"
                               id="shipping-code-{{ $delivery['code'] }}"
                        >
                        <label class="custom-control-label text-body text-nowrap"
                               for="shipping-code-{{ $delivery['code'] }}">
                            {{ $delivery['name'] }}
                        </label>
                    </div>
                    @if($delivery['type'] === 'cdek.pvz')
                        <button type="button" class="btn btn-info btn-xxs float-end" data-toggle="modal" data-target="#modal-pvz">Выбрать пункт выдачи</button>
                    @endif
                </td>
                <td>{{ $delivery['price'] }} руб.</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<textarea class="form-control form-control-sm mb-9 mb-md-0 font-size-xs"
          rows="5"
          name="comment"
          placeholder="Комментарий к заказу (не обязательное поле)"></textarea>
