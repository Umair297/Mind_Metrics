<!doctype html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
  data-theme="theme-default" data-assets-http://localhost/cms//assets/" data-template="vertical-menu-template"
  data-style="light">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>CMS</title>
  <meta name="description" content="" />
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="http://localhost/cms/public/dashboard/assets/img/favicon/favicon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/libs/fullcalendar/fullcalendar.css" />
  <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/css/pages/app-calendar.css" />
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=http://localhost/cms/Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
    rel="stylesheet" />
  <!-- Icons -->
  <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/fonts/fontawesome.css" />
  <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/fonts/tabler-icons.css" />
  <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/fonts/flag-icons.css" />
  <!-- Core CSS -->
  <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/css/rtl/core.css"
    class="template-customizer-core-css" />
  <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/css/rtl/theme-default.css"
    class="template-customizer-theme-css" />
  <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/css/demo.css" />
  <!-- Vendors CSS -->
  <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/libs/node-waves/node-waves.css" />
  <link rel="stylesheet"
    href="http://localhost/cms/public/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/libs/typeahead-js/typeahead.css" />
  <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/libs/apex-charts/apex-charts.css" />
  <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/libs/swiper/swiper.css" />
  <link rel="stylesheet"
    href="http://localhost/cms/public/dashboard/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
  <link rel="stylesheet"
    href="http://localhost/cms/public/dashboard/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
  <link rel="stylesheet"
    href="http://localhost/cms/public/dashboard/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
  <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/css/pages/cards-advance.css" />

  <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
  <script src="http://localhost/cms/public/dashboard/assets/vendor/js/helpers.js"></script>
  <script src="http://localhost/cms/public/dashboard/assets/js/config.js"></script>
  <style>
      .app-brand{
    height:100px !important;
    }
    .app-brand-logo.demo{
    height:100% !important;
    }
    .bg-menu-theme.menu-vertical .menu-item.active > .menu-link:not(.menu-toggle) {
    background: #676b6b;
    box-shadow:none !important;
    }
  </style>
</head>

<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
        <img src="http://localhost/cms/public/dashboard/assets/img/branding/logo.png" alt="Logo"  style="width: auto; height: 100vh; max-height: 180px; display: block; margin: 0 auto; padding: 10px;">

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>
        <ul class="menu-inner py-1">
  {{-- Dashboard - Visible to all --}}
  <li class="menu-item {{ request()->routeIs('home') ? 'active-item' : '' }}">
    <a href="{{ route('home') }}" class="menu-link">
      <i class="menu-icon tf-icons ti ti-smart-home"></i>
      <div data-i18n="Dashboards">Dashboards</div>
    </a>
  </li>

  {{-- Users - Admin Only --}}
  @if(Auth::user()->role === 'admin')
    <li class="menu-item {{ request()->routeIs('users.*') ? 'active-item' : '' }}">
      <a href="#" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-users"></i>
        <div data-i18n="Users">Users</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('users.index') ? 'active-item' : '' }}">
          <a href="{{ route('users.index') }}" class="menu-link">
            <div data-i18n="List">List</div>
          </a>
        </li>
      </ul>
    </li>
  @endif

  {{-- Assessment - Visible to all --}}
  <li class="menu-item {{ request()->routeIs('assessments.index') ? 'active-item' : '' }}">
    <a href="#" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons ti ti-clipboard-list"></i>
      <div data-i18n="Assessment">Assessment</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item {{ request()->routeIs('assessments.index') ? 'active-item' : '' }}">
        <a href="{{ route('assessments.index') }}" class="menu-link">
          <div data-i18n="View Assessment">View Assessment</div>
        </a>
      </li>
    </ul>
  </li>

  {{-- Services - Visible to all --}}
  <li class="menu-item {{ request()->routeIs('services.index') ? 'active-item' : '' }}">
    <a href="#" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons ti ti-briefcase"></i>
      <div data-i18n="Services">Services</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item {{ request()->routeIs('services.index') ? 'active-item' : '' }}">
        <a href="{{ route('services.index') }}" class="menu-link">
          <div data-i18n="List">List</div>
        </a>
      </li>
    </ul>
  </li>

  {{-- Schools - Admin Only --}}
  @if(Auth::user()->role === 'admin')
    <li class="menu-item {{ request()->routeIs('schools.index') ? 'active-item' : '' }}">
      <a href="#" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-school"></i>
        <div data-i18n="Schools">Schools</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('schools.index') ? 'active-item' : '' }}">
          <a href="{{ route('schools.index') }}" class="menu-link">
            <div data-i18n="List">List</div>
          </a>
        </li>
      </ul>
    </li>
  @endif
</ul>



        <style>
          .menu-link {
            color: black !important;
            transition: background-color 0.3s ease, color 0.3s ease;
          }

          .active-item>.menu-link {
            background-color: #EE2D7B !important;
            color: white !important;
          }
        </style>
      </aside>
      <!-- Navbar -->
      <div class="layout-page">
        <nav
          class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
          id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="ti ti-menu-2 ti-md"></i>
            </a>
          </div>
          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">

              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="http://localhost/cms/public/dashboard/assets/img/avatars/1.png" alt class="rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item mt-0" href="pages-account-settings-account.html">
                      <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                          <div class="avatar avatar-online">
                            <img src="http://localhost/cms/public/dashboard/assets/img/avatars/1.png" alt
                              class="rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                          <small class="text-muted">{{ auth()->user()->role }}</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider my-1 mx-n2"></div>
                  </li>
                  <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="ti ti-logout me-3 ti-md"></i>
                      <span class="align-middle">Logout</span>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            @yield('content')
          </div>
          
          <div class="content-backdrop fade"></div>
        </div>
            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
              <p style="text-align: center;">
  &copy; All rights reserved Mind Metrices | Design and developed by 
  <a href="https://webcrazier.com" target="_blank" style="text-decoration: none; color: inherit; color: #EE2D7B;">
    Webcrazier
  </a>
</p>

              </div>
            </footer>
            <!-- / Footer -->
      </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
  </div>




  <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/popper/popper.js"></script>
  <script src="http://localhost/cms/public/dashboard/assets/vendor/js/bootstrap.js"></script>
  <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/node-waves/node-waves.js"></script>
  <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/hammer/hammer.js"></script>
  <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/i18n/i18n.js"></script>
  <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/typeahead-js/typeahead.js"></script>
  <script src="http://localhost/cms/public/dashboard/assets/vendor/js/menu.js"></script>

  <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/fullcalendar/fullcalendar.js"></script>
  <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/@form-validation/popular.js"></script>
  <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
  <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/@form-validation/auto-focus.js"></script>
  <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/select2/select2.js"></script>
  <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/moment/moment.js"></script>
  <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/flatpickr/flatpickr.js"></script>

  <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/apex-charts/apexcharts.js"></script>
  <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/swiper/swiper.js"></script>
  <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

  <!-- Main JS -->
  <script src="http://localhost/cms/public/dashboard/assets/js/main.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>

  <!-- Page JS -->
  @yield('script')
</body>

</html>