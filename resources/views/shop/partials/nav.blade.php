<!-- header -->
<div class="top-header-area" id="sticker">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="index.html">
                            <img src="assets/img/logo.png" alt="">
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li class="current-list-item"><a href="{{ route('customer.home') }}">{{ trans('general.home') }}</a>
                                <ul class="sub-menu">
                                    <li><a href="index.html">Static Home</a></li>
                                    <li><a href="index_2.html">Slider Home</a></li>
                                </ul>
                            </li>
                            <li><a href="about.html">About</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="sub-menu">
                                    <li><a href="404.html">404 page</a></li>
                                    <li><a href="about.html">product</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="checkout.html">Check Out</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                    <li><a href="news.html">News</a></li>
                                    <li><a href="shop.html">Shop</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('customer.category.index') }}">{{ trans('category.categories') }}</a>
                                <ul class="sub-menu">
                                    @foreach (App\Models\Category::all() as $category)
                                        <li><a
                                                href="{{ route('customer.category.show', $category->slug) }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="news.html">News</a>
                                <ul class="sub-menu">
                                    <li><a href="news.html">News</a></li>
                                    <li><a href="single-news.html">Single News</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('customer.review.index') }}">{{ trans('shop.contact') }}</a></li>
                            <li><a href="{{ route('customer.review.index') }}">{{ trans('shop.reviews') }}</a></li>
                            {{-- <li><a href="{{ route('customer.product.index') }}">Reviews</a></li> --}}
                            <li><a href="{{ route('customer.shop') }}">{{ trans('shop.shop') }}</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('customer.shop') }}">Shop</a></li>
                                    <li><a href="checkout.html">Check Out</a></li>
                                    <li><a href="single-product.html">Single Product</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                </ul>
                            </li>
                            @guest
                            <li><a href="{{ route('customer.login') }}">{{ trans('general.login') }}</a>
                                <ul class="sub-menu">

                                    <li><a href="{{ route('customer.register') }}">{{ trans('general.register') }}</a></li>

                                </ul>
                            </li>
                            @endguest

                            @auth
                                <li class="dropdown">
                                    <a href="#">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('customer.settings.index')}}">{{ trans('dashboard.settings') }}</a></li>
                                        <li><a href="#">All Orders</a></li>
                                        <li><a href="{{route('customer.wishlist.index')}}">{{ trans('shop.wish') }}</a></li>
                                        <li>
                                            <a href="#"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                @endauth
                                <li class="dropdown">
                                    <a href="#">
                                        {{ trans('general.language') }} <span class="caret"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        @foreach (['en' => __('general.english'), 'ar' => __('general.arabic')] as $localeCode => $localeName)

                                        <li><a href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}">
                                            {{ $localeName }}
                                        </a></li>
                                    @endforeach
                                    </ul>
                                </li>
                            <li>
                                <div class="header-icons">
                                    <span class="badge badge-danger position-absolute top-0 start-100 translate-middle">
                                        {{ \App\Models\Cart::where('user_id', auth()->id())->sum('quantity') }}
                                    </span>
                                    <a class="shopping-cart" href="{{ route('customer.cart.index') }}"><i
                                            class="fas fa-shopping-cart"></i></a>
                                    <a class="mobile-hide search-bar-icon" href="#">

                                    <i class="fas fa-search"></i></a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                    <div class="mobile-menu"></div>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end header -->
