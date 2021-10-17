<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0">Список</h3>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped projects table-sm">
            <thead>
            <tr>
                <th style="width: 1%">#</th>
                <th>Статус</th>
                <th>Телефон</th>
                <th>Почта</th>
                <th>Клиент</th>
                <th>Оплата</th>
                <th style="width: 15rem;">Доставка</th>
                <th style="width: 5rem;">Итого</th>
                <th style="width: 10rem;">Дата создания</th>
                <th style="width: 10rem;">Дата обновления</th>
                <th style="width: 10rem;">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $orders as $order )
                <tr>
                    <td>
                        {{ $order->id }}
                    </td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->email }}</td>
                    <td>
                        {{ $order->firstname }} {{ $order->lastname }}
                    </td>
                    <td>{{ $order->payment_name }}</td>
                    <td>
                        @if( $delivery = $order->totals->firstWhere('sort_order', '10'))
                            {{ $delivery->title }} - {{ $delivery->value }} р.
                        @endif
                    </td>
                    <td>
                        {{ $order->totals->firstWhere('code', 'total')?->value }}
                    </td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->updated_at }}</td>

                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.order.show', $order) }}">
                            <i class="fas fa-folder"></i>
                        </a>
                        <a class="btn btn-info btn-sm" href="{{ route('admin.order.edit', $order) }}">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm"
                                onclick="confirm('Удалить заказ #{{ $order->id }}?') ? $(this).next().submit() : '';">
                            <i class="fas fa-trash"></i>
                        </button>
                        <form action="{{ route('admin.order.destroy', $order) }}" method="post">
                            @CSRF
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-between align-content-start">
            <div>
                {{ $orders->links() }}
            </div>
            <div>
                <a href="{{ route('admin.order.create') }}" class="btn btn-success btn-sm">Создать</a>
            </div>
        </div>
    </div>
</div>
