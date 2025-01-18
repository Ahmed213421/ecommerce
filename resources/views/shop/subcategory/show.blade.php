@extends('shop.partials.master')

@section('css')

@endsection

@section('content')
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="offset-lg-2 {{ app()->getLocale() == 'ar' ? 'col-lg-12' : 'col-lg-8' }} text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{ trans('category.sub') }}</span> {{ $subcategory->name }}</h3>
                        <p>{{ $subcategory->description ?? trans('general.description') }}</p>
                    </div>
                </div>
            </div>

            <div class="row">

                @foreach ($subcategory->products as $product)
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product-item text-center">
                            <div class="product-image">
                                <a href="{{route('admin.products.show',$product->slug)}}"><img src="{{asset($product->imagepath)}}"
                                        alt=""></a>
                            </div>
                            <h3><a href="{{route('customer.product.show',$product->slug)}}">{{ $product->name }}</a></h3>
                            <p class="product-price"><span>{{ trans('shop.per_kg') }} </span> {{ $product->price }}$ </p>
                            <div class="favorite-icon">
                                <i
                                    id="heart-{{ $product->id }}"
                                    class="fa fa-heart {{ $product->isFavoritedByUser ? 'active' : '' }}"
                                    onclick="toggleFavorite({{ $product->id }})"
                                    style="cursor: pointer; color: {{ $product->isFavoritedByUser ? 'red' : 'gray' }};">
                                </i>
                            </div>

                            <a href="{{ route('customer.cart.index') }}" class="cart-btn"
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
            </div>
        </div>
    </div>
@endsection
