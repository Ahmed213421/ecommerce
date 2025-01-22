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
        <h2 class="mb-2 page-title">Welcome {{ auth('admin')->user()->name }}</h2>

        <div class="container my-5">


            <!--Section: Content-->
            <section class="p-5 z-depth-1">

                {{-- <h3 class="text-center font-weight-bold mb-5">Counter</h3> --}}

                <div class="row d-flex justify-content-center">

                    <div class="col-md-6 col-lg-3 mb-4 text-center">
                        <h4 class="h1 font-weight-normal mb-3">
                            <i class="fa-solid fa-box"></i>
                            <span class="d-inline-block">{{App\Models\Product::count()}}</span>
                        </h4>
                        <a href="{{route('admin.products.index')}}"><p class="font-weight-normal text-muted">{{ trans('products.products') }}</p></a>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 text-center">
                        <h4 class="h1 font-weight-normal mb-3">
                            <i class="fa-solid fa-layer-group"></i>
                            <span class="d-inline-block">{{App\Models\Category::count()}}</span>
                        </h4>
                        <a href="{{route('admin.category.index')}}"><p class="font-weight-normal text-muted">{{ trans('category.categories') }}</p></a>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 text-center">
                        <h4 class="h1 font-weight-normal mb-3">
                            <i class="fa-regular fa-star"></i>
                            <span class="d-inline-block">{{App\Models\Review::count()}}</span>
                        </h4>
                        <a href="{{route('admin.review.index')}}"><p class="font-weight-normal text-muted">{{ trans('general.review') }}</p></a>
                    </div>

                </div>

            </section>
            <!--Section: Content-->


        </div>

        <!-- End Counter -->



    </div>
@endsection

@section('js')
@endsection
