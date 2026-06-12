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
    <li class="breadcrumb-item active" aria-current="page">{{ trans('dashboard.edit') }}</li>
@endsection

@section('content')
    <div class="bg-white p-4">
        <h2 class="mb-2 page-title">{{ trans('spatie.users') }}</h2>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">

                    @if ($errors->any())
                        <ul class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h4>{{ trans('dashboard.edit') }}
                                <a href="{{ route('admin.users.index') }}" class="btn btn-danger float-end">{{ trans('general.backto.dashboard') }}</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="">{{ trans('general.name') }}</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">{{ trans('general.email') }}</label>
                                    <input type="text" name="email" readonly value="{{ $user->email }}"
                                        class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">{{ trans('general.password') }}</label>
                                    <input type="text" name="password" class="form-control" />
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">{{ trans('spatie.roles') }}</label>
                                    <select name="roles[]" class="form-control" multiple>
                                        <option value="">{{ trans('dashboard.sel.category') }}</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}"
                                                {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                                {{ $role }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <select name="status" id="">
                                        <option value="active"
                                            {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>{{ trans('general.active') }}
                                        </option>
                                        <option value="unactive"
                                            {{ old('status', $user->status) == 'unactive' ? 'selected' : '' }}>{{ trans('general.unactive') }}
                                        </option>
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
@endsection

@section('js')
@endsection
