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
            href="{{ route('admin.review.index') }}">{{ trans('general.review') }}</a></li>
@endsection

@section('content')
    <div class="bg-white p-4">
        <h2 class="mb-2 page-title">{{ trans('general.review') }}</h2>

        <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <!-- table -->
                        <div id="dataTable-1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="dataTable-1_length"><label>Show <select
                                                name="dataTable-1_length" aria-controls="dataTable-1"
                                                class="custom-select custom-select-sm form-control form-control-sm">
                                                <option value="16">16</option>
                                                <option value="32">32</option>
                                                <option value="64">64</option>
                                                <option value="-1">All</option>
                                            </select> entries</label></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="dataTable-1_filter" class="dataTables_filter"><label>Search:<input
                                                type="search" class="form-control form-control-sm" placeholder=""
                                                aria-controls="dataTable-1"></label></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <table class="table datatables dataTable no-footer" id="dataTable-1" role="grid"
                                        aria-describedby="dataTable-1_info">
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
                                            <tr role="row" class="even">
                                                @foreach ($reviews as $review)
                                                    </td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $review->name }}</td>
                                                    <td>{{ $review->email }}</td>
                                                    <td>{{ $review->phone }}</td>
                                                    <td>{{ $review->subject }}</td>
                                                    <td>{{ $review->message }}</td>
                                                    <td class="text-center">

                                                        <form action="{{ route('admin.stauts.change', $review->id) }}" method="POST">
                                                            @csrf
                                                            @method('POST')
                                                            <input type="hidden" name="status" value="review">
                                                            <button type="submit" class="btn btn-link p-0">
                                                                <span class="badge badge-secondary">
                                                                    @if ($review->status == 1)
                                                                    <span class="badge badge-light p-2 mt-1">{{ trans('general.active') }}</span>
                                                                    @else
                                                                    <span class="badge badge-dark p-2 mt-1">{{ trans('general.unactive') }}</span>
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
                                                        </div>
                                                    </td>
                                            </tr>
                                            @include('dashboard.review.delete')
                                            @include('dashboard.review.edit')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="dataTable-1_info" role="status" aria-live="polite">
                                        Showing 1 to 16 of 63 entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTable-1_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled"
                                                id="dataTable-1_previous"><a href="#" aria-controls="dataTable-1"
                                                    data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                            <li class="paginate_button page-item active"><a href="#"
                                                    aria-controls="dataTable-1" data-dt-idx="1" tabindex="0"
                                                    class="page-link">1</a></li>
                                            <li class="paginate_button page-item "><a href="#"
                                                    aria-controls="dataTable-1" data-dt-idx="2" tabindex="0"
                                                    class="page-link">2</a></li>
                                            <li class="paginate_button page-item "><a href="#"
                                                    aria-controls="dataTable-1" data-dt-idx="3" tabindex="0"
                                                    class="page-link">3</a></li>
                                            <li class="paginate_button page-item "><a href="#"
                                                    aria-controls="dataTable-1" data-dt-idx="4" tabindex="0"
                                                    class="page-link">4</a></li>
                                            <li class="paginate_button page-item next" id="dataTable-1_next"><a
                                                    href="#" aria-controls="dataTable-1" data-dt-idx="5"
                                                    tabindex="0" class="page-link">Next</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- simple table -->


        </div>
    </div>

@endsection

@section('js')
@endsection
