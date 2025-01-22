@extends('dashboard.partials.master')

@section('title')
@endsection

@section('css')
@endsection

@section('breadcumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
<li class="breadcrumb-item active" aria-current="page"><a href="#">{{ trans('dashboard.all_cat') }}</a></li>
@endsection

@section('content')
<div class="bg-white p-4">
<h2 class="mb-2 page-title">{{ trans('category.categories') }}</h2>
{{-- <button type="button" class="btn mb-2 btn-outline-secondary" data-toggle="modal" data-target="#varyModal" data-whatever="@mdo">{{ trans('dashboard.create_product') }}</button> --}}

<div class="row my-4">
    <!-- Small table -->
    <div class="col-md-12 col-sm-6">
        <div class="card shadow">
            <div class="card-body">
                <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                            role="tab" aria-controls="pills-home"
                            aria-selected="true">{{ trans('category.sub') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                            role="tab" aria-controls="pills-profile"
                            aria-selected="false">{{ trans('category.categories') }}</a>
                    </li>
                </ul>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('dashboard.create_cat') }}
                </button>
                <div class="tab-content mb-1" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <!-- table -->
                        <div id="dataTable-1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            {{-- <div class="row">
        </div> --}}
                            <div class="row">
                                <div class="col-sm-6 col-md-12 overflow-auto">
                                    <table class="table datatables dataTable no-footer w-100" id="dataTable-1"
                                        role="grid" aria-describedby="dataTable-1_info">
                                        <thead>
                                            <tr role="row">
                                                <td>#</th>
                                                <td>{{ trans('dashboard.name') }}</td>
                                                <td>{{ trans('dashboard.photo') }}</td>
                                                <td>{{ trans('dashboard.desc') }}</td>
                                                <td>{{ trans('dashboard.created_at') }}</td>
                                                <td>{{ trans('dashboard.actions') }}</td>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <tr role="row" class="even">
                                                @foreach ($subcategories as $subcategory)
                                                    </td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a
                                                            href="{{ route('admin.subcategory.show', $subcategory->id) }}">{{ $subcategory->name }}</a>
                                                        <span> > </span>
                                                        <a
                                                            href="{{ route('admin.category.show', $subcategory->category->id) }}">{{ $subcategory->category->name }}</a>
                                                    </td>
                                                    <td><img src="{{ asset($subcategory->imagepath) }}"
                                                            width="100px" alt="" srcset=""></td>
                                                    <td>{{ $subcategory->category->description }}</td>
                                                    <td>{{ $subcategory->created_at->diffForHumans() }}</td>
                                                    <td><button class="btn btn-sm dropdown-toggle more-horizontal"
                                                            type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <span
                                                                class="text-muted sr-only">{{ trans('dashboard.actions') }}</span>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#"
                                                                data-toggle="modal"
                                                                data-target="#deletesub{{ $subcategory->id }}">
                                                                {{ trans('dashboard.delete') }}
                                                            </a>
                                                            <a class="dropdown-item" href="#"
                                                                data-toggle="modal"
                                                                data-target="#editsub{{ $subcategory->id }}">
                                                                {{ trans('dashboard.edit') }}
                                                            </a>

                                                        </div>
                                                    </td>
                                            </tr>
                                            @include('dashboard.category.subcategory.delete')
                                            @include('dashboard.category.subcategory.edit')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                        aria-labelledby="pills-profile-tab">
                        <div class="row">
                            <div class="col-sm-12 col-md-12  overflow-auto">
                                <table class="table datatables dataTable no-footer" id="dataTable-2" role="grid"
                                    aria-describedby="dataTable-1_info" style="width: 100%">
                                    <thead>
                                        <tr role="row">
                                            <td>#</th>
                                            <td>{{ trans('dashboard.name') }}</td>
                                            <td>{{ trans('dashboard.photo') }}</td>
                                            <td>{{ trans('dashboard.desc') }}</td>
                                            <td>{{ trans('dashboard.created_at') }}</td>
                                            <td>{{ trans('dashboard.actions') }}</td>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr role="row" class="even">
                                            @foreach ($categories as $category)
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a
                                                        href="{{ route('admin.category.show', $category->id) }}">{{ $category->name }}</a>
                                                </td>
                                                <td><img src="{{ asset($category->imagepath) }}" width="100px"
                                                        alt="" srcset=""></td>
                                                <td>{{ $category->description }}</td>
                                                <td>{{ $category->created_at->diffForHumans() }}</td>
                                                <td><button class="btn btn-sm dropdown-toggle more-horizontal"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <span
                                                            class="text-muted sr-only">{{ trans('dashboard.actions') }}</span>
                                                    </button>

                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#modal{{ $category->id }}">
                                                            {{ trans('dashboard.delete') }}
                                                        </a>
                                                        <a class="dropdown-item" href="#"
                                                            data-toggle="modal"
                                                            data-target="#modaledit{{ $category->id }}">
                                                            {{ trans('dashboard.edit') }}
                                                        </a>

                                                    </div>
                                                </td>
                                        </tr>
                                        @include('dashboard.category.delete')
                                        @include('dashboard.category.edit')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.category.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @method('POST')
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ trans('dashboard.name') }}
                                {{ trans('dashboard.ineng') }}</label>
                            <input type="text" class="form-control" id="name" name="name_en"
                                placeholder="Enter category name">
                        </div>

                        <div class="form-group">
                            <label for="name">{{ trans('dashboard.name') }}
                                {{ trans('dashboard.inarabic') }}</label>
                            <input type="text" class="form-control" id="name" name="name_ar"
                                placeholder="Enter category name">
                        </div>

                        <div class="form-group">
                            <label for="description">{{ trans('dashboard.desc') }}
                                {{ trans('dashboard.ineng') }}</label>
                            <textarea class="form-control" id="description" name="description_en" rows="4"
                                placeholder="Enter category description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('dashboard.desc') }}
                                {{ trans('dashboard.inarabic') }}</label>
                            <textarea class="form-control" id="description" name="description_ar" rows="4"
                                placeholder="Enter category description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">{{ trans('dashboard.photo') }}</label>
                            <input type="file" class="form-control" id="image" name="image"
                                accept="image/*">
                        </div>

                        <div class="form-group">
                            <label for="category">{{ trans('dashboard.select_category') }}</label>
                            <select class="form-control" id="category" name="category_id">
                                <option value="">{{ trans('dashboard.new_category') }}</option>
                                @foreach (App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('dashboard.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('general.submit') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#dataTable-2').DataTable({
            autoWidth: true,
            "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ]
        });
    </script>
    <script>
        $('#dataTable-1').DataTable({
            autoWidth: true,
            "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ]
        });
    </script>
@endsection
