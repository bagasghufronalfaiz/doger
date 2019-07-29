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
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" /> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- Material Dashboard CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/material-dashboard.css')}}">

  </head>
  <body>

    @yield('content')

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
  <script src="{{ asset('assets/js/plugins/jquery.datatables.min.js')}}"></script>

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
  <script src="{{ asset('assets/js/material-dashboard.min.js?v=2.1.1')}}" type="text/javascript"></script>
  </body>
</html>
