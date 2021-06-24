@extends('catalog.index')

@section('content')
    <section class="py-11">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">

                    <!-- Filters -->
                    <form class="mb-10 mb-md-0">
                        <ul class="nav nav-vertical" id="filterNav">
                            <li class="nav-item">

                                <!-- Toggle -->
                                <a class="nav-link dropdown-toggle font-size-lg text-reset border-bottom mb-6"
                                   data-toggle="collapse" href="shop.html#categoryCollapse">
                                    Category
                                </a>

                                <!-- Collapse -->
                                <div class="collapse show" id="categoryCollapse">
                                    <div class="form-group">
                                        <ul class="list-styled mb-0" id="productsNav">
                                            <li class="list-styled-item">
                                                <a class="list-styled-link" href="shop.html#">
                                                    All Products
                                                </a>
                                            </li>
                                            <li class="list-styled-item">

                                                <!-- Toggle -->
                                                <a class="list-styled-link" data-toggle="collapse"
                                                   href="shop.html#blousesCollapse">
                                                    Blouses and Shirts
                                                </a>

                                                <!-- Collapse -->
                                                <div class="collapse" id="blousesCollapse" data-parent="#productsNav">
                                                    <div class="py-4 pl-5">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="blousesOne"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="blousesOne">
                                                                Women Tops, Tees & Blouses
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="blousesTwo"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="blousesTwo">
                                                                Petite
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="blousesThree"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="blousesThree">
                                                                Petite-Size Blouses & Button-Down Shirts
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" id="blousesFour"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="blousesFour">
                                                                Women Plus Tops & Tees
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                            <li class="list-styled-item">

                                                <!-- Toggle -->
                                                <a class="list-styled-link" data-toggle="collapse"
                                                   href="shop.html#coatsCollapse">
                                                    Coats and Jackets
                                                </a>

                                                <!-- Collapse -->
                                                <div class="collapse" id="coatsCollapse" data-parent="#productsNav">
                                                    <div class="py-4 pl-5">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="coatsOne"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="coatsOne">
                                                                Coats, Jackets & Vests
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="coatsTwo"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="coatsTwo">
                                                                Down Jackets & Parkas
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" id="coatsThree"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="coatsThree">
                                                                Wool & Pea Coats Plus-Size
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                            <li class="list-styled-item">

                                                <!-- Toggle -->
                                                <a class="list-styled-link" data-toggle="collapse"
                                                   href="shop.html#dressesCollapse" aria-expanded="true">
                                                    Dresses
                                                </a>

                                                <!-- Collapse -->
                                                <div class="collapse show" id="dressesCollapse"
                                                     data-parent="#productsNav">
                                                    <div class="py-4 pl-5">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="dressesOne"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="dressesOne">
                                                                A-line Dresses
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="dressesTwo"
                                                                   type="checkbox" checked>
                                                            <label class="custom-control-label" for="dressesTwo">
                                                                Shift Dresses
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="dressesThree"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="dressesThree">
                                                                Wrap Dresses
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" id="dressesFour"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="dressesFour">
                                                                Maxi Dresses
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                            <li class="list-styled-item">

                                                <!-- Toggle -->
                                                <a class="list-styled-link" data-toggle="collapse"
                                                   href="shop.html#hoodiesCollapse">
                                                    Hoodies and Sweats
                                                </a>

                                                <!-- Collapse -->
                                                <div class="collapse" id="hoodiesCollapse" data-parent="#productsNav">
                                                    <div class="py-4 pl-5">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="hoodiesOne"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="hoodiesOne">
                                                                Activewear
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="hoodiesTwo"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="hoodiesTwo">
                                                                Fashion Hoodies & Sweatshirts
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="hoodiesThree"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="hoodiesThree">
                                                                Big & Tall Sweatshirts
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" id="hoodiesFour"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="hoodiesFour">
                                                                Big & Tall Fashion Hoodies
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                            <li class="list-styled-item">

                                                <!-- Toggle -->
                                                <a class="list-styled-link" data-toggle="collapse"
                                                   href="shop.html#denimCollapse">
                                                    Denim
                                                </a>

                                                <!-- Collapse -->
                                                <div class="collapse" id="denimCollapse" data-parent="#productsNav">
                                                    <div class="py-4 pl-5">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="denimOne"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="denimOne">
                                                                Women Shorts
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="denimTwo"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="denimTwo">
                                                                Juniors' Shorts
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="denimThree"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="denimThree">
                                                                Petite
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" id="denimFour"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="denimFour">
                                                                Women Plus Shorts
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                            <li class="list-styled-item">

                                                <!-- Toggle -->
                                                <a class="list-styled-link" data-toggle="collapse"
                                                   href="shop.html#jeansCollapse">
                                                    Jeans
                                                </a>

                                                <!-- Collapse -->
                                                <div class="collapse" id="jeansCollapse" data-parent="#productsNav">
                                                    <div class="py-4 pl-5">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="jeansOne"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="jeansOne">
                                                                Men Jeans
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="jeansTwo"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="jeansTwo">
                                                                Men Big & Tall Jeans
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="jeansThree"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="jeansThree">
                                                                Surf, Skate & Street Clothing
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" id="jeansFour"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="jeansFour">
                                                                Men Big & Tall Pants
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                            <li class="list-styled-item">

                                                <!-- Toggle -->
                                                <a class="list-styled-link" data-toggle="collapse"
                                                   href="shop.html#jumpersCollapse">
                                                    Jumpers and Cardigans
                                                </a>

                                                <!-- Collapse -->
                                                <div class="collapse" id="jumpersCollapse" data-parent="#productsNav">
                                                    <div class="py-4 pl-5">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="jumpersOne"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="jumpersOne">
                                                                Sweaters Plus-Size
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="jumpersTwo"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="jumpersTwo">
                                                                Plus Sweaters
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="jumpersThree"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="jumpersThree">
                                                                Petite Cardigans
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" id="jumpersFour"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="jumpersFour">
                                                                Tops, Tees & Blouses
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                            <li class="list-styled-item">

                                                <!-- Toggle -->
                                                <a class="list-styled-link" data-toggle="collapse"
                                                   href="shop.html#legginsCollapse">
                                                    Leggings
                                                </a>

                                                <!-- Collapse -->
                                                <div class="collapse" id="legginsCollapse" data-parent="#productsNav">
                                                    <div class="py-4 pl-5">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="legginsOne"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="legginsOne">
                                                                Novelty Leggings
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="legginsTwo"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="legginsTwo">
                                                                Novelty Pants & Capris
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input class="custom-control-input" id="legginsThree"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="legginsThree">
                                                                Women Yoga Leggings
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" id="legginsFour"
                                                                   type="checkbox">
                                                            <label class="custom-control-label" for="legginsFour">
                                                                Workout & Training Leggings
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </li>
                            <li class="nav-item">

                                <!-- Toggle -->
                                <a class="nav-link dropdown-toggle font-size-lg text-reset border-bottom mb-6"
                                   data-toggle="collapse" href="shop.html#seasonCollapse">
                                    Season
                                </a>

                                <!-- Collapse -->
                                <div class="collapse" id="seasonCollapse" data-toggle="simplebar"
                                     data-target="#seasonGroup">
                                    <div class="form-group form-group-overflow mb-6" id="seasonGroup">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" id="seasonOne" type="checkbox" checked>
                                            <label class="custom-control-label" for="seasonOne">
                                                Summer
                                            </label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" id="seasonTwo" type="checkbox">
                                            <label class="custom-control-label" for="seasonTwo">
                                                Winter
                                            </label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="seasonThree" type="checkbox">
                                            <label class="custom-control-label" for="seasonThree">
                                                Spring & Autumn
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <li class="nav-item">

                                <!-- Toggle -->
                                <a class="nav-link dropdown-toggle font-size-lg text-reset border-bottom mb-6"
                                   data-toggle="collapse" href="shop.html#sizeCollapse">
                                    Size
                                </a>

                                <!-- Collapse -->
                                <div class="collapse" id="sizeCollapse" data-toggle="simplebar"
                                     data-target="#sizeGroup">
                                    <div class="form-group form-group-overlow mb-6" id="sizeGroup">
                                        <div class="custom-control custom-control-inline custom-control-size mb-2">
                                            <input class="custom-control-input" id="sizeOne" type="checkbox">
                                            <label class="custom-control-label" for="sizeOne">
                                                3XS
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-size mb-2">
                                            <input class="custom-control-input" id="sizeTwo" type="checkbox" disabled>
                                            <label class="custom-control-label" for="sizeTwo">
                                                2XS
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-size mb-2">
                                            <input class="custom-control-input" id="sizeThree" type="checkbox">
                                            <label class="custom-control-label" for="sizeThree">
                                                XS
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-size mb-2">
                                            <input class="custom-control-input" id="sizeFour" type="checkbox">
                                            <label class="custom-control-label" for="sizeFour">
                                                S
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-size mb-2">
                                            <input class="custom-control-input" id="sizeFive" type="checkbox" checked>
                                            <label class="custom-control-label" for="sizeFive">
                                                M
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-size mb-2">
                                            <input class="custom-control-input" id="sizeSix" type="checkbox">
                                            <label class="custom-control-label" for="sizeSix">
                                                L
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-size mb-2">
                                            <input class="custom-control-input" id="sizeSeven" type="checkbox">
                                            <label class="custom-control-label" for="sizeSeven">
                                                XL
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-size mb-2">
                                            <input class="custom-control-input" id="sizeEight" type="checkbox" disabled>
                                            <label class="custom-control-label" for="sizeEight">
                                                2XL
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-size mb-2">
                                            <input class="custom-control-input" id="sizeNine" type="checkbox">
                                            <label class="custom-control-label" for="sizeNine">
                                                3XL
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-size mb-2">
                                            <input class="custom-control-input" id="sizeTen" type="checkbox">
                                            <label class="custom-control-label" for="sizeTen">
                                                4XL
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-inline custom-control-size mb-2">
                                            <input class="custom-control-input" id="sizeEleven" type="checkbox">
                                            <label class="custom-control-label" for="sizeEleven">
                                                One Size
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <li class="nav-item">

                                <!-- Toggle -->
                                <a class="nav-link dropdown-toggle font-size-lg text-reset border-bottom mb-6"
                                   data-toggle="collapse" href="shop.html#colorCollapse">
                                    Color
                                </a>

                                <!-- Collapse -->
                                <div class="collapse" id="colorCollapse" data-toggle="simplebar"
                                     data-target="#colorGroup">
                                    <div class="form-group form-group-overflow mb-6" id="colorGroup">
                                        <div class="custom-control custom-control-color mb-3">
                                            <input class="custom-control-input" id="colorOne" type="checkbox">
                                            <label class="custom-control-label text-dark" for="colorOne">
                                                <span class="text-body">Black</span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-color mb-3">
                                            <input class="custom-control-input" id="colorTwo" type="checkbox" checked>
                                            <label class="custom-control-label" style="color: #f9f9f9;" for="colorTwo">
                                                <span class="text-body">White</span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-color mb-3">
                                            <input class="custom-control-input" id="colorThree" type="checkbox">
                                            <label class="custom-control-label text-info" for="colorThree">
                                                <span class="text-body">Blue</span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-color mb-3">
                                            <input class="custom-control-input" id="colorFour" type="checkbox">
                                            <label class="custom-control-label text-primary" for="colorFour">
                                                <span class="text-body">Red</span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-color mb-3">
                                            <input class="custom-control-input" id="colorFive" type="checkbox" disabled>
                                            <label class="custom-control-label" for="colorFive" style="color: #795548">
                                                <span class="text-body">Brown</span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-color mb-3">
                                            <input class="custom-control-input" id="colorSix" type="checkbox">
                                            <label class="custom-control-label text-gray-300" for="colorSix">
                                                <span class="text-body">Gray</span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-color mb-3">
                                            <input class="custom-control-input" id="colorSeven" type="checkbox">
                                            <label class="custom-control-label" for="colorSeven"
                                                   style="color: #17a2b8;">
                                                <span class="text-body">Cyan</span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-color">
                                            <input class="custom-control-input" id="colorEight" type="checkbox">
                                            <label class="custom-control-label" for="colorEight"
                                                   style="color: #e83e8c;">
                                                <span class="text-body">Pink</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <li class="nav-item">

                                <!-- Toggle -->
                                <a class="nav-link dropdown-toggle font-size-lg text-reset border-bottom mb-6"
                                   data-toggle="collapse" href="shop.html#brandCollapse">
                                    Brand
                                </a>

                                <!-- Collapse -->
                                <div class="collapse" id="brandCollapse" data-toggle="simplebar"
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

                                        <!-- Form group -->
                                        <div class="form-group form-group-overflow mb-6" id="brandGroup">
                                            <div class="list">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input class="custom-control-input" id="brandOne" type="checkbox">
                                                    <label class="custom-control-label name" for="brandOne">
                                                        Dsquared2
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input class="custom-control-input" id="brandTwo" type="checkbox"
                                                           disabled>
                                                    <label class="custom-control-label name" for="brandTwo">
                                                        Alexander McQueen
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input class="custom-control-input" id="brandThree" type="checkbox">
                                                    <label class="custom-control-label name" for="brandThree">
                                                        Balenciaga
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input class="custom-control-input" id="brandFour" type="checkbox"
                                                           checked>
                                                    <label class="custom-control-label name" for="brandFour">
                                                        Adidas
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input class="custom-control-input" id="brandFive" type="checkbox">
                                                    <label class="custom-control-label name" for="brandFive">
                                                        Balmain
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input class="custom-control-input" id="brandSix" type="checkbox">
                                                    <label class="custom-control-label name" for="brandSix">
                                                        Burberry
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input class="custom-control-input" id="brandSeven" type="checkbox">
                                                    <label class="custom-control-label name" for="brandSeven">
                                                        Chloé
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input class="custom-control-input" id="brandEight" type="checkbox">
                                                    <label class="custom-control-label name" for="brandEight">
                                                        Kenzo
                                                    </label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="brandNine" type="checkbox">
                                                    <label class="custom-control-label name" for="brandNine">
                                                        Givenchy
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </li>
                            <li class="nav-item">

                                <!-- Toggle -->
                                <a class="nav-link dropdown-toggle font-size-lg text-reset border-bottom mb-6"
                                   data-toggle="collapse" href="shop.html#priceCollapse">
                                    Price
                                </a>

                                <!-- Collapse -->
                                <div class="collapse" id="priceCollapse" data-toggle="simplebar"
                                     data-target="#priceGroup">

                                    <!-- Form group-->
                                    <div class="form-group form-group-overflow mb-6" id="priceGroup">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" id="priceOne" type="checkbox" checked>
                                            <label class="custom-control-label" for="priceOne">
                                                $10.00 - $49.00
                                            </label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" id="priceTwo" type="checkbox" checked>
                                            <label class="custom-control-label" for="priceTwo">
                                                $50.00 - $99.00
                                            </label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" id="priceThree" type="checkbox">
                                            <label class="custom-control-label" for="priceThree">
                                                $100.00 - $199.00
                                            </label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="priceFour" type="checkbox">
                                            <label class="custom-control-label" for="priceFour">
                                                $200.00 and Up
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Range -->
                                    <div class="d-flex align-items-center">

                                        <!-- Input -->
                                        <input type="number" class="form-control form-control-xs" placeholder="$10.00"
                                               min="10">

                                        <!-- Divider -->
                                        <div class="text-gray-350 mx-2">‒</div>

                                        <!-- Input -->
                                        <input type="number" class="form-control form-control-xs" placeholder="$350.00"
                                               max="350">

                                    </div>

                                </div>

                            </li>
                        </ul>
                    </form>

                </div>
                <div class="col-12 col-md-8 col-lg-9">

                    <!-- Slider -->
{{--                @include('catalog.master.catalog_slider')--}}

                <!-- Header -->
                    <div class="row align-items-center mb-7">
                        <div class="col-12 col-md">

                            <!-- Heading -->
                            <h3 class="mb-1">{{ $category->name }}</h3>

                            <!-- Breadcrumb -->
                            <ol class="breadcrumb mb-md-0 font-size-xs text-gray-400">
                                <li class="breadcrumb-item">
                                    <a class="text-gray-400" href="index.html">Главная</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    {{ $category->name }}
                                </li>
                            </ol>

                        </div>
                        <div class="col-12 col-md-auto">
                            <!-- Select -->
                            <select class="custom-select custom-select-xs">
                                <option selected>Most popular</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="row mb-7">
                        <div class="col-12">
                            <span class="btn btn-xs btn-light font-weight-normal text-muted mr-3 mb-3">
                              Shift dresses <a class="text-reset ml-2" href="shop.html#!" role="button">
                                <i class="fe fe-x"></i></a>
                            </span>
                        </div>
                    </div>

                    <!-- Products -->
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <!-- Card -->
                            @include('catalog.master.catalog_card')
                        </div>
                    </div>

                    <!-- Pagination -->
                    <nav class="d-flex justify-content-center justify-content-md-end">
                        <ul class="pagination pagination-sm text-gray-400">
                            <li class="page-item">
                                <a class="page-link page-link-arrow" href="shop.html#">
                                    <i class="fa fa-caret-left"></i>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="shop.html#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="shop.html#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="shop.html#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="shop.html#">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="shop.html#">5</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="shop.html#">6</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link page-link-arrow" href="shop.html#">
                                    <i class="fa fa-caret-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </section>
@endsection
