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
            href="{{ route('admin.tags.index') }}">{{ trans('dashboard.tags') }}</a></li>
@endsection

@section('content')
    <div class="bg-white p-4">
        <h2 class="mb-2 page-title">{{__('dashboard.all')}} {{ trans('dashboard.tags') }}</h2>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            {{ trans('dashboard.create.tag') }}
        </button>
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
                                                <td>{{ trans('dashboard.actions') }}</td>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach ($tags as $tag)
                                            <tr role="row" class="even">
                                                    </td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $tag->name }}
                                                    <td><button class="btn btn-sm dropdown-toggle more-horizontal"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <span
                                                                class="text-muted sr-only">{{ trans('dashboard.actions') }}</span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                                data-target="#modaledit{{ $tag->id }}">
                                                                {{ trans('dashboard.edit') }}
                                                            </a>
                                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                                data-target="#modal{{ $tag->id }}">
                                                                {{ trans('dashboard.delete') }}
                                                            </a>
                                                        </div>
                                                    </td>
                                            </tr>

                                            @include('dashboard.tags.edit')
                                            @include('dashboard.tags.delete')
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.tags.store') }}" method="POST">
                    @method('POST')
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ trans('dashboard.name') }} {{ trans('dashboard.ineng') }}</label>
                        <input type="text" class="form-control" id="name" name="name_en" value="{{ old('name_en')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ trans('dashboard.branch_title') }} {{ trans('dashboard.inarabic') }}</label>
                        <input type="text" class="form-control" id="name" name="name_ar" value="{{ old('name_ar')}}" required>
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('dashboard.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('general.submit') }}</button>
                </div>
            </form>
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
