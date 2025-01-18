@extends('shop.partials.master')
@section('css')
    <style>
        .no-products-message {
            text-align: center;
            color: #555;
            margin-top: 50px;
        }

        .no-products-message h3 {
            font-size: 24px;
            font-weight: bold;
        }

        .no-products-message p {
            font-size: 18px;
            margin: 10px 0;
        }

        .layer {
            position: fixed;
            z-index: 100000;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            overflow: auto;
            background-color: rgba(43, 51, 59, 0.80);
        }

        .flex {
            display: flex;
            display: -webkit-flex;
            align-items: center;
            justify-content: center;
        }

        #image_preview_<a href="https://www.jqueryscript.net/tags.php?/popup/">popup</a>img.hide {
            opacity: 0;
            transform: scale(0);
            transition: all 0.2;
            cursor: zoom-out;
        }

        #image_preview_popup img {
            width: 100%;
            height: auto;
            opacity: 1;
            transform: scale(1);
            transition: all 0.2s;
            cursor: zoom-out;
        }
    </style>
@endsection

@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <p>{{ trans('shop.fresh') }}</p>
                        <h1>{{ trans('products.product') }} {{ $product->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    <!-- single product -->
    <div class="single-product mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="single-product-img product-thumbnails">
                        <img src="{{ asset($product->imagepath) }}" alt="">
                    </div>
                    <!-- Thumbnail Images -->
                    <div class="product-thumbnails mt-3">
                        <div class="row">
                            @foreach ($product->images->take(4) as $image)
                                <!-- Thumbnail Image 1 -->
                                <div class="col-3">
                                    <img src="{{ asset($image->imagepath) }}" alt=""
                                        class="img-fluid product-thumbnail">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="single-product-content {{ app()->getLocale() == 'ar' ? 'text-right' : '' }}">
                        <h3>{{ $product->name }}</h3>
                        <div class="single-product-pricing" style="margin-bottom: 15px;">
                            <span style="font-size: 16px; color: #999; text-decoration: line-through; margin-right: 10px;">
                                ${{ $product->price }}
                            </span>
                            <span style="font-size: 20px; color: #e74c3c; font-weight: bold;">
                                ${{ $product->price_after_discount }}
                            </span>
                        </div>
                        <p>{{ $product->description }}</p>
                        <div class="single-product-form">
                            <div class="d-inline-block">
                                <form id="add-product-to-cart-{{ $product->id }}"
                                    action="{{ route('customer.cart.product.add') }}" method="POST" class="form-inline">

                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="productid">

                                    <input type="number" name="quantity" class="form-control form-control-sm mr-2"
                                        placeholder="Qty" min="1" value="1" style="width: 70px;">

                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-shopping-cart"></i> {{ trans('products.add_to_cart') }}
                                    </button>
                                </form>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <p><strong>{{ trans('category.categories') }}: </strong>
                                <a
                                    href="{{ route('customer.subcategory.show', $product->subcategory->id) }}">{{ $product->subcategory->name }}</a>
                            </p>
                        </div>
                        <h4>{{ trans('general.share') }}:</h4>
                        <ul class="product-share">
                            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href=""><i class="fab fa-twitter"></i></a></li>
                            <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href=""><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end single product -->

    <!-- more products -->
    <div class="more-products mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{ trans('shop.Related') }}</span> {{ trans('products.products') }}</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
                            beatae optio.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="single-product.html"><img src="assets/img/products/product-img-1.jpg"
                                    alt=""></a>
                        </div>
                        <h3>Strawberry</h3>
                        <p class="product-price"><span>Per Kg</span> 85$ </p>
                        <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="single-product.html"><img src="assets/img/products/product-img-2.jpg"
                                    alt=""></a>
                        </div>
                        <h3>Berry</h3>
                        <p class="product-price"><span>Per Kg</span> 70$ </p>
                        <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3 text-center">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="single-product.html"><img src="assets/img/products/product-img-3.jpg"
                                    alt=""></a>
                        </div>
                        <h3>Lemon</h3>
                        <p class="product-price"><span>Per Kg</span> 35$ </p>
                        <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end more products -->

    <!-- logo carousel -->
    <div class="logo-carousel-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo-carousel-inner">
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/1.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/2.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/3.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/4.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/5.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end logo carousel -->
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/jquery-imagepreviewer.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize the imagePreviewer plugin on page load
            $(".product-thumbnails").imagePreviewer({
                scroll: true
            });
        });
    </script>
@endsection
