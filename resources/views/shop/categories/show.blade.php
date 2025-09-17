@extends('shop.partials.master')

@section('css')
    <style>
        .top-header-area {
            background-color: #051922 !important;
        }
    </style>
@endsection

@section('content')
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="offset-lg-2 {{ app()->getLocale() == 'ar' ? 'col-lg-12' : 'col-lg-8'}} text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{ trans('category.category') }}</span> {{ $category->name }}</h3>
                        </div>
                    </div>
                </div>
                <h3 class="text-center">{{ trans('general.branch') }}</h3>

                <div class="row">
                    <div class="col-md-12">
                        <div class="product-filters">
                            <ul>
                                <li class="active" data-filter="*">All</li>
                                @foreach ($category->subcategories as $subcategory)
                                    <li data-filter=".{{ Str::slug($subcategory->name) }}">{{ $subcategory->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row product-lists">
                    @foreach ($category->subcategories as $subcategory)
                            @foreach ($subcategory->products as $item)
                                <div class="col-lg-4 col-md-6 text-center {{ Str::slug($subcategory->name) }}">
                                    <div class="single-product-item">
                                        <div class="product-image">
                                            <a href="{{route('admin.products.show',$item->slug)}}"><img src="{{asset($item->imagepath)}}"
                                                    alt=""></a>
                                        </div>
                                        <h3><a href="{{route('customer.product.show',$item->slug)}}">{{ $item->name }}</a></h3>
                                        <p class="product-price"><span></span>
                                            <br> {{$item->price}}</del> {{ $item->price_after_discount }}$
                                        </p>
                                        @auth

                                        <div class="favorite-icon">
                                            <i id="heart-{{ $item->id }}" class="fa fa-heart {{ $item->favoritedBy->contains(auth()->id()) ? 'active' : '' }}"
                                               onclick="toggleFavorite({{ $item->id }})" style="cursor: pointer;"></i>
                                        </div>
                                    </div>
                                    @endauth

                                    <a href="{{ route('customer.cart.index') }}" class="cart-btn"
                                        onclick="event.preventDefault();
                                            document.getElementById('add-product-to-cart-{{ $item->id }}').submit();">

                                        <form id="add-product-to-cart-{{ $item->id }}"
                                            action="{{ route('customer.cart.product.add') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            <input type="hidden" value="{{ $item->id }}" name="productid">
                                            <input type="hidden" value="1" name="quantity">
                                        </form>
                                        <i class="fas fa-shopping-cart"></i> {{ trans('products.add_to_cart') }}
                                    </a>
                                    </div>
                                </div>
                            @endforeach
                    @endforeach
                </div>

        {{-- <div class="row text-center">
                @foreach($category->subcategories as $subcategory)
                    <div class="col-lg-3 col-md-6">
                        <div class="single-subcategory">
                            <div class="product-image">
                                <a href="{{route('customer.subcategory.show',$subcategory->id)}}"><img src="{{asset($subcategory->imagepath)}}" alt=""></a>
                            </div>
                            <h4><a href="{{route('customer.subcategory.show', $subcategory->id )}}">{{ $subcategory->name }}</a></h4>
                            <p>{{ $subcategory->description ?? trans('general.description').'.' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> --}}
    </div>
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
