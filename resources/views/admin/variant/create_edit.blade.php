@extends('layouts.app')

@section('content')
    <form class="row"
          action="@if( isset($variant->id) ) {{ route('variant.update',[$variant->product_id, $variant->id]) }} @else {{ route('variant.store', $product->id) }} @endif"
          method="post">
        @CSRF
        @isset( $variant->id )
            @method('put')
            <input type="hidden" name="id" value="{{ $variant->id }}">
        @endisset
        <div class="col-md-8">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">Создание</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Короткое название <small>прим.(белый)</small></label>
                                <input type="text" name="short_name" class="form-control"
                                       value="{{ old('short_name', $variant->short_name) }}">
                                @include('admin.master.message.error', ['name' => 'short_name'])
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Артикул</label>
                                <input type="text" name="sku" class="form-control"
                                       value="{{ old('sku', $variant->sku) }}">
                                @include('admin.master.message.error', ['name' => 'sku'])
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Статус</label>
                        <div>
                            <input type="checkbox"
                                   @if( old('status', $variant->status) ) checked @endif
                                   name="status"
                                   data-bootstrap-switch data-off-color="danger" data-on-color="success"
                                   id="customSwitchStatus">
                            @include('admin.master.message.error', ['name' => 'status'])
                        </div>
                    </div>
                    <table class="table" id="table-prices">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Размер</th>
                            <th>Закупка</th>
                            <th>Цена</th>
                            <th>Кол-во</th>
                            <th>Скидка %</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $variant->prices as $price )
                            <tr>
                                <td>
                                    {{ $price->id }}
                                    <input type="hidden" name="prices[{{ $loop->index }}][id]" value="{{ $price->id }}">
                                </td>
                                <td>
                                    <select name="prices[{{ $loop->index }}][size_id]" class="form-control">
                                        <option value="">-- Выберите --</option>
                                        @foreach( $sizes as $size )
                                            <option value="{{ $size->id }}"
                                                    @if( (int)$size->id === $price->size_id ) selected @endif>
                                                {{ $size->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" name="prices[{{ $loop->index }}][cost]"
                                           value="{{ $price->cost }}"
                                           class="form-control">
                                </td>
                                <td><input type="number" name="prices[{{ $loop->index }}][price]"
                                           value="{{ $price->price }}"
                                           class="form-control">
                                </td>
                                <td><input type="number" name="prices[{{ $loop->index }}][quantity]"
                                           value="{{ $price->quantity }}"
                                           class="form-control"></td>
                                <td><input type="number" name="prices[{{ $loop->index }}][discount]"
                                           value="{{ $price->discount }}"
                                           class="form-control"></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="7" class="text-right">
                                <button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-success btn-sm">Сохранить</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title mb-0">Фото варианта товара</h3>
                </div>
                <div class="card-body p-0">

                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <!-- Bootstrap Switch -->
    <script src="{{ asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
        var $tablePrices = $('#table-prices');

        $tablePrices.on('click', '.btn-danger', function () {
            $(this).closest('tr').remove();
        });

        $tablePrices.on('click', '.btn-success', function () {
            var $tBody = $($tablePrices).children('tbody');
            var count = $tBody.find('tr').length;
            var row = $('#price_row').html().replace(/\{index\}/gi, count);
            $tBody.append($(row));
        });
    </script>
    <script type="template/html" id="price_row">
        <tr>
            <td>
                new
                <input type="hidden" name="prices[{index}][id]" value="">
            </td>
            <td>
                <select name="size_id" class="form-control">
                    <option value="null">-- Выберите --</option>
                    @foreach( $sizes as $size )
                        <option value="{{ $size->id }}">
                            {{ $size->name }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="prices[{index}][cost]" value="0" class="form-control"></td>
            <td><input type="number" name="prices[{index}][price]" value="0" class="form-control"></td>
            <td><input type="number" name="prices[{index}][quantity]" value="0" class="form-control"></td>
            <td><input type="number" name="prices[{index}][discount]" value="0" class="form-control"></td>
            <td>
                <button type="button" class="btn btn-danger btn-block"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
    </script>
@endpush
