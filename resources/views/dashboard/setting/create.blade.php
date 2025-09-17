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
            href="{{ route('admin.setting.create') }}">{{ trans('dashboard.add') }} {{ trans('dashboard.settings') }}</a>
    </li>
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
                                <form action="{{ route('admin.setting.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="row mb-3">
                                        <label for="inputText"
                                            class="col-sm-2 col-form-label">{{ trans('dashboard.iconpage') }}</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" accept="image/*" name="pageIcon">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ app()->getLocale() == 'ar' ? 'الضريبه' : 'tax:' }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control"  name="tax_rate">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                            class="col-sm-2 col-form-label">{{ trans('dashboard.logo') }}</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" accept="image/*" name="logo">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                            class="col-sm-2 col-form-label">{{ trans('general.phone') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ old('phone', 01050033344) }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                            class="col-sm-2 col-form-label">{{ trans('general.whoweare') }}
                                            {{ trans('dashboard.ineng') }}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="editor" style="height: 300px" name="whoweare_en">
                                                @if (old('whoweare_en'))
{{ old('whoweare_en') }}
@else
<div class="abt-text">
                                                <p class="top-sub">Since Year 1999</p>
                                                <h2>We are <span class="orange-text">Fruitkha</span></h2>
                                                <p>Etiam vulputate ut augue vel sodales. In sollicitudin neque et massa porttitor vestibulum ac vel
                                                    nisi. Vestibulum placerat eget dolor sit amet posuere. In ut dolor aliquet, aliquet sapien sed,
                                                    interdum velit. Nam eu molestie lorem.</p>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente facilis illo repellat
                                                    veritatis minus, et labore minima mollitia qui ducimus.</p>
                                            </div>
@endif
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                            class="col-sm-2 col-form-label">{{ trans('general.whoweare') }}
                                            {{ trans('dashboard.inarabic') }}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="editor-2" style="height: 300px" name="whoweare_ar">
                                                @if (old('whoweare_ar'))
{{ old('whoweare_ar') }}
@else
<div class="abt-text">
                                                <p class="top-sub">Since Year 1999</p>
                                                <h2>We are <span class="orange-text">Fruitkha</span></h2>
                                                <p>Etiam vulputate ut augue vel sodales. In sollicitudin neque et massa porttitor vestibulum ac vel
                                                    nisi. Vestibulum placerat eget dolor sit amet posuere. In ut dolor aliquet, aliquet sapien sed,
                                                    interdum velit. Nam eu molestie lorem.</p>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente facilis illo repellat
                                                    veritatis minus, et labore minima mollitia qui ducimus.</p>
                                            </div>
@endif
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                            class="col-sm-2 col-form-label">{{ trans('general.workinghours') }}
                                            {{ trans('dashboard.ineng') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="hours_working_en"
                                                value="{{ old('hours_working_en', 'MON - FRIDAY: 8 to 9 PM SAT - SUN: 10 to 8 PM') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                            class="col-sm-2 col-form-label">{{ trans('general.workinghours') }}
                                            {{ trans('dashboard.inarabic') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="hours_working_ar"
                                                value="{{ old('hours_working_ar', 'الاتنين - الجمعه : 8 الي 9 مساءا - الاحد: 10 الي 8 مسائا') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                            class="col-sm-2 col-form-label">{{ trans('general.description') }}
                                            {{ trans('dashboard.ineng') }}</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" class="form-control" name="description_en">{{ old('description_en', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eveniet tempore fuga nulla sed possimus neque magnam itaque ipsa laudantium commodi amet consequuntur in illum, obcaecati repellat vero nemo tempora. Eius.') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                            class="col-sm-2 col-form-label">{{ trans('general.description') }}
                                            {{ trans('dashboard.inarabic') }}</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" class="form-control" name="description_ar">{{ old('description_ar', 'لوريم إيبسوم هو ببساطة نص شكلي يستخدم في صناعة الطباعة والتنضيد. كان لوريم إيبسوم النص القياسي للصناعة منذ القرن الخامس عشر.') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                            class="col-sm-2 col-form-label">{{ trans('dashboard.map') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="map"
                                                value="{{ old('map') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                            class="col-sm-2 col-form-label">{{ trans('general.address') }}
                                            {{ trans('dashboard.ineng') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="address_en"
                                                value="{{ old(
                                                    'address_en',
                                                    '34/8, East Hukupara
                                                Gifirtok, Sadan.
                                                Country Name

                                                ',
                                                ) }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                            class="col-sm-2 col-form-label">{{ trans('general.address') }}
                                            {{ trans('dashboard.inarabic') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="address_ar"
                                                value="{{ old('address_ar','شارع المشتشارين خلف مسجد الصباحي') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                            class="col-sm-2 col-form-label">{{ trans('dashboard.facebook') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="fb"
                                                value="{{ old('fb') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                            class="col-sm-2 col-form-label">{{ trans('dashboard.linked') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="li"
                                                value="{{ old('li') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                            class="col-sm-2 col-form-label">{{ trans('dashboard.twitter') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tw"
                                                value="{{ old('tw') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                            class="col-sm-2 col-form-label">{{ trans('dashboard.instagram') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="ins"
                                                value="{{ old('ins') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText"
                                            class="col-sm-2 col-form-label">{{ trans('general.email') }}</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email"
                                                value="{{ old('email', 'spiderofegypt98@gmail.com') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        {{-- <label class="col-sm-2 col-form-label">Submit Button</label> --}}
                                        <div class="col-sm-10">
                                            <button type="submit"
                                                class="btn btn-primary btn-block">{{ trans('general.submit') }}</button>
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
