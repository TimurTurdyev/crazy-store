@extends('admin.app')

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
                    <th>
                        Действие
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($sizes as $size)
                    <tr>
                        <td>
                            {{ $size->id }}
                        </td>
                        <td>
                            {{ $size->name }}
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.category.show', $size) }}">
                                <i class="fas fa-folder"></i>
                            </a>
                            <a class="btn btn-info btn-sm" href="{{ route('admin.category.edit', $size) }}">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirm('Удалить категорию - {{ $size->name }}?') ? $(this).next().submit() : '';">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form action="{{ route('admin.category.destroy', $size) }}" method="post">
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
                    {{ $sizes->links() }}
                </div>
                <div>
                    <a href="{{ route('admin.size.create') }}" class="btn btn-success btn-sm">Создать</a>
                </div>
            </div>
        </div>
    </div>
@endsection
