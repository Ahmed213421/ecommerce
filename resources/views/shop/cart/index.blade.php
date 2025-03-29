@extends('shop.partials.master')

@section('title')
@endsection


@section('content')
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <p>{{ trans('shop.fresh') }}</p>
                        <h1>{{ trans('general.cart') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- cart -->
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
                                    <th class="product-remove"></th>
                                    <th class="product-image">{{ trans('products.product') }} {{ trans('dashboard.photo') }}
                                    </th>
                                    <th class="product-name">{{ trans('dashboard.name') }}</th>
                                    <th class="product-price">{{ trans('dashboard.price') }}</th>
                                    <th class="product-quantity">{{ trans('general.qty') }}</th>
                                    <th class="product-total">{{ trans('general.total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($cartItems) > 0)
                                    @foreach ($cartItems as $item)
                                        <tr class="table-body-row">
                                            <td class="product-remove">
                                                <!-- Remove item button for logged-in users -->
                                                @if (Auth::check())
                                                    <form action="{{ route('customer.cart.destroy', $item->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="far fa-window-close"></i>
                                                        </button>
                                                    </form>
                                            <td class="product-image">
                                                <img src="{{ asset($item->product->imagepath) }}" alt="">

                                            </td>
                                            <!-- Check if item has product relationship for logged-in users -->
                                            <td class="product-name">
                                                <a
                                                    href="{{ route('customer.product.show', $item->product->slug ?? '') }}">{{ $item->product->name }}</a>
                                            </td>

                                            <!-- Check if item has product relationship for logged-in users -->
                                            <td class="product-price">
                                                ${{ $item->product->price_after_discount }}
                                            </td>
                                            <td class="product-quantity">{{ $item->quantity }}</td>

                                            <td class="product-total">
                                                {{ number_format($item->product->price_after_discount * $item->quantity, 2) }}$
                                            </td>
                                        @else
                                            <!-- For guest users, use session-based removal logic -->
                                            {{-- @dump($item) --}}
                                            <form action="{{ route('customer.cart.destroy', $item['product_id']) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="far fa-window-close"></i>
                                                </button>
                                            </form>
                                            </td>
                                            <!-- Check if item has product relationship for logged-in users -->
                                            <td class="product-image">
                                                @if (isset($item['image']))
                                                    <img src="{{ asset($item['image']) }}" alt="">
                                                @endif
                                            </td>
                                            <!-- Check if item has product relationship for logged-in users -->
                                            <td class="product-name">
                                                <a
                                                    href="{{ route('customer.product.show', Str::slug($item['name'])) }}">{{ $item['name'] }}</a>
                                            </td>

                                            <!-- Check if item has product relationship for logged-in users -->
                                            <td class="product-price">
                                                ${{ $item['price_after_discount'] }}
                                            </td>
                                            <td class="product-quantity">{{ $item['quantity'] }}</td>

                                            <td class="product-total">
                                                {{ number_format($item['price_after_discount'] * $item['quantity'], 2) }}$
                                            </td>
                                    @endif
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">{{ trans('shop.no_cart') }}</td>
                                </tr>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="total-section">
                        <table class="total-table">
                            <thead class="total-table-head">
                                <tr class="table-total-row">
                                    <th>{{ trans('general.total') }}</th>
                                    <th>{{ trans('dashboard.price') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="total-data">
                                    <td><strong>
                                        {{ app()->getLocale() == 'ar' ? 'المجموع الكلي قبل الخصم' : 'Subtotal:' }}  </strong></td>
                                    <td>{{ number_format($subtotal, 2) }}</td>
                                </tr>
                                <tr class="total-data">
                                    <td><strong>
                                        {{ app()->getLocale() == 'ar' ? 'الضريبه' : 'tax:' }}  </strong></td>
                                    <td>{{App\Models\Setting::getTaxRate()}}</td>
                                </tr>
                                <tr class="total-data">
                                    <td><strong>{{ trans('general.total') }}: </strong></td>
                                    <td>${{ number_format($total, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="cart-buttons">
                            <a href="{{ route('customer.cart.edit','update') }}"
                                class="boxed-btn">{{ trans('dashboard.edit') }} {{ trans('general.cart') }}</a>
                            @if (count($cartItems) > 0)
                                <a href="{{ route('customer.check-out.index') }}"
                                    class="boxed-btn black">{{ trans('general.checkout') }}</a>
                            @endif
                        </div>
                    </div>

                    <div class="coupon-section">
                        <h3>Apply Coupon</h3>
                        <div class="coupon-form-wrap">
                            <form action="index.html">
                                <p><input type="text" placeholder="Coupon"></p>
                                <p><input type="submit" value="Apply"></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end cart -->

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
