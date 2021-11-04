@extends('admin.app')

@section('content')
    <form class="invoice p-3 mb-3"
          id="form-order"
          autocomplete="off"
          action="@if( $order->id ) {{ route('admin.order.update', $order) }} @else {{ route('admin.order.store') }} @endif"
          method="post">
        @CSRF
        @if( $order->id )
            @method('put')
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <h4>
                    <small>#{{ $order->id }} / Date: {{ $order->created_at }}</small>

                    <button type="submit" class="float-right btn btn-default mb-2">Сохранить</button>
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p class="lead">Информация</p>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="form-user_id">Клиент Id</label>
                            <input type="text"
                                   class="form-control form-control-sm"
                                   id="form-user_id"
                                   name="user_id"
                                   value="{{ old('user_id', $order->user_id) }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="form-group">
                            <label for="form-search_user">Поиск по клиентам</label>
                            <input type="text" class="form-control form-control-sm"
                                   id="form-search_user"
                                   placeholder="Имя, фамилия, почта или телефон">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="formFirstName">Имя *</label>
                            <input type="text"
                                   class="form-control form-control-sm"
                                   id="formFirstName"
                                   name="firstname" placeholder="Имя"
                                   required=""
                                   value="{{ old('firstname', $order->firstname) }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="formLastName">Фамилия *</label>
                            <input type="text" class="form-control form-control-sm"
                                   id="formLastName"
                                   name="lastname"
                                   placeholder="Фамилия"
                                   required=""
                                   value="{{ old('lastname', $order->lastname) }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="formEmail">Email *</label>
                            <input type="email"
                                   class="form-control form-control-sm"
                                   id="formEmail"
                                   name="email"
                                   placeholder="Email"
                                   required=""
                                   value="{{ old('email', $order->email) }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="formPhone">Телефон *</label>
                            <input type="tel"
                                   class="form-control form-control-sm"
                                   id="formPhone"
                                   name="phone"
                                   placeholder="Телефон"
                                   required="" value="{{ old('phone', $order->phone) }}">
                        </div>
                    </div>
                </div>
                @include('admin.order.delivery')
                @if( $order->id )
                    @include('admin.order.payment')
                @endif
                <div class="histories"></div>
            </div>
            <div class="col-sm-6">
                <p class="lead">Сумма заказа</p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        @if( $order->order_code )
                            <tr>
                                <th style="width:50%">Публичная ссылка на заказ</th>
                                <td><a href="{{ route('order.completed', $order->order_code) }}"
                                       target="_blank">{{ $order->order_code }}</a></td>
                            </tr>
                        @endif
                        @foreach( $order->totals as $total )
                            <tr>
                                <th>
                                    <input type="hidden" name="totals[{{ $total->sort_order }}][code]"
                                           value="{{ $total->code }}">
                                    <input type="hidden" name="totals[{{ $total->sort_order }}][sort_order]"
                                           value="{{ $total->sort_order }}">
                                    <input type="text" class="form-control"
                                           name="totals[{{ $total->sort_order }}][title]" value="{{ $total->title }}">
                                </th>
                                <td>
                                    <input type="text" class="form-control {{ $total->code }}"
                                           name="totals[{{ $total->sort_order }}][value]" value="{{ $total->value }}"
                                           readonly>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if( $order->id )
                    @include('admin.order.product_list')
                @endif
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{ asset('main/autocomplete.js') }}"></script>
    <script>
        $('input[name="totals[1][value]"]').attr('readonly', false);
        $('input[name="totals[10][value]"]').attr('readonly', false);
        $('#form-search_user').autocomplete({
            'source': function (request, response) {
                if (request === '') return;
                $.ajax({
                    url: '{{ route('admin.user.filter') }}?all_fields=' + encodeURIComponent(request),
                    dataType: 'json',
                    cache: false,
                    success: function (json) {
                        response($.map(json, function (item) {
                            return {
                                label: item['name'],
                                value: item['value'],
                                data: item['data']
                            }
                        }));
                    }
                });
            },
            'select': function (item) {
                $(this).val(item['label']);
                $('#form-user_id').val(item['value']);
            }
        });
        @if( $order->id )
        function handleHistoryMessage(block, params) {
            var url = '{{ route('admin.order.history', $order) }}';
            $.ajax({
                url: url + (params ? '?' + params : ''),
                dataType: 'html',
                cache: false,
                success: function (response) {
                    $(block).html(response);
                }
            });
        }

        $('.histories').each(function () {
            var self = this;

            $(self).on('click', 'a', function (event) {
                event.preventDefault();
                var params = $(this).attr('href').replace(/http.+?[?&]/gi, '');
                handleHistoryMessage(self, params);
            });

            $(self).on('click', '.btn-success', function (event) {
                event.preventDefault();
                var params = $(self).find('[name*="history"]').serialize();
                handleHistoryMessage(self, params);
            });

            setTimeout(function () {
                handleHistoryMessage(self);
            }, 1000);
        });
        @endif
    </script>

    <style>
        .card-footer .pagination {
            margin-bottom: 0;
        }

        .direct-chat-img {
            text-align: center;
        }

        .direct-chat-img i {
            font-size: 2rem;
        }
    </style>
@endpush
