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
    <li class="breadcrumb-item active" aria-current="page">{{ Request('search') }}</li>
@endsection

@section('content')
    <div class="bg-white p-4">
        <h2 class="mb-2 page-title">{{ trans('shop.search_for') }} {{ Request('search') }}</h2>

        <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-12 overflow-auto">
                                @if ($no_results)
                                    <div class="no-results">
                                        <p>{{ trans('general.noresult') }}.</p>
                                        <form action="{{ route('admin.search', ['search' => 'search']) }}" method="GET">
                                            <input type="text" name="search"
                                                class="search-input">
                                            <button type="submit"
                                                class="search-button btn btn-primary">{{ trans('general.search') }}</button>
                                        </form>
                                    </div>
                                @endif

                                @if ($products->count() > 0)
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
                                                            <td>#</td>
                                                            <td>{{ trans('dashboard.name') }}</td>
                                                            <td>{{ trans('dashboard.desc') }}</td>
                                                            <td>{{ trans('dashboard.photo') }}</td>
                                                            <td>{{ trans('dashboard.price') }}</td>
                                                            <td>{{ trans('dashboard.discount') }}</td>
                                                            <td>{{ trans('general.after') }}
                                                                {{ trans('dashboard.discount') }}</td>
                                                            <td>{{ trans('category.category') }}</td>
                                                            <td>{{ trans('dashboard.quantity') }}</td>
                                                            <td>{{ trans('dashboard.created_at') }}</td>
                                                            <td>{{ trans('dashboard.actions') }}</td>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($products as $product)
                                                            <tr role="row" class="even">
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $product->name }}</td>
                                                                <td>{{ $product->description }}</td>
                                                                <td><img src="{{ asset($product->imagepath) }}"
                                                                        alt="" srcset="" class="img-fluid"
                                                                        style="width: 100px"></td>
                                                                <td>{{ $product->price }}</td>
                                                                <td>{{ $product->discount_percentage }}</td>
                                                                <td>{{ $product->price_after_discount }}</td>
                                                                <td><a
                                                                        href="{{ route('admin.subcategory.show', $product->subcategory->id) }}">{{ $product->subcategory->name }}</a>
                                                                </td>
                                                                <td class="text-center">{{ $product->quantity }}</td>
                                                                <td>{{ $product->created_at->diffForHumans() }}</td>

                                                                <td><button
                                                                        class="btn btn-sm dropdown-toggle more-horizontal"
                                                                        type="button" data-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false">
                                                                        <span class="text-muted sr-only"></span>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                                                            class="dropdown-item">{{ trans('dashboard.edit') }}</a>
                                                                        <a class="dropdown-item" href="#"
                                                                            data-toggle="modal"
                                                                            data-target="#modal{{ $product->id }}">
                                                                            {{ trans('dashboard.delete') }}
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                                @include('dashboard.products.delete')
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                            </div>
                                        </div>
                                    </div> <!-- simple table -->
                                @endif

                                @if ($categories->count() > 0)
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
                                            @foreach ($categories as $category)
                                                <tr role="row" class="even">
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
                                                            <a class="dropdown-item" href="#" data-toggle="modal"
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
                                @endif
                                @if ($subcategories->count() > 0)
                                    <div id="dataTable-1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
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
                                                        @foreach ($subcategories as $subcategory)
                                                            <tr role="row" class="even">
                                                                </td>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>
                                                                    @if (app()->getLocale() == 'en')
                                                                        <a
                                                                            href="{{ route('admin.subcategory.show', $subcategory->id) }}">{{ $subcategory->name }}</a>
                                                                        <span>></span>
                                                                        <a
                                                                            href="{{ route('admin.category.show', $subcategory->category->id) }}">{{ $subcategory->category->name }}</a>
                                                                    @else
                                                                        <a
                                                                            href="{{ route('admin.category.show', $subcategory->category->id) }}">{{ $subcategory->category->name }}</a>
                                                                        <span>
                                                                            < </span>
                                                                                <a
                                                                                    href="{{ route('admin.subcategory.show', $subcategory->id) }}">{{ $subcategory->name }}</a>
                                                                    @endif
                                                                </td>
                                                                <td><img src="{{ asset($subcategory->imagepath) }}"
                                                                        width="100px" alt="" srcset="">
                                                                </td>
                                                                <td>{{ $subcategory->category->description }}</td>
                                                                <td>{{ $subcategory->created_at->diffForHumans() }}</td>
                                                                <td><button
                                                                        class="btn btn-sm dropdown-toggle more-horizontal"
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
                                @endif
                                @if ($posts->count() > 0)
                                    <table class="table datatables dataTable no-footer" id="dataTable-1" role="grid"
                                        aria-describedby="dataTable-1_info">
                                        <thead>
                                            <tr role="row">
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
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><a
                                                            href="{{ route('admin.news.show', $post->id) }}">{{ $post->title }}</a>
                                                    </td>
                                                    <td><img src="{{ asset($post->imagepath) }}" width="100px"
                                                            alt="" srcset=""></td>
                                                    <td>{!! Str::limit(strip_tags($post->description), 90) !!}</td>
                                                    <td>{{ $post->subcategory->name }} </td>
                                                    <td>{{ $post->admin->name }} </td>
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
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.news.edit', $post->id) }}">
                                                                {{ trans('dashboard.edit') }}
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @include('dashboard.news.delete')
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                                @if ($tags->count() > 0)
                                    <!-- table -->
                                    <div id="dataTable-1_wrapper"
                                        class="dataTables_wrapper dt-bootstrap4 no-footer w-100">

                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <table class="table datatables dataTable no-footer" id="dataTable-1"
                                                    role="grid" aria-describedby="dataTable-1_info">
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
                                                                <td><button
                                                                        class="btn btn-sm dropdown-toggle more-horizontal"
                                                                        type="button" data-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false">
                                                                        <span
                                                                            class="text-muted sr-only">{{ trans('dashboard.actions') }}</span>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class="dropdown-item" href="#"
                                                                            data-toggle="modal"
                                                                            data-target="#modaledit{{ $tag->id }}">
                                                                            {{ trans('dashboard.edit') }}
                                                                        </a>
                                                                        <a class="dropdown-item" href="#"
                                                                            data-toggle="modal"
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
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
