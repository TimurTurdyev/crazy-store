@if( session('status') )
    <div class="alert alert-success">
        <div class="d-flex justify-content-between align-content-start">
            <div>{{ session('status') }}</div>
            <button type="button" class="btn btn-default btn-xs" onclick="$(this).closest('.alert').remove();">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
@endif
