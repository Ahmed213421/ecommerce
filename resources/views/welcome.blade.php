@extends('shop.partials.master')

@section('css')
    <style>
        .slider-container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            flex: 0 0 100%;
            text-align: center;
            padding: 10px;
        }

        .slider-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        .slider-title {
            font-size: 1.5rem;
            margin-top: 10px;
        }

        .slider-description {
            font-size: 1rem;
            color: #666;
        }
    </style>
@endsection

@section('content')
    @if (app()->getLocale() !== 'ar')
        <!-- home page slider -->
        <div class="homepage-slider">
            <!-- single home slider -->


            @foreach (App\Models\Slider::get() as $slide)
                <div class="single-homepage-slider" style="background-image: url({{ asset($slide->imagepath) }})">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
                                <div class="hero-text">
                                    <div class="hero-text-tablecell">
                                        <p class="subtitle">{{ $slide->main_title }}</p>
                                        <h1>{{ $slide->branch_title }}</h1>
                                        <div class="hero-btns">
                                            <a href="#mostviewed" class="boxed-btn">Fruit Collection</a>
                                            <a href="{{ route('admin.users.index') }}" class="bordered-btn">Contact Us</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- single home slider -->
            <div class="single-homepage-slider homepage-bg-2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 text-center">
                            <div class="hero-text">
                                <div class="hero-text-tablecell">
                                    <p class="subtitle">Fresh Everyday</p>
                                    <h1>100% Organic Collection</h1>
                                    <div class="hero-btns">
                                        <a href="#mostviewed" class="boxed-btn">Visit Shop</a>
                                        <a href="{{ route('customer.us.index') }}" class="bordered-btn">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end home page slider -->
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (request('status') == 'success')
        <div class="alert alert-success">
            success
        </div>

    @endif
    {{--
	<!-- features list section -->
	<div class="list-section pt-80 pb-80">
		<div class="container">

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-shipping-fast"></i>
						</div>
						<div class="content">
                            <h3>Free Shipping</h3>
							<p>When order over $75</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
                        <div class="list-icon">
							<i class="fas fa-phone-volume"></i>
						</div>
						<div class="content">
							<h3>24/7 Support</h3>
							<p>Get support all day</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
                    <div class="list-box d-flex justify-content-start align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-sync"></i>
						</div>
						<div class="content">
                            <h3>Refund</h3>
							<p>Get refund within 3 days!</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- end features list section --> --}}

    <!-- product section -->
    <div class="product-section mt-150" id="mostviewed">
        <div class="container">
            <div class="row">
                <div class="offset-lg-2 {{ app()->getLocale() == 'ar' ? 'col-lg-12' : 'col-lg-8' }}  text-center">
                    <div class="section-title">
                        <h3><span class="orange-text"></span> {{ trans('general.most_view_prod') }}</h3>
                        <p></p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach (App\Models\Product::all() as $product)
                    <div class="col-md-4 text-center">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="{{ route('customer.product.show', $product->slug) }}"><img
                                        src="{{ asset($product->imagepath) }}" alt=""></a>
                            </div>
                            <h3><a href="{{ route('customer.product.show', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            <p class="product-price"><span>{{ trans('shop.per_kg') }}<br>
                                </span><del>{{ $product->price }}</del> {{ $product->price_after_discount }}$
                            </p>
                            @auth

                                <div class="favorite-icon">
                                    <i id="heart-{{ $product->id }}"
                                        class="fa fa-heart {{ $product->favoritedBy->contains(auth()->id()) ? 'active' : '' }}"
                                        onclick="toggleFavorite({{ $product->id }})"
                                        style="cursor: pointer; color: {{ $product->isFavoritedByUser ? 'red' : 'gray' }};">
                                    </i>
                                </div>
                            @endauth
                            <a href="{{ route('customer.cart.index') }}" class="cart-btn"
                                onclick="event.preventDefault();
                                        document.getElementById('add-product-to-cart-{{ $product->id }}').submit();">

                                <form id="add-product-to-cart-{{ $product->id }}"
                                    action="{{ route('customer.cart.product.add') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="productid">
                                    <input type="hidden" value="1" name="quantity">
                                </form>
                                <i class="fas fa-shopping-cart"></i> {{ trans('products.add_to_cart') }}
                            </a>


                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- end product section -->

    <!-- cart banner section -->
    <section class="cart-banner pt-100 pb-100">
        <div class="container">
            <div class="row clearfix">
                <!--Image Column-->
                <div class="image-column col-lg-6">
                    <div class="image">
                        <div class="price-box">
                            <div class="inner-price">
                                <span class="price">
                                    <strong>30%</strong> <br> off per kg
                                </span>
                            </div>
                        </div>
                        <img src="assets/img/a.jpg" alt="">
                    </div>
                </div>
                <!--Content Column-->
                <div class="content-column col-lg-6">
                    <h3><span class="orange-text">Deal</span> of the month</h3>
                    <h4>Hikan Strwaberry</h4>
                    <div class="text">Quisquam minus maiores repudiandae nobis, minima saepe id, fugit ullam similique!
                        Beatae, minima quisquam molestias facere ea. Perspiciatis unde omnis iste natus error sit voluptatem
                        accusant</div>
                    <!--Countdown Timer-->
                    <div class="time-counter">
                        <div class="time-countdown clearfix" data-countdown="2020/2/01">
                            <div class="counter-column">
                                <div class="inner"><span class="count">00</span>Days</div>
                            </div>
                            <div class="counter-column">
                                <div class="inner"><span class="count">00</span>Hours</div>
                            </div>
                            <div class="counter-column">
                                <div class="inner"><span class="count">00</span>Mins</div>
                            </div>
                            <div class="counter-column">
                                <div class="inner"><span class="count">00</span>Secs</div>
                            </div>
                        </div>
                    </div>
                    <a href="cart.html" class="cart-btn mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end cart banner section -->

    <div class="slider-container my-5">
        <div class="slider">
            @foreach (App\Models\Review::where('status', 1)->get() as $review)
                <div class="slide">
                    {{-- <img src="{{$}}" alt="Image 1" class="slider-image"> --}}
                    <h3 class="slider-title">{{ $review->name }}</h3>
                    <p class="slider-description">{{ $review->message }}.</p>
                </div>
            @endforeach
            <!-- Add more slides as needed -->
        </div>
    </div>


    <!-- advertisement section -->
    <div class="abt-section mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="abt-bg">
                        <a href="https://www.youtube.com/watch?v=DBLlFWYcIGQ" class="video-play-btn popup-youtube"><i
                                class="fas fa-play"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    @foreach (App\Models\Setting::all() as $item)
                        {!! $item->whoweare !!}
                    @endforeach
                    <a href="about.html" class="boxed-btn mt-4">know more</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- end advertisement section -->

    <!-- shop banner -->
    <section class="shop-banner">
        <div class="container">
            <h3>December sale is on! <br> with big <span class="orange-text">Discount...</span></h3>
            <div class="sale-percent"><span>Sale! <br> Upto</span>50% <span>off</span></div>
            <a href="shop.html" class="cart-btn btn-lg">Shop Now</a>
        </div>
    </section>
    <!-- end shop banner -->

    <!-- latest news -->
    <div class="latest-news pt-150 pb-150">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{ trans('dashboard.news') }}
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach (App\Models\Post::latest()->take(3)->get() as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-news">
                            <a href="{{ route('customer.news.show', $post->slug) }}" class="news-image">
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
                                <a href="{{ route('customer.news.show', $post->slug) }}"
                                    class="read-more-btn">{{ trans('general.readmore') }} <i
                                        class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="{{ route('customer.news.index') }}" class="boxed-btn">{{ trans('shop.more') }}
                        {{ trans('dashboard.news') }}</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end latest news -->

    <!-- logo carousel -->
    <div class="logo-carousel-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo-carousel-inner">
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/1.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/2.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/3.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/4.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/5.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end logo carousel -->
@endsection

@section('scripts')
    <script>
        function toggleFavorite(productId) {
            const heart = $(`#heart-${productId}`);

            $.ajax({
                url: `{{ route('customer.favorites.toggle', ':id') }}`.replace(':id', productId),
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    if (!response.success) {
                        heart.toggleClass('active');
                        // alert('Operation failed on the server.');
                    }
                },
                error: function(xhr) {
                    heart.toggleClass('active');
                    console.error('Error:', xhr.responseText);
                    alert('An error occurred! Please try again later.');
                },
            });
        }

        let currentIndex = 0;

        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;

        function changeSlide() {
            if (currentIndex >= totalSlides) {
                currentIndex = 0;
            }

            const slider = document.querySelector('.slider');
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;

            currentIndex++;
        }

        setInterval(changeSlide, 4000); // Change slide every 3 seconds
    </script>
@endsection
