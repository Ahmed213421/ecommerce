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
<li class="breadcrumb-item active" aria-current="page"><a
    href="{{ route('admin.setting.create') }}">{{ trans('dashboard.add') }} {{ trans('dashboard.settings') }}</a></li>
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
                                <form action="{{ route('admin.setting.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('dashboard.iconpage') }}</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" accept="image/*" name="iconpage">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('dashboard.logo') }}</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" accept="image/*" name="logo">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('general.phone') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('dashboard.street') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="street" value="{{ old('street') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('dashboard.country') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="country" value="{{ old('country') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('dashboard.map') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="map" value="{{ old('map') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('general.address') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('dashboard.facebook') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="fb" value="{{ old('fb') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('dashboard.linked') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="li" value="{{ old('li') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('dashboard.twitter') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tw" value="{{ old('tw') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('dashboard.instagram') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="ins" value="{{ old('ins') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">{{ trans('general.email') }}</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">{{ trans('dashboard.desc') }}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" style="height: 100px" name="description">{{ old('description') }}</textarea>
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
    @endsection
