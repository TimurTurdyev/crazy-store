@extends('layouts.app')

@section('content')
    <form class="row"
          action="@if( isset($category) ) {{ route('category.update', $category) }} @else {{ route('category.store') }} @endif"
          method="post">
        @CSRF
        @isset( $category )
            @method('put')
        @endisset
        <div class="col-md-8">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name', isset($category) ? $category->name : '') }}">
                        @include('admin.master.message.error', ['name' => 'name'])
                    </div>
                    <div class="form-group">
                        <label>Статус</label>
                        <div>
                            <input type="checkbox"
                                   @if( old('status', isset($category) ? $category->status : '') ) checked @endif
                                   name="status"
                                   data-bootstrap-switch data-off-color="danger" data-on-color="success"
                                   id="customSwitchStatus">
                            @include('admin.master.message.error', ['name' => 'status'])
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-success btn-sm">Создать</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <div class="form-group">
                        <label>Группы товаров</label>
                        @foreach( $groups as $group )
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="groups[]" id="checkbox_group{{ $group->id }}"
                                       value="{{ $group->id }}">
                                <label for="checkbox_group{{ $group->id }}" class="custom-control-label">{{ $group->name }}</label>
                            </div>
                        @endforeach
                    </div>
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
        })
    </script>
@endpush
