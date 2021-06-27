<ul class="nav nav-vertical" id="filterNav">
    <li class="nav-item">

        <!-- Toggle -->
        <a class="nav-link dropdown-toggle font-size-lg text-reset border-bottom mb-6"
           data-toggle="collapse" href="shop.html#categoryCollapse">
            Группа товара
        </a>

        <!-- Collapse -->
        <div class="collapse show" id="categoryCollapse">
            <div class="form-group">
                <ul class="list-styled mb-0" id="productsNav">
                    @foreach( $groups as $group )
                        <li class="list-styled-item">
                            <a class="list-styled-link" href="shop.html#">
                                {{ $group->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </li>

    @if( $brands->count() )
        <li class="nav-item">
            <!-- Toggle -->
            <a class="nav-link dropdown-toggle font-size-lg text-reset border-bottom mb-6"
               data-toggle="collapse" href="shop.html#brandCollapse">
                Бренд
            </a>
            <!-- Collapse -->
            <div class="collapse show" id="brandCollapse" data-toggle="simplebar"
                 data-target="#brandGroup">
                <!-- Search -->
                <div data-toggle="lists" data-options='{"valueNames": ["name"]}'>
                    <!-- Input group -->
                    <div class="input-group input-group-merge mb-6">
                        <input class="form-control form-control-xs search" type="search"
                               placeholder="Search Brand">
                        <!-- Button -->
                        <div class="input-group-append">
                            <button class="btn btn-outline-border btn-xs">
                                <i class="fe fe-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group form-group-overflow mb-6" id="brandGroup">
                        <div class="list">
                            @foreach( $brands as $brand )
                                <div class="custom-control custom-checkbox mb-3">
                                    <input class="custom-control-input" id="brand_{{ $brand->id }}" type="checkbox">
                                    <label class="custom-control-label name" for="brand_{{ $brand->id }}">
                                        {{ $brand->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @endif

    @if( $sizes->count() )
        <li class="nav-item">
            <a class="nav-link dropdown-toggle font-size-lg text-reset border-bottom mb-6"
               data-toggle="collapse" href="shop.html#sizeCollapse">
                Размер
            </a>
            <div class="collapse show" id="sizeCollapse" data-toggle="simplebar"
                 data-target="#sizeGroup">
                <div class="form-group form-group-overlow mb-6" id="sizeGroup">
                    @foreach( $sizes as $size )
                        <div class="custom-control custom-control-inline custom-control-size mb-2">
                            <input class="custom-control-input" id="size_{{ $size->id }}" type="checkbox">
                            <label class="custom-control-label" for="size_{{ $size->id }}">
                                {{ $size->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

        </li>
    @endif
</ul>
