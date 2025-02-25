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
                        <h1>{{ trans('general.my.orders') }}
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
                @foreach ($orders as $order)

                <!-- Order Summary -->
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">{{$order->created_at}}</h4>
                        </div>
                        <div class="card-body">
                            <!-- Customer Info -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>{{ trans('dashboard.name') }}:</strong> {{$order->name}}</p>
                                    <p><strong>{{ trans('general.email') }}:</strong> {{$order->email}}</p>
                                    <p><strong>{{ trans('general.phone') }}:</strong> +{{$order->phone}}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>{{trans('general.address')}}:</strong> {{$order->phone}}</p>
                                    <p><strong>{{ trans('dashboard.desc') }}:</strong> {{$order->note}}</p>
                                </div>
                            </div>
                            <!-- Order Items -->
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('products.product') }}</th>
                                        <th>{{ trans('dashboard.quantity') }}</th>
                                        <th>{{ trans('dashboard.price') }}</th>
                                        <th>{{ trans('general.total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderDetails as $item)

                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->product->name}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>${{$item->product->price_after_discount}}</td>
                                        <td>${{$item->product->price_after_discount * $item->quantity}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>{{ trans('general.total') }}:</strong></td>
                                        <td><strong>${{$total = $order->orderDetails->map(function ($item) {
                                            return $item->product->price_after_discount * $item->quantity;
                                        })->sum()}}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach

                {{$orders->links('pagination::bootstrap-4')}}
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
