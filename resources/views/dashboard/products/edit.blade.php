@extends('dashboard.partials.master')

@section('title')
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('admin/css/dropzone.css')}}">
@endsection

@section('breadcumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.products.edit',$product->id)}}">{{ trans('dashboard.edit') }} {{$product->name}}</a></li>
@endsection

@section('content')
<div class="bg-white p-4">
<h2 class="mb-2 page-title ml-3">{{ trans('dashboard.edit') }} {{$product->name}}</h2>
<form action="{{route('admin.products.update',$product->id)}}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label for="simpleinput">{{ trans('dashboard.name') }} {{ trans('dashboard.ineng') }}</label>
                <input type="text" id="simpleinput" class="form-control" name="name_en" value="{{ $product->getTranslation('name', 'en') }}">
            </div>
            <div class="form-group mb-3">
                <label for="simpleinput">{{ trans('dashboard.name') }} {{ trans('dashboard.inarabic') }}</label>
                <input type="text" id="simpleinput" class="form-control" name="name_ar" value="{{ $product->getTranslation('name', 'ar') }}">
            </div>
            <div class="form-group mb-3">
                <label for="simpleinput">{{ trans('dashboard.desc') }} {{ trans('dashboard.ineng') }}</label>
                <input type="text" id="simpleinput" class="form-control" name="description_en" value="{{ $product->getTranslation('description', 'en') }}">
            </div>
            <div class="form-group mb-3">
                <label for="simpleinput">{{ trans('dashboard.desc') }} {{ trans('dashboard.inarabic') }}</label>
                <input type="text" id="simpleinput" class="form-control" name="description_ar" value="{{ $product->getTranslation('description', 'ar') }}">
            </div>
            <div class="form-group mb-3">
                <label for="price">{{ trans('dashboard.price') }}</label>
                <input type="number" id="price" value="{{$product->price}}" class="form-control" name="price" placeholder="Enter price" min="0" required oninput="this.value = Math.max(0, this.value)">
            </div>

            <div class="form-group mb-3">
                <label for="simpleinput">stripe product id {{ trans('general.optional') }}</label>
                <input type="text" id="simpleinput" class="form-control" name="stripe_price_id" value="{{$product->stripe_price_id}}">
            </div>

            <div class="form-group mb-3">
                <label for="discount">{{ trans('dashboard.discount') }}</label>
                <input type="number" id="discount" value="{{$product->discount_percentage}}" class="form-control" name="discount"min="0" required oninput="this.value = Math.max(0, this.value)">
            </div>
            <div class="form-group mb-3">
                <label for="image">{{ trans('dashboard.photo') }}</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                <img src="{{asset($product->imagepath)}}" width="100px" class="mt-2" alt="" srcset="">
            </div>

            <div class="form-group mb-3">
                <label for="custom-select">{{ trans('dashboard.sel.category') }}</label>
                <select class="custom-select" id="custom-select" name="subcategory_id">
                    @foreach ($subcategories as $category)
                    <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected':"" }}>{{$category->name}}</option>

                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="custom-select"></label>
                <input type="file" name="images[]" multiple>
            </div>
            <div class="form-group mb-3">
                <label for="custom-multiselect">Custom Multiple Select</label>
                <select class="custom-select" multiple="" id="custom-multiselect">
                    <option selected="">Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>

            <button type="submit">submit</button>

        </form>
    </div>
@endsection

@section('js')
<script src="{{asset('admin/js/dropzone.min.js')}}"></script>


@endsection
