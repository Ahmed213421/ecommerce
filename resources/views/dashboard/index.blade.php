@extends('dashboard.partials.master')

@section('title')
@endsection

@section('css')
@endsection

@section('titlepage')
@endsection

@section('breadcumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
    <li class="breadcrumb-item active" aria-current="page"></li>
@endsection

@section('content')
    <div class="bg-white p-4">
        <h2 class="mb-2 page-title">{{ trans('general.welcome') }} {{ auth('admin')->user()->name }}</h2>

        <div class="container my-5">


            <!--Section: Content-->
            <section class="p-5 z-depth-1">

                <div class="row d-flex">

                    <div class="col-md-6 col-lg-3 mb-4 text-center">
                        <h4 class="h1 font-weight-normal mb-3">
                            <i class="fa-solid fa-box"></i>
                            <span class="d-inline-block">{{ App\Models\Product::count() }}</span>
                        </h4>
                        <a href="{{ route('admin.products.index') }}">
                            <p class="font-weight-normal text-muted">{{ trans('products.products') }}</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 text-center">
                        <h4 class="h1 font-weight-normal mb-3">
                            <i class="fa-solid fa-layer-group"></i>
                            <span class="d-inline-block">{{ App\Models\Category::count() }}</span>
                        </h4>
                        <a href="{{ route('admin.category.index') }}">
                            <p class="font-weight-normal text-muted">{{ trans('category.categories') }}</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 text-center">
                        <h4 class="h1 font-weight-normal mb-3">
                            <i class="fa-regular fa-star"></i>
                            <span class="d-inline-block">{{ App\Models\Review::count() }}</span>
                        </h4>
                        <a href="{{ route('admin.review.index') }}">
                            <p class="font-weight-normal text-muted">{{ trans('general.review') }}</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 text-center">
                        <h4 class="h1 font-weight-normal mb-3">
                            <i class="fa-regular fa-newspaper"></i>
                            <span class="d-inline-block">{{ App\Models\Post::count() }}</span>
                        </h4>
                        <a href="{{ route('admin.news.index') }}">
                            <p class="font-weight-normal text-muted">{{ trans('dashboard.news') }}</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 text-center">
                        <h4 class="h1 font-weight-normal mb-3">
                            <i class="fa-regular fa-user"></i>
                            <span class="d-inline-block">{{ App\Models\Admin::count() }}</span>
                        </h4>
                        <a href="{{ route('admin.users.index') }}">
                            <p class="font-weight-normal text-muted">{{ trans('spatie.users') }}</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 text-center">
                        <h4 class="h1 font-weight-normal mb-3">
                            <i class="fa-regular fa-bell"></i>
                            <span class="d-inline-block">{{ App\Models\Subscriber::count() }}</span>
                        </h4>
                        <a href="{{ route('admin.subcategory.index') }}">
                            <p class="font-weight-normal text-muted">{{ trans('general.subscribers') }}</p>
                        </a>
                    </div>



                </div>

                <div class="row">
                    @php
                $previousMonthOrders = App\Models\Order::where('status', 'delivered')
                    ->whereMonth('created_at', now()->subMonth()->month)
                    ->count();
                $deliveredOrders = App\Models\Order::where('status', 'delivered')
                    ->whereMonth('created_at', now()->month)
                    ->count();
                $orderGrowthPercentage =
                    $previousMonthOrders > 0
                        ? round((($deliveredOrders - $previousMonthOrders) / $previousMonthOrders) * 100, 2)
                        : 0;
            @endphp
            <div class="col-sm-6 col-md-12 col-xl-3 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-3 text-center">
                                <span class="circle circle-sm bg-primary">
                                    <i class="fe fe-16 fe-shopping-cart text-white mb-0"></i>
                                </span>
                            </div>
                            <div class="col pr-0">
                                <p class="small text-muted mb-0">{{ trans('general.orders') }}</p>
                                <span class="h3 mb-0">{{ \App\Models\Order::where('status', 'delivered')->count() }}</span>
                                <span class="small text-success">
                                    +{{ $orderGrowthPercentage ?? 0 }}%
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! $chart1->renderHtml() !!}
        </div>

            </section>
            <!--Section: Content-->




        </div>


        <!-- End Counter -->



    </div>
@endsection

@section('js')
{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}
@endsection
