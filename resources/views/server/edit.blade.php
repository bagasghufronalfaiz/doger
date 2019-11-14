@extends('layouts.app')

@section('css')
<!-- Dropdown CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/quill/dist/quill.core.css') }}">
@endsection

@section('content')
<!-- Topnav -->
<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Search form -->
        <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
            <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Search" type="text">
            </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </form>
        <!-- Navbar links -->
        <ul class="navbar-nav align-items-center ml-md-auto">
            <li class="nav-item d-xl-none">
            <!-- Sidenav toggler -->
            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                </div>
            </div>
            </li>
            <li class="nav-item d-sm-none">
            <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
            </a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ni ni-bell-55"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
                <!-- Dropdown header -->
                <div class="px-3 py-3">
                <h6 class="text-sm text-muted m-0">You have <strong class="text-primary">13</strong> notifications.</h6>
                </div>
                <!-- List group -->
                <div class="list-group list-group-flush">
                <a href="#!" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                    <div class="col-auto">
                        <!-- Avatar -->
                        <img alt="Image placeholder" src="{{ asset('assets/img/theme/team-1.jpg') }}" class="avatar rounded-circle">
                    </div>
                    <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0 text-sm">John Snow</h4>
                        </div>
                        <div class="text-right text-muted">
                            <small>2 hrs ago</small>
                        </div>
                        </div>
                        <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
                    </div>
                    </div>
                </a>
                <a href="#!" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                    <div class="col-auto">
                        <!-- Avatar -->
                        <img alt="Image placeholder" src="{{ asset('assets/img/theme/team-2.jpg') }}" class="avatar rounded-circle">
                    </div>
                    <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0 text-sm">John Snow</h4>
                        </div>
                        <div class="text-right text-muted">
                            <small>3 hrs ago</small>
                        </div>
                        </div>
                        <p class="text-sm mb-0">A new issue has been reported for Argon.</p>
                    </div>
                    </div>
                </a>
                <a href="#!" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                    <div class="col-auto">
                        <!-- Avatar -->
                        <img alt="Image placeholder" src="{{ asset('assets/img/theme/team-3.jpg') }}" class="avatar rounded-circle">
                    </div>
                    <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0 text-sm">John Snow</h4>
                        </div>
                        <div class="text-right text-muted">
                            <small>5 hrs ago</small>
                        </div>
                        </div>
                        <p class="text-sm mb-0">Your posts have been liked a lot.</p>
                    </div>
                    </div>
                </a>
                <a href="#!" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                    <div class="col-auto">
                        <!-- Avatar -->
                        <img alt="Image placeholder" src="{{ asset('assets/img/theme/team-4.jpg') }}" class="avatar rounded-circle">
                    </div>
                    <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0 text-sm">John Snow</h4>
                        </div>
                        <div class="text-right text-muted">
                            <small>2 hrs ago</small>
                        </div>
                        </div>
                        <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
                    </div>
                    </div>
                </a>
                <a href="#!" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                    <div class="col-auto">
                        <!-- Avatar -->
                        <img alt="Image placeholder" src="{{ asset('assets/img/theme/team-5.jpg') }}" class="avatar rounded-circle">
                    </div>
                    <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0 text-sm">John Snow</h4>
                        </div>
                        <div class="text-right text-muted">
                            <small>3 hrs ago</small>
                        </div>
                        </div>
                        <p class="text-sm mb-0">A new issue has been reported for Argon.</p>
                    </div>
                    </div>
                </a>
                </div>
                <!-- View all -->
                <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
            </div>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ni ni-ungroup"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default dropdown-menu-right">
                <div class="row shortcuts px-4">
                <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                    <i class="ni ni-calendar-grid-58"></i>
                    </span>
                    <small>Calendar</small>
                </a>
                <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                    <i class="ni ni-email-83"></i>
                    </span>
                    <small>Email</small>
                </a>
                <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                    <i class="ni ni-credit-card"></i>
                    </span>
                    <small>Payments</small>
                </a>
                <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                    <i class="ni ni-books"></i>
                    </span>
                    <small>Reports</small>
                </a>
                <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
                    <i class="ni ni-pin-3"></i>
                    </span>
                    <small>Maps</small>
                </a>
                <a href="#!" class="col-4 shortcut-item">
                    <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                    <i class="ni ni-basket"></i>
                    </span>
                    <small>Shop</small>
                </a>
                </div>
            </div>
            </li>
        </ul>
        <ul class="navbar-nav align-items-center ml-auto ml-md-0">
            <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="{{ asset('assets/img/theme/team-4.jpg') }}">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
                </div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="{{ url('/home') }}" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
                </a>
                <a href="#!" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Settings</span>
                </a>
                <a href="#!" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Activity</span>
                </a>
                <a href="#!" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Support</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            </li>
        </ul>
        </div>
    </div>
</nav>
<!-- Header -->
<div class="header pb-6 bg-primary">
    <div class="container-fluid">
        <div class="header-body">
        <div class="row align-items-center py-4">
            <div class="col-lg-12 col-12">
            <h6 class="h2 d-inline-block mb-0 text-white">Server</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active"><a href="{{ route('server') }}">Server</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('addserver') }}">Add Server</a></li>
                </ol>
            </nav>
            </div>
        </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
      <div class="row">
        <div class="col-lg-12">
          <div class="card-wrapper">
            <!-- Input groups -->
            <div class="card">
              <!-- Card header -->
              <div class="card-header">
                <h3 class="mb-0">Add Server</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <form action="/server/{{$server->id}}" method="post">
                  <!-- Input groups with icon -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="seller">Seller</label>
                          <input class="form-control" placeholder="Seller" type="text" name="seller" value="{{(old('seller')) ? old('seller') : $server->seller}}">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="location">Location</label>
                          <input class="form-control" placeholder="Location" type="text" name="location" value="{{(old('location')) ? old('location') : $server->location}}">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="serverName">Server Name</label>
                          <input class="form-control" placeholder="Server Name" type="text" name="serverName" value="{{(old('serverName')) ? old('serverName') : $server->servername}}">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="ip">IP</label>
                          <input class="form-control" placeholder="IP" type="text" name="ip" value="{{(old('ip')) ? old('ip') : $server->ip}}">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="username">Username</label>
                          <input class="form-control" placeholder="Username" type="text" name="username" value="{{(old('username')) ? old('username') : $server->username}}">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="password">Password</label>
                          <input class="form-control" placeholder="Password" type="text" name="password" value="{{(old('password')) ? old('password') : $server->password}}">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="price">Price</label>
                          <input class="form-control" placeholder="Price" type="text" name="price" value="{{(old('price')) ? old('price') : $server->price}}">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="InvoiceDate">Invoice Date</label>
                        <input class="form-control datepicker" placeholder="Invoice Date" type="text" value="{{(old('newDate')) ? old('newDate') : $newDate}}" name="invoiceDate">
                      </div>
                    </div>
                  </div>
                  {{ csrf_field() }}
                  <input type="hidden" name="_method" value="PUT">
                      @if(count($errors)>0)
                          <div class="alert alert-danger">
                          @foreach($errors->all() as $error)
                          <p>{{$error}}</p>
                          @endforeach
                          </div>
                      @endif
                    <input type="submit" class="btn btn-primary" value="Edit Server">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="copyright text-center text-lg-left text-muted">
            &copy; 2019 <a href="{{ url('/') }}" class="font-weight-bold ml-1" target="_blank">{{ config('app.name', 'Laravel') }}</a>
        </div>
    </footer>
    </div>
@endsection

@section('javascript-optional')
    <!-- Dropdown JS -->
    <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/nouislider/distribute/nouislider.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/dist/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/dropzone/dist/min/dropzone.min.js') }}"></script>

@endsection

@section('javascript')
    <!-- javascript -->
@endsection

