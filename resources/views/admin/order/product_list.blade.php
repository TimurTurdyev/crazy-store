<div class="card card-primary card-outline">
    <div class="card-header">
        <h5 class="card-title">Товары</h5>
        <div class="card-tools">
            <a href="#" class="btn btn-tool btn-link">#{{ $order->items->count() }}</a>
            <a href="{{ route('admin.order_items.index', $order) }}" class="btn btn-tool">
                <i class="fas fa-pen"></i>
            </a>
        </div>
    </div>
    <div class="card-body">
        @foreach( $order->items as $item )
            <div class="row align-items-center">
                <div class="col-3">
                    <img src="{{ $item->photo }}" alt="{{ $item->name }}" class="img-fluid">
                </div>
                <div class="col">
                    <div class="form-group">
                        <div>
                            <label>Наименование *</label>
                        </div>
                        <input type="text"
                               class="form-control form-control-sm"
                               readonly
                               value="{{ $item->name }}">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Старая цена *</label>
                                <input type="text"
                                       class="form-control form-control-sm"
                                       readonly
                                       value="{{ $item->price_old }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Цена *</label>
                                <input type="text"
                                       class="form-control form-control-sm"
                                       readonly
                                       value="{{ $item->price }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Кол-во *</label>
                                <input type="text"
                                       class="form-control form-control-sm"
                                       readonly
                                       value="{{ $item->quantity }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <p class="mb-0 font-size-sm text-muted">
                            На складе: <strong class="stock">{{ $item->variantPrice->quantity }}</strong> шт.
                        </p>
                        <a href="{{ route('admin.product.edit', $item->product_id) }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn-xs btn-outline-secondary mb-2">
                            Перейти в товар
                        </a>
                    </div>
                </div>
            </div>
            @if( !$loop->last )
                <hr>
            @endif
        @endforeach
    </div>
</div>


