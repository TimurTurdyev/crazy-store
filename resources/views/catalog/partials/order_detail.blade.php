<div class="card card-lg mb-5 border">
    <div class="card-body pb-0">
        <div class="card card-sm">
            <div class="card-body bg-light">
                <div class="row">
                    <div class="col-6 col-lg-3">

                        <h6 class="heading-xxxs text-muted">Номер заказа:</h6>

                        <p class="mb-lg-0 font-size-sm font-weight-bold">
                            {{ $order->id }}
                        </p>

                    </div>
                    <div class="col-6 col-lg-3">

                        <h6 class="heading-xxxs text-muted">Дата создания:</h6>

                        <p class="mb-lg-0 font-size-sm font-weight-bold">
                            <time datetime="{{ $order->created_at }}">
                                {{ $order->created_at }}
                            </time>
                        </p>

                    </div>
                    <div class="col-6 col-lg-3">

                        <h6 class="heading-xxxs text-muted">Статус:</h6>

                        <p class="mb-0 font-size-sm font-weight-bold">
                            {{ $order->status }}
                        </p>

                    </div>
                    <div class="col-6 col-lg-3">

                        <h6 class="heading-xxxs text-muted">Сумма заказа:</h6>

                        <p class="mb-0 font-size-sm font-weight-bold">
                            {{ $order->totals->last()?->value }} <i class="fas fa-ruble-sign"></i>
                        </p>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card-footer">
        <h6 class="mb-7">Кол-во ({{ $order->items->count() }})</h6>
        <hr class="my-5">
        <ul class="list-group list-group-lg list-group-flush-y list-group-flush-x">
            @foreach( $order->items as $item )
                <li class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-4 col-md-3 col-xl-2">
                            <a href="{{ route('catalog.product', $item->product_id) }}?variant={{ $item->variant_id }}">
                                <img src="{{ $item->photo }}" alt="{{ $item->name }}"
                                     class="img-fluid">
                            </a>
                        </div>
                        <div class="col">
                            <div class="mb-4 font-size-sm font-weight-bold">
                                <a class="text-body"
                                   href="{{ route('catalog.product', $item->product_id) }}?variant={{ $item->variant_id }}">{{ $item->name }}</a>
                                <br>

                                <div class="mt-2">
                                    @if($item->price_old < $item->price)
                                        <div
                                            class="d-inline-block text-gray-350 text-decoration-line-through">
                                            {{ $item->price_old }} <i class="fas fa-ruble-sign"></i>
                                        </div>
                                        <div class="d-inline-block ml-1">
                                            {{ $item->price }} <i class="fas fa-ruble-sign"></i>
                                        </div>
                                    @else
                                        <div class="text-muted">{{ $item->price }} <i
                                                class="fas fa-ruble-sign"></i></div>
                                    @endif
                                </div>
                                <div class="font-size-sm text-muted">
                                    Кол-во: <strong>{{ $item->quantity }} шт.</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="card card-lg mb-5 border">
    <div class="card-body">

        <h6 class="mb-7">Сумма заказа</h6>

        <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-5">
            @foreach( $order->totals as $total )
                <li class="list-group-item d-flex @if( $loop->last ) font-size-lg font-weight-bold @endif">
                    <span>{{ $total->title }}</span>
                    <span class="ml-auto">{{ $total->value }} <i
                            class="fas fa-ruble-sign"></i></span>
                </li>
            @endforeach
        </ul>
        <form
              autocomplete="off"
              action="{{ route('payment.instruction.change', $order) }}"
              method="post">
            @CSRF
            <div id="payment_instruction" class="alert alert-info">{{ $order->payment_instruction }}</div>
            <div class="form-group mb-2">
                <div class="input-group">
                    <select name="payment_code" class="form-control">
                        @foreach( $order->payments as $code => $name )
                            @if( $order->payment_code === $code)
                                <option value="{{ $code }}" selected>{{ $name }}</option>
                            @else
                                <option value="{{ $code }}">{{ $name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-info btn-flat"
                                id="form-payment_code">Применить
                        </button>
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>

<div id="histories"></div>
@push('scripts')
    <script>
        function linkInit(message) {
            return message.replace(/(https:\/\/.+\s?)/gi, "<a href='$1' target='_blank'>$1</a>");
        }

        $('#histories').on('click', 'a', function () {
            event.preventDefault();
            var params = $(this).attr('href').replace(/http.+?[?&]/gi, '');
            histories(params);
        });

        function histories(params) {
            $.ajax({
                url: '{{ route('order.histories', $order->order_code) }}' + (params ? '?' + params : ''),
                method: 'get',
                cache: false,
                success: function (response) {
                    $('#histories').html(response);
                }
            });
        }

        histories();
        $('#payment_instruction').html(linkInit($('#payment_instruction').text()));
    </script>
@endpush
