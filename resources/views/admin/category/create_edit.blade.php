@extends('admin.app')

@section('content')
    <form class="row"
          action="@if( $category->id ) {{ route('admin.category.update', $category) }} @else {{ route('admin.category.store') }} @endif"
          method="post">
        @CSRF
        @if( $category->id )
            @method('put')
        @endif
        <div class="col-md-8">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name', $category->name) }}">
                        @include('admin.master.message.error', ['name' => 'name'])
                    </div>
                    @include('admin.description.form', ['description' => $category->description])
                    <div class="form-group">
                        <label>Статус</label>
                        <div>
                            <input type="checkbox"
                                   @if( old('status', $category->status) ) checked @endif
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
                                @if( in_array($group->id, $group_selected) )
                                    <input class="custom-control-input" type="checkbox"  checked name="groups[]"
                                           id="checkbox_group{{ $group->id }}"
                                           value="{{ $group->id }}">
                                @else
                                    <input class="custom-control-input" type="checkbox" name="groups[]"
                                           id="checkbox_group{{ $group->id }}"
                                           value="{{ $group->id }}">
                                @endif
                                <label for="checkbox_group{{ $group->id }}"
                                       class="custom-control-label">{{ $group->name }}</label>
                            </div>
                        @endforeach
                    </div>
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
