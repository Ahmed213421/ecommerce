@extends('shop.partials.master')

@section('title')
    {{ trans('shop.about_us') }}
@endsection

@section('css')
    <style>
        .about-page-section {
            padding: 150px 0;
            background: #fbfbfb;
        }

        .about-page-copy {
            max-width: 560px;
        }

        .about-page-copy h2 {
            font-size: 38px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .about-page-copy h2 span {
            color: #F28123;
        }

        .about-page-copy p {
            color: #555;
            font-size: 16px;
            line-height: 1.9;
            margin-bottom: 18px;
        }

        .about-feature-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-top: 28px;
        }

        .about-feature {
            background: #fff;
            border: 1px solid #eeeeee;
            border-radius: 8px;
            padding: 22px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.05);
        }

        .about-feature i {
            color: #F28123;
            font-size: 28px;
            margin-bottom: 14px;
        }

        .about-feature h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .about-feature p {
            color: #666;
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
        }

        .about-page-image {
            min-height: 420px;
            border-radius: 8px;
            background-image: url("{{ asset('assets/img/abt.jpg') }}");
            background-size: cover;
            background-position: center;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.12);
        }

        @media (max-width: 767px) {
            .about-page-section {
                padding: 90px 0;
            }

            .about-feature-grid {
                grid-template-columns: 1fr;
            }

            .about-page-image {
                min-height: 300px;
                margin-top: 30px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>{{ trans('shop.about_us') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="about-page-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-page-copy">
                        <h2>{!! trans('shop.about_page_title') !!}</h2>
                        <p>{{ trans('shop.about_page_intro') }}</p>
                        <p>{{ trans('shop.about_page_body') }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-page-image"></div>
                </div>
            </div>

            <div class="about-feature-grid">
                <div class="about-feature">
                    <i class="fas fa-leaf"></i>
                    <h3>{{ trans('shop.about_feature_fresh_title') }}</h3>
                    <p>{{ trans('shop.about_feature_fresh_text') }}</p>
                </div>
                <div class="about-feature">
                    <i class="fas fa-shipping-fast"></i>
                    <h3>{{ trans('shop.about_feature_delivery_title') }}</h3>
                    <p>{{ trans('shop.about_feature_delivery_text') }}</p>
                </div>
                <div class="about-feature">
                    <i class="fas fa-award"></i>
                    <h3>{{ trans('shop.about_feature_quality_title') }}</h3>
                    <p>{{ trans('shop.about_feature_quality_text') }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
