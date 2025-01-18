@extends('shop.partials.master')

@section('title')
@endsection


@section('content')
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div>Get 24/7 Support</p>
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
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, ratione! Laboriosam est,
                            assumenda. Perferendis, quo alias quaerat aliquid. Corporis ipsum minus voluptate? Dolore, esse
                            natus!</p>
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
                            <p><input type="submit" value="Submit"></p>
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
                        <div class="contact-form-box">
                            <h4><i class="fas fa-map"></i> Shop Address</h4>
                            <p>34/8, East Hukupara <br> Gifirtok, Sadan. <br> Country Name</p>
                        </div>
                        <div class="contact-form-box">
                            <h4><i class="far fa-clock"></i> Shop Hours</h4>
                            <p>MON - FRIDAY: 8 to 9 PM <br> SAT - SUN: 10 to 8 PM </p>
                        </div>
                        <div class="contact-form-box">
                            <h4><i class="fas fa-address-book"></i> Contact</h4>
                            <p>Phone: +00 111 222 3333 <br> Email: support@fruitkha.com</p>
                        </div>
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
