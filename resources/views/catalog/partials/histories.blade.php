<h6 class="mb-7">История ({{ $histories->total() }})</h6>
<table class="table table-bordered table-sm mb-0">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Статус</th>
        <th scope="col">Сообщение</th>
        <th scope="col">Дата</th>
    </tr>
    </thead>
    <tbody>
    @foreach( $histories as $history )
        <tr>
            <th scope="row">{{ $loop->index + 1 }}</th>
            <td>{{ config('main.order')[$history->status] ?? '-' }}</td>
            <td class="messages">{{ $history->notify ? $history->message : '-' }}</td>
            <td>{{ $history->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $histories->links() }}
