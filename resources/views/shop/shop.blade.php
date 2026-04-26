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
                    <div class="product-filters category-filters">
                        <ul>
                            <li class="active" data-filter="*">{{ trans('general.all') }}</li>
                            @foreach ($categories as $category)
                                <li data-filter=".cat-{{ $category->id }}" data-category-id="{{ $category->id }}">{{ $category->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row" id="subcategory-filters-row" style="display: none;">
                <div class="col-md-12">
                    <div class="product-filters subcategory-filters">
                        <ul id="subcategory-filters-list">
                            <li class="active" data-filter="*">{{ trans('general.all') }}</li>
                            @foreach ($categories as $category)
                                @foreach ($category->subcategories as $sub)
                                    <li class="sub-item cat-{{ $category->id }}" data-filter=".sub-{{ $sub->id }}" style="display: none;">{{ $sub->name }}</li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row product-lists">
                @foreach ($categories as $category)
                    @foreach ($category->subcategories as $sub)
                        @foreach ($sub->products as $item)
                            <div class="col-lg-4 col-md-6 text-center cat-{{ $category->id }} sub-{{ $sub->id }} product-item">
                                <div class="single-product-item">
                                    <div class="product-image">
                                        <a href="{{ route('customer.product.show', $item->slug) }}">
                                            <img src="{{ asset($item->imagepath) }}" alt="">
                                        </a>
                                    </div>
                                    <h3><a href="{{ route('customer.product.show', $item->slug) }}">{{ $item->name }}</a></h3>
                                    <p class="product-price"><span></span><br>{{$item->price}}</del> {{ $item->price_after_discount }}$</p>

                                    @auth
                                        <div class="favorite-icon">
                                            <i id="heart-{{ $item->id }}"
                                                class="fa fa-heart {{ $item->favoritedBy->contains(auth()->id()) ? 'active' : '' }}"
                                                onclick="toggleFavorite({{ $item->id }})"
                                                style="cursor: pointer; color: {{ $item->isFavoritedByUser ? 'red' : 'gray' }};">
                                            </i>
                                        </div>
                                    @endauth

                                    <a href="{{ route('customer.cart.index') }}" class="cart-btn"
                                       onclick="event.preventDefault(); document.getElementById('add-product-to-cart-{{ $item->id }}').submit();">
                                        <form id="add-product-to-cart-{{ $item->id }}" action="{{ route('customer.cart.product.add') }}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" value="{{ $item->id }}" name="productid">
                                            <input type="hidden" value="1" name="quantity">
                                        </form>
                                        <i class="fas fa-shopping-cart"></i> {{ trans('products.add_to_cart') }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        <!-- Pagination links for the products in the current subcategory -->

                        @endforeach
                        @endforeach
                    </div>



                    <div class="row">
                        {{-- <div class="col-lg-12 text-center">
                            {{ $sub->products->links('pagination::bootstrap-4') }}
                        </div> --}}
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

@section('scripts')
    <script>
        function toggleFavorite(productId) {
            const heart = $(`#heart-${productId}`);

            $.ajax({
                url: `{{ route('customer.favorites.toggle', ':id') }}`.replace(':id', productId),
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    if (!response.success) {
                        heart.toggleClass('active');
                        // alert('Operation failed on the server.');
                    }
                },
                error: function(xhr) {
                    heart.toggleClass('active');
                    console.error('Error:', xhr.responseText);
                    alert('An error occurred! Please try again later.');
                },
            });
        }

        $(document).ready(function() {
            // Category filter click
            $(".category-filters li").off('click').on('click', function(e) {
                $(".category-filters li").removeClass("active");
                $(this).addClass("active");

                var categoryId = $(this).attr('data-category-id');
                var selector = $(this).attr('data-filter');

                // Hide all subcategories and reset subcategory filters
                $(".subcategory-filters li").removeClass("active");
                $(".subcategory-filters li[data-filter='*']").addClass("active");
                $(".sub-item").hide();

                if (selector === '*' || !categoryId) {
                    $("#subcategory-filters-row").hide();
                } else {
                    // Show relevant subcategories
                    $(".sub-item.cat-" + categoryId).show();
                    $("#subcategory-filters-row").show();
                }

                // Filter products
                $(".product-lists").isotope({
                    filter: selector
                });
            });

            // Subcategory filter click
            $(".subcategory-filters li").off('click').on('click', function(e) {
                $(".subcategory-filters li").removeClass("active");
                $(this).addClass("active");

                var selector = $(this).attr('data-filter');

                // If "All" subcategories, filter by the active category
                if (selector === '*') {
                    selector = $(".category-filters li.active").attr('data-filter');
                }

                // Filter products
                $(".product-lists").isotope({
                    filter: selector
                });
            });
        });
    </script>
@endsection
