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
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label>Короткое название <small>прим.(белый)</small></label>
                            <input type="text" name="short_name" class="form-control" required
                                   value="{{ old('short_name', $variant->short_name) }}">
                            @include('admin.master.message.error', ['name' => 'short_name'])
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Артикул</label>
                            <input type="text" name="sku" class="form-control" required
                                   value="{{ old('sku', $variant->sku) }}">
                            @include('admin.master.message.error', ['name' => 'sku'])
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Id</label>
                            <input type="text" name="id" class="form-control" readonly
                                   value="{{ $variant->id }}">
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
                <table class="table table-prices">
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
                                <input type="hidden" name="prices[{{ $loop->index }}][id]"
                                       value="{{ $price->id }}">
                                @include('admin.master.message.error', ['name' => 'prices.' . $loop->index . '.id'])
                            </td>
                            <td>
                                <select name="prices[{{ $loop->index }}][size_id]" class="form-control">
                                    <option value="">-- Выберите --</option>
                                    @foreach( $sizes as $size )
                                        <option value="{{ $size->id }}"
                                                @if( (int)$size->id === (int)$price['size_id'] ) selected @endif>
                                            {{ $size->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @include('admin.master.message.error', ['name' => 'prices.' . $loop->index . '.size_id'])
                            </td>
                            <td><input type="number" name="prices[{{ $loop->index }}][cost]"
                                       value="{{ $price['cost'] }}"
                                       class="form-control">
                                @include('admin.master.message.error', ['name' => 'prices.' . $loop->index . '.cost'])
                            </td>
                            <td><input type="number" name="prices[{{ $loop->index }}][price]"
                                       value="{{ $price['price'] }}"
                                       class="form-control">
                                @include('admin.master.message.error', ['name' => 'prices.' . $loop->index . '.price'])
                            </td>
                            <td><input type="number" name="prices[{{ $loop->index }}][quantity]"
                                       value="{{ $price['quantity'] }}"
                                       class="form-control">
                                @include('admin.master.message.error', ['name' => 'prices.' . $loop->index . '.quantity'])
                            </td>
                            <td><input type="number" name="prices[{{ $loop->index }}][discount]"
                                       value="{{ $price['discount'] }}"
                                       class="form-control">
                                @include('admin.master.message.error', ['name' => 'prices.' . $loop->index . '.discount'])
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-block"><i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
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
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    @isset( $loop )
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirm('Удалить вариант товара?') ? $('#variant_destroy{{ $loop->index }}').submit() : ''">Удалить</button>
                    @else
                        <div></div>
                    @endisset
                    <button type="submit" class="btn btn-success btn-sm">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-photos card card-success card-outline">
            <div class="card-body p-0">
                <table class="table table-sm table-bordered">
                    <thead>
                    <tr>
                        <th>Фото</th>
                        <th>Сортировка</th>
                        <th>Изменить</th>
                        <th>Удалить</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( old('photos', $variant->photos) as $photo )
                        <tr>
                            <td>
                                <a href="{{ asset($photo['path']) }}" data-toggle="lightbox">
                                    <img src="{{ asset($photo['path']) }}" alt=""
                                         class="image img-fluid img-size-64">
                                </a>
                                <input type="hidden" value="{{ $photo['path'] }}"
                                       name="photos[{{ $loop->index }}][path]" id="input-photos-{{$photo->id}}-{{ $loop->index }}"
                                       class="input_image_hidden">
                                @include('admin.master.message.error', ['name' => 'photos.' . $loop->index . '.path'])
                            </td>
                            <td>
                                <input type="number" name="photos[{{ $loop->index }}][sort_order]"
                                       value="{{ $photo['sort_order'] }}" class="form-control">
                                @include('admin.master.message.error', ['name' => 'photos.' . $loop->index . '.sort_order'])
                            </td>
                            <td>
                                <button class="btn btn-success popup_selector"
                                        data-inputid="input-photos-{{$photo->id}}-{{ $loop->index }}">
                                    +
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-danger image_delete">x</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button type="button" class="add_image btn btn-sm btn-block btn-success">Добавить</button>
            </div>
        </div>
    </div>
</form>

@isset( $loop )
    <form id="variant_destroy{{ $loop->index }}" action="{{ route('variant.destroy', [$variant->product_id, $variant->id]) }}" method="post">
        @CSRF
        @method('DELETE')
    </form>
@endisset
