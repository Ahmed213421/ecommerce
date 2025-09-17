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
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.products.index')}}">{{ trans('dashboard.all_products') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.products.show',$product->id)}}">{{$product->name}}</a></li>
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
                <input type="number" id="price" value="{{$product->price}}" class="form-control" name="price" min="0" required oninput="this.value = Math.max(0, this.value)">
            </div>
            <div class="form-group mb-3">
                <label for="quantity">{{ trans('dashboard.quantity') }}</label>
                <input type="number" id="quantity" class="form-control" name="quantity" min="0" value="{{$product->quantity}}" required oninput="this.value = Math.max(0, this.value)">
            </div>
            <input type="hidden" id="productSubcategoryId" value="{{ optional($product)->subcategory_id }}">

            <div class="form-group mb-3">
                <label for="discount">{{ trans('dashboard.discount') }}</label>
                <input type="number" id="discount" value="{{$product->discount_percentage}}" class="form-control" name="discount"min="0" required oninput="this.value = Math.max(0, this.value)">
            </div>


            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" id="customFi" name="imagepath" accept="image/*">
                <label class="custom-file-label" for="customFile">{{ trans('dashboard.photo') }}</label>
                <img src="{{asset($product->imagepath)}}" width="100px" class="my-2 img-fluid" alt="" srcset="">
            </div>

            {{-- <div class="form-group mb-3">
                <label for="custom-select">{{ trans('dashboard.sel.category') }}</label>
                <select class="custom-select" id="custom-select" name="subcategory_id">
                    <option selected="" disabled>{{ trans('dashboard.sel.category') }}</option>
                    @foreach ($subcategories as $category)

                    @endforeach
                </select>
            </div> --}}
            <div class="form-group my-3 mt-5">
                <label for="custom-select">{{ trans('dashboard.sel.category') }}</label>
                <select class="custom-select" id="categoryselect" name="category">
                    <option value="">{{ trans('dashboard.sel.category') }}</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}" {{$category->id == $product->subcategory_id ? 'selected' : '' }}>{{$category->name}}</option>

                    @endforeach
                </select>
            </div>
            <input type="hidden" value="{{$product->id}}" id="productId">
            {{-- @dump({{ $category->id == $product->category_id ? 'selected' : '' }}) --}}
            <label for="custom-select">{{ trans('dashboard.sel.subcategory') }}</label>
            <select class="custom-select" id="subSelect" name="subcategory_id">
                <option value="">{{ __('dashboard.sel.subcategory') }}</option>
                @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}"
                        {{ (int)$subcategory->id === (int)optional($product)->subcategory_id ? 'selected' : '' }}>
                        {{ $subcategory->name }}
                    </option>
                @endforeach
            </select>

            <div class="form-group my-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFi" name="images[]" multiple accept="image/*">
                    <label class="custom-file-label" for="customFile">{{ trans('dashboard.photos') }}</label>
                </div>
            </div>


            <button type="submit" class="btn btn-primary">{{ trans('general.submit') }}</button>

        </form>
    </div>
@endsection

@section('js')
<script src="{{asset('admin/js/dropzone.min.js')}}"></script>

<script>
    // $(document).ready(function() {
    //     $('#categoryselect').change(function() {
    //         var categoryId = $(this).val();
    //         var productId = $('#productId').val();
    //         // Reset student dropdown
    //         $('#subSelect').empty().append('<option value="">{{__('dashboard.sel.subcategory')}}</option>').prop('disabled', true);

    //         if (categoryId) {
    //             $.ajax({
    //                 url: '/select/' + categoryId + '/subcategory',
    //                 method: 'GET',
    //                 success: function(data) {
    //                     $.each(data, function(index, sub) {
    //                         $('#subSelect').append('<option value="' + sub.id + '">' + sub.name + '</option>');
    //                     });
    //                     $('#subSelect').prop('disabled', false);
    //                 }
    //             });
    //         }
    //     });
    // });

    $(document).ready(function() {
    $('#categoryselect').change(function() {
        var categoryId = $(this).val();
        var productSubcategoryId = $('#productSubcategoryId').val(); // Store current product's subcategory ID

        $('#subSelect').empty().append('<option value="">{{__('dashboard.sel.subcategory')}}</option>').prop('disabled', true);

        if (categoryId) {
            $.ajax({
                url: '/select/' + categoryId + '/subcategory',
                method: 'GET',
                success: function(data) {
                    $.each(data, function(index, sub) {
                        var isSelected = productSubcategoryId == sub.id ? 'selected' : '';
                        $('#subSelect').append('<option value="' + sub.id + '" ' + isSelected + '>' + sub.name + '</option>');
                    });

                    $('#subSelect').prop('disabled', false);
                }
            });
        }
    });
});


</script>
@endsection
