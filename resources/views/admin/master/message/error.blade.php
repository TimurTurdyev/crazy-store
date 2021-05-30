@error( $name )
<div class="alert alert-danger mt-1 py-1 px-2">
    <div class="d-flex justify-content-between align-content-start">
        <div>{{ $message }}</div>
        <button type="button" class="btn btn-default btn-xs" onclick="$(this).closest('.alert').remove();">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@enderror
