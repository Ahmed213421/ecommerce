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
              <span class="ml-3 item-text">{{ trans('dashboard.dashboard') ?: 'Dashboard' }}</span>
            </a>
          </li>
      </ul>
      {{-- <p class="text-muted nav-heading mt-4 mb-1">
        <span>Components</span>
      </p> --}}
      <ul class="navbar-nav flex-fill w-100 mb-2">
          <li class="nav-item dropdown {{Route::is('admin.category.*') ? 'active' : ''}}">
            <a href="#ui-elements1" data-toggle="collapse" aria-expanded="{{Route::is('admin.category.*') ? 'true' : 'false'}}" class="dropdown-toggle nav-link {{Route::is('admin.category.*') ? 'activelink' : ''}}">
                <i class="fa-solid fa-layer-group"></i>
              <span class="ml-3 item-text">{{ trans('category.categories') ?: 'Categories' }}</span>
            </a>
            <ul class="collapse list-unstyled pl-4 w-100 {{Route::is('admin.category.*') ? 'show' : ''}}" id="ui-elements1">
              <li class="nav-item">
                <a class="nav-link pl-3" href="{{route('admin.category.index')}}"><span class="ml-1 item-text">{{ trans('general.all') }} {{ trans('category.categories')  }}</span>
                </a>
              </li>
            </ul>
          </li>
        <li class="nav-item dropdown {{Route::is('admin.products.*') ? 'active' : ''}}">
          <a href="#ui-elements" data-toggle="collapse" aria-expanded="{{Route::is('admin.products.*') ? 'true' : 'false'}}" class="dropdown-toggle nav-link {{Route::is('admin.products.*') ? 'activelink' : ''}}">
            <i class="fa-solid fa-box"></i>
            <span class="ml-3 item-text">{{ trans('dashboard.products') ?: 'Products' }}</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100 {{Route::is('admin.products.*') ? 'show' : ''}}" id="ui-elements">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{route('admin.products.index')}}"><span class="ml-1 item-text">{{ trans('dashboard.all_products') }}</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown {{Route::is('admin.news.*') ? 'active' : ''}}">
          <a href="#news" data-toggle="collapse" aria-expanded="{{Route::is('admin.news.*') ? 'true' : 'false'}}" class="dropdown-toggle nav-link {{Route::is('admin.news.*') ? 'activelink' : ''}}">
            <i class="fa-regular fa-newspaper"></i>
            <span class="ml-3 item-text">{{ trans('dashboard.news') ?: 'News' }}</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100 {{Route::is('admin.news.*') ? 'show' : ''}}" id="news">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{route('admin.news.index')}}"><span class="ml-1 item-text">{{ trans('dashboard.all') }} {{ trans('dashboard.news') }}</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown {{Route::is('admin.users.*') || Route::is('admin.roles.*') || Route::is('admin.permissions.*') ? 'active' : ''}}">
          <a href="#permission" data-toggle="collapse" aria-expanded="{{Route::is('admin.users.*') || Route::is('admin.roles.*') || Route::is('admin.permissions.*') ? 'true' : 'false'}}" class="dropdown-toggle nav-link {{Route::is('admin.users.*') || Route::is('admin.roles.*') || Route::is('admin.permissions.*') ? 'activelink' : ''}}">
            <i class="fa-regular fa-user"></i>
            <span class="ml-3 item-text">{{ trans('spatie.users') ?: 'Users' }}</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100 {{Route::is('admin.users.*') || Route::is('admin.roles.*') || Route::is('admin.permissions.*') ? 'show' : ''}}" id="permission">
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{route('admin.users.index')}}"><span class="ml-1 item-text">{{ trans('spatie.users') }} </span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{route('admin.permissions.index')}}"><span class="ml-1 item-text">{{ trans('spatie.perrmisssions') }} </span></a>
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
            <span class="ml-3 item-text">{{ trans('dashboard.settings') ?: 'Settings' }}</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link {{Route::is('admin.subscribers.index') ? 'activelink' : ''}}" href="{{route('admin.subscribers.index')}}">
            <i class="fa-regular fa-bell"></i>
            <span class="ml-3 item-text">{{ trans('general.subscribers') }}</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link {{Route::is('admin.orders.*') ? 'activelink' : ''}}" href="{{route('admin.orders.index')}}">
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
          <a class="nav-link {{Route::is('admin.tags.*') ? 'activelink' : ''}}" href="{{route('admin.tags.index')}}">
            <i class="fa-solid fa-key"></i>
            <span class="ml-3 item-text">{{ trans('dashboard.tags') }}</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link {{Route::is('admin.testmonials.*') ? 'activelink' : ''}}" href="{{route('admin.testmonials.index')}}">
            <i class="fa-regular fa-star"></i>
            {{-- <span class="ml-3 item-text">{{ trans('general.review') }}</span> --}}
            <span class="ml-3 item-text">{{ trans('general.testmonials') }}</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link {{Route::is('admin.review.*') ? 'activelink' : ''}}" href="{{route('admin.review.index')}}">
            <i class="fa-regular fa-star"></i>
            <span class="ml-3 item-text">{{ trans('general.review') }}</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link {{Route::is('admin.contact.*') ? 'activelink' : ''}}" href="{{route('admin.contact.index')}}">
            <i class="fa-regular fa-address-book"></i>
            <span class="ml-3 item-text">{{ trans('general.contact') }}</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link {{Route::is('admin.customers.*') ? 'activelink' : ''}}" href="{{route('admin.customers.index')}}">
            <i class="fa-solid fa-circle-user"></i>
            <span class="ml-3 item-text">{{ trans('dashboard.customers') }}</span>
          </a>
        </li>

    </nav>
  </aside>

  <style>
    /* Ensure dropdowns are hidden by default */
    .collapse:not(.show) {
      display: none !important;
    }

    .collapse.show {
      display: block !important;
    }

    /* Smooth transition for dropdowns */
    .collapse {
      transition: all 0.3s ease;
    }

    /* Ensure nav-link text is visible */
    .nav-link {
      color: #333 !important;
      text-decoration: none !important;
    }

    .nav-link:hover {
      color: #007bff !important;
    }

    .nav-link .item-text {
      display: inline !important;
      visibility: visible !important;
      opacity: 1 !important;
    }

    .nav-link i {
      margin-right: 8px;
    }

    /* Ensure proper spacing */
    .nav-link span {
      display: inline-block !important;
    }

    /* Disable sidebar hover behavior completely */
    .sidebar-left:hover {
      /* Override any hover styles */
    }

    .vertical.hover .sidebar-left {
      /* Remove hover expansion */
      width: 0 !important;
      min-width: 0 !important;
    }

    .vertical.hover .topnav,
    .vertical.hover .main-content {
      /* Remove hover margin adjustments */
      margin-left: 0 !important;
    }

    /* Ensure sidebar only expands on click, not hover */
    .vertical.collapsed .sidebar-left {
      width: 0 !important;
      min-width: 0 !important;
    }

    .vertical.collapsed .topnav,
    .vertical.collapsed .main-content {
      margin-left: 0 !important;
    }

    .vertical:not(.collapsed) .sidebar-left {
      width: 16rem !important;
      min-width: 16rem !important;
    }

    .vertical:not(.collapsed) .topnav,
    .vertical:not(.collapsed) .main-content {
      margin-left: 16rem !important;
    }
  </style>

  <script>
    // Disable sidebar hover behavior and only allow click toggle
    document.addEventListener('DOMContentLoaded', function() {
      // Remove hover event listeners from sidebar
      const sidebar = document.querySelector('.sidebar-left');
      if (sidebar) {
        // Clone the sidebar to remove all event listeners
        const newSidebar = sidebar.cloneNode(true);
        sidebar.parentNode.replaceChild(newSidebar, sidebar);
      }

      // Override the hover behavior by preventing it
      $('.sidebar-left').off('hover');

      // Only allow click toggle behavior
      $('.collapseSidebar').on('click', function(e) {
        e.preventDefault();
        if ($('.vertical').hasClass('narrow')) {
          $('.vertical').toggleClass('open');
        } else {
          $('.vertical').toggleClass('collapsed');
          // Remove hover class if it exists
          if ($('.vertical').hasClass('hover')) {
            $('.vertical').removeClass('hover');
          }
        }
      });

      // Handle sidebar dropdown collapse
      const dropdownToggles = document.querySelectorAll('[data-toggle="collapse"]');

      dropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();

          const targetId = this.getAttribute('href');
          const target = document.querySelector(targetId);

          if (target) {
            // Check current state
            const isCurrentlyOpen = target.classList.contains('show');

            // Close all other dropdowns first
            dropdownToggles.forEach(function(otherToggle) {
              if (otherToggle !== toggle) {
                const otherTargetId = otherToggle.getAttribute('href');
                const otherTarget = document.querySelector(otherTargetId);
                if (otherTarget) {
                  otherTarget.classList.remove('show');
                  otherTarget.style.display = 'none';
                  otherToggle.setAttribute('aria-expanded', 'false');
                }
              }
            });

            // Toggle the current dropdown
            if (isCurrentlyOpen) {
              // If it's currently open, close it
              target.classList.remove('show');
              target.style.display = 'none';
              this.setAttribute('aria-expanded', 'false');
            } else {
              // If it's currently closed, open it
              target.classList.add('show');
              target.style.display = 'block';
              this.setAttribute('aria-expanded', 'true');
            }
          }
        });
      });
    });
  </script>
