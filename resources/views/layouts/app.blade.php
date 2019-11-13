<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" type="text/css">
  <!-- Page plugins -->
  @yield('css')
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/argon.css?v=1.1.0') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" type="text/css">
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="{{ url('/') }}">
            <h1 class="h1 text-primary">{{ config('app.name', 'Laravel') }}</h1>
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link {!!(Route::currentRouteName()=='dashboard' || request()->is('website*')) ? 'active' : '' !!}" href="{{ url('/') }}">
                <i class="material-icons text-primary">dashboard</i>
                <span class="nav-link-text">Dashboards</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('domain*')) ? 'active' : '' }}" href="{{ route('domain') }}">
                <i class="material-icons text-orange">label</i>
                <span class="nav-link-text">Domain</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('registrar*')) ? 'active' : '' }}" href="{{ route('registrar') }}">
                <i class="material-icons text-info">indeterminate_check_box</i>
                <span class="nav-link-text">Registrar</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('server*')) ? 'active' : '' }}" href="{{ route('server') }}">
                <i class="material-icons text-green">cloud</i>
                <span class="nav-link-text">Server</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('ad*')) ? 'active' : '' }}" href="{{ route('ad') }}">
                <i class="material-icons text-red">local_florist</i>
                <span class="nav-link-text">Ad</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('webmaster*')) ? 'active' : '' }}" href="{{ route('webmaster') }}">
                <i class="material-icons text-pink">assistant</i>
                <span class="nav-link-text">Webmaster</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
      @yield('content')
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>

  @yield('javascript-optional')
  <!-- Argon JS -->
  <script src="{{ asset('assets/js/argon.js?v=1.1.0') }}"></script>
  @yield('javascript')
</body>

</html>
