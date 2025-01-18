@extends('dashboard.partials.master')

@section('title')

@endsection

@section('css')

@endsection

@section('titlepage')

@endsection

@section('breadcumb')
<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{ trans('dashboard.home') }}</a></li>
@endsection

@section('breadcumbactive')
<li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.category.index')}}">{{ trans('dashboard.all_cat') }}</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.category.show',$category->id)}}">{{$category->name}}</a></li>
@endsection

@section('content')
<div class="bg-white p-4">
    <h2 class="mb-2 page-title">{{ $category->name }}</h2>

    <div class="card">
        <div class="accordion" id="accordionExample">
            @foreach ($category->subcategories as $subcategory)

            <div class="card">
                <div class="card-header" id="headingTwo{{$loop->iteration}}">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo{{$loop->iteration}}" aria-expanded="false" aria-controls="collapseTwo{{$loop->iteration}}">
                            {{$subcategory->name}}
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo{{$loop->iteration}}" class="collapse" aria-labelledby="headingTwo{{$loop->iteration}}" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="row">
                            @forelse ($subcategory->products as $product)
                                <div class="col-md-4 mb-4">
                                    <div class="card shadow-sm">
                                        <img src="{{ asset($product->imagepath) }}" class="card-img-top img-fluid" alt="{{ $product->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <p class="card-text">
                                                {{ trans('dashboard.price') }}: <strong>${{ $product->price }}</strong> <br>
                                                {{ trans('dashboard.quantity') }}: <strong>{{ $product->quantity }} kg</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-md-4 mb-4">
                                    {{ trans('general.description') }}
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('dashboard.category.subcategory.delete')
        @include('dashboard.category.subcategory.edit')
        @endforeach

      </div>


</div>
@endsection

@section('js')

@endsection
