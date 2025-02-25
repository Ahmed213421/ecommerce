@extends('dashboard.partials.master')

@section('title')
{{ trans('dashboard.edit') }} {{$post->title}}
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">

@endsection

@section('breadcumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.news.index')}}"> {{ trans('general.all') }} {{ trans('dashboard.news') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.news.show',$post->id)}}"> {{$post->title}}</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.news.edit',$post->id)}}">{{ trans('dashboard.edit') }} {{$post->title}}</a></li>
@endsection

@section('content')
<div class="bg-white p-4">
<h2 class="mb-2 page-title ml-3">{{ trans('dashboard.edit') }} {{$post->title}}</h2>
<form action="{{route('admin.news.update',$post->id)}}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label for="simpleinput">{{ trans('dashboard.name') }} {{ trans('dashboard.ineng') }}</label>
                <input type="text" id="simpleinput" class="form-control" name="title_en" value="{{ $post->getTranslation('title', 'en') }}">
            </div>
            <div class="form-group mb-3">
                <label for="simpleinput">{{ trans('dashboard.name') }} {{ trans('dashboard.inarabic') }}</label>
                <input type="text" id="simpleinput" class="form-control" name="title_ar" value="{{ $post->getTranslation('title', 'ar') }}">
            </div>
            <div class="form-group mb-3">
                <label for="simpleinput">{{ trans('dashboard.desc') }} {{ trans('dashboard.inarabic') }}</label>
                <input type="text" id="simpleinput" class="form-control" name="description_ar" value="{{ $post->getTranslation('description', 'ar') }}">
            </div>
            <div class="form-group mb-3">
                <label for="simpleinput">{{ trans('dashboard.desc') }} {{ trans('dashboard.ineng') }}</label>
                <textarea class="form-control" id="editor" style="height: 300px" name="description_en">

                    @if (old('description_en'))
                    {{old('description_en')}}
                @else
                    {{$post->description}}
                </div>
                @endif
            </textarea>
        </div>


            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" id="customFi" name="image" accept="image/*">
                <label class="custom-file-label" for="customFile">{{ trans('dashboard.photo') }}</label>
            </div>
            <img src="{{asset($post->imagepath)}}" width="100px" class="my-2"  alt="" srcset="">

            <div class="form-group mb-3">
                <label for="custom-select">{{ trans('dashboard.sel.category') }}</label>
                <select class="custom-select" id="categoryselect" name="category">
                    <option selected="" disabled>{{ trans('dashboard.sel.category') }}</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="custom-select">{{ trans('dashboard.sel.subcategory') }}</label>
                <select class="custom-select" id="subSelect" name="subcategory_id">

                </select>
            </div>
            <div class="form-group mb-3">
                <label for="custom-select">{{ trans('dashboard.sel.tags') }}</label>
                <select class="custom-select" id="custom-select" name="tag_id" multiple>
                    @foreach ($tags as $tag)
                    <option value="{{$tag->id}}" {{$tag->id == $post->tags->contains($tag->id) ? 'selected':"" }}>{{$tag->name}}</option>

                    @endforeach
                </select>
            </div>


            <button type="submit" class="btn btn-primary">{{ trans('general.submit') }}</button>

        </form>
    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

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
<script>
    $(document).ready(function() {
        $('#editor').summernote({
            tabsize: 2,
            height: 200
        });
    });
</script>
@endsection
