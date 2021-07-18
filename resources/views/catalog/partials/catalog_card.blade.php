<div class="card mb-7">

    <div class="card-img">
        @if( $count = ($item->photos = $item->photos->take(2))->count() )
            @if( $count > 1 )
                <a class="card-img-hover"
                   href="{{ route('catalog.product', $item->product_id) }}?variant={{ $item->id }}">
                    <img class="card-img-top card-img-back" src="{{ asset( $item->photos->last()->path ) }}"
                         alt="{{ $item->variant_name }}">
                    <img class="card-img-top card-img-front" src="{{ asset( $item->photos->first()->path ) }}"
                         alt="{{ $item->variant_name }}">
                </a>
            @else
                <a class="card-img" href="{{ route('catalog.product', $item->product_id) }}?variant={{ $item->id }}">
                    <img class="card-img-top card-img-front" src="{{ asset( $item->photos->first()->path ) }}"
                         alt="{{ $item->variant_name }}">
                </a>
            @endif
        @endif
        <div class="card-actions">
              <span class="card-action">
                    <button class="btn btn-xs btn-circle btn-white-primary"
                            data-toggle="modal"
                            data-target="#modalProduct">
                      <i class="fe fe-eye"></i>
                    </button>
              </span>
            <span class="card-action">
                    <button class="btn btn-xs btn-circle btn-white-primary" data-toggle="button">
                      <i class="fe fe-shopping-cart"></i>
                    </button>
              </span>
            <span class="card-action">
                    <button class="btn btn-xs btn-circle btn-white-primary" data-toggle="button">
                      <i class="fe fe-heart"></i>
                    </button>
              </span>
        </div>
    </div>
    <div class="card-body px-0">
        @isset( $category )
            <div class="font-size-xs">
                <a class="text-muted"
                   href="{{ route('catalog', $category->id) }}?group={{ $item->group_id }}">{{ $item->group_name }}</a>
            </div>
        @endisset
        <div class="font-weight-bold">
            <a class="text-body" href="{{ route('catalog.product', $item->product_id) }}?variant={{ $item->id }}">
                {{ $item->variant_name }}
            </a>
        </div>
        @if( $item->prices->count() )
            <div class="font-weight-bold text-muted">
                {{ $item->prices->min('price') }} Руб
            </div>
        @endif
    </div>
</div>
