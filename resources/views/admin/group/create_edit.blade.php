@extends('layouts.app')

@section('content')
    <form class="row"
          action="@if( $group->id ) {{ route('group.update', $group) }} @else {{ route('group.store') }} @endif"
          method="post">
        @CSRF
        @if( $group->id )
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
                               value="{{ old('name', $group->name) }}">
                        @include('admin.master.message.error', ['name' => 'name'])
                    </div>
                    @include('admin.description.form', ['description' => $group->description])
                    <div class="form-group">
                        <label>Статус</label>
                        <div>
                            <input type="checkbox"
                                   @if( old('status', $group->status) ) checked @endif
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
    </form>
@endsection
@include('admin.description.scripts')
@push('scripts')
    <!-- Bootstrap Switch -->
    <script src="{{ asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
    </script>
@endpush
