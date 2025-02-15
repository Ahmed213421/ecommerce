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
            href="{{ route('admin.news.index') }}">{{ trans('dashboard.news') }}</a></li>
@endsection

@section('content')
    <div class="bg-white p-4">
        <h2 class="mb-2 page-title"> {{ trans('dashboard.news') }}</h2>

        <a href="{{route('admin.news.create')}}" class="btn btn-primary">
            {{ trans('dashboard.create.post') }}
        </a>
        <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12 col-sm-6">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{ route('admin.news.destroy', 'test') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                {{-- {{ trans('My_Classes_trans.Warning_Grade') }} --}}
                                <input type="hidden" name="page" value="2">
                                <input type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                            </div>

                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary" --}}
                                {{-- data-bs-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button> --}}
                                <button type="submit"
                                    class="btn btn-danger deletebtn">{{ trans('dashboard.delete') }}</button>
                            </div>
                        </form>
                        <!-- table -->
                        <div id="dataTable-1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                            <div class="row">
                                <div class="col-sm-6 col-md-12  overflow-auto">
                                    <table class="table datatables dataTable no-footer" id="dataTable-1" role="grid"
                                        aria-describedby="dataTable-1_info">
                                        <thead>
                                            <tr role="row">
                                                <td>
                                                    <input type="checkbox" id="checkAll">

                                                </td>
                                                <td>#</th>
                                                <td>{{ trans('dashboard.name') }}</td>
                                                <td>{{ trans('dashboard.photo') }}</td>
                                                <td>{{ trans('dashboard.desc') }}</td>
                                                <td>{{ trans('category.sub') }}</td>
                                                <td>{{ trans('dashboard.admin') }}</td>
                                                <td>{{ trans('dashboard.created_at') }}</td>
                                                <td>{{ trans('dashboard.actions') }}</td>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach ($posts as $post)
                                            <tr role="row" class="even">
                                                <td>
                                                    <input type="checkbox" class="delete-checkbox" name="delete[]"
                                                        value="{{ $post->id }}">
                                                </td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><a href="{{route('admin.news.show',$post->id)}}">{{ $post->title }}</a></td>
                                                    <td><img src="{{asset($post->imagepath)}}" width="100px" alt="" srcset=""></td>
                                                    <td>{!! Str::limit(strip_tags($post->description), 90) !!}</td>
                                                    <td>{{$post->subcategory->name}}    </td>
                                                    <td>{{$post->admin->name}}    </td>
                                                    <td>{{ $post->created_at->diffForHumans() }}</td>
                                                    <td><button class="btn btn-sm dropdown-toggle more-horizontal"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <span
                                                                class="text-muted sr-only">{{ trans('dashboard.actions') }}</span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                                data-target="#modal{{ $post->id }}">
                                                                {{ trans('dashboard.delete') }}
                                                            </a>
                                                            <a class="dropdown-item" href="{{route('admin.news.edit',$post->id)}}">
                                                                {{ trans('dashboard.edit') }}
                                                            </a>
                                                        </div>
                                                    </td>
                                            </tr>
                                            @include('dashboard.news.delete')
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

<script>
    $(document).ready(function() {
        $('#categoryselect').change(function() {
            var categoryId = $(this).val();

            // Reset student dropdown
            $('#subSelect').empty().append('<option value="">Select a subcategory</option>').prop('disabled', true);

            if (categoryId) {
                $.ajax({
                    url: '/select/' + categoryId + '/subcategory',
                    method: 'GET',
                    success: function(data) {
                        $.each(data, function(index, sub) {
                            $('#subSelect').append('<option value="' + sub.id + '">' + sub.name + '</option>');
                        });
                        $('#subSelect').prop('disabled', false); // Enable student dropdown
                    }
                });
            }
        });
    });
</script>

<script language="javascript">
    $("#checkAll").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });



    //     $(document).ready(function(){
    // $(".btn").click(function(){
    //     $("#btn-delete-all").modal('show');
    // });
    // });
</script>

<script type="text/javascript">
    $(function() {

        $(".deletebtn").click(function() {


            var selected = [];
            $("input[type=checkbox]:checked").each(function() {
                selected.push(this.value);

            });



            if (selected.length > 0) {
                // $('#btn-delete-all').modal('show');
                $('input[id="delete_all_id"]').val(JSON.stringify(selected));
            }


        });
    });
</script>
@endsection
