<!doctype html>
<html lang="en">
  <head>

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- Material Dashboard CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/material-dashboard.css')}}">
    {{-- <link rel="stylesheet" href="https://demos.creative-tim.com/material-dashboard-pro/assets/css/material-dashboard.min.css?v=2.1.0"> --}}

    <!-- Self Edited CSS -->
    <link href="{{ asset('css/app-material.css') }}" rel="stylesheet">

<!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{ asset('assets/js/core/popper.min.js')}}" type="text/javascript"></script>
  <script src="{{ asset('assets/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>

  <!-- Plugin for the Perfect Scrollbar -->
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>

  <!-- Plugin for the momentJs  -->
  <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>

  <!--  Plugin for Sweet Alert -->
  <script src="{{ asset('assets/js/plugins/sweetalert2.js')}}"></script>

  <!-- Forms Validations Plugin -->
  <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>

  <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{ asset('assets/js/plugins/jquery.bootstrap-wizard.js')}}"></script>

  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}" ></script>

  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
  <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    {{-- <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/jquery.dataTables.min.js"></script> --}}

  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="{{ asset('assets/js/plugins/bootstrap-tagsinput.js')}}"></script>

  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>

  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="{{ asset('assets/js/plugins/fullcalendar.min.js')}}"></script>

  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="{{ asset('assets/js/plugins/jquery-jvectormap.js')}}"></script>

  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{ asset('assets/js/plugins/nouislider.min.js')}}" ></script>

  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- Library for adding dinamically elements -->
  <script src="{{ asset('assets/js/plugins/arrive.min.js')}}"></script>

  <!--  Google Maps Plugin    -->
  <script  src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

  <!-- Chartist JS -->
  <script src="{{ asset('assets/js/plugins/chartist.min.js')}}"></script>

  <!--  Notifications Plugin    -->
  <script src="{{ asset('assets/js/plugins/bootstrap-notify.js')}}"></script>

  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/material-dashboard.min.js')}}" type="text/javascript"></script>

  <!-- Self Edited JS -->
  <script src="{{ asset('js/app-material.js') }}"></script>




  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css"> --}}

    {{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script> --}}

  </head>
  <body>
    <div class="wrapper ">
      <div class="sidebar" data-color="green" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
        <div class="logo">
          <a href="{{ url('/') }}" class="simple-text logo-normal">
              {{ config('app.name', 'Laravel') }}
          </a>
        </div>
        <div class="sidebar-wrapper">
          <ul class="nav">
            <li class="nav-item {!!(Route::currentRouteName()=='dashboard' || request()->is('website*')) ? 'active' : '' !!}  ">
              <a class="nav-link" href="{{ url('/') }}">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('home*')) ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('home') }}">
                <i class="material-icons">home</i>
                <p>Home</p>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('domain*')) ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('domain') }}">
                <i class="material-icons">label</i>
                <p>Domain</p>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('registrar*')) ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('registrar') }}">
                <i class="material-icons">launch</i>
                <p>Registrar</p>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('server*')) ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('server') }}">
                <i class="material-icons">cloud</i>
                <p>Server</p>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('ad*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('ad') }}">
                  <i class="material-icons">local_florist</i>
                  <p>Ad</p>
                </a>
            </li>
            <li class="nav-item {{ (request()->is('webmaster*')) ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('webmaster') }}">
                <i class="material-icons">art_track</i>
                <p>Webmaster</p>
              </a>
          </li>
          </ul>
        </div>
      </div>
      <div class="main-panel">
        @yield('content')
      </div>
    </div>
    @yield('javascript')
  </body>
</html>
