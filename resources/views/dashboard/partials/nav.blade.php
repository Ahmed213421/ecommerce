<div class="wrapper">
    <nav class="topnav navbar navbar-light">
      <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
      </button>
      <form class="form-inline mr-auto searchform text-muted" method="GET" action="{{route('admin.search',['search'=> 'search'])}}">
        @csrf
        <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" name="search" aria-label="Search">
      </form>
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
            <i class="fe fe-sun fe-16"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
            <span class="fe fe-grid fe-16"></span>
          </a>
        </li>
        <li class="nav-item nav-notif position-relative">
            <a class="nav-link text-muted my-2 position-relative counternot" href="./#" data-toggle="modal" data-target=".modal-notif">
              <span class="fe fe-bell fe-16"></span>
              <span class="badge badge-pill badge-success position-absolute top-0 start-100 translate-middle dot" style="font-size: 12px; padding: 4px 7px; border-radius: 50%;top:0px">
                {{count(Auth::guard('admin')->user()->unreadnotifications)}}
              </span>
            </a>
          </li>




        @auth('admin')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                    <img src="{{ asset(Auth::guard('admin')->user()->image?->imagepath)  }}"  style="height: 32px" alt="..." class="avatar-img rounded-circle rounded-circle">
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item text-dark">{{ auth('admin')->user()->name }}</a>
                <a class="dropdown-item" href="{{route('admin.profile.index')}}">{{ trans('general.settings') }}</a>
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ trans('general.logout') }}</a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
        @endauth


      <li class="nav-item dropdown mt-2">
        <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLinklang" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="avatar avatar-sm mt-2">
              {{ app()->getLocale() == 'ar' ? trans('general.arabic') : trans('general.english') }}
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLinklang">
              @foreach (['en' => __('general.english'), 'ar' => __('general.arabic')] as $localeCode => $localeName)

                <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}">
                    {{ $localeName }}
                </a>
            @endforeach
        </div>
      </li>
    </ul>
    </nav>
