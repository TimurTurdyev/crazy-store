<div class="card card-success card-outline direct-chat direct-chat-success shadow-sm">
    <input type="hidden" name="history[code]" value="{{ $request_data['code'] ?? '' }}">
    <div class="card-header">
        <div class="d-inline-flex input-group input-group-sm w-50">
            <div class="input-group-prepend">
                <span class="input-group-text">Статус</span>
            </div>
            <select name="history[status]" class="form-control">
                @foreach( config('main.order') as $code => $name )
                    @if( $selected === $code )
                        <option value="{{ $code }}" selected>{{ $name }}</option>
                    @else
                        <option value="{{ $code }}">{{ $name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
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
                        <span
                            class="direct-chat-name float-left">{{ config('main.order')[$history->status] ?? '' }} | {{ $history->notify ? 'Уведомлен' : 'Скрыт' }}</span>
                        <span class="direct-chat-timestamp float-right">{{ $history->created_at }}</span>
                    </div>
                    <div class="direct-chat-img"></div>
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
                <div class="input-group-text" title="Уведомить клиента">
                    <input type="checkbox" name="history[notify]" value="1">
                </div>
            </div>
            <textarea placeholder="Type Message ..." name="history[message]" class="form-control"></textarea>
            <div class="input-group-append">
                <button type="button" class="btn btn-success">Отправить</button>
            </div>
        </div>
    </div>
</div>

