@extends('layouts.app')
@section('content')
    <form class="row"
          action="@if( $product->id ) {{ route('product.update', $product) }} @else {{ route('product.store') }} @endif"
          method="post">
        @CSRF
        @if( $product->id )
            @method('put')
        @endif
        <div class="col-md-8">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">Создание</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name', $product->name) }}">
                        @include('admin.master.message.error', ['name' => 'name'])
                    </div>
                    <div class="form-group">
                        <label>Статус</label>
                        <div>
                            <input type="checkbox"
                                   @if( old('status', $product->status) ) checked @endif
                                   name="status"
                                   data-bootstrap-switch data-off-color="danger" data-on-color="success"
                                   id="customSwitchStatus">
                            @include('admin.master.message.error', ['name' => 'status'])
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-success btn-sm">Выполнить</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title mb-0">Связи</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Группа товара</label>
                        <select name="group_id" class="form-control">
                            <option value="0">-- Выберите группу --</option>
                            @foreach( $groups as $group )
                                <option
                                    value="{{ $group->id }}"
                                    @if((int)$group->id === (int)old('group_id', $product->group_id)) selected @endif
                                >{{ $group->name }}</option>
                            @endforeach
                        </select>
                        @include('admin.master.message.error', ['name' => 'group_id'])
                    </div>
                    <div class="form-group">
                        <label>Бренд</label>
                        <select name="brand_id" class="form-control">
                            <option value="0">-- Выберите бренд --</option>
                            @foreach( $brands as $brand )
                                <option
                                    value="{{ $brand->id }}"
                                    @if((int)$brand->id === (int)old('brand_id', $product->brand_id)) selected @endif
                                >{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @include('admin.master.message.error', ['name' => 'brand_id'])
                    </div>
                </div>
            </div>
        </div>
    </form>
    @if( !isset($product->id) )
        Сначала создайте товар, после можно будет создать вариант товара
    @else
        <div class="card">
            <div class="card-body">
                <a href="{{ route('variant.create', $product->id) }}" class="btn btn-default btn-lg">Добавить
                    вариант товара</a>
            </div>
        </div>

        @foreach( $product->variants as $variant)
            <form action="">
                <div class="card">
                    <div class="card-header py-1 px-3">
                        <h3 class="card-title">
                            {{ $variant->short_name }}
                        </h3>
                        <div class="card-tools">#{{ $variant->id }}</div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-sm-3"><a
                                            href="https://via.placeholder.com/1200/000000.png?text=2"
                                            data-toggle="lightbox" data-title="sample 2 - black"
                                            data-gallery="gallery">
                                            <img src="https://via.placeholder.com/300/000000?text=2"
                                                 class="img-fluid mb-2" alt="black sample">
                                        </a></div>
                                    <div class="col-sm-3"><a
                                            href="https://via.placeholder.com/1200/000000.png?text=2"
                                            data-toggle="lightbox" data-title="sample 2 - black"
                                            data-gallery="gallery">
                                            <img src="https://via.placeholder.com/300/000000?text=2"
                                                 class="img-fluid mb-2" alt="black sample">
                                        </a></div>
                                    <div class="col-sm-3"><a
                                            href="https://via.placeholder.com/1200/000000.png?text=2"
                                            data-toggle="lightbox" data-title="sample 2 - black"
                                            data-gallery="gallery">
                                            <img src="https://via.placeholder.com/300/000000?text=2"
                                                 class="img-fluid mb-2" alt="black sample">
                                        </a></div>
                                    <div class="col-sm-3"><a href="https://via.placeholder.com/1200/000000.png?text=2"
                                                             data-toggle="lightbox" data-title="sample 2 - black"
                                                             data-gallery="gallery">
                                            <img src="https://via.placeholder.com/300/000000?text=2"
                                                 class="img-fluid mb-2" alt="black sample">
                                        </a></div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <table class="table table-bordered table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Размер</th>
                                        <th>Закупка</th>
                                        <th>Цена на сайте</th>
                                        <th>Кол-во</th>
                                        <th>Скидка</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $variant->prices as $price )
                                        <tr>
                                            <td>{{ $price->id }}</td>
                                            <td>{{ $price->name ?? '---' }}</td>
                                            <td>{{ $price->cost }}</td>
                                            <td>{{ $price->price }}</td>
                                            <td>{{ $price->quantity }}</td>
                                            <td>{{ $price->discount }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer py-1 px-3 d-flex justify-content-end">
                        <a href="{{ route('variant.edit', [$product->id, $variant->id]) }}"
                           class="btn btn-outline-info btn-xs">Редактировать</a>
                    </div>
                </div>
            </form>
        @endforeach
    @endif
@endsection

@push('scripts')
    <!-- Bootstrap Switch -->
    <script src="{{ asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
    </script>
@endpush
