<p class="lead">Способ оплаты</p>
<div class="form-group">
    <label for="form-payment_code">Оплата *</label>
    <div class="input-group">
        <select name="payment_code" class="form-control">
            <option value="">-- Выберите --</option>
            @foreach( $order->payments as $code => $name )
                @if( $order->payment_code === $code)
                    <option value="{{ $code }}" selected>{{ $name }}</option>
                @else
                    <option value="{{ $code }}">{{ $name }}</option>
                @endif
            @endforeach
        </select>
        <span class="input-group-append">
                            <button type="button" class="btn btn-info btn-flat"
                                    id="form-payment_code">Применить</button>
                        </span>
    </div>
</div>
<div class="histories" data-code="payment"></div>
@push('scripts')
    <script>
        $('#form-payment_code').on('click', function () {
            $.ajax({
                url: '{{ route('admin.order.update', $order) }}',
                method: 'put',
                data: $('#form-order').serialize(),
                cache: false,
                success: function (response) {
                    if (response.code) {

                        $('#sub_total').text(response.order.sub_total);
                        $('#promo_value').val(response.order.promo_value);
                        $('#delivery_value').text(response.order.delivery_value);
                        $('#total').text(response.order.total);

                        $.ajax({
                            url: '{{ route('payment.instruction', $order) }}',
                            method: 'get',
                            cache: false,
                            success: function (response) {
                                $('.histories[data-code="payment"] textarea[name="history\[message\]"]').val(response.message);
                            }
                        });
                    }
                }
            });
        });
    </script>
@endpush
