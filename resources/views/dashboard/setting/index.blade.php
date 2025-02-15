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
    href="{{ route('admin.setting.index') }}">{{ trans('dashboard.settings') }}</a></li>
@endsection

@section('content')
    <div class="bg-white p-4">
        <h2 class="mb-2 page-title">{{ trans('dashboard.settings') }}</h2>
        <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 overflow-auto">
                                <table class="table datatables dataTable no-footer" id="dataTable-2" role="grid"
                                    aria-describedby="dataTable-1_info" style="width: 100%">
                                    <thead>
                                        <tr role="row">
                                            <td>#</th>
                                            <td>:</th>
                                            <td>#</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @forelse ($settings as $setting)
                                            <tr>
                                                <td>{{ trans('dashboard.iconpage') }}</td>
                                                <td>:</td>
                                                <td><img src="{{ asset($setting->pageIcon) }}" alt=""
                                                        srcset="" width="20px" height="20px"></td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('dashboard.logo') }}</td>
                                                <td>:</td>
                                                <td><img src="{{ asset($setting->logo) }}" alt=""
                                                        srcset="" width="200px" height="100px"></td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('general.address') }}</td>
                                                <td>:</td>
                                                <td>{{ $setting->address }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('dashboard.desc') }}</td>
                                                <td>:</td>
                                                <td>{{ $setting->description }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('general.phone') }}</td>
                                                <td>:</td>
                                                <td>{{ $setting->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('dashboard.map') }}</td>
                                                <td>:</td>
                                                <td>{{ $setting->map }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('dashboard.twitter') }}</td>
                                                <td>:</td>
                                                <td>{{ optional($setting->link)->tw }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('dashboard.facebook') }}</td>
                                                <td>:</td>
                                                <td>{{ optional($setting->link)->fb }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('dashboard.instagram') }}</td>
                                                <td>:</td>
                                                <td>{{ optional($setting->link)->ins }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('dashboard.linked') }}</td>
                                                <td>:</td>
                                                <td>{{ optional($setting->link)->li }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center">{{ trans('dashboard.no_content') }}</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>

                                <div class="d-flex flex-column gap-2">
                                    @forelse ($settings as $setting)
                                        <a href="{{ route('admin.setting.edit', $setting->id) }}" class="btn btn-primary mt-2">
                                            {{ trans('dashboard.edit') }}
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger text-white mt-2" data-toggle="modal" data-target="#del{{ $setting->id }}">
                                            <i class="fa fa-trash"></i> {{ trans('dashboard.delete') }}
                                        </button>
                                        @include('dashboard.setting.delete')
                                    @empty
                                        <a href="{{ route('admin.setting.create') }}" class="btn btn-primary mt-2">
                                            {{ trans('dashboard.add') }}
                                        </a>
                                    @endforelse
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
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
