@extends('shop.partials.master')

@section('title')
@endsection


@section('content')
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                        <h1>{{ trans('general.review') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="form-title">
                        <h2>{{ trans('general.review') }}</h2>
                    </div>
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="POST" id="fruitkha-contact" action="{{ route('customer.review.store') }}">
                            @csrf
                            @method('POST')
                            <p>
                                <input type="text" placeholder="Name" name="name" id="name"
                                    value="{{ old('name') }}">
                                <input type="email" placeholder="Email" name="email" id="email"
                                    value="{{ old('email') }}">
                            </p>
                            <p>
                                <input type="tel" placeholder="Phone" name="phone" id="phone"
                                    value="{{ old('phone') }}">
                                <input type="text" placeholder="Subject" name="subject" id="subject"
                                    value="{{ old('subject') }}">
                            </p>
                            <p>
                                <textarea name="message" id="message" cols="30" rows="10" placeholder="Message">{{ old('message') }}</textarea>
                            </p>
                            <p><input type="submit" value="{{trans('general.submit')}}"></p>
                        </form>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4">
					<div class="contact-form-wrap">
                        @foreach (App\Models\Setting::all() as $item)

						<div class="contact-form-box">
                            <h4><i class="fas fa-map"></i> {{ trans('general.address') }}</h4>
							{{$item->address}}
						</div>
						<div class="contact-form-box">
                            <h4><i class="far fa-clock"></i> {{ trans('general.workinghours') }}</h4>
							<p>{{$item->hours_working}}</p>
						</div>
						<div class="contact-form-box">
                            <h4><i class="fas fa-address-book"></i> {{ trans('shop.contact') }}</h4>
							<p>{{ trans('general.phone') }}: +{{$item->phone}} <br> {{ trans('general.email') }}: {{$item->email}}</p>
						</div>
                        @endforeach
					</div>
				</div>
            </div>
        </div>
    </div>

    @if (app()->getLocale() !== 'ar')
        <!-- testimonail-section -->
        <div class="testimonail-section mt-150 mb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-center">
                        <div class="testimonial-sliders">
                            @foreach (App\Models\Review::all() as $review)
                                <div class="single-testimonial-slider">
                                    <div class="client-avater">
                                        <img src="{{ asset($review->image) }}" alt="">
                                    </div>
                                    <div class="client-meta">
                                        <h3>{{ $review->name }} <span>{{ $review->subject }}</span></h3>
                                        <p class="testimonial-body">
                                            " {{ $review->message }} "
                                        </p>
                                        <div class="last-icon">
                                            <i class="fas fa-quote-right"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end testimonail-section -->
    @endif

@endsection
