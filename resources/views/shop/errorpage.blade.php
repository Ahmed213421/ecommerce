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
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-text">
                    <p>{{ trans('shop.fresh') }}</p>
                    <h1>{{ trans('general.nopagefound') }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->
<!-- error section -->
<div class="full-height-section error-section">
    <div class="full-height-tablecell">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="error-text">
                        <i class="far fa-sad-cry"></i>
                        <h1>{{ trans('general.oops') }}</h1>
                        <p>{{ trans('general.nopagefound') }}</p>
                        <a href="{{route('customer.home')}}" class="boxed-btn">{{ trans('general.backto.home') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end error section -->
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
