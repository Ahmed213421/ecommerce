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
                    <h1>{{ trans('slider.contact_us') }}</h1>
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
						<h2>{{ trans('shop.anyq') }}</h2>
					</div>
				 	<div id="form_status"></div>
					<div class="contact-form">
						<form action="{{route('customer.us.store')}}" method="POST" id="fruitkha-contact" onSubmit="return valid_datas( this );">
                            @csrf
							<p>
								<input type="text" placeholder="Name" name="name" id="name">
								<input type="email" placeholder="Email" name="email" id="email">
							</p>
							<p>
								<input type="tel" placeholder="Phone" name="phone" id="phone">
								<input type="text" placeholder="Subject" name="subject" id="subject">
							</p>
							<p><textarea name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea></p>
							<input type="hidden" name="token" value="FsWga4&@f6aw" />
							<p><input type="submit" value="{{trans('general.submit')}}"></p>
						</form>
					</div>
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

@endsection
