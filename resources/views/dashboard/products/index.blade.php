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
            href="{{ route('admin.products.index') }}">{{ trans('dashboard.all_products') }}</a></li>
@endsection

@section('content')
    <div class="bg-white p-4">
        <h2 class="mb-2 page-title">{{ trans('dashboard.all_products') }}</h2>
        {{-- <button type="button" class="btn mb-2 btn-outline-secondary" data-toggle="modal" data-target="#varyModal" data-whatever="@mdo">{{ trans('dashboard.create_product') }}</button> --}}
        <a href="{{ route('admin.products.create') }}"
            class="btn mb-2 btn-outline-secondary">{{ trans('dashboard.create_product') }}</a>

        <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12 col-sm-6">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{ route('admin.products.destroy', 'test') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                {{-- {{ trans('My_Classes_trans.Warning_Grade') }} --}}
                                <input type="hidden" name="page" value="2">
                                <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
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
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="dataTable-1_length">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-12 overflow-auto">
                                    <table class="table datatables dataTable no-footer w-100" id="dataTable-1"
                                        role="grid" aria-describedby="dataTable-1_info">
                                        <thead>
                                            <tr role="row">
                                                <td>
                                                    <input type="checkbox" id="checkAll">

                                                </td>
                                                <td>#</td>
                                                <td>{{ trans('dashboard.name') }}</td>
                                                <td>{{ trans('dashboard.desc') }}</td>
                                                <td>{{ trans('dashboard.photo') }}</td>
                                                <td>{{ trans('dashboard.price') }}</td>
                                                <td>{{ trans('dashboard.discount') }}</td>
                                                <td>{{ trans('general.after') }} {{ trans('dashboard.discount') }}</td>
                                                <td>{{ trans('category.category') }}</td>
                                                <td>{{ trans('dashboard.quantity') }}</td>
                                                <td>{{ trans('dashboard.created_at') }}</td>
                                                <td>{{ trans('dashboard.actions') }}</td>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr role="row" class="even">
                                                    <td>
                                                        <input type="checkbox" class="delete-checkbox" name="delete[]"
                                                            value="{{ $product->id }}">
                                                    </td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->description }}</td>
                                                    <td><img src="{{ asset($product->imagepath) }}" alt=""
                                                            srcset="" class="img-fluid" style="width: 100px"></td>
                                                    <td>{{ $product->price }}</td>
                                                    <td>{{ $product->discount_percentage }}</td>
                                                    <td>{{ $product->price_after_discount }}</td>
                                                    <td><a
                                                            href="{{ route('admin.subcategory.show', $product->subcategory->id) }}">{{ $product->subcategory->name }}</a>
                                                    </td>
                                                    <td class="text-center">{{ $product->quantity }}</td>
                                                    <td>{{ $product->created_at->diffForHumans() }}</td>

                                                    <td><button class="btn btn-sm dropdown-toggle more-horizontal"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <span class="text-muted sr-only"></span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                                                class="dropdown-item">{{ trans('dashboard.edit') }}</a>
                                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                                data-target="#modalview{{ $product->id }}">
                                                                {{ trans('dashboard.view') }}
                                                            </a>
                                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                                data-target="#modal{{ $product->id }}">
                                                                {{ trans('dashboard.delete') }}
                                                            </a>

                                                        </div>
                                                    </td>
                                                    @include('dashboard.products.delete')
                                                    @include('dashboard.products.view')
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </div>
                            </div>
                        </div> <!-- simple table -->
                    </div>
                </div>
            @endsection

            @section('js')
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
                <script>
                    var currentLocale = '{{ app()->getLocale() }}';
                    console.log(currentLocale);

                    $('#dataTable-1').DataTable({
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
