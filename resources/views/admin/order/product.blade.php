@extends('admin.app')

@section('content')

    <form class="invoice p-3 mb-3"
          id="form-product"
          autocomplete="off"
          action="{{ route('admin.order_items.update', [$order, $order]) }}"
          method="post">
        @CSRF
        @method('put')
        <div class="row">
            <div class="col-12">
                <h4>
                    #{{ $order->id }}
                    <button type="submit" class="float-right btn btn-default mb-2">Сохранить</button>
                </h4>
            </div>
        </div>
        <table class="table table-striped projects">
            <thead>
            <tr>
                <th style="width: 1%">
                    #
                </th>
                <th style="width: 10rem;">
                    Фото
                </th>
                <th>
                    Название
                </th>
                <th style="width: 9rem;">
                    Старая цена
                </th>
                <th style="width: 9rem;">
                    Цена
                </th>
                <th style="width: 9rem;">
                    Кол-во
                </th>
                <th style="width: 9rem;">
                    Наличие
                </th>
                <th>
                    Действие
                </th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <td colspan="8">
                    <button type="button" class="btn btn-info" id="add-product">Добавить товар</button>
                </td>
            </tr>
            </tfoot>
            <tbody>
            @foreach( $order->items as $item )
                <tr class="product{{ $item->id }}">
                    <td>
                        {{ $item->id }}
                        <input type="hidden" name="prices[{{ $item->id }}][photo]"
                               value="{{ $item->photo }}">
                        <input type="hidden" name="prices[{{ $item->id }}][product_id]"
                               value="{{ $item->product_id }}">
                        <input type="hidden" name="prices[{{ $item->id }}][variant_id]"
                               value="{{ $item->variant_id }}">
                        <input type="hidden" name="prices[{{ $item->id }}][price_id]"
                               value="{{ $item->price_id }}">
                    </td>
                    <td>
                        <img src="{{ $item->photo }}" alt="{{ $item->name }}" class="img-fluid">
                    </td>
                    <td>
                        <div class="position-relative">
                            <input type="text"
                                   class="form-control form-control-sm"
                                   name="prices[{{ $item->id }}][name]"
                                   required=""
                                   value="{{ $item->name }}" data-item="{{ $item->id }}">
                        </div>
                    </td>
                    <td>
                        <input type="number"
                               class="form-control form-control-sm"
                               name="prices[{{ $item->id }}][price_old]"
                               required=""
                               value="{{ $item->price_old }}">
                    </td>
                    <td>
                        <input type="number"
                               class="form-control form-control-sm"
                               name="prices[{{ $item->id }}][price]"
                               required=""
                               value="{{ $item->price }}">
                    </td>
                    <td>
                        <input type="number"
                               class="form-control form-control-sm"
                               name="prices[{{ $item->id }}][quantity]"
                               required=""
                               value="{{ $item->quantity }}">
                    </td>
                    <td>
                        <strong class="stock">{{ $item->variantPrice->quantity }}</strong>
                        шт.
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.product.edit', $item->product_id) }}"
                           target="_blank">
                            <i class="fas fa-folder"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" onclick="$(this).closest('tr').remove();">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </form>
@endsection
@push('scripts')
    <script>
        $('#add-product').on('click', function (event) {
            event.preventDefault();
            var rowClass = 'r' + $('#form-product tbody tr').length;
            var rowProduct = $('#row-product').html().replace(/#item_id#/gi, rowClass);
            $('#form-product tbody').append(rowProduct);
            searchProduct('.product' + rowClass + ' input[name*="\[name\]"]');
        });
    </script>
    <script src="{{ asset('main/autocomplete.js') }}"></script>
    <script>
        function searchProduct(element) {
            console.log($(element))
            $(element).autocomplete({
                'source': function (request, response) {
                    var itemId = $(this).data('item');
                    $.ajax({
                        url: '{{ route('admin.price.filter') }}?name=' + encodeURIComponent(request),
                        dataType: 'json',
                        cache: false,
                        success: function (json) {
                            response($.map(json, function (item) {
                                var label = item['name'] + ' / ' + item.data.price + 'р. - ' + item.data.stock + 'шт.';
                                return {
                                    label: label,
                                    value: item['value'],
                                    itemId: itemId,
                                    data: item['data']
                                }
                            }));
                        }
                    });
                },
                'select': function (item) {
                    console.log(item)
                    var itemId = item['itemId'];

                    for (var key in item.data) {
                        var entity = $('input[name="prices\[' + itemId + '\]\[' + key + '\]"]');
                        if ($(entity).is('input')) {
                            $(entity).val(item.data[key]);
                        }
                    }
                    var link = '{{ asset('admin/product') }}/' + item.data['product_id'] + '/edit';
                    $('.product' + itemId + ' a').attr('href', link);
                    $('.product' + itemId + ' img').attr('src', item.data['photo']);
                    $('.product' + itemId + ' .stock').text(item.data['stock']);
                }
            });
        }
        searchProduct('input[name*="\[name\]"]');
    </script>
    <script type="template/html" id="row-product">
        <tr class="product#item_id#">
            <td>
                #item_id#
                <input type="hidden" name="prices[#item_id#][photo]"
                       value="">
                <input type="hidden" name="prices[#item_id#][product_id]"
                       value="">
                <input type="hidden" name="prices[#item_id#][variant_id]"
                       value="">
                <input type="hidden" name="prices[#item_id#][price_id]"
                       value="">
            </td>
            <td>
                <img src="" alt="" class="img-fluid">
            </td>
            <td>
                <div class="position-relative">
                    <input type="text"
                           class="form-control form-control-sm"
                           name="prices[#item_id#][name]"
                           required=""
                           value="" data-item="#item_id#">
                </div>
            </td>
            <td>
                <input type="number"
                       class="form-control form-control-sm"
                       name="prices[#item_id#][price_old]"
                       required=""
                       value="">
            </td>
            <td>
                <input type="number"
                       class="form-control form-control-sm"
                       name="prices[#item_id#][price]"
                       required=""
                       value="">
            </td>
            <td>
                <input type="number"
                       class="form-control form-control-sm"
                       name="prices[#item_id#][quantity]"
                       required=""
                       value="">
            </td>
            <td>
                <strong class="stock"></strong>
                шт.
            </td>
            <td class="project-actions text-right">
                <a class="btn btn-primary btn-sm" href="{{ route('admin.product.edit', 0) }}"
                   target="_blank">
                    <i class="fas fa-folder"></i>
                </a>
                <button type="button" class="btn btn-danger btn-sm" onclick="$(this).closest('tr').remove();">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    </script>
@endpush
