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
                        Привязанные группы товаров
                    </th>
                    <th>
                        Кол-во товаров
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
                @foreach($brands as $brand)
                    <tr>
                        <td>
                            {{ $brand->id }}
                        </td>
                        <td>
                            {{ $brand->name }}
                        </td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">

                                </li>
                            </ul>
                        </td>
                        <td></td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" disabled="disabled"
                                       {{ $brand->status ? 'checked' : '' }} id="customSwitch{{$brand->id}}">
                                <label class="custom-control-label" for="customSwitch{{$brand->id}}"></label>
                            </div>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('brand.show', $brand) }}">
                                <i class="fas fa-folder"></i>
                            </a>
                            <a class="btn btn-info btn-sm" href="{{ route('brand.edit', $brand) }}">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirm('Удалить бренд - {{ $brand->name }}?') ? $(this).next().submit() : '';">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form action="{{ route('brand.destroy', $brand) }}" method="post">
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
                    {{ $brands->links() }}
                </div>
                <div>
                    <a href="{{ route('brand.create') }}" class="btn btn-success btn-sm">Создать</a>
                </div>
            </div>
        </div>
    </div>
@endsection
