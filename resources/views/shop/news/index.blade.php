@extends('shop.partials.master')

@section('css')
    <style>
        .news-image img {
            width: 300px;
            height: 200px;
            object-fit: cover;
            display: block;
            margin: 0 auto;
            border-radius: 8px;
        }
    </style>
@endsection

@section('title')
@endsection


@section('content')
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>{{ trans('dashboard.news') }}</h1>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- end breadcrumb section -->

    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-news">
                            <a href="{{route('customer.news.show',$post->slug)}}" class="news-image">
                                <img src="{{ asset($post->imagepath) }}" alt="News Image">
                            </a>
                            <div class="news-text-box">
                                <h3><a href="single-news.html">{{ $post->title }}.</a></h3>
                                <p class="blog-meta">
                                    <span class="author"><i class="fas fa-user"></i> {{ $post->admin->name }}</span>
                                    <span class="date"><i class="fas fa-calendar"></i>
                                        {{ $post->created_at->format('d F, Y') }}</span>
                                </p>
                                <p class="excerpt">{!! Str::limit(strip_tags($post->description), 200) !!}
                                    .</p>
                                <a  href="{{route('customer.news.show',$post->slug)}}" class="read-more-btn">{{ trans('general.readmore') }} <i
                                        class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{$posts->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>

@endsection
