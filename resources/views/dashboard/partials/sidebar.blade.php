<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
      <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
      <!-- nav bar -->
      <div class="w-100 mb-4 d-flex">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{route('admin.dashboard')}}">
          <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
            <g>
              <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
              <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
              <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
            </g>
          </svg>
        </a>
      </div>
      <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item w-100">
            <a class="nav-link {{Route::is('admin.dashboard') ? 'activelink' : ''}}" href="{{route('admin.dashboard')}}">
                <i class="fe fe-home fe-16"></i>
              <span class="ml-3 item-text">{{ trans('dashboard.dashboard') }}</span>
            </a>
          </li>
      </ul>
      {{-- <p class="text-muted nav-heading mt-4 mb-1">
        <span>Components</span>
      </p> --}}
      <ul class="navbar-nav flex-fill w-100 mb-2">
          <li class="nav-item dropdown {{Route::is('admin.category.*') ? 'active' : ''}}">
            <a href="#ui-elements1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link {{Route::is('admin.category.*') ? 'activelink' : ''}}">
                <i class="fa-solid fa-layer-group"></i>
              <span class="ml-3 item-text">{{ trans('category.categories') }}</span>
            </a>
            <ul class="collapse list-unstyled pl-4 w-100 {{Route::is('admin.category.*') ? 'show' : ''}}" id="ui-elements1">
              <li class="nav-item">
                <a class="nav-link pl-3" href="{{route('admin.category.index')}}"><span class="ml-1 item-text">{{ trans('general.all') }} {{ trans('category.categories')  }}</span>
                </a>
              </li>
            </ul>
          </li>
        <li class="nav-item dropdown {{Route::is('admin.products.*') ? 'active' : ''}}">
          <a href="#ui-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link {{Route::is('admin.products.*') ? 'activelink' : ''}}">
            <i class="fa-solid fa-box"></i>
            <span class="ml-3 item-text">{{ trans('dashboard.products') }}</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100 {{Route::is('admin.products.*') ? 'show' : ''}}" id="ui-elements">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{route('admin.products.index')}}"><span class="ml-1 item-text">{{ trans('dashboard.all_products') }}</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown {{Route::is('admin.news.*') ? 'active' : ''}}">
          <a href="#news" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link {{Route::is('admin.news.*') ? 'activelink' : ''}}">
            <i class="fa-regular fa-newspaper"></i>
            <span class="ml-3 item-text"> {{ trans('dashboard.news') }}</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100 {{Route::is('admin.news.*') ? 'show' : ''}}" id="news">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{route('admin.news.index')}}"><span class="ml-1 item-text">{{ trans('dashboard.all') }} {{ trans('dashboard.news') }}</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown {{Route::is('admin.users.*') || Route::is('admin.roles.*') || Route::is('admin.permissions.*') ? 'active' : ''}}">
          <a href="#permission" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link {{Route::is('admin.news.*') ? 'activelink' : ''}}">
            <i class="fa-regular fa-user"></i>
            <span class="ml-3 item-text"> {{ trans('spatie.users') }}</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100 {{Route::is('admin.news.*') ? 'show' : ''}}" id="permission">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{route('admin.users.index')}}"><span class="ml-1 item-text">{{ trans('spatie.users') }} </span>
              <a class="nav-link pl-3" href="{{route('admin.permissions.index')}}"><span class="ml-1 item-text">{{ trans('spatie.perrmisssions') }} </span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
      <p class="text-muted nav-heading mt-4 mb-1">
        <span>{{ trans('shop.pages') }}</span>
      </p>
      <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item w-100">
          <a class="nav-link {{Route::is('admin.setting.index') ? 'activelink' : ''}}" href="{{route('admin.setting.index')}}">
            <i class="fa-solid fa-gear"></i>
            <span class="ml-3 item-text">{{ trans('dashboard.settings') }}</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link {{Route::is('admin.subscribers.index') ? 'activelink' : ''}}" href="{{route('admin.subscribers.index')}}">
            <i class="fa-regular fa-bell"></i>
            <span class="ml-3 item-text">{{ trans('general.subscribers') }}</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link {{Route::is('admin.subscribers.index') ? 'activelink' : ''}}" href="{{route('admin.orders.index')}}">
            <i class="fa-solid fa-cart-shopping"></i>
            <span class="ml-3 item-text">{{ trans('general.orders') }}</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link {{Route::is('admin.slider.index') ? 'activelink' : ''}}" href="{{route('admin.slider.index')}}">
            <i class="fa-solid fa-sliders"></i>
            <span class="ml-3 item-text">{{ trans('dashboard.slider') }}</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link {{Route::is('admin.slider.index') ? 'activelink' : ''}}" href="{{route('admin.tags.index')}}">
            <i class="fa-solid fa-key"></i>
            <span class="ml-3 item-text">{{ trans('dashboard.tags') }}</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link {{Route::is('admin.testmonials.index') ? 'activelink' : ''}}" href="{{route('admin.testmonials.index')}}">
            <i class="fa-regular fa-star"></i>
            {{-- <span class="ml-3 item-text">{{ trans('general.review') }}</span> --}}
            <span class="ml-3 item-text">{{ trans('general.testmonials') }}</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link {{Route::is('admin.reviews.index') ? 'activelink' : ''}}" href="{{route('admin.review.index')}}">
            <i class="fa-regular fa-star"></i>
            <span class="ml-3 item-text">{{ trans('general.review') }}</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link {{Route::is('admin.contact.index') ? 'activelink' : ''}}" href="{{route('admin.contact.index')}}">
            <i class="fa-regular fa-address-book"></i>
            <span class="ml-3 item-text">{{ trans('general.contact') }}</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link {{Route::is('admin.customers.index') ? 'activelink' : ''}}" href="{{route('admin.customers.index')}}">
            <i class="fa-solid fa-circle-user"></i>
            <span class="ml-3 item-text">{{ trans('dashboard.customers') }}</span>
          </a>
        </li>

    </nav>
  </aside>
