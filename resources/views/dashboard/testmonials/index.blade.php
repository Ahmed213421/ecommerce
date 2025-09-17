@extends('dashboard.partials.master')

@section('title')
@endsection

@section('css')
@endsection


@section('breadcumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
<li class="breadcrumb-item active" aria-current="page"><a
href="{{ route('admin.testmonials.index') }}">{{ trans('general.review') }}</a></li>
@endsection

@section('content')
<div class="bg-white p-4">
<h2 class="mb-2 page-title">{{ trans('general.review') }}</h2>

<div class="row my-4">
<!-- Small table -->
<div class="col-md-12 col-sm-6">
    <div class="card shadow">
        <div class="card-body">
            <!-- table -->
            <div id="dataTable-1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                <div class="row">
                    <div class="col-sm-6 col-md-12 overflow-auto">
                        <table class="table datatables dataTable no-footer w-100" id="dataTable-1"
                            role="grid" aria-describedby="dataTable-1_info">
                            <thead>
                                <tr role="row">
                                    <td>#</th>
                                    <td>{{ trans('dashboard.name') }}</td>
                                    <td>{{ trans('general.email') }}</td>
                                    <td>{{ trans('general.phone') }}</td>
                                    <td>{{ trans('general.subject') }}</td>
                                    <td>{{ trans('general.message') }}</td>
                                    <td>{{ trans('general.status') }}</td>
                                    <td>{{ trans('dashboard.created_at') }}</td>
                                    <td>{{ trans('dashboard.actions') }}</td>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                <tr role="row" class="even">
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $review->name }}</td>
                                        <td>{{ $review->email }}</td>
                                        <td>{{ $review->phone }}</td>
                                        <td>{{ $review->subject }}</td>
                                        <td>{{ Str::limit($review->message,10) }}</td>
                                        <td class="text-center">

                                            <form action="{{ route('admin.stauts.change', $review->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="status" value="testmonial">
                                                <button type="submit" class="btn btn-link p-0">
                                                    <span class="badge badge-secondary">
                                                        @if ($review->status == 1)
                                                            <span
                                                                class="badge badge-light p-2 mt-1">{{ trans('general.active') }}</span>
                                                        @else
                                                            <span
                                                                class="badge badge-dark p-2 mt-1">{{ trans('general.unactive') }}</span>
                                                        @endif
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                        <td>{{ $review->created_at->diffForHumans() }}</td>
                                        <td><button class="btn btn-sm dropdown-toggle more-horizontal"
                                                type="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <span
                                                    class="text-muted sr-only">{{ trans('dashboard.actions') }}</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#modal{{ $review->id }}">
                                                    {{ trans('dashboard.delete') }}
                                                </a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#modaledit{{ $review->id }}">
                                                    {{ trans('dashboard.edit') }}
                                                </a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#modalview{{ $review->id }}">
                                                    {{ trans('dashboard.view') }}
                                                </a>
                                            </div>
                                        </td>
                                </tr>
                                @include('dashboard.testmonials.delete')
                                @include('dashboard.testmonials.edit')
                                @include('dashboard.testmonials.view')
                                @endforeach
                            </tbody>
                    </div>
                </div>
            </div> <!-- simple table -->
        </div>
    </div>
@endsection

@section('js')
<script>
    var currentLocale = '{{ app()->getLocale() }}';
        console.log(currentLocale);

        $('#dataTable-1').DataTable(
        {
            "language": {
                "url": currentLocale === 'ar' ? 'https://cdn.datatables.net/plug-ins/2.2.1/i18n/ar.json' : ''
            },
          autoWidth: true,
          "lengthMenu": [
            [16, 32, 64, -1],
            [16, 32, 64, "All"]
          ]
        });
    </script>

@endsection
