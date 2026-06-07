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
<li class="breadcrumb-item active" aria-current="page"></li>
@endsection

@section('content')
<div class="bg-white p-4">
    <h2 class="mb-2 page-title">{{ trans('dashboard.data_table') }}</h2>

    <div class="container mt-5">
        <a href="{{ route('admin.roles.index') }}" class="btn btn-primary mx-1">{{ trans('spatie.roles') }}</a>
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-info mx-1">{{ trans('spatie.perrmisssions') }}</a>
        <a href="{{ route('admin.users.index') }}" class="btn btn-warning mx-1">{{ trans('spatie.users') }}</a>
    </div>

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>{{ trans('spatie.perrmisssions') }}
                            @if (auth('admin')->check() && auth('admin')->user()->can('create-permission'))
                                <a href="{{ url('dashboard/permissions/create') }}" class="btn btn-primary float-end">{{ trans('dashboard.add_permission') }}</a>
                            @endif
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('dashboard.id') }}</th>
                                    <th>{{ trans('dashboard.name') }}</th>
                                    <th width="40%">{{ trans('dashboard.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td class="d-flex">
                                        @if (auth('admin')->check() && auth('admin')->user()->can('update-permission'))
                                            <a href="{{ route('admin.permissions.edit',$permission->id) }}" class="btn btn-success">Edit</a>
                                        @endif

                                        @if (auth('admin')->check() && auth('admin')->user()->can('delete-permission'))

                                            <form action="{{ route('admin.permissions.destroy',$permission->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-primary" value="{{ trans('dashboard.delete') }}">
                                            </form>

                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

@endsection
