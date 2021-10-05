@extends('admin.app')
@section('header', sprintf('%s %s', $user->firstname, $user->lastname))
@section('breadcrumbs')
    <li class="breadcrumb-item active">Список клиентов</li>
@endsection
@section('content')
    <form class="row"
          action="@if( isset($user->id) ) {{ route('admin.user.update', $user) }} @else {{ route('admin.size.store') }} @endif"
          method="post">
        @CSRF
        @isset( $user->id )
            @method('put')
        @endisset
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="col-md-8">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">Редактирование</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Имя</label>
                        <input type="text" name="firstname" class="form-control"
                               value="{{ old('firstname', $user->firstname) }}">
                        @include('admin.master.message.error', ['name' => 'firstname'])
                    </div>
                    <div class="form-group">
                        <label>Фамилия</label>
                        <input type="text" name="lastname" class="form-control"
                               value="{{ old('lastname', $user->lastname) }}">
                        @include('admin.master.message.error', ['name' => 'lastname'])
                    </div>
                    <div class="form-group">
                        <label>Почта</label>
                        <input type="text" name="email" class="form-control"
                               value="{{ old('email', $user->email) }}">
                        @include('admin.master.message.error', ['name' => 'email'])
                    </div>
                    <div class="form-group">
                        <label>Телефон</label>
                        <input type="text" name="phone" class="form-control"
                               value="{{ old('phone', $user->phone) }}">
                        @include('admin.master.message.error', ['name' => 'phone'])
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-success btn-sm">Обновить</button>
                </div>
            </div>
        </div>
    </form>
    @if($orders = $user->orders()->paginate(10))
        @if($orders->total())
            @include('admin.order.list', ['orders' => $orders])
        @endif
    @endif
@endsection

