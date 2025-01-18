@extends('shop.partials.master')

@section('title')
@endsection

@section('css')
    <style>
        .boxed-btn {
            font-family: 'Poppins', sans-serif;
            display: inline-block;
            background-color: #F28123;
            color: #fff;
            padding: 10px 20px;
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
                        <p>Fresh and Organic</p>
                        <h1>Check Out Product</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- check out section -->
    <div class="checkout-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card single-accordion">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Billing Address
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="billing-address-form">
                                            <form id="checkoutForm" action="{{ route('customer.check-out.store') }}"
                                                method="POST">
                                                @csrf
                                                <p><input type="text" placeholder="name" name="name"></p>
                                                <p><input type="email" placeholder="email" name="email"></p>
                                                <p><input type="text" placeholder="address" name="address"></p>
                                                <p><input type="tel" placeholder="phone" name="phone"></p>
                                                <p>
                                                    <textarea name="note" id="note" cols="30" rows="10" placeholder="Say Something"></textarea>
                                                </p>
                                                <p>
                                                    <select name="payment">
                                                        <option value="" disabled selected>Select Payment Method
                                                        </option>
                                                        <option value="visa">{{app()->getLocale() == 'ar' ? 'فيزا' : 'Visa'}}</option>
                                                        <option value="cash">{{app()->getLocale() == 'ar' ? 'نقدي' : 'Cash'}}</option>
                                                    </select>
                                                </p>
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
                                    </div>
                                </div>
                            </div>
                            <div class="card single-accordion">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Shipping Address
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shipping-address-form">
                                            <p>Your shipping address form is here.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card single-accordion">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            Card Details
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-details">
                                            <div class="cart-section">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-md-12">
                                                            <div class="cart-table-wrap">
                                                                <table class="cart-table">
                                                                    <thead class="cart-table-head">
                                                                        <tr class="table-head-row">
                                                                            <th class="product-remove"></th>
                                                                            <th class="product-image">
                                                                                {{ trans('products.product') }}
                                                                                {{ trans('dashboard.photo') }}
                                                                            </th>
                                                                            <th class="product-name">
                                                                                {{ trans('dashboard.name') }}</th>
                                                                            <th class="product-price">
                                                                                {{ trans('dashboard.price') }}</th>
                                                                            <th class="product-quantity">
                                                                                {{ trans('general.qty') }}</th>
                                                                            <th class="product-total">
                                                                                {{ trans('general.total') }}</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($cartItems as $item)
                                                                            <tr class="table-body-row">
                                                                                <td class="product-remove">
                                                                                    <!-- Remove item button for logged-in users -->

                                                                                    <form
                                                                                        action="{{ route('customer.cart.destroy', $item->id) }}"
                                                                                        method="POST"
                                                                                        style="display: inline;">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="submit"
                                                                                            class="btn btn-danger">
                                                                                            <i
                                                                                                class="far fa-window-close"></i>
                                                                                        </button>
                                                                                    </form>
                                                                                <td class="product-image">
                                                                                    <img src="{{ asset($item->product->imagepath) }}"
                                                                                        alt="" width="200px">

                                                                                </td>
                                                                                <!-- Check if item has product relationship for logged-in users -->
                                                                                <td class="product-name">
                                                                                    <a
                                                                                        href="{{ route('customer.product.show', $item->product->slug    ) }}">{{ $item->product->name }}</a>
                                                                                </td>

                                                                                <!-- Check if item has product relationship for logged-in users -->
                                                                                <td class="product-price">
                                                                                    ${{ $item->product->price_after_discount }}
                                                                                </td>
                                                                                <td class="product-quantity">
                                                                                    {{ $item->quantity }}</td>

                                                                                    <td class="product-total">
                                                                                        {{ number_format($item->product->price_after_discount * $item->quantity, 2) }}$
                                                                                    </td>
                                                                                </tr>
                                                                                @endforeach
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
                                                                            <th>Price</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="total-data">
                                                                            <td><strong>Subtotal: </strong></td>
                                                                            <td>$500</td>
                                                                        </tr>
                                                                        <tr class="total-data">
                                                                            <td><strong>Shipping: </strong></td>
                                                                            <td>$45</td>
                                                                        </tr>
                                                                        <tr class="total-data">
                                                                            <td><strong>{{ trans('general.total') }}:
                                                                                </strong></td>
                                                                            <td>${{ number_format(
                                                                                $cartItems->sum(function ($item) {
                                                                                    return $item->product->price_after_discount * $item->quantity;
                                                                                }),
                                                                                2,
                                                                            ) }}
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="order-details-wrap">
                        <table class="order-details">
                            <thead>
                                <tr>
                                    <th>Your order Details</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody class="order-details-body">
                                <tr>
                                    <td>Product</td>
                                    <td>Total</td>
                                </tr>
                                <tr>
                                    <td>Strawberry</td>
                                    <td>$85.00</td>
                                </tr>
                                <tr>
                                    <td>Berry</td>
                                    <td>$70.00</td>
                                </tr>
                                <tr>
                                    <td>Lemon</td>
                                    <td>$35.00</td>
                                </tr>
                            </tbody>
                            <tbody class="checkout-details">
                                <tr>
                                    <td>Subtotal</td>
                                    <td>$190</td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td>$50</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>$240</td>
                                </tr>
                            </tbody>
                        </table>
                        <a id="submitButton" class="boxed-btn">{{ trans('general.order') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end check out section -->

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

@endsection

@section('scripts')

<script>
    document.getElementById('submitButton').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent default anchor behavior
        document.getElementById('checkoutForm').submit(); // Trigger form submission
    });
</script>


@endsection
