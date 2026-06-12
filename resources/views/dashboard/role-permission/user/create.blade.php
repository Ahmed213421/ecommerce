@extends('dashboard.partials.master')

@section('title')

@endsection

@section('css')

@endsection

@section('titlepage')

@endsection

@section('breadcumb')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
<li class="breadcrumb-item active" aria-current="page">{{ trans('spatie.add_user') }}</li>
@endsection

@section('content')
<div class="bg-white p-4">
    <h2 class="mb-2 page-title">{{ trans('dashboard.data_table') }}</h2>

    <div class="row col-md-12">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">

                    @if ($errors->any())
                    <ul class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h4>{{ trans('spatie.add_user') }}
                                <a href="{{ route('admin.users.index') }}" class="btn btn-danger float-end">{{ trans('general.backto.dashboard') }}</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.users.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="">{{ trans('general.name') }}</label>
                                    <input type="text" name="name" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">{{ trans('general.email') }}</label>
                                    <input type="text" name="email" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">{{ trans('general.password') }}</label>
                                    <input type="text" name="password" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">{{ trans('spatie.roles') }}</label>
                                    <select name="roles[]" class="form-control" multiple>
                                        <option value="">{{ trans('dashboard.sel.category') }}</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">{{ trans('general.submit') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('js')

@endsection
