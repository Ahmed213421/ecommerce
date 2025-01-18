
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
                        {{-- <h1>{{ Route::is('customer.category.index') ? trans('category.categories') : trans('shop.shop') }} --}}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- products -->
    <div class="wishlist-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <!-- Order Summary -->
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">My Wish List</h4>
                        </div>
                        <div class="card-body">
                            <div class="row"> <!-- Ensure this row exists to wrap the columns -->
                                @foreach ($favorites as $product)
                                    <div class="col-md-4 text-center">
                                        <div class="single-product-item">
                                            <div class="product-image">
                                                <a href="{{ route('customer.product.show', $product->slug) }}">
                                                    <img src="{{ asset($product->imagepath) }}" alt="">
                                                </a>
                                            </div>
                                            <h3>
                                                <a href="{{ route('customer.product.show', $product->slug) }}">{{ $product->name }}</a>
                                            </h3>
                                            <p class="product-price"><span>{{ trans('shop.per_kg') }}<br> </span> {{ $product->price }}$</p>
                                            <p class="product-quantity"><span>{{ trans('general.qty') }}</span><br> {{ $product->quantity }}</p>
                                            <div class="favorite-icon">
                                                <i id="heart-{{ $product->id }}" class="fa fa-heart {{ $product->favoritedBy->contains(auth()->id()) ? 'active' : '' }}"
                                                   onclick="toggleFavorite({{ $product->id }})" style="cursor: pointer;"></i>
                                            </div>
                                            <a href="javascript:void(0);" class="cart-btn" onclick="event.preventDefault(); document.getElementById('add-product-to-cart-{{ $product->id }}').submit();">
                                                <form id="add-product-to-cart-{{ $product->id }}" action="{{ route('customer.cart.product.add') }}" method="POST" style="display: none;">
                                                    @csrf
                                                    <input type="hidden" value="{{ $product->id }}" name="productid">
                                                </form>
                                                <i class="fas fa-shopping-cart"></i> {{ trans('products.add_to_cart') }}
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div> <!-- End of row -->
                        </div>
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
