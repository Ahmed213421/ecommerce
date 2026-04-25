@extends('dashboard.partials.master')

@section('title')

@endsection

@section('css')

@endsection

@section('breadcumb')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
<li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.products.index')}}">{{ trans('dashboard.all_products') }}</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="#">{{$product->name}}</a></li>
@endsection

@section('content')
<div class="bg-white p-4">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                @if($product->imagepath)
                <div class="col-md-5">
                    <img src="{{ asset($product->imagepath) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                    @if(isset($product->images) && count($product->images) > 0)
                    <div class="mt-3">
                        <h6>{{ trans('dashboard.photos') }}</h6>
                        <div class="row">
                            @foreach($product->images as $image)
                            <div class="col-md-4 mb-2">
                                <img src="{{ asset($image->imagepath) }}" class="img-fluid rounded" alt="">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endif
                <div class="col-md-7">
                    <h2 class="mb-3 page-title">{{ $product->name }}</h2>
                    <p class="mb-2"><strong>{{ trans('dashboard.description') }}:</strong></p>
                    <p class="mb-3">{{ $product->description }}</p>
                    <p class="mb-2"><strong>{{ trans('dashboard.price') }}:</strong> <span class="text-success">${{ $product->price }}</span></p>
                    <p class="mb-2"><strong>{{ trans('dashboard.discount') }}:</strong> {{ $product->discount_percentage ?? 0 }}%</p>
                    <p class="mb-2"><strong>{{ trans('dashboard.quantity') }}:</strong> {{ $product->quantity ?? 0 }}</p>
                    <p class="mb-2"><strong>{{ trans('dashboard.category') }}:</strong> {{ $product->subcategory->category->name ?? '-' }}</p>
                    <p class="mb-2"><strong>{{ trans('category.sub') }}:</strong> {{ $product->subcategory->name ?? '-' }}</p>
                    <p class="mb-2"><strong>{{ trans('dashboard.slug') }}:</strong> {{ $product->slug ?? '-' }}</p>
                    <p class="mb-2"><strong>{{ trans('dashboard.id') }}:</strong> {{ $product->id }}</p>
                    
                    <div class="mt-4">
                        <a href="{{route('admin.products.edit', $product->id)}}" class="btn btn-primary">{{ trans('dashboard.edit') }}</a>
                        <a href="{{route('admin.products.index')}}" class="btn btn-secondary">{{ trans('dashboard.close') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection
