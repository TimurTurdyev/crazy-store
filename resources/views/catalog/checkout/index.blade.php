@extends('catalog.index')

@section('content')
    <nav class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <ol class="breadcrumb mb-0 font-size-xs text-gray-400">
                        <li class="breadcrumb-item">
                            <a class="text-gray-400" href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Shopping Cart
                        </li>
                    </ol>

                </div>
            </div>
        </div>
    </nav>

    <section class="pt-7 pb-12">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <h3 class="mb-10 text-center">Корзина</h3>

                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-7">

                    <ul class="list-group list-group-lg list-group-flush-x mb-6">
                        @foreach($cartCollection as $item)
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-3">

                                        <a href="https://yevgenysim.github.io/shopper/product.html">
                                            <img src="assets/img/products/product-6.jpg" alt="..." class="img-fluid">
                                        </a>

                                    </div>
                                    <div class="col">

                                        <div class="d-flex mb-2 font-weight-bold">
                                            <a class="text-body"
                                               href="https://yevgenysim.github.io/shopper/product.html">Cotton floral
                                                print</a> <span class="ml-auto">$40.00</span>
                                        </div>

                                        <p class="mb-7 font-size-sm text-muted">
                                            Size: M <br>
                                            Color: Red
                                        </p>

                                        <div class="d-flex align-items-center">

                                            <select class="custom-select custom-select-xxs w-auto">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                            </select>

                                            <a class="font-size-xs text-gray-400 ml-auto" href="shopping-cart.html#!">
                                                <i class="fe fe-x"></i> Remove
                                            </a>

                                        </div>

                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="row align-items-end justify-content-between mb-10 mb-md-0">
                        <div class="col-12 col-md-7">

                            <form class="mb-7 mb-md-0">
                                <label class="font-size-sm font-weight-bold" for="cartCouponCode">
                                    Coupon code:
                                </label>
                                <div class="row form-row">
                                    <div class="col">

                                        <input class="form-control form-control-sm" id="cartCouponCode" type="text"
                                               placeholder="Enter coupon code*">

                                    </div>
                                    <div class="col-auto">

                                        <button class="btn btn-sm btn-dark" type="submit">
                                            Apply
                                        </button>

                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="col-12 col-md-auto">

                            <button class="btn btn-sm btn-outline-dark">Update Cart</button>

                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-5 col-lg-4 offset-lg-1">

                    <div class="card mb-7 bg-light">
                        <div class="card-body">
                            <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                                <li class="list-group-item d-flex">
                                    <span>Subtotal</span> <span class="ml-auto font-size-sm">$89.00</span>
                                </li>
                                <li class="list-group-item d-flex">
                                    <span>Tax</span> <span class="ml-auto font-size-sm">$00.00</span>
                                </li>
                                <li class="list-group-item d-flex font-size-lg font-weight-bold">
                                    <span>Total</span> <span class="ml-auto font-size-sm">$89.00</span>
                                </li>
                                <li class="list-group-item font-size-sm text-center text-gray-500">
                                    Shipping cost calculated at Checkout *
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Button -->
                    <a class="btn btn-block btn-dark mb-2" href="checkout.html">Proceed to Checkout</a>

                    <!-- Link -->
                    <a class="btn btn-link btn-sm px-0 text-body" href="shop.html">
                        <i class="fe fe-arrow-left mr-2"></i> Continue Shopping
                    </a>

                </div>
            </div>
        </div>
    </section>

    <section class="bg-light py-9">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3">

                    <div class="d-flex mb-6 mb-lg-0">

                        <i class="fe fe-truck font-size-lg text-primary"></i>

                        <div class="ml-6">

                            <h6 class="heading-xxs mb-1">
                                Free shipping
                            </h6>

                            <p class="mb-0 font-size-sm text-muted">
                                From all orders over $100
                            </p>

                        </div>

                    </div>

                </div>
                <div class="col-12 col-md-6 col-lg-3">

                    <div class="d-flex mb-6 mb-lg-0">

                        <i class="fe fe-repeat font-size-lg text-primary"></i>

                        <div class="ml-6">

                            <h6 class="mb-1 heading-xxs">
                                Free returns
                            </h6>

                            <p class="mb-0 font-size-sm text-muted">
                                Return money within 30 days
                            </p>

                        </div>

                    </div>

                </div>
                <div class="col-12 col-md-6 col-lg-3">

                    <!-- Item -->
                    <div class="d-flex mb-6 mb-md-0">

                        <!-- Icon -->
                        <i class="fe fe-lock font-size-lg text-primary"></i>

                        <!-- Body -->
                        <div class="ml-6">

                            <!-- Heading -->
                            <h6 class="mb-1 heading-xxs">
                                Secure shopping
                            </h6>

                            <!-- Text -->
                            <p class="mb-0 font-size-sm text-muted">
                                You're in safe hands
                            </p>

                        </div>

                    </div>

                </div>
                <div class="col-12 col-md-6 col-lg-3">

                    <!-- Item -->
                    <div class="d-flex">

                        <!-- Icon -->
                        <i class="fe fe-tag font-size-lg text-primary"></i>

                        <!-- Body -->
                        <div class="ml-6">

                            <!-- Heading -->
                            <h6 class="mb-1 heading-xxs">
                                Over 10,000 Styles
                            </h6>

                            <!-- Text -->
                            <p class="mb-0 font-size-sm text-muted">
                                We have everything you need
                            </p>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
