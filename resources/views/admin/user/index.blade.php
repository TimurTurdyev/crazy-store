@extends('admin.app')
@section('header', 'Список клиентов')
@section('breadcrumbs')
    <li class="breadcrumb-item active">Список клиентов</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title mb-0">Список</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects table-sm">
                <thead>
                <tr>
                    <th style="width: 1%">#</th>
                    <th>Клиент</th>
                    <th>Телефон</th>
                    <th>Почта</th>
                    <th>Создан:</th>
                    <th>Обновил:</th>
                    <th style="width: 10rem;">Действие</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $users as $user )
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><a href="{{ route('admin.user.start_session', $user->id) }}">{{ $user->firstname }} {{ $user->lastname }}</a></td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.user.show', $user) }}">
                                <i class="fas fa-folder"></i>
                            </a>
                            <a class="btn btn-info btn-sm" href="{{ route('admin.user.edit', $user) }}">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirm('Удалить заказ #{{ $user->id }}?') ? $(this).next().submit() : '';">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form action="{{ route('admin.user.destroy', $user) }}" method="post">
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
                    {{ $users->links() }}
                </div>
                <div>
                    <a href="{{ route('admin.order.create') }}" class="btn btn-success btn-sm">Создать</a>
                </div>
            </div>
        </div>
    </div>
@endsection

