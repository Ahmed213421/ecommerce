@extends('shop.partials.master')

@section('title')
@endsection


@section('content')
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text text-center">
                        <p>{{ trans('shop.fresh') }}</p>
                        <h1>{{ Route::is('customer.category.index') ? trans('category.categories') : trans('shop.shop') }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach ($categories as $category)
                                <li data-filter=".{{ Str::slug($category->name) }}">{{ $category->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row product-lists">
                @foreach ($categories as $category)
                    @foreach ($category->subcategories as $subcategory)
                        @foreach ($subcategory->products as $item)
                            <div class="col-lg-4 col-md-6 text-center {{ Str::slug($category->name) }}">
                                <div class="single-product-item">
                                    <div class="product-image">
                                        <a href="{{route('admin.products.show',$item->slug)}}"><img src="{{asset($item->imagepath)}}"
                                                alt=""></a>
                                    </div>
                                    <h3><a href="{{route('customer.product.show',$item->slug)}}">{{ $item->name }}</a></h3>
                                    <p class="product-  price"><span>{{ trans('shop.per_kg') }}</span>
                                        <br> {{ $item->price }}$
                                    </p>
                                    <p class="product-  price"><span>{{ trans('general.qty') }}</span>
                                        <br> {{ $item->quantity }}
                                    </p>
                                    <div class="favorite-icon">
                                        <i
                                            id="heart-{{ $item->id }}"
                                            class="fa fa-heart {{ $item->isFavoritedByUser ? 'active' : '' }}"
                                            onclick="toggleFavorite({{ $item->id }})"
                                            style="cursor: pointer; color: {{ $item->isFavoritedByUser ? 'red' : 'gray' }};">
                                        </i>
                                    </div>

                                <a href="{{ route('customer.cart.index') }}" class="cart-btn"
                                    onclick="event.preventDefault();
                                        document.getElementById('add-product-to-cart-{{ $item->id }}').submit();">

                                    <form id="add-product-to-cart-{{ $item->id }}"
                                        action="{{ route('customer.cart.product.add') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        <input type="hidden" value="{{ $item->id }}" name="productid">
                                    </form>
                                    <i class="fas fa-shopping-cart"></i> {{ trans('products.add_to_cart') }}
                                </a>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endforeach
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="pagination-wrap">
                        <ul>
                            <li><a href="#">Prev</a></li>
                            <li><a href="#">1</a></li>
                            <li><a class="active" href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end products -->

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
