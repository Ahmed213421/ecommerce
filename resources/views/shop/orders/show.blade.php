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
                        <h1>{{ trans('shop.wish') }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- products -->
    <div class="order-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <!-- Order Summary -->
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Order Details</h4>
                        </div>
                        <div class="card-body">
                            <!-- Customer Info -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>Name:</strong> John Doe</p>
                                    <p><strong>Email:</strong> john@example.com</p>
                                    <p><strong>Phone:</strong> +123456789</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Address:</strong> 123 Main Street, City, Country</p>
                                    <p><strong>Note:</strong> Please deliver between 9 AM and 12 PM.</p>
                                </div>
                            </div>
                            <!-- Order Items -->
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Product A</td>
                                        <td>2</td>
                                        <td>$50.00</td>
                                        <td>$100.00</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Product B</td>
                                        <td>1</td>
                                        <td>$30.00</td>
                                        <td>$30.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>Total:</strong></td>
                                        <td><strong>$130.00</strong></td>
                                    </tr>
                                </tbody>
                            </table>
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
