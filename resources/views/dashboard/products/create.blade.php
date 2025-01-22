@extends('dashboard.partials.master')

@section('title')
@endsection

@section('css')
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endsection

@section('breadcumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.products.create')}}">{{ trans('dashboard.create_product') }}</a></li>
@endsection

@section('content')
<div class="bg-white p-4">
<h2 class="mb-2 page-title ml-3">{{ trans('dashboard.create_product') }}</h2>
<form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
    @method('POST')
    @csrf
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label for="simpleinput">{{ trans('dashboard.name') }} {{ trans('dashboard.ineng') }}</label>
                <input type="text" id="simpleinput" class="form-control" name="name_en" value="{{old('name_en')}}">
            </div>
            <div class="form-group mb-3">
                <label for="simpleinput">{{ trans('dashboard.name') }} {{ trans('dashboard.inarabic') }}</label>
                <input type="text" id="simpleinput" class="form-control" name="name_ar" value="{{old('name_ar')}}">
            </div>
            <div class="form-group mb-3">
                <label for="simpleinput">{{ trans('dashboard.desc') }} {{ trans('dashboard.ineng') }}</label>
                <input type="text" id="simpleinput" class="form-control" name="description_en" value="{{old('description_en')}}">
            </div>
            <div class="form-group mb-3">
                <label for="simpleinput">stripe product id {{ trans('general.optional') }}</label>
                <input type="text" id="simpleinput" class="form-control" name="stripe_price_id" value="{{old('stripe_price_id')}}">
            </div>
            <div class="form-group mb-3">
                <label for="simpleinput">{{ trans('dashboard.desc') }} {{ trans('dashboard.inarabic') }}</label>
                <input type="text" id="simpleinput" class="form-control" name="description_ar" value="{{old('description_ar')}}">
            </div>
            <div class="form-group mb-3">
                <label for="price">{{ trans('dashboard.price') }}</label>
                <input type="number" id="price" class="form-control" name="price" placeholder="Enter price" min="0" value="{{old('price')}}" required oninput="this.value = Math.max(0, this.value)">
            </div>
            <div class="form-group mb-3">
                <label for="discount">{{ trans('dashboard.discount') }}</label>
                <input type="number" id="discount" class="form-control" name="discount"min="0" value="{{old('discount')}}" required oninput="this.value = Math.max(0, this.value)">
            </div>
            <div class="form-group mb-3">
                <label for="image">{{ trans('dashboard.photo') }}</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <div class="form-group mb-3">
                <label for="custom-select">{{ trans('dashboard.sel.category') }}</label>
                <select class="custom-select" id="categoryselect" name="category">
                    <option selected="" disabled>Open this select menu</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="custom-select">{{ trans('dashboard.sel.category') }}</label>
                <select class="custom-select" id="subSelect" name="subcategory_id">

                </select>
            </div>

            <div class="form-group mb-3">
                <label for="custom-select"></label>
                <input type="file" name="images[]" multiple>
            </div>

            <button type="submit" class="btn btn-primary">{{ trans('general.submit') }}</button>

        </form>
    </div>
@endsection

@section('js')
<script src="{{asset('admin/js/dropzone.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#categoryselect').change(function() {
            var categoryId = $(this).val();

            // Reset student dropdown
            $('#subSelect').empty().append('<option value="">Select a subcategory</option>').prop('disabled', true);

            if (categoryId) {
                $.ajax({
                    url: '/select/' + categoryId + '/subcategory',
                    method: 'GET',
                    success: function(data) {
                        $.each(data, function(index, sub) {
                            $('#subSelect').append('<option value="' + sub.id + '">' + sub.name + '</option>');
                        });
                        $('#subSelect').prop('disabled', false); // Enable student dropdown
                    }
                });
            }
        });
    });

</script>
@endsection
