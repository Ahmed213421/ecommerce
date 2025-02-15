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
            href="{{ route('admin.orders.index') }}">{{ trans('general.orders') }}</a></li>
@endsection

@section('content')
    <div class="bg-white p-4">
        <h2 class="mb-2 page-title">{{ trans('general.orders') }}</h2>
        </a>
        <div class="row my-4">
            <!-- Small table -->
            <div class="col-sm-6 col-md-12 overflow-auto">
                <div class="card shadow">
                    <div class="card-body">

                        <!-- table -->
                        <div id="dataTable-1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer w-100">

                            <div class="row">
                                <div class="col-sm-12 col-md-12 overflow-auto">
                                    <table class="table datatables dataTable no-footer" id="dataTable-1" role="grid"
                                        aria-describedby="dataTable-1_info">
                                        <thead>
                                            <tr role="row">
                                                <td>#</th>
                                                <td>{{ trans('dashboard.name') }}</td>
                                                <td>{{ trans('general.email') }}</td>
                                                <td>{{ trans('general.address') }}</td>
                                                <td>{{ trans('general.phone') }}</td>
                                                <td>{{ trans('general.payment') }}</td>
                                                <td>{{ trans('dashboard.price') }}</td>
                                                <td>{{ trans('dashboard.created_at') }}</td>
                                                <td>{{ trans('dashboard.actions') }}</td>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                            <tr role="row" class="even">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $order->name }}</a></td>
                                                    <td>{{ $order->email }}</td>
                                                    <td>{{ $order->address }}</td>
                                                    <td>{{ $order->phone }}</td>
                                                    <td>{{ $order->payment }} </td>
                                                    <td>{{ $order->totalprice }} </td>
                                                    <td>{{ $order->created_at->diffForHumans() }}</td>
                                                    <td><button class="btn btn-sm dropdown-toggle more-horizontal"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <span
                                                                class="text-muted sr-only">{{ trans('dashboard.actions') }}</span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">

                                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                                data-target="#modalview{{ $order->id }}">
                                                                {{ trans('dashboard.view') }}
                                                            </a>
                                                        </div>
                                                    </td>
                                            </tr>
                                            @include('dashboard.orders.view')
                                            @endforeach
                                        </tbody>
                                    </table>
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
