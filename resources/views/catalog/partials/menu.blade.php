<div class="navbar navbar-fashion navbar-expand-lg navbar-dark mb-4 bg-dark">
    <div class="container">

        <!-- Search-->
        <form class="navbar-form mr-auto order-lg-1">
            <div class="input-group">
                <input type="search" class="form-control" placeholder="Search for items and brands"/>
                <div class="input-group-append">
                    <button class="btn btn-dark">
                        <i class="fe fe-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFashionBottomCollapse"
                aria-controls="navbarFashionBottomCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbarFashionBottomCollapse">
            <ul class="navbar-nav">
                @if( $menu->count() )
                    @foreach( $menu as $item )
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('catalog', $item->id) }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
                @endif
                <li class="nav-item">
                    <a class="nav-link text-primary" href="index-fashion.html#!">Sale %</a>
                </li>
            </ul>
        </div>

    </div>
</div>
