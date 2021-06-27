<div class="card mb-7">
    <div class="card-img">
        @if( $count = ($variant->photos = $variant->photos->take(2))->count() )
            @if( $count > 1 )
                <a class="card-img-hover" href="https://yevgenysim.github.io/shopper/product.html">
                    <img class="card-img-top card-img-back" src="{{ asset( $variant->photos->last()->path ) }}"
                         alt="{{ $product->name }}, {{ $variant->short_name }}">
                    <img class="card-img-top card-img-front" src="{{ asset( $variant->photos->first()->path ) }}"
                         alt="{{ $product->name }}, {{ $variant->short_name }}">
                </a>
            @else
                <a class="card-img" href="https://yevgenysim.github.io/shopper/product.html">
                    <img class="card-img-top card-img-front" src="{{ asset( $variant->photos->first()->path ) }}"
                         alt="{{ $product->name }}, {{ $variant->short_name }}">
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
        <div class="font-size-xs">
            <a class="text-muted" href="shop.html">{{ $product->group_name }}</a>
        </div>
        <div class="font-weight-bold">
            <a class="text-body" href="https://yevgenysim.github.io/shopper/product.html">
                {{ $product->name }}, {{ $variant->short_name }}
            </a>
        </div>
        <div class="font-weight-bold text-muted">
            $79.00
        </div>
    </div>
</div>
