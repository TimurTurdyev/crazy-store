<div class="modal fade" tabindex="-1" role="dialog" id="modal-user" aria-labelledby="modal-user" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Поиск клиентов</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="modal-body">
                <div class="input-group position-relative">
                    <div class="input-group-prepend">
                        <input type="text"
                               class="form-control form-control-sm"
                               name="user_id"
                               readonly
                               value="{{ $order->user?->id }}"
                        >
                    </div>
                    <input type="text"
                           class="form-control form-control-sm"
                           id="form-search_user"
                           value="{{ $order->user?->full_name }}"
                    >
                </div>
                <br>
                <button type="submit" class="btn btn-success btn-block">Применить</button>
            </form>
        </div>
    </div>
</div>
