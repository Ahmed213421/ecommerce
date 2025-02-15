<!-- header -->
<div class="top-header-area" id="sticker" style="{{app()->getLocale() == 'ar' ? 'background:#051922' : ''}}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        @foreach (App\Models\Setting::all() as $item)

                        <a href="{{route('customer.home')}}">
                            <img class="w-25" src="{{ $item->logo ? asset($item->logo) : asset('assets/img/logo.png') }}" alt="">
                        </a>
                        @endforeach
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li class="{{Route::is('customer.home') ? 'current-list-item' : ''}}"><a
                                    href="{{ route('customer.home') }}">{{ trans('general.home') }}</a>

                            </li>
                            {{-- <li><a href="about.html">About</a></li> --}}

                            <li class="{{Route::is('customer.category.*') ? 'current-list-item' : ''}}"><a href="{{ route('customer.category.index') }}">{{ trans('category.categories') }}</a>
                                <ul class="sub-menu">
                                    @foreach (App\Models\Category::all() as $category)
                                        <li><a class="{{Route::is('customer.category.show', $category->slug ) ? 'text-primary' : ''}}"
                                                href="{{ route('customer.category.show', $category->slug) }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="{{Route::is('customer.news.*') ? 'current-list-item' : ''}}"><a href="{{ route('customer.news.index') }}">{{ trans('dashboard.news') }}</a>

                            </li>
                            <li class="{{Route::is('customer.us.*') ? 'current-list-item' : ''}}"><a href="{{ route('customer.us.index') }}">{{ trans('slider.contact_us') }}</a></li>
                            <li class="{{Route::is('customer.review.*') ? 'current-list-item' : ''}}"><a href="{{ route('customer.review.index') }}">{{ trans('shop.reviews') }}</a></li>
                            {{-- <li><a href="{{ route('customer.product.index') }}">Reviews</a></li> --}}
                            <li class="{{Route::is('customer.shop')  ? 'current-list-item' : ''}}"><a href="{{ route('customer.shop') }}">{{ trans('shop.shop') }}</a>
                                <ul class="sub-menu">
                                    <li><a class="{{Route::is('customer.cart.index') ? 'text-primary' : ''}}" href="{{route('customer.cart.index')}}">{{ trans('general.cart') }}</a></li>
                                </ul>
                            </li>
                            @guest
                                <li class="{{Route::is('customer.login') || Route::is('customer.register') ? 'current-list-item' : ''}}"><a href="{{ route('customer.login') }}">{{ trans('general.login') }}</a>
                                    <ul class="sub-menu">

                                        <li><a class="{{Route::is('customer.register') ? 'text-primary' : ''}}" href="{{ route('customer.register') }}">{{ trans('general.register') }}</a>
                                        </li>

                                    </ul>
                                </li>
                            @endguest

                            @auth
                                <li class="dropdown">
                                    <a href="#">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a
                                                href="{{ route('customer.settings.index') }}">{{ trans('dashboard.settings') }}</a>
                                        </li>
                                        <li><a href="{{route('customer.orders.index')}}">{{ trans('general.all') }} {{ trans('general.orders') }}</a></li>
                                        <li><a href="{{ route('customer.wishlist.index') }}">{{ trans('shop.wish') }}</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ trans('general.logout') }}</a>
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
                                    {{ app()->getLocale() == 'ar' ? trans('general.arabic') : trans('general.english') }} <span class="caret"></span>
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
                                        @php
                                            $cart = session('cart', []);
                                            $cartCount = count($cart);
                                        @endphp
                                        @auth
                                            {{ \App\Models\Cart::where('user_id', auth()->id())->sum('quantity') }}

                                        @endauth
                                        @guest
                                            {{ $cartCount }}
                                        @endguest
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
