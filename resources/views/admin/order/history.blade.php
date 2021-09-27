<div class="card card-success card-outline direct-chat direct-chat-success shadow-sm">
    <div class="card-header">
        <h3 class="card-title">История заказа</h3>
        <div class="card-tools">
            <span title="{{ $histories->total() }} сообщений"
                  class="badge bg-success">{{ $histories->total() }}</span>
        </div>
    </div>
    <div class="card-body">
        <div class="direct-chat-messages" id="history-message">
            @foreach( $histories as $history )
                <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">{{ $history->notify ? 'Уведомлен' : 'Скрыт' }}</span>
                        <span class="direct-chat-timestamp float-right">{{ $history->created_at }}</span>
                    </div>
                    <div class="direct-chat-text">
                        {{ $history->message }}
                    </div>
                </div>
            @endforeach
        </div>
        {{ $histories->links() }}
    </div>
    <div class="card-footer">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" title="Уведомить клиента">
                  <input type="checkbox" name="history[notify]" value="1">
                </span>
            </div>
            <textarea placeholder="Type Message ..." name="history[message]" class="form-control"></textarea>
            <span class="input-group-append">
                <button type="button" class="btn btn-success">Отправить</button>
            </span>
        </div>
    </div>
</div>
