@extends('layouts.app')

@section('content')
    <form class="row"
          action="@if( isset($variant->id) ) {{ route('variant.update',[0, $variant->id]) }} @else {{ route('variant.store', $product->id) }} @endif"
          method="post">
        @CSRF
        @isset( $variant->id )
            @method('put')
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
                                <input type="text" name="short_name" class="form-control"
                                       value="{{ old('short_name', $variant->short_name) }}">
                                @include('admin.master.message.error', ['name' => 'short_name'])
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
                        @foreach( $variant->prices() as $price )
                            <tr>
                                <td>
                                    <input type="text" name="prices[][id]" value="{{ $price->id }}" class="form-control"
                                           readonly>
                                </td>
                                <td>
                                    <select name="prices[][size_id]" class="form-control">
                                        <option value="">-- Выберите --</option>
                                        @foreach( $sizes as $size )
                                            <option value="{{ $size->id }}"
                                                    @if( (int)$size->id === $price->size_id ) selected @endif>
                                                {{ $size->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" name="prices[][cost]" value="{{ $price->cost }}"
                                           class="form-control">
                                </td>
                                <td><input type="number" name="prices[][price]" value="{{ $price->price }}"
                                           class="form-control">
                                </td>
                                <td><input type="number" name="prices[][quantity]" value="{{ $price->quantity }}"
                                           class="form-control"></td>
                                <td><input type="number" name="prices[][discount]" value="{{ $price->discount }}"
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
            $($tablePrices).children('tbody').append( $('#price_row').html() );
        });
    </script>
    <script type="template/html" id="price_row">
        <tr>
            <td>
                <input type="text" name="prices[][id]" value="new" class="form-control" readonly>
            </td>
            <td>
                <select name="size_id" class="form-control">
                    <option value="">-- Выберите --</option>
                    @foreach( $sizes as $size )
                        <option value="{{ $size->id }}">
                            {{ $size->name }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="prices[][cost]" value="" class="form-control"></td>
            <td><input type="number" name="prices[][price]" value="" class="form-control"></td>
            <td><input type="number" name="prices[][quantity]" value="" class="form-control"></td>
            <td><input type="number" name="prices[][discount]" value="" class="form-control"></td>
            <td>
                <button type="button" class="btn btn-danger btn-block"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
    </script>
@endpush
