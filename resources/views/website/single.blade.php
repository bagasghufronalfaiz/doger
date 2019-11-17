@extends('layouts.app')

@section('css')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
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
                <h6 class="h2 d-inline-block mb-0 text-white">Website</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Website</a></li>
                    <li class="breadcrumb-item active"><a href="">{{$website->domain->domain}}</a></li>
                    </ol>
                </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Index Google Search</h5>
                            <div class="row">
                                <div class="col-lg-10">
                                    <span class="h2 mb-0 index-web pointer" data-domain="{{$website->domain->domain}}">{{$website->index_web}}</span>
                                </div>
                                <div class="col-lg-2">
                                    <i class="material-icons vab index-web-refresh text-right pointer refresh-index">refresh</i>
                                </div>
                            </div>

                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Index Google Image</h5>
                            <div class="row">
                                <div class="col-lg-10">
                                    <span class="h2 font-weight-bold mb-0 index-image pointer" data-domain="{{$website->domain->domain}}">{{$website->index_image}}</span>
                                </div>
                                <div class="col-lg-2">
                                    <i class="material-icons vab index-image-refresh text-right pointer refresh-index">refresh</i>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Page content -->
<div class="container-fluid mt--6">

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <!-- Title -->
                    <h2 class="mb-0">Wordpress</h2>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- List group -->
                    <ul class="list-group list-group-flush list my--3">
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Post</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-6 row">
                                    <div class="col-lg-10 wordpress-post pointer" data-domain="{{$website->domain->domain}}">{{$website->wp_post}}</div>
                                    <div class="col-lg-2">
                                        <i class="material-icons vab wordpress-post-refresh text-right pointer">refresh</i>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Category</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                 <div class="col-lg-6 row">
                                    <div class="col-lg-10 wordpress-category pointer" data-domain="{{$website->domain->domain}}">{{$website->wp_category}}</div>
                                    <div class="col-lg-2">
                                        <i class="material-icons vab wordpress-category-refresh text-right pointer">refresh</i>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Category Title</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                 <div class="col-lg-6 row">
                                    <div class="col-lg-10 wordpress-category-title pointer" data-domain="{{$website->domain->domain}}">{{$website->wp_category_titles}}</div>
                                    <div class="col-lg-2">
                                        <i class="material-icons vab wordpress-category-title-refresh text-right pointer">refresh</i>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Page</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                 <div class="col-lg-6 row">
                                    <div class="col-lg-10 wordpress-page pointer" data-domain="{{$website->domain->domain}}">{{$website->wp_page}}</div>
                                    <div class="col-lg-2">
                                        <i class="material-icons vab wordpress-page-refresh text-right pointer">refresh</i>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Page Title</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                 <div class="col-lg-6 row">
                                    <div class="col-lg-10 wordpress-page-title pointer" data-domain="{{$website->domain->domain}}">{{$website->wp_page_title}}</div>
                                    <div class="col-lg-2">
                                        <i class="material-icons vab wordpress-page-title-refresh text-right pointer">refresh</i>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Theme</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                 <div class="col-lg-6 row">
                                    <div class="col-lg-10 wordpress-theme pointer" data-domain="{{$website->domain->domain}}">
                                    {{$website->theme}}</div>
                                    <div class="col-lg-2">
                                        <i class="material-icons vab wordpress-theme-refresh text-right pointer">refresh</i>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <!-- Title -->
                    <h2 class="mb-0">Server</h2>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- List group -->
                    <ul class="list-group list-group-flush list my--3">
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Server</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-6">
                                    {{$website->server->name}}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Server Folder</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-6">
                                    {{$website->server_folder}}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">IP</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-6">
                                    {{$website->server->ip}}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Username</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-6">
                                    {{$website->server->username}}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Password</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-6">
                                    {{$website->server->password}}
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <!-- Title -->
                    <h2 class="mb-0">Domain</h2>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- List group -->
                    <ul class="list-group list-group-flush list my--3">
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Registrar</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-6">{{$website->domain->registrar->registrar}}</div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Expiration</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-6 row">
                                    <div class="col-lg-10 expiration pointer" data-domain="{{$website->domain->domain}}">{{$website->domain->expiration}}</div>
                                    <div class="col-lg-2 text">
                                        <i class="material-icons vab expiration-refresh text-right pointer">refresh</i>
                                    </div>

                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Nameserver 1</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-6 row">
                                    <div class="col-lg-10 nameserver1 pointer" data-domain="{{$website->domain->domain}}">{{$website->domain->nameserver1}}</div>
                                    <div class="col-lg-2">
                                        <i class="material-icons vab nameserver1-refresh text-right pointer">refresh</i>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Nameserver 2</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-6 row">
                                    <div class="col-lg-10 nameserver2 pointer" data-domain="{{$website->domain->domain}}">{{$website->domain->nameserver2}}</div>
                                    <div class="col-lg-2">
                                        <i class="material-icons vab nameserver2-refresh text-right pointer">refresh</i>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Registrar Username</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-6">{{$website->domain->registrar->username}}</div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Registrar Email</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-6">
                                    {{$website->domain->registrar->email}}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Registrar  Password: </h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-6">
                                    {{$website->domain->registrar->password}}
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <!-- Title -->
                    <h2 class="mb-0">Ad & Webmaster</h2>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- List group -->
                    <ul class="list-group list-group-flush list my--3">
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Ad</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-6">
                                    @if($website->ad_id!=null){{$website->ad->name}} @else Not Yet @endif
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Webmaster</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-6">
                                    @if($website->webmaster_id!=null){{$website->webmaster->name}} @else Not Yet @endif
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Date</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-6">
                                    {{$website->date}}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <h3 class="mb-0">Build Tool</h3>
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-6">
                                    {{$website->tool}}
                                </div>
                            </div>
                        </li>
                    </ul>
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
    <!-- DataTables JS -->
    <script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
@endsection

@section('javascript')
    <script>
        $(function() {
            $('.index-web-refresh').click(function(){
                var rotate = $(this);
                rotate.addClass('fa-spin');
                $('.index-web').html('<i class="fa fa-spinner fa-spin text-right pointer"></i>');
                $.get("{{url('index-web')}}/" + $('.index-web').attr('data-domain'), function(e){
                    $('.index-web').html(e['index-web']);
                    rotate.removeClass('fa-spin');
                });
            });
            $('.index-web').click(function () {
                var domain = $(this);
                domain.html('<i class="fa fa-spinner fa-spin"></i>');
                $.get("{{url('index-web')}}/" + domain.attr('data-domain'), function(e){
                domain.html(e['index-web']);
                });
            });
            $('.index-image-refresh').click(function(){
                var rotate = $(this);
                rotate.addClass('fa-spin');
                $('.index-image').html('<i class="fa fa-spinner fa-spin text-right pointer"></i>');
                $.get("{{url('index-image')}}/" + $('.index-image').attr('data-domain'), function(e){
                    $('.index-image').html(e['index-image']);
                    rotate.removeClass('fa-spin');
                });
            });
            $('.index-image').click(function () {
                var domain = $(this);
                domain.html('<i class="fa fa-spinner fa-spin" ></i>');
                $.get("{{url('index-image')}}/" + domain.attr('data-domain'), function(e){
                domain.html(e['index-image']);
                });
            });
            $('.wordpress-post-refresh').click(function(){
                var rotate = $(this);
                rotate.addClass('fa-spin');
                $('.wordpress-post').html('<i class="fa fa-spinner fa-spin text-right pointer"></i>');
                $.get("{{url('wordpress-post')}}/" + $('.wordpress-post').attr('data-domain'), function(e){
                    $('.wordpress-post').html(e['post']);
                    rotate.removeClass('fa-spin');
                });
            });
            $('.wordpress-post').click(function () {
                var domain = $(this);
                domain.html('<i class="fa fa-spinner fa-spin" ></i>');
                $.get("{{url('wordpress-post')}}/" + domain.attr('data-domain'), function(e){
                domain.html(e['post']);
                });
            });
            $('.wordpress-category-refresh').click(function(){
                var rotate = $(this);
                rotate.addClass('fa-spin');
                $('.wordpress-category').html('<i class="fa fa-spinner fa-spin text-right pointer"></i>');
                $.get("{{url('wordpress-category')}}/" + $('.wordpress-category').attr('data-domain'), function(e){
                    $('.wordpress-category').html(e['category']);
                    rotate.removeClass('fa-spin');
                });
            });
            $('.wordpress-category').click(function () {
                var domain = $(this);
                domain.html('<i class="fa fa-spinner fa-spin"  ></i>');
                $.get("{{url('wordpress-category')}}/" + domain.attr('data-domain'), function(e){
                domain.html(e['category']);
                });
            });
            $('.wordpress-category-title-refresh').click(function(){
                var rotate = $(this);
                rotate.addClass('fa-spin');
                $('.wordpress-category-title').html('<i class="fa fa-spinner fa-spin text-right pointer"></i>');
                $.get("{{url('wordpress-category-title')}}/" + $('.wordpress-category-title').attr('data-domain'), function(e){
                    $('.wordpress-category-title').html(e['category-title']);
                    rotate.removeClass('fa-spin');
                });
            });
            $('.wordpress-category-title').click(function () {
                var domain = $(this);
                domain.html('<i class="fa fa-spinner fa-spin"  ></i>');
                $.get("{{url('wordpress-category-title')}}/" + domain.attr('data-domain'), function(e){
                domain.html(e['category-title']);
                });
            });
            $('.wordpress-page-refresh').click(function(){
                var rotate = $(this);
                rotate.addClass('fa-spin');
                $('.wordpress-page').html('<i class="fa fa-spinner fa-spin text-right pointer"></i>');
                $.get("{{url('wordpress-page')}}/" + $('.wordpress-page').attr('data-domain'), function(e){
                    $('.wordpress-page').html(e['page']);
                    rotate.removeClass('fa-spin');
                });
            });
            $('.wordpress-page').click(function () {
                var domain = $(this);
                domain.html('<i class="fa fa-spinner fa-spin"  ></i>');
                $.get("{{url('wordpress-page')}}/" + domain.attr('data-domain'), function(e){
                domain.html(e['page']);
                });
            });
            $('.wordpress-page-title-refresh').click(function(){
                var rotate = $(this);
                rotate.addClass('fa-spin');
                $('.wordpress-page-title').html('<i class="fa fa-spinner fa-spin text-right pointer"></i>');
                $.get("{{url('wordpress-page-title')}}/" + $('.wordpress-page-title').attr('data-domain'), function(e){
                    $('.wordpress-page-title').html(e['page-title']);
                    rotate.removeClass('fa-spin');
                });
            });
            $('.wordpress-page-title').click(function () {
                var domain = $(this);
                domain.html('<i class="fa fa-spinner fa-spin"  ></i>');
                $.get("{{url('wordpress-page-title')}}/" + domain.attr('data-domain'), function(e){
                domain.html(e['page-title']);
                });
            });
            $('.wordpress-theme-refresh').click(function(){
                var rotate = $(this);
                rotate.addClass('fa-spin');
                $('.wordpress-theme').html('<i class="fa fa-spinner fa-spin text-right pointer"></i>');
                $.get("{{url('wordpress-theme')}}/" + $('.wordpress-theme').attr('data-domain'), function(e){
                    $('.wordpress-theme').html(e['theme']);
                    rotate.removeClass('fa-spin');
                });
            });
            $('.wordpress-theme').click(function () {
                var domain = $(this);
                domain.html('<i class="fa fa-spinner fa-spin"  ></i>');
                $.get("{{url('wordpress-theme')}}/" + domain.attr('data-domain'), function(e){
                domain.html(e['theme']);
                });
            });
            $('.expiration-refresh').click(function(){
                var rotate = $(this);
                rotate.addClass('fa-spin');
                $('.expiration').html('<i class="fa fa-spinner fa-spin text-right pointer"></i>');
                $.get("{{url('expiration')}}/" + $('.expiration').attr('data-domain'), function(e){
                    $('.expiration').html(e['expiration']);
                    rotate.removeClass('fa-spin');
                });
            });
            $('.expiration').click(function () {
                var domain = $(this);
                domain.html('<i class="fa fa-spinner fa-spin"  ></i>');
                $.get("{{url('expiration')}}/" + domain.attr('data-domain'), function(e){
                domain.html(e['expiration']);
                });
            });
            $('.nameserver1-refresh').click(function(){
                var rotate = $(this);
                rotate.addClass('fa-spin');
                $('.nameserver1').html('<i class="fa fa-spinner fa-spin text-right pointer"></i>');
                $.get("{{url('nameserver1')}}/" + $('.nameserver1').attr('data-domain'), function(e){
                    $('.nameserver1').html(e['nameserver1']);
                    rotate.removeClass('fa-spin');
                });
            });
            $('.nameserver1').click(function () {
                var domain = $(this);
                domain.html('<i class="fa fa-spinner fa-spin"  ></i>');
                $.get("{{url('nameserver1')}}/" + domain.attr('data-domain'), function(e){
                domain.html(e['nameserver1']);
                });
            });
            $('.nameserver2-refresh').click(function(){
                var rotate = $(this);
                rotate.addClass('fa-spin');
                $('.nameserver2').html('<i class="fa fa-spinner fa-spin text-right pointer"></i>');
                $.get("{{url('nameserver2')}}/" + $('.nameserver2').attr('data-domain'), function(e){
                    $('.nameserver2').html(e['nameserver2']);
                    rotate.removeClass('fa-spin');
                });
            });
            $('.nameserver2').click(function () {
                var domain = $(this);
                domain.html('<i class="fa fa-spinner fa-spin"></i>');
                $.get("{{url('nameserver2')}}/" + domain.attr('data-domain'), function(e){
                domain.html(e['nameserver2']);
                });
            });
            });
    </script>
@endsection
