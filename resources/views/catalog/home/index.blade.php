@extends('catalog.index')

@section('content')
<!-- WELCOME -->
<section class="position-relative mb-4 py-13">

    <!-- Cover -->
    <div class="container-cover">
        <div class="container-fluid">
            <div class="row">
                <div class="col d-none d-xl-block bg-cover" style="background-image: url(assets/img/covers/cover-6.jpg);"></div>
                <div class="col d-none d-lg-block bg-cover" style="background-image: url(assets/img/covers/cover-7.jpg);"></div>
                <div class="col d-none d-md-block bg-cover" style="background-image: url(assets/img/covers/cover-8.jpg);"></div>
                <div class="col bg-cover" style="background-image: url(assets/img/covers/cover-9.jpg);"></div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">

                <!-- Card -->
                <div class="card card-xl">
                    <div class="card-body text-center">

                        <!-- Heading -->
                        <h4 class="mb-6">Summer Collection</h4>

                        <!-- Text -->
                        <p class="mb-0">
                            Appear, dry there darkness they're seas, dry waters thing fly midst above.
                        </p>

                        <!-- Button -->
                        <a class="btn btn-dark btn-sm mb-n12" href="shop.html">
                            Shop Now <i class="fe fe-arrow-right ml-2"></i>
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>

</section>

<!-- SALE -->
<section class="py-12 bg-primary bg-pattern">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">

                <!-- Heading-->
                <h1 class="display-4 mb-9 text-white">
                    Sale up to 50% off
                </h1>

                <!-- Buttons -->
                <a class="btn btn-outline-white border-2 px-md-8 m-2 m-md-4" href="shop.html">Dresses</a>
                <a class="btn btn-outline-white border-2 px-md-8 m-2 m-md-4" href="shop.html">Tops & T-Shirts</a>
                <a class="btn btn-outline-white border-2 px-md-8 m-2 m-md-4" href="shop.html">Blouses & Shirts</a>
                <a class="btn btn-outline-white border-2 px-md-8 m-2 m-md-4" href="shop.html">Jeans & Trousers</a>
                <a class="btn btn-outline-white border-2 px-md-8 m-2 m-md-4" href="shop.html">Jeans & Trousers</a>
                <a class="btn btn-outline-white border-2 px-md-8 m-2 m-md-4" href="shop.html">Shoes</a>
                <a class="btn btn-outline-white border-2 px-md-8 m-2 m-md-4" href="shop.html">Acessories</a>
                <a class="btn btn-outline-white border-2 px-md-8 m-2 m-md-4" href="shop.html">Coats & Jakets</a>
                <a class="btn btn-outline-white border-2 px-md-8 m-2 m-md-4" href="shop.html">Shorts & Skirts</a>

            </div>
        </div>
    </div>
</section>

<!-- TOP SELLERS -->
<section class="py-12">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6">

                <!-- Preheading -->
                <h6 class="heading-xxs mb-3 text-center text-gray-400">
                    Top selling
                </h6>

                <!-- Heading -->
                <h2 class="mb-10 text-center">Top wekeend Sellers</h2>

            </div>
        </div>
        <div class="row">
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">

                <!-- Card -->
                <div class="card mb-7" data-toggle="card-collapse">

                    <!-- Badge -->
                    <div class="badge badge-white card-badge card-badge-left text-uppercase">
                        New
                    </div>

                    <!-- Image -->
                    <div class="card-img" data-flickity='{"draggable": false}' id="productOneImg">
                        <a class="d-block w-100" href="https://yevgenysim.github.io/shopper/product.html">
                            <img class="card-img-top" src="assets/img/products/product-5.jpg" alt="..." />
                        </a>
                        <a class="d-block w-100" href="https://yevgenysim.github.io/shopper/product.html">
                            <img class="card-img-top" src="assets/img/products/product-142.jpg" alt="..." />
                        </a>
                    </div>

                    <!-- Collapse -->
                    <div class="card-collapse-parent">

                        <!-- Body -->
                        <div class="card-body px-0 pb-0 bg-white">
                            <div class="row no-gutters">
                                <div class="col">

                                    <!-- Title -->
                                    <a class="d-block font-weight-bold text-body" href="https://yevgenysim.github.io/shopper/product.html">
                                        Leather mid-heel Sandals
                                    </a>

                                    <!-- Category -->
                                    <a class="font-size-xs text-muted" href="shop.html">
                                        Shoes
                                    </a>

                                </div>
                                <div class="col-auto">

                                    <!-- Price -->
                                    <div class="font-size-sm font-weight-bold text-muted">
                                        $129.00
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-collapse collapse">
                            <div class="card-footer px-0 bg-white">
                                <form>
                                    <div class="mb-1">
                                        <div class="custom-control custom-control-inline custom-control-color">
                                            <input type="radio" id="productOneColorOne" name="productOneColor" class="custom-control-input" checked />
                                            <label class="custom-control-label" data-toggle="flickity" data-target="#productOneImg" data-slide="0" style="color: beige" for="productOneColorOne"></label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-color ml-n2">
                                            <input type="radio" id="productOneColorTwo" name="productOneColor" class="custom-control-input" />
                                            <label class="custom-control-label" data-toggle="flickity" data-target="#productOneImg" data-slide="1" style="color: black" for="productOneColorTwo"></label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productOneSizeOne" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productOneSizeOne">6</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productOneSizeTwo" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productOneSizeTwo">6.5</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productOneSizeThree" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productOneSizeThree">7</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productOneSizeFour" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productOneSizeFour">7.5</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productOneSizeFive" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productOneSizeFive">8.5</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">

                <!-- Card -->
                <div class="card mb-7" data-toggle="card-collapse">

                    <!-- Image -->
                    <div class="card-img" data-flickity='{"draggable": false}' id="productTwoImg">
                        <a class="d-block w-100" href="https://yevgenysim.github.io/shopper/product.html">
                            <img class="card-img-top" src="assets/img/products/product-6.jpg" alt="..." />
                        </a>
                        <a class="d-block w-100" href="https://yevgenysim.github.io/shopper/product.html">
                            <img class="card-img-top" src="assets/img/products/product-143.jpg" alt="..." />
                        </a>
                    </div>

                    <!-- Collapse -->
                    <div class="card-collapse-parent">

                        <!-- Body -->
                        <div class="card-body px-0 pb-0 bg-white">
                            <div class="row no-gutters">
                                <div class="col">

                                    <!-- Title -->
                                    <a class="d-block font-weight-bold text-body" href="https://yevgenysim.github.io/shopper/product.html">
                                        Cotton floral print Dress
                                    </a>

                                    <!-- Category -->
                                    <a class="font-size-xs text-muted" href="shop.html">
                                        Dresses
                                    </a>

                                </div>
                                <div class="col-auto">

                                    <!-- Price -->
                                    <div class="font-size-sm font-weight-bold text-muted">
                                        $40.00
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-collapse collapse">
                            <div class="card-footer px-0 bg-white">
                                <form>
                                    <div class="mb-1">
                                        <div class="custom-control custom-control-inline custom-control-color">
                                            <input type="radio" id="productTwoColorOne" name="productTwoColor" class="custom-control-input" checked />
                                            <label class="custom-control-label" data-toggle="flickity" data-target="#productTwoImg" data-slide="0" style="color: red" for="productTwoColorOne"></label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-color ml-n2">
                                            <input type="radio" id="productTwoColorTwo" name="productTwoColor" class="custom-control-input" />
                                            <label class="custom-control-label" data-toggle="flickity" data-target="#productTwoImg" data-slide="1" style="color: white" for="productTwoColorTwo"></label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productTwoSizeOne" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productTwoSizeOne">6</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productTwoSizeTwo" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productTwoSizeTwo">6.5</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productTwoSizeThree" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productTwoSizeThree">7</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productTwoSizeFour" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productTwoSizeFour">7.5</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productTwoSizeFive" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productTwoSizeFive">8.5</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">

                <!-- Card -->
                <div class="card mb-7" data-toggle="card-collapse">

                    <!-- Badge -->
                    <div class="badge badge-dark card-badge card-badge-left text-uppercase letter-spacing-lg">
                        Sale
                    </div>

                    <!-- Image -->
                    <img class="card-img-top" src="assets/img/products/product-7.jpg" alt="..." />

                    <!-- Collapse -->
                    <div class="card-collapse-parent">

                        <!-- Body -->
                        <div class="card-body px-0 pb-0 bg-white">
                            <div class="row no-gutters">
                                <div class="col">

                                    <!-- Title -->
                                    <a class="d-block font-weight-bold text-body" href="https://yevgenysim.github.io/shopper/product.html">
                                        Leather Sneakers
                                    </a>

                                    <!-- Category -->
                                    <a class="font-size-xs text-muted" href="shop.html">
                                        Shoes
                                    </a>

                                </div>
                                <div class="col-auto">

                                    <!-- Price -->
                                    <div class="font-size-xs font-weight-bold text-gray-350 text-decoration-line-through">
                                        $115.00
                                    </div>
                                    <div class="font-size-sm font-weight-bold text-primary">
                                        $85.00
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-collapse collapse">
                            <div class="card-footer px-0 bg-white">
                                <form>
                                    <div class="mb-1">
                                        <div class="custom-control custom-control-inline custom-control-color">
                                            <input type="radio" id="productThreeColorOne" name="productThreeColor" class="custom-control-input" checked />
                                            <label class="custom-control-label" style="color: #f9f9f9;" for="productThreeColorOne"></label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productThreeSizeOne" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productThreeSizeOne">6</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productThreeSizeTwo" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productThreeSizeTwo">6.5</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productThreeSizeThree" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productThreeSizeThree">7</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productThreeSizeFour" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productThreeSizeFour">7.5</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productThreeSizeFive" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productThreeSizeFive">8.5</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">

                <!-- Card -->
                <div class="card mb-7" data-toggle="card-collapse">

                    <!-- Image -->
                    <img class="card-img-top" src="assets/img/products/product-8.jpg" alt="..." />

                    <!-- Collapse -->
                    <div class="card-collapse-parent">

                        <!-- Body -->
                        <div class="card-body px-0 pb-0 bg-white">
                            <div class="row no-gutters">
                                <div class="col">

                                    <!-- Title -->
                                    <a class="d-block font-weight-bold text-body" href="https://yevgenysim.github.io/shopper/product.html">
                                        Cropped cotton Top
                                    </a>

                                    <!-- Category -->
                                    <a class="font-size-xs text-muted" href="shop.html">
                                        Top
                                    </a>

                                </div>
                                <div class="col-auto">

                                    <!-- Price -->
                                    <div class="font-size-sm font-weight-bold text-muted">
                                        $29.00
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-collapse collapse">
                            <div class="card-footer px-0 bg-white">
                                <form>
                                    <div class="mb-1">
                                        <div class="custom-control custom-control-inline custom-control-color">
                                            <input type="radio" id="productFourColorOne" name="productFourColor" class="custom-control-input" checked />
                                            <label class="custom-control-label" style="color: #f9f9f9;" for="productFourColorOne"></label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productFourSizeOne" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productFourSizeOne">6</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productFourSizeTwo" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productFourSizeTwo">6.5</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productFourSizeThree" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productFourSizeThree">7</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productFourSizeFour" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productFourSizeFour">7.5</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productFourSizeFive" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productFourSizeFive">8.5</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">

                <!-- Card -->
                <div class="card mb-7" data-toggle="card-collapse">

                    <!-- Image -->
                    <img class="card-img-top" src="assets/img/products/product-9.jpg" alt="..." />

                    <!-- Collapse -->
                    <div class="card-collapse-parent">

                        <!-- Body -->
                        <div class="card-body px-0 pb-0 bg-white">
                            <div class="row no-gutters">
                                <div class="col">

                                    <!-- Title -->
                                    <a class="d-block font-weight-bold text-body" href="https://yevgenysim.github.io/shopper/product.html">
                                        Floral print midi Dress
                                    </a>

                                    <!-- Category -->
                                    <a class="font-size-xs text-muted" href="shop.html">
                                        Dresses
                                    </a>

                                </div>
                                <div class="col-auto">

                                    <!-- Price -->
                                    <div class="font-size-sm font-weight-bold text-muted">
                                        $50.00
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-collapse collapse">
                            <div class="card-footer px-0 bg-white">
                                <form>
                                    <div class="mb-1">
                                        <div class="custom-control custom-control-inline custom-control-color">
                                            <input type="radio" id="productFiveColorOne" name="productFiveColor" class="custom-control-input" checked />
                                            <label class="custom-control-label" style="color: yellow;" for="productFiveColorOne"></label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productFiveSizeOne" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productFiveSizeOne">6</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productFiveSizeTwo" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productFiveSizeTwo">6.5</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productFiveSizeThree" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productFiveSizeThree">7</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productFiveSizeFour" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productFiveSizeFour">7.5</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productFiveSizeFive" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productFiveSizeFive">8.5</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">

                <!-- Card -->
                <div class="card mb-7" data-toggle="card-collapse">

                    <!-- Badge -->
                    <div class="badge badge-dark card-badge card-badge-left text-uppercase letter-spacing-lg">
                        Sale
                    </div>

                    <!-- Image -->
                    <div class="card-img" data-flickity='{"draggable": false}' id="productSixImg">
                        <a class="d-block w-100" href="https://yevgenysim.github.io/shopper/product.html">
                            <img class="card-img-top" src="assets/img/products/product-10.jpg" alt="..." />
                        </a>
                        <a class="d-block w-100" href="https://yevgenysim.github.io/shopper/product.html">
                            <img class="card-img-top" src="assets/img/products/product-144.jpg" alt="..." />
                        </a>
                    </div>

                    <!-- Collapse -->
                    <div class="card-collapse-parent">

                        <!-- Body -->
                        <div class="card-body px-0 pb-0 bg-white">
                            <div class="row no-gutters">
                                <div class="col">

                                    <!-- Title -->
                                    <a class="d-block font-weight-bold text-body" href="https://yevgenysim.github.io/shopper/product.html">
                                        Suede cross body Bag
                                    </a>

                                    <!-- Category -->
                                    <a class="font-size-xs text-muted" href="shop.html">
                                        Bags
                                    </a>

                                </div>
                                <div class="col-auto">

                                    <!-- Price -->
                                    <div class="font-size-xs font-weight-bold text-gray-350 text-decoration-line-through">
                                        $79.00
                                    </div>
                                    <div class="font-size-sm font-weight-bold text-primary">
                                        $49.00
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-collapse collapse">
                            <div class="card-footer px-0 bg-white">
                                <form>
                                    <div class="mb-1">
                                        <div class="custom-control custom-control-inline custom-control-color">
                                            <input type="radio" id="productSixColorOne" name="productSixColor" class="custom-control-input" checked />
                                            <label class="custom-control-label" data-toggle="flickity" data-target="#productSixImg" data-slide="0" style="color: beige;" for="productSixColorOne"></label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-color ml-n2">
                                            <input type="radio" id="productSixColorTwo" name="productSixColor" class="custom-control-input" />
                                            <label class="custom-control-label" data-toggle="flickity" data-target="#productSixImg" data-slide="1" style="color: black;" for="productSixColorTwo"></label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productSixSizeOne" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productSixSizeOne">6</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productSixSizeTwo" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productSixSizeTwo">6.5</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productSixSizeThree" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productSixSizeThree">7</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productSixSizeFour" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productSixSizeFour">7.5</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productSixSizeFive" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productSixSizeFive">8.5</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">

                <!-- Card -->
                <div class="card mb-7" data-toggle="card-collapse">

                    <!-- Image -->
                    <img class="card-img-top" src="assets/img/products/product-11.jpg" alt="..." />

                    <!-- Collapse -->
                    <div class="card-collapse-parent">

                        <!-- Body -->
                        <div class="card-body px-0 pb-0 bg-white">
                            <div class="row no-gutters">
                                <div class="col">

                                    <!-- Title -->
                                    <a class="d-block font-weight-bold text-body" href="https://yevgenysim.github.io/shopper/product.html">
                                        Printed A-line Skirt
                                    </a>

                                    <!-- Category -->
                                    <a class="font-size-xs text-muted" href="shop.html">
                                        Skirts
                                    </a>

                                </div>
                                <div class="col-auto">

                                    <!-- Price -->
                                    <div class="font-size-sm font-weight-bold text-muted">
                                        $79.00
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-collapse collapse">
                            <div class="card-footer px-0 bg-white">
                                <form>
                                    <div class="mb-1">
                                        <div class="custom-control custom-control-inline custom-control-color">
                                            <input type="radio" id="productSevenColorOne" name="productSevenColor" class="custom-control-input" checked />
                                            <label class="custom-control-label" style="color: black;" for="productSevenColorOne"></label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productSevenSizeOne" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productSevenSizeOne">6</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productSevenSizeTwo" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productSevenSizeTwo">6.5</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productSevenSizeThree" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productSevenSizeThree">7</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productSevenSizeFour" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productSevenSizeFour">7.5</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productSevenSizeFive" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productSevenSizeFive">8.5</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">

                <!-- Card -->
                <div class="card mb-7" data-toggle="card-collapse">

                    <!-- Badge -->
                    <div class="badge badge-white card-badge card-badge-left text-uppercase">
                        New
                    </div>

                    <!-- Image -->
                    <div class="card-img" data-flickity='{"draggable": false}' id="productEightImg">
                        <a class="d-block w-100" href="https://yevgenysim.github.io/shopper/product.html">
                            <img class="card-img-top" src="assets/img/products/product-12.jpg" alt="..." />
                        </a>
                        <a class="d-block w-100" href="https://yevgenysim.github.io/shopper/product.html">
                            <img class="card-img-top" src="assets/img/products/product-145.jpg" alt="..." />
                        </a>
                    </div>

                    <!-- Collapse -->
                    <div class="card-collapse-parent">

                        <!-- Body -->
                        <div class="card-body px-0 pb-0 bg-white">
                            <div class="row no-gutters">
                                <div class="col">

                                    <!-- Title -->
                                    <a class="d-block font-weight-bold text-body" href="https://yevgenysim.github.io/shopper/product.html">
                                        Heel strappy Sandals
                                    </a>

                                    <!-- Category -->
                                    <a class="font-size-xs text-muted" href="shop.html">
                                        Shoes
                                    </a>

                                </div>
                                <div class="col-auto">

                                    <!-- Price -->
                                    <div class="font-size-sm font-weight-bold text-muted">
                                        $90.00
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-collapse collapse">
                            <div class="card-footer px-0 bg-white">
                                <form>
                                    <div class="mb-1">
                                        <div class="custom-control custom-control-inline custom-control-color">
                                            <input type="radio" id="productEightColorOne" name="productEightColor" class="custom-control-input" checked />
                                            <label class="custom-control-label" data-toggle="flickity" data-target="#productEightImg" data-slide="0" style="color: black;" for="productEightColorOne"></label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-color ml-n2">
                                            <input type="radio" id="productEightColorTwo" name="productEightColor" class="custom-control-input" />
                                            <label class="custom-control-label" data-toggle="flickity" data-target="#productEightImg" data-slide="1" style="color: red;" for="productEightColorTwo"></label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productEightSizeOne" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productEightSizeOne">6</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productEightSizeTwo" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productEightSizeTwo">6.5</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productEightSizeThree" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productEightSizeThree">7</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productEightSizeFour" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productEightSizeFour">7.5</label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-text font-size-xs">
                                            <input type="radio" id="productEightSizeFive" name="sizeRadio" class="custom-control-input" />
                                            <label class="custom-control-label" for="productEightSizeFive">8.5</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12">

                <!-- Link  -->
                <div class="mt-7 text-center">
                    <a class="link-underline" href="shop.html">Discover more</a>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- MUST HAVES -->
<section class="bg-light overflow-hidden">
    <div class="container">
        <div class="row no-gutters justify-content-between">
            <div class="col-12 col-md-5 col-lg-4 py-13">

                <!-- Pretitle -->
                <h6 class="heading-xxs text-gray-400">
                    Summer trends
                </h6>

                <!-- Heading -->
                <h1 class="mb-4">Our must haves</h1>

                <!-- Text -->
                <p class="text-gray-500 mb-8">
                    Male his our upon seed had said wherein their
                    i great wherein under you'll deep first multiply.
                    Fish waters they're herb shall saying.
                </p>

                <!-- Button -->
                <a class="btn btn-dark" href="shop.html">
                    Shop Now <i class="fe fe-arrow-right ml-2"></i>
                </a>

            </div>
            <div class="col-12 col-md-6">

                <!-- Image -->
                <div class="h-100 vw-50 bg-cover" style="background-image: url(assets/img/covers/cover-10.jpg);"></div>

            </div>
        </div>
    </div>
</section>

<!-- NEW COLLECTION -->
<section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-4">

                <!-- Image -->
                <img src="assets/img/products/product-38.jpg" alt="..." class="img-fluid my-12">

            </div>
            <div class="col-12 col-md-4 text-center">

                <!-- Heading -->
                <h2 class="mb-4">
                    New 2019 Summer collection
                </h2>

                <!-- Text -->
                <p class="mb-7 text-gray-500">
                    Appear, dry there darkness they're seas, dry
                    waters thing fly midst. Beast, above fly
                    brought Very green.
                </p>

                <!-- Link  -->
                <a class="link-underline" href="shop.html">Discover more</a>

            </div>
            <div class="col-12 col-md-4">

                <!-- Video -->
                <div class="position-relative">

                    <!-- Poster -->
                    <img src="assets/img/products/product-39.jpg" alt="..." class="img-fluid my-12">

                    <!-- Button -->
                    <a class="btn btn-lg btn-circle btn-white btn-hover center" data-fancybox href="https://www.youtube.com/watch?v=BGrY85i-skk">
                        <i class="fas fa-play"></i>
                    </a>

                </div>

            </div>
        </div>
    </div>
</section>

<!-- BRAND -->
<section class="py-12 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- Heading -->
                <h2 class="mb-10 text-center">
                    Shop by Brand
                </h2>

            </div>
        </div>
        <div class="row">
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="shop.html">
                    <img class="brand-img" src="assets/img/brands/gray-350/mango.svg" alt="...">
                </a>

            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="shop.html">
                    <img class="brand-img" src="assets/img/brands/gray-350/zara.svg" alt="...">
                </a>

            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="shop.html">
                    <img class="brand-img" src="assets/img/brands/gray-350/reebok.svg" alt="...">
                </a>

            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="shop.html">
                    <img class="brand-img" src="assets/img/brands/gray-350/asos.svg" alt="...">
                </a>

            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="shop.html">
                    <img class="brand-img" src="assets/img/brands/gray-350/stradivarius.svg" alt="...">
                </a>

            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="shop.html">
                    <img class="brand-img" src="assets/img/brands/gray-350/adidas.svg" alt="...">
                </a>

            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="shop.html">
                    <img class="brand-img" src="assets/img/brands/gray-350/bershka.svg" alt="...">
                </a>

            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="shop.html">
                    <img class="brand-img" src="assets/img/brands/gray-350/forever21.svg" alt="...">
                </a>

            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="shop.html">
                    <img class="brand-img" src="assets/img/brands/gray-350/esprit.svg" alt="...">
                </a>

            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="shop.html">
                    <img class="brand-img" src="assets/img/brands/gray-350/converse.svg" alt="...">
                </a>

            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="shop.html">
                    <img class="brand-img" src="assets/img/brands/gray-350/calvin-klein.svg" alt="...">
                </a>

            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="index-fashion.html#!">
                    <img class="brand-img" src="assets/img/brands/gray-350/joop.svg" alt="...">
                </a>

            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="index-fashion.html#!">
                    <img class="brand-img" src="assets/img/brands/gray-350/h&amp;m.svg" alt="...">
                </a>

            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="index-fashion.html#!">
                    <img class="brand-img" src="assets/img/brands/gray-350/only.svg" alt="...">
                </a>

            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="index-fashion.html#!">
                    <img class="brand-img" src="assets/img/brands/gray-350/guess.svg" alt="...">
                </a>

            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="index-fashion.html#!">
                    <img class="brand-img" src="assets/img/brands/gray-350/river-island.svg" alt="...">
                </a>

            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="index-fashion.html#!">
                    <img class="brand-img" src="assets/img/brands/gray-350/victorias-secret.svg" alt="...">
                </a>

            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">

                <!-- Brand -->
                <a class="brand lift mb-7 text-center" href="index-fashion.html#!">
                    <img class="brand-img" src="assets/img/brands/gray-350/topshop.svg" alt="...">
                </a>

            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">

                <!-- Link  -->
                <div class="mt-10 text-center">
                    <a class="link-underline" href="shop.html">Discover more</a>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- NEW ARRIVAL -->
<section>
    <div class="container py-12 border-bottom">
        <div class="row">
            <div class="col-12">

                <!-- Heading -->
                <h2 class="mb-10 text-center">New Arrivals</h2>

                <!-- Slider-->
                <div class="flickity-buttons-lg flickity-buttons-offset px-lg-12" data-flickity='{"prevNextButtons": true}'>

                    <!-- Card -->
                    <div class="card col-12 col-md-4 mb-10">

                        <!-- Image -->
                        <a href="https://yevgenysim.github.io/shopper/product.html">
                            <img class="card-img-top" src="assets/img/products/product-26.jpg" alt="...">
                        </a>

                        <!-- Body -->
                        <div class="card-body px-0">
                            <div class="d-flex">

                                <!-- Caption -->
                                <div class="mr-auto">

                                    <!-- Heading -->
                                    <div class="font-weight-bold">
                                        <a class="text-body" href="https://yevgenysim.github.io/shopper/product.html">Striped knit Top</a>
                                    </div>

                                    <!-- Text -->
                                    <div class="font-size-sm">
                                        <a class="text-muted" href="shop.html">Tops</a>
                                    </div>

                                </div>

                                <!-- Price -->
                                <div class="font-size-sm font-weight-bold text-muted">
                                    $39.00
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- Card -->
                    <div class="card col-12 col-md-4 mb-10">

                        <!-- Image -->
                        <a href="https://yevgenysim.github.io/shopper/product.html">
                            <img class="card-img-top" src="assets/img/products/product-25.jpg" alt="...">
                        </a>

                        <!-- Body -->
                        <div class="card-body px-0">
                            <div class="d-flex">

                                <!-- Caption -->
                                <div class="mr-auto">

                                    <!-- Heading -->
                                    <div class="font-weight-bold">
                                        <a class="text-body" href="https://yevgenysim.github.io/shopper/product.html">Floral print Dress</a>
                                    </div>

                                    <!-- Text -->
                                    <div class="font-size-sm">
                                        <a class="text-muted" href="shop.html">Dress</a>
                                    </div>

                                </div>

                                <!-- Price -->
                                <div class="font-size-sm font-weight-bold text-muted">
                                    $60.00
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- Card -->
                    <div class="card col-12 col-md-4 mb-10">

                        <!-- Image -->
                        <a href="https://yevgenysim.github.io/shopper/product.html">
                            <img class="card-img-top" src="assets/img/products/product-28.jpg" alt="...">
                        </a>

                        <!-- Body -->
                        <div class="card-body px-0">
                            <div class="d-flex">

                                <!-- Caption -->
                                <div class="mr-auto">

                                    <!-- Heading -->
                                    <div class="font-weight-bold">
                                        <a class="text-body" href="https://yevgenysim.github.io/shopper/product.html">Straight Trousers with Belt</a>
                                    </div>

                                    <!-- Text -->
                                    <div class="font-size-sm">
                                        <a class="text-muted" href="shop.html">Trousers</a>
                                    </div>

                                </div>

                                <!-- Price -->
                                <div class="font-size-sm font-weight-bold text-muted">
                                    $79.00
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- Card -->
                    <div class="card col-12 col-md-4 mb-10">

                        <!-- Image -->
                        <a href="https://yevgenysim.github.io/shopper/product.html">
                            <img class="card-img-top" src="assets/img/products/product-27.jpg" alt="...">
                        </a>

                        <!-- Body -->
                        <div class="card-body px-0">
                            <div class="d-flex">

                                <!-- Caption -->
                                <div class="mr-auto">

                                    <!-- Heading -->
                                    <div class="font-weight-bold">
                                        <a class="text-body" href="https://yevgenysim.github.io/shopper/product.html">Fine quality jeans</a>
                                    </div>

                                    <!-- Text -->
                                    <div class="font-size-sm text-muted">
                                        <a class="text-muted" href="shop.html">Trousers</a>
                                    </div>

                                </div>

                                <!-- Price -->
                                <div class="font-size-sm font-weight-bold text-muted">
                                    $69.00
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <!-- Button -->
                <div class="text-center">
                    <a class="btn btn-dark" href="shop.html">
                        Shop Now <i class="fe fe-arrow-right ml-2"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- NEWSLETTER -->
<section class="py-12">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">

                <!-- Heading -->
                <h3>
                    Subscribe to our Newsletter
                </h3>

                <!-- Subheading -->
                <p class="mb-7 font-size-lg text-gray-500">
                    Receive an exclusive 10% discount code when you signup.
                </p>

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">

                <!-- Form -->
                <form>
                    <div class="input-group">

                        <!-- Input -->
                        <input class="form-control form-control-underline form-control-sm border-dark" type="email" placeholder="Enter Email *">

                        <!-- Button -->
                        <div class="input-group-append">
                            <button class="btn btn-underline btn-sm border-dark" type="button">Subscribe</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<!-- INSTASHOP -->
<section class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="row h-100">
                    <div class="col-6 bg-cover" style="background-image: url(assets/img/products/product-16.jpg);"></div>
                    <div class="col-6 bg-cover" style="background-image: url(assets/img/products/product-40.jpg);"></div>
                    <div class="col-6 bg-cover" style="background-image: url(assets/img/products/product-41.jpg);"></div>
                    <div class="col-6 bg-cover" style="background-image: url(assets/img/products/product-17.jpg);"></div>
                </div>
            </div>
            <div class="col-12 col-lg-4 py-12 px-9 text-center">

                <!-- Icon -->
                <i class="fe fe-instagram h3 mb-6"></i>

                <!-- Heading -->
                <h2 class="mb-6">Instashop</h2>

                <!-- Text -->
                <p class="mb-8 font-size-lg text-muted">
                    Appear, dry there darkness they're seas, dry
                    waters thing fly midst. Beast, above fly
                    brought Very green.
                </p>

                <!-- Link -->
                <a href="index-fashion.html#!" class="link-underline">Go to Instagram</a>

            </div>
            <div class="col-12 col-lg-4">
                <div class="row h-100">
                    <div class="col-6 bg-cover" style="background-image: url(assets/img/products/product-42.jpg);"></div>
                    <div class="col-6 bg-cover" style="background-image: url(assets/img/products/product-21.jpg);"></div>
                    <div class="col-6 bg-cover" style="background-image: url(assets/img/products/product-18.jpg);"></div>
                    <div class="col-6 bg-cover" style="background-image: url(assets/img/products/product-43.jpg);"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="py-9">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">

                <!-- Item -->
                <div class="d-flex mb-6 mb-lg-0">

                    <!-- Icon -->
                    <i class="fe fe-truck font-size-lg text-primary"></i>

                    <!-- Body -->
                    <div class="ml-6">

                        <!-- Heading -->
                        <h6 class="heading-xxs mb-1">
                            Free shipping
                        </h6>

                        <!-- Text -->
                        <p class="mb-0 font-size-sm text-muted">
                            From all orders over $100
                        </p>

                    </div>

                </div>

            </div>
            <div class="col-12 col-md-6 col-lg-3">

                <!-- Item -->
                <div class="d-flex mb-6 mb-lg-0">

                    <!-- Icon -->
                    <i class="fe fe-repeat font-size-lg text-primary"></i>

                    <!-- Body -->
                    <div class="ml-6">

                        <!-- Heading -->
                        <h6 class="mb-1 heading-xxs">
                            Free returns
                        </h6>

                        <!-- Text -->
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
@push('styles')

@endpush

@push('scripts')

@endpush
