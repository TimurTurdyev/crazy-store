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
        <div class="input-group-append">
            <button type="button" class="btn btn-info btn-flat"
                    id="form-payment_code">Применить
            </button>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="form-payment_instruction">Инструкция по оплате</label>
    <textarea id="form-payment_instruction" type="text" class="form-control" name="payment_instruction">{{ $order->payment_instruction }}</textarea>
</div>
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
                        $.each(response.totals, function (i, item) {
                            $('.form-control.' + item.code).val(item.value);
                        });

                        $.ajax({
                            url: '{{ route('payment.instruction', $order) }}',
                            method: 'get',
                            cache: false,
                            success: function (response) {
                                $('textarea[name="payment_instruction"]').val(response.message);
                                $('.histories select[name="history\[status\]"]').val(40);
                                $('.histories input[name="history\[notify\]"]').prop('checked', true);
                            }
                        });
                    }
                }
            });
        });
    </script>
@endpush
