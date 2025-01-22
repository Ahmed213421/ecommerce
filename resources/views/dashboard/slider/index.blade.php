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
            href="{{ route('admin.slider.index') }}">{{ trans('dashboard.slider') }}</a></li>
@endsection

@section('content')
    <div class="bg-white p-4">
        <h2 class="mb-2 page-title">{{ trans('dashboard.slider') }}</h2>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            {{ trans('dashboard.create_slide') }}
        </button>
        <div class="row my-4">
            <!-- Small table -->
            <div class="col-sm-6 col-md-12 overflow-auto">
                <div class="card shadow">
                    <div class="card-body">
                        <!-- table -->
                        <div id="dataTable-1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer w-100">

                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <table class="table datatables dataTable no-footer" id="dataTable-1" role="grid"
                                        aria-describedby="dataTable-1_info">
                                        <thead>
                                            <tr role="row">
                                                <td>#</th>
                                                <td>{{ trans('dashboard.name') }}</td>
                                                <td>{{ trans('dashboard.photo') }}</td>
                                                <td>{{ trans('dashboard.branch_title') }}</td>
                                                <td>{{ trans('dashboard.created_at') }}</td>
                                                <td>{{ trans('dashboard.actions') }}</td>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <tr role="row" class="even">
                                                @foreach ($sliders as $slide)
                                                    </td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $slide->main_title }}</td>
                                                    <td>{{$slide->branch_title}}    </td>
                                                    <td><img src="{{asset($slide->imagepath)}}" width="100px" alt="" srcset=""></td>
                                                    <td>{{ $slide->created_at->diffForHumans() }}</td>
                                                    <td><button class="btn btn-sm dropdown-toggle more-horizontal"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <span
                                                                class="text-muted sr-only">{{ trans('dashboard.actions') }}</span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                                data-target="#modal{{ $slide->id }}">
                                                                {{ trans('dashboard.delete') }}
                                                            </a>
                                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                                data-target="#modaledit{{ $slide->id }}">
                                                                {{ trans('dashboard.edit') }}
                                                            </a>
                                                        </div>
                                                    </td>
                                            </tr>
                                            @include('dashboard.slider.delete')
                                            @include('dashboard.slider.edit')
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
                <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ trans('dashboard.name') }} </label>
                        <input type="text" class="form-control" id="name" name="main_title" value="{{ old('main_title')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ trans('dashboard.branch_title') }}</label>
                        <input type="text" class="form-control" id="name" name="branch_title" value="{{ old('branch_title')}}" required>
                    </div>



                    <div class="form-group">
                        <label for="image">{{ trans('dashboard.photo') }}</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">

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
    $('#dataTable-1').DataTable(
    {
      autoWidth: true,
      "lengthMenu": [
        [16, 32, 64, -1],
        [16, 32, 64, "All"]
      ]
    });
</script>

@endsection
