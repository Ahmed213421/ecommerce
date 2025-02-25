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
    </style>
@endsection

@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>{{ trans('shop.fresh') }}</p>
                        <h1>{{ trans('shop.search_for') }} {{ Request('search') }} </h1>
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
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text"></span> </h3>
                    </div>
                </div>
            </div>

            @if ($no_results)
                <div class="no-results">
                    <p>{{ trans('general.noresult') }}.</p>
                    <form action="{{ route('customer.search') }}" method="GET">
                        <input type="text" name="search" placeholder="Search again..." class="search-input">
                        <button type="submit" class="search-button btn btn-primary">{{ trans('general.search') }}</button>
                    </form>
                </div>
            @endif
            <div class="row">
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        <div class="col-md-4 text-center">
                            <div class="single-product-item">
                                <div class="product-image">
                                    <a href="{{ route('customer.product.show', $product->slug) }}"><img
                                            src="{{ asset($product->imagepath) }}" alt=""></a>
                                </div>
                                <h3><a href="{{ route('customer.product.show', $product->slug) }}">{{ $product->name }}</a>
                                </h3>
                                <p class="product-price"><span>{{ trans('shop.per_kg') }}<br> </span>{{$product->price}}</del> {{ $product->price_after_discount }}$
                                </p>
                                @auth

                                <div class="favorite-icon">
                                    <i id="heart-{{ $product->id }}" class="fa fa-heart {{ $product->favoritedBy->contains(auth()->id()) ? 'active' : '' }}"
                                       onclick="toggleFavorite({{ $product->id }})" style="cursor: pointer;"></i>
                                </div>
                                @endauth
                                <a href="javascript:void(0);" class="cart-btn"
                                    onclick="event.preventDefault();
                                    document.getElementById('add-product-to-cart-{{ $product->id }}').submit();">
                                    <form id="add-product-to-cart-{{ $product->id }}"
                                        action="{{ route('customer.cart.product.add') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        <input type="hidden" value="{{ $product->id }}" name="productid">
                                    </form>
                                    <i class="fas fa-shopping-cart"></i> {{ trans('products.add_to_cart') }}
                                </a>


                            </div>
                        </div>
                    @endforeach
                    @endif


                @if ($categories->count() > 0)
                    @forelse ($categories as $category)
                        <div class="col-md-4 text-center">
                            <div class="single-product-item">
                                <div class="product-image">
                                    <a href="{{ route('customer.category.show', $category->slug) }}"><img
                                            src="{{ asset($category->imagepath) }}" alt=""></a>
                                </div>
                                <h3><a
                                        href="{{ route('customer.category.show', $category->slug) }}">{{ $category->name }}</a>
                                </h3>
                            </div>
                        </div>
                    @endforeach
                @endif
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

</script>
@endsection
