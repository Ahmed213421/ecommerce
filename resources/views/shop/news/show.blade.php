@extends('shop.partials.master')

@section('css')

@endsection

@section('title')
@endsection


@section('content')
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                        <h1>{{ $post->title }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row">
				<div class="col-lg-8">
					<div class="single-article-section">
						<div class="single-article-text">
							<div class="single-artcile-bg"></div>
							<p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i> {{$post->admin->name}}</span>
								<span class="date"><i class="fas fa-calendar"></i> {{ $post->created_at->format('d F, Y') }}</span>
							</p>
                            {!! $post->description !!}

                            <div class="comments-list-wrap">
                                <h3 class="comment-count-title">{{$post->comments->count()}} {{ trans('general.comments') }}</h3>
                                <div class="comment-list">
                                    @foreach ($post->comments as $comment)

                                        <div class="single-comment-body">
                                            <div class="comment-user-avater">
                                                <img src="assets/img/avaters/avatar1.png" alt="">
                                            </div>
                                            <div class="comment-text-body">
                                                <h4>{{$comment->name}} <span class="comment-date">{{$comment->created_at->diffForHumans()}}</span></h4>
                                                <p>{{$comment->message}}.</p>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>


						<div class="comment-template">
							<h4>{{trans('general.leavecomment')}}</h4>
							<form action="{{route('customer.comments.store')}}" method="POST">
                                @csrf
								<p>
									<input type="text" placeholder="Your Name" name="name">
									<input type="email" placeholder="Your Email" name="email">
									<input type="hidden" value="{{$post->id}}" name="postid">
								</p>
								<p><textarea name="message" id="comment" cols="30" rows="10" placeholder="Your Message"></textarea></p>
								<p><input type="submit" value="{{trans('general.submit')}}"></p>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="sidebar-section">
						<div class="recent-posts">
							<h4>{{ trans('shop.recent') }}</h4>
							<ul>
                                @foreach ($posts as $post)
                                    <li><a href="{{route('customer.news.show',$post->slug)}}">{{$post->title}}.</a></li>
                                @endforeach
							</ul>
						</div>
						<div class="tag-section">
							<h4>{{ trans('dashboard.tags') }}</h4>
							<ul>
                                @foreach ($post->tags as $tag)
								<li><a href="#">{{$tag->name}}</a></li>
                                @endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>



@endsection

@section('scripts')


@endsection
