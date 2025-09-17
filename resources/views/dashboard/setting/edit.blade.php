@extends('dashboard.partials.master')

@section('title')
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('titlepage')
@endsection

@section('breadcumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
<li class="breadcrumb-item active" aria-current="page"><a
    href="{{ route('admin.setting.edit',$setting->id) }}">{{ trans('dashboard.edit') }} {{ trans('dashboard.settings') }}</a></li>
@endsection

@section('content')
    <div class="bg-white p-4">
        <h2 class="mb-2 page-title">{{ trans('dashboard.add') }} {{ trans('dashboard.settings') }}</h2>

        <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <form action="{{ route('admin.setting.update',$setting->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('dashboard.iconpage') }}</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" accept="image/*" name="pageIcon">
                                            <img src="{{asset($setting->pageIcon)}}" alt="" srcset="" width="20px" height="20px">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('dashboard.logo') }}</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" accept="image/*" name="logo">
                                            <img src="{{asset($setting->logo)}}" alt="" srcset="" width="200px" height="100px" class="mt-2">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ app()->getLocale() == 'ar' ? 'الضريبه' : 'tax:' }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tax_rate" value="{{ $setting->tax_rate }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('general.phone') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="phone" value="{{ $setting->phone }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('general.whoweare') }} {{ trans('dashboard.ineng') }}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="editor" style="height: 300px" name="whoweare_en">
                                                @if (old('whoweare_en'))
                                                    {{ old('whoweare_en') }}
                                                @else
                                                    {{ $setting->getTranslation('whoweare', 'en') }}
                                                @endif
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('general.whoweare') }} {{ trans('dashboard.inarabic') }}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="editor-2" style="height: 300px" name="whoweare_ar">
                                                @if (old('whoweare_ar'))
                                                    {{ old('whoweare_ar') }}
                                                @else
                                                    {{ $setting->getTranslation('whoweare', 'ar') }}
                                                @endif
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('general.description') }} {{ trans('dashboard.ineng') }}</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" class="form-control" name="description_en">{{ old('description_en', $setting->getTranslation('description', 'en')) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('general.description') }} {{ trans('dashboard.inarabic') }}</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" class="form-control" name="description_ar">{{ old('description_ar', $setting->getTranslation('description', 'ar')) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('general.workinghours') }} {{ trans('dashboard.ineng') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="hours_working_en" value="{{ old('hours_working_en', $setting->getTranslation('hours_working', 'en')) }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('general.workinghours') }} {{ trans('dashboard.inarabic') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="hours_working_ar" value="{{ old('hours_working_ar', $setting->getTranslation('hours_working', 'ar')) }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('dashboard.map') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="map" value="{{ old('map', $setting->map) }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('general.address') }} {{ trans('dashboard.ineng') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="address_en" value="{{ old('address_en', $setting->getTranslation('address', 'en')) }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('general.address') }} {{ trans('dashboard.inarabic') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="address_ar" value="{{ old('address_ar', $setting->getTranslation('address', 'ar')) }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('dashboard.facebook') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="fb" value="{{ old('fb', optional($setting->link)->fb) }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('dashboard.linked') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="li" value="{{ old('li', optional($setting->link)->li) }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('dashboard.twitter') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tw" value="{{ old('tw', optional($setting->link)->tw) }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('dashboard.instagram') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="ins" value="{{ old('ins', optional($setting->link)->ins) }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('general.email') }}</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" value="{{ old('email', $setting->email) }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">{{ trans('dashboard.desc') }}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" style="height: 100px" name="description">{{ old('description', $setting->description) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        {{-- <label class="col-sm-2 col-form-label">Submit Button</label> --}}
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary btn-block">{{ trans('general.submit') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js')

<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#editor').summernote({
            tabsize: 2,
            height: 200
        });
        $('#editor-2').summernote({
            tabsize: 2,
            height: 200
        });
    });
</script>
    @endsection
