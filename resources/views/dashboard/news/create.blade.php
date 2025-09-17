@extends('dashboard.partials.master')

@section('title')
{{ trans('dashboard.create.post') }}
@endsection

@section('css')

<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">

@endsection

@section('breadcumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.news.create')}}">{{ trans('dashboard.create.post') }} </a></li>
@endsection

@section('content')
<div class="bg-white p-4">
<h2 class="mb-2 page-title ml-3">{{ trans('dashboard.create.post') }} </h2>
<form action="{{route('admin.news.store')}}" method="post" enctype="multipart/form-data">

    @csrf
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label for="simpleinput">{{ trans('dashboard.name') }} {{ trans('dashboard.ineng') }}</label>
                <input type="text" id="simpleinput" class="form-control" name="title_en" value="{{old('title_en')}}">
            </div>
            <div class="form-group mb-3">
                <label for="simpleinput">{{ trans('dashboard.name') }} {{ trans('dashboard.inarabic') }}</label>
                <input type="text" id="simpleinput" class="form-control" name="title_ar" value="{{ old('title_ar') }}">
            </div>
            <div class="form-group mb-3">
                <label for="simpleinput">{{ trans('dashboard.desc') }} {{ trans('dashboard.ineng') }}</label>
                <textarea class="form-control" id="editor" style="height: 300px" name="description_en">

                    @if (old('description_en'))
                    {{old('description_en')}}
                @else
                    <h2>Pomegranate can prevent heart disease</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint soluta, similique quidem fuga vel voluptates amet doloremque corrupti. Perferendis totam voluptates eius error fuga cupiditate dolorum? Adipisci mollitia quod labore aut natus nobis. Rerum perferendis, nobis hic adipisci vel inventore facilis rem illo, tenetur ipsa voluptate dolorem, cupiditate temporibus laudantium quidem recusandae expedita dicta cum eum. Quae laborum repellat a ut, voluptatum ipsa eum. Culpa fugiat minus laborum quia nam!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, praesentium, dicta. Dolorum inventore molestias velit possimus, dolore labore aliquam aperiam architecto quo reprehenderit excepturi ipsum ipsam accusantium nobis ducimus laudantium.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum est aperiam voluptatum id cupiditate quae corporis ex. Molestias modi mollitia neque magni voluptatum, omnis repudiandae aliquam quae veniam error! Eligendi distinctio, ab eius iure atque ducimus id deleniti, vel alias sint similique perspiciatis saepe necessitatibus non eveniet, quo nisi soluta.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt beatae nemo quaerat, doloribus obcaecati odio!</p>
                </div>
                @endif
            </textarea>
        </div>
            <div class="form-group mb-3">
                <label for="simpleinput">{{ trans('dashboard.desc') }} {{ trans('dashboard.inarabic') }}</label>
                <input type="text" id="simpleinput" class="form-control" name="description_ar" value="">
            <div>

            <div class="custom-file my-3">
                <input type="file" class="custom-file-input" id="customFile" name="imagepath" accept="image/*">
                <label class="custom-file-label" for="customFile">{{ trans('dashboard.photo') }}</label>
              </div>
              <div class="form-group mb-3">
                <label for="custom-select">{{ trans('dashboard.sel.category') }}</label>
                <select class="custom-select" id="categoryselect" name="category">
                    <option selected disabled value="">{{ trans('dashboard.sel.category') }}</option>
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
                <select class="custom-select" id="custom-select" name="tags[]" multiple>
                    @foreach ($tags as $tag)
                    <option value="{{$tag->id}}" >{{$tag->name}}</option>

                    @endforeach
                </select>
            </div>




            <button type="submit">{{ trans('general.submit') }}</button>

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
