@extends('layouts.app')

@section('content')
    <form class="row"
          action="@if( isset($size->id) ) {{ route('size.update', $size) }} @else {{ route('size.store') }} @endif"
          method="post">
        @CSRF
        @isset( $size->id )
            @method('put')
        @endisset
        <div class="col-md-8">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">Создание</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name', isset($size) ? $size->name : '') }}">
                        @include('admin.master.message.error', ['name' => 'name'])
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-success btn-sm">Создать</button>
                </div>
            </div>
        </div>
    </form>
@endsection
