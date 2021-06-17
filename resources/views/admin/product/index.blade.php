@extends('layouts.app')

@section('content')
    @include('admin.master.message.success')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title mb-0">Список</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th style="width: 1%">
                        #
                    </th>
                    <th style="width: 20%">
                        Название
                    </th>
                    <th style="width: 30%">
                        Группа
                    </th>
                    <th style="width: 30%">
                        Бренд
                    </th>
                    <th style="width: 8%" class="text-center">
                        Статус
                    </th>
                    <th>
                        Действие
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            {{ $product->id }}
                        </td>
                        <td>
                            {{ $product->name }}
                        </td>
                        <td>
                            @if($product->group_id)
                                <a href="{{ route('group.edit', $product->group_id) }}">{{ $product->group->name }}</a>
                            @else
                                ---
                            @endif
                        </td>
                        <td>
                            @if($product->brand_id)
                                <a href="{{ route('brand.edit', $product->brand_id) }}">{{ $product->brand->name }}</a>
                            @else
                                ---
                            @endif
                        </td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" disabled="disabled"
                                       {{ $product->status ? 'checked' : '' }} id="customSwitch{{$product->id}}">
                                <label class="custom-control-label" for="customSwitch{{$product->id}}"></label>
                            </div>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('product.show', $product) }}">
                                <i class="fas fa-folder"></i>
                            </a>
                            <a class="btn btn-info btn-sm" href="{{ route('product.edit', $product) }}">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirm('Удалить товар - {{ $product->name }}?') ? $(this).next().submit() : '';">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form action="{{ route('product.destroy', $product) }}" method="post">
                                @CSRF
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between align-content-start">
                <div>
                    {{ $products->links() }}
                </div>
                <div>
                    <a href="{{ route('product.create') }}" class="btn btn-success btn-sm">Создать</a>
                </div>
            </div>
        </div>
    </div>
@endsection
