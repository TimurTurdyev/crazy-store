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
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        @if( $product->id )
                            <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirm('Удалить товар?') ? $('#product_destroy').submit() : ''">
                                Удалить
                            </button>
                        @else
                            <div></div>
                        @endif
                        <button type="submit" class="btn btn-success btn-sm">Выполнить</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-success card-outline">
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
    @if( $product->id )
        <form id="product_destroy" action="{{ route('product.destroy', $product->id) }}" method="post">
            @CSRF
            @method('DELETE')
        </form>
    @endif
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
            @include('admin.variant.index')
        @endforeach
    @endif
@endsection

@include('admin.variant.scripts')
