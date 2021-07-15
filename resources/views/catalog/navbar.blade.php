<div class="navbar navbar-topbar navbar-expand-xl navbar-light bg-light">
    <div class="container">

        <!-- Promo -->
        <div class="mr-xl-8">
            <i class="fe fe-truck mr-2"></i> <span class="heading-xxxs">Free shipping worldwide</span>
        </div>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topbarCollapse"
                aria-controls="topbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="topbarCollapse">

            <!-- Nav -->
            <ul class="nav nav-divided navbar-nav mr-auto">

            </ul>

            <!-- Nav -->
            <ul class="nav navbar-nav mr-8">
                <li class="nav-item">
                    <a class="nav-link" href="shipping-and-returns.html">Shipping</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="faq.html">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact-us.html">Contact</a>
                </li>
            </ul>

            <!-- Nav -->
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item">
                    <a class="nav-link text-gray-350" href="index-fashion.html#!">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </li>
                <li class="nav-item ml-xl-n4">
                    <a class="nav-link text-gray-350" href="index-fashion.html#!">
                        <i class="fab fa-twitter"></i>
                    </a>
                </li>
                <li class="nav-item ml-xl-n4">
                    <a class="nav-link text-gray-350" href="index-fashion.html#!">
                        <i class="fab fa-instagram"></i>
                    </a>
                </li>
                <li class="nav-item ml-xl-n4">
                    <a class="nav-link text-gray-350" href="index-fashion.html#!">
                        <i class="fab fa-medium"></i>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light @@classList">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand d-lg-none" href="overview.html">
            Shopper.
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarFashionTopCollapse"
                aria-controls="navbarFashionTopCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbarFashionTopCollapse">

            <!-- Brand -->
            <a class="navbar-brand d-none d-lg-block" href="overview.html">
                CrazyKids.
            </a>

            <!-- Nav -->
            <ul class="nav navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link" href="shipping-and-returns.html">Shipping</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="faq.html">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact-us.html">Contact</a>
                </li>
            </ul>

            <!-- Nav -->
            <ul class="navbar-nav flex-row">
                <li class="nav-item">
                    <a class="nav-link" href="account-orders.html">
                        <i class="fe fe-user"></i>
                    </a>
                </li>
                <li class="nav-item ml-lg-n4">
                    <a class="nav-link" href="account-wishlist.html">
                        <i class="fe fe-heart"></i>
                    </a>
                </li>
                <li class="nav-item ml-lg-n4">
                    <a class="nav-link" data-toggle="modal" href="index-fashion.html#modalShoppingCart">
                    <span data-cart-items="{{ Cart::getContent()->count() }}">
                      <i class="fe fe-shopping-cart"></i>
                    </span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>

@include('catalog.partials.menu')
