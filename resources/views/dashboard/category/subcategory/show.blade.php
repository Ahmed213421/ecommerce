@extends('dashboard.partials.master')

@section('title')

@endsection

@section('css')

@endsection

@section('breadcumb')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
<li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.category.index')}}">{{ trans('category.categories') }}</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.category.show',$subcategory->category->id)}}">{{$subcategory->category->name}}</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.subcategory.show',$subcategory->id)}}">{{$subcategory->name}}</a></li>
@endsection

@section('content')
<div class="bg-white p-4">
    <h2 class="mb-2 page-title">{{$subcategory->name}}</h2>
    <div class="row">
    @foreach ($subcategory->products as $product)

        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm">
            <img src="{{asset($product->imagepath)}}" class="card-img-top" style="width:100%;height:200px" alt="Card image cap">
            <div class="card-body">
                <h6 class="card-text my-2">
                    <a href="your-link-here" class="text-dark">{{$product->name}}</a>
                </h6>
                {{-- Replace or remove post description here --}}
                <p class="card-text">{{$product->description}}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        {{-- Replace these with actual links or actions --}}
                        <a href="your-link-here" class="btn btn-sm btn-outline-secondary">{{ trans('dashboard.view') }}</a>
                        <a href="{{route('admin.products.edit',$product->id)}}" class="btn btn-sm btn-outline-secondary">{{ trans('dashboard.edit') }}</a>
                    </div>
                    {{-- You can either hardcode a timestamp or remove this line --}}
                    <small class="text-muted">{{$product->created_at}}</small>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
    </div>
@endsection

@section('js')

@endsection
