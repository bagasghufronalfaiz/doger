<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Website Manager">
  <meta name="author" content="Doger">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
  <!-- Argon CSS -->
  <link type="text/css" href="{{ asset('assets/css/argon-landing.css?v=1.1.0') }}" rel="stylesheet">
</head>

<body>
  <header class="header-global">
    <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light ">
      <div class="container">
        <a class="navbar-brand mr-lg-5" href="../index.html">
          <h1 class="text-white">{{ config('app.name', 'Laravel') }}</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar_global">
          <div class="navbar-collapse-header">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="../index.html">
                  <h1>Doger</h1>
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <ul class="navbar-nav align-items-lg-center ml-lg-auto">
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="https://www.facebook.com/" target="_blank" data-toggle="tooltip" title="Like us on Facebook">
                <i class="fab fa-facebook-square"></i>
                <span class="nav-link-inner--text d-lg-none">Facebook</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="https://www.instagram.com/" target="_blank" data-toggle="tooltip" title="Follow us on Instagram">
                <i class="fab fa-instagram"></i>
                <span class="nav-link-inner--text d-lg-none">Instagram</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="https://twitter.com/" target="_blank" data-toggle="tooltip" title="Follow us on Twitter">
                <i class="fab fa-twitter-square"></i>
                <span class="nav-link-inner--text d-lg-none">Twitter</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="https://github.com/" target="_blank" data-toggle="tooltip" title="Star us on Github">
                <i class="fab fa-github"></i>
                <span class="nav-link-inner--text d-lg-none">Github</span>
              </a>
            </li>
            <li class="nav-item d-none d-lg-block ml-lg-4">
              <a href="{{ route('login') }}" class="btn btn-neutral btn-icon">
                <span class="btn-inner--icon">
                  <i class="fas fa-sign-in-alt"></i>
                </span>
                <span class="nav-link-inner--text">{{ __('Login') }}</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div class="position-relative">
      <!-- shape Hero -->
      <section class="section section-lg section-shaped pb-250">
        <div class="shape shape-style-1 shape-default">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </div>
        <div class="container py-lg-md d-flex">
          <div class="col px-0">
            <div class="row">
              <div class="col-lg-6">
                <h1 class="display-3  text-white">Website Manager<span>Managa your website list here</span></h1>
                <p class="lead  text-white">Many websites and you are very confused managing it, doger came to give a solution to manage it.</p>
                <div class="btn-wrapper">
                  <a href="{{ route('login') }}" class="btn btn-white btn-icon mb-3 mb-sm-0">
                    <span class="btn-inner--icon"><i class="fas fa-sign-in-alt"></i></span>
                    <span class="btn-inner--text">{{ __('Login') }}</span>
                  </a>
                  <a href="{{ route('register') }}" class="btn btn-success btn-icon mb-3 mb-sm-0">
                    <span class="btn-inner--icon"><i class='fas fa-user-plus'></i></span>
                    <span class="btn-inner--text">{{ __('Register') }}</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew">
          <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
          </svg>
        </div>
      </section>
      <!-- 1st Hero Variation -->
    </div>
    <section class="section section-lg pt-lg-0 mt--200">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="row row-grid">
              <div class="col-lg-4">
                <div class="card card-lift--hover shadow border-0">
                  <div class="card-body py-5">
                    <div class="icon icon-shape icon-shape-primary rounded-circle mb-4">
                      <i class="ni ni-check-bold"></i>
                    </div>
                    <h6 class="text-primary text-uppercase">Check Index</h6>
                    <p class="description mt-3">Auto check index google, check index google image and check index google search.</p>
                    <div>
                      <span class="badge badge-pill badge-primary">Index Image</span>
                      <span class="badge badge-pill badge-primary">Index Search</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="card card-lift--hover shadow border-0">
                  <div class="card-body py-5">
                    <div class="icon icon-shape icon-shape-success rounded-circle mb-4">
                      <i class="ni ni-istanbul"></i>
                    </div>
                    <h6 class="text-success text-uppercase">Wordpress API</h6>
                    <p class="description mt-3">Wordpress API provides a lot of wordpress website data, such as posts, pages and themes.</p>
                    <div>
                      <span class="badge badge-pill badge-success">post</span>
                      <span class="badge badge-pill badge-success">page</span>
                      <span class="badge badge-pill badge-success">theme</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="card card-lift--hover shadow border-0">
                  <div class="card-body py-5">
                    <div class="icon icon-shape icon-shape-warning rounded-circle mb-4">
                      <i class="ni ni-planet"></i>
                    </div>
                    <h6 class="text-warning text-uppercase">Domain Property</h6>
                    <p class="description mt-3">Provide domian expiration data, retrieve nameservers currently attached to the domain</p>
                    <div>
                      <span class="badge badge-pill badge-warning">expiration</span>
                      <span class="badge badge-pill badge-warning">nameservers</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section section-lg">
      <div class="container">
        <div class="row row-grid align-items-center">
          <div class="col-md-6 order-md-2">
            <img src="{{ asset('assets/img/theme/promo-1.png') }}" class="img-fluid floating" alt="image">
          </div>
          <div class="col-md-6 order-md-1">
            <div class="pr-md-5">
              <div class="icon icon-lg icon-shape icon-shape-success shadow rounded-circle mb-5">
                <i class="ni ni-settings-gear-65"></i>
              </div>
              <h3>Awesome features</h3>
              <p>Provides good features for automation, such as auto check index, auto check domain nameservers and domain expiration.</p>
              <ul class="list-unstyled mt-5">
                <li class="py-2">
                  <div class="d-flex align-items-center">
                    <div>
                      <div class="badge badge-circle badge-success mr-3">
                        <i class='fab fa-google'></i>
                      </div>
                    </div>
                    <div>
                      <h6 class="mb-0">Check Index</h6>
                    </div>
                  </div>
                </li>
                <li class="py-2">
                  <div class="d-flex align-items-center">
                    <div>
                      <div class="badge badge-circle badge-success mr-3">
                        <i class='fab fa-wordpress-simple'></i>
                      </div>
                    </div>
                    <div>
                      <h6 class="mb-0">Wordpress API</h6>
                    </div>
                  </div>
                </li>
                <li class="py-2">
                  <div class="d-flex align-items-center">
                    <div>
                      <div class="badge badge-circle badge-success mr-3">
                        <i class="far fa-smile-beam"></i>
                      </div>
                    </div>
                    <div>
                      <h6 class="mb-0">Domain Property</h6>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section bg-secondary">
      <div class="container">
        <div class="row row-grid align-items-center">
          <div class="col-md-6">
            <div class="card bg-default shadow border-0">
              <img src="{{ asset('assets/img/theme/img-2-1200x1000.jpg') }}" class="card-img-top" alt="image">
              <blockquote class="card-blockquote">
                <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95" class="svg-bg">
                  <polygon points="0,52 583,95 0,95" class="fill-default" />
                  <polygon points="0,42 583,95 683,0 0,95" opacity=".2" class="fill-default" />
                </svg>
                <h4 class="display-3 font-weight-bold text-white">Automation</h4>
              </blockquote>
            </div>
          </div>
          <div class="col-md-6">
            <div class="pl-md-5">
              <div class="icon icon-lg icon-shape icon-shape-warning shadow rounded-circle mb-5">
                <i class="ni ni-settings"></i>
              </div>
              <h3>Automation</h3>
              <p class="lead">Automation is very much needed nowadays. Because things have to be done quickly and precisely.</p>
              <p>Doger came to provide the automation and this makes it easier for users to manage their website.</p>
              <p>Doger will also continue to update features and tools to provide other automation. Therefore, suggestions from users are expected.</p>
              <a href="#" class="font-weight-bold text-warning mt-5">Automation is a very useful thing</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section section-lg">
      <div class="container">
        <div class="row justify-content-center text-center mb-lg">
          <div class="col-lg-8">
            <h2 class="display-3">The amazing Team</h2>
            <p class="lead text-muted">Teamwork is necessary to achieve a common goal.</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="px-4">
              <img src="{{ asset('assets/img/theme/team-1.jpg') }}" class="rounded-circle img-center img-fluid shadow shadow-lg--hover" style="width: 200px;" alt="image">
              <div class="pt-4 text-center">
                <h5 class="title">
                  <span class="d-block mb-1">Bagas</span>
                  <small class="h6 text-muted">Web Developer</small>
                </h5>
                <div class="mt-3">
                  <a href="#" class="btn btn-warning btn-icon-only rounded-circle">
                    <i class="fab fa-twitter"></i>
                  </a>
                  <a href="#" class="btn btn-warning btn-icon-only rounded-circle">
                    <i class="fab fa-facebook"></i>
                  </a>
                  <a href="#" class="btn btn-warning btn-icon-only rounded-circle">
                    <i class="fab fa-dribbble"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="px-4">
              <img src="{{ asset('assets/img/theme/team-2.jpg') }}" class="rounded-circle img-center img-fluid shadow shadow-lg--hover" style="width: 200px;" alt="image">
              <div class="pt-4 text-center">
                <h5 class="title">
                  <span class="d-block mb-1">Ani</span>
                  <small class="h6 text-muted">Marketing Strategist</small>
                </h5>
                <div class="mt-3">
                  <a href="#" class="btn btn-primary btn-icon-only rounded-circle">
                    <i class="fab fa-twitter"></i>
                  </a>
                  <a href="#" class="btn btn-primary btn-icon-only rounded-circle">
                    <i class="fab fa-facebook"></i>
                  </a>
                  <a href="#" class="btn btn-primary btn-icon-only rounded-circle">
                    <i class="fab fa-dribbble"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="px-4">
              <img alt="image" src="{{ asset('assets/img/theme/team-3.jpg') }}" class="rounded-circle img-center img-fluid shadow shadow-lg--hover" style="width: 200px;">
              <div class="pt-4 text-center">
                <h5 class="title">
                  <span class="d-block mb-1">Salsabila</span>
                  <small class="h6 text-muted">UI/UX Designer</small>
                </h5>
                <div class="mt-3">
                  <a href="#" class="btn btn-info btn-icon-only rounded-circle">
                    <i class="fab fa-twitter"></i>
                  </a>
                  <a href="#" class="btn btn-info btn-icon-only rounded-circle">
                    <i class="fab fa-facebook"></i>
                  </a>
                  <a href="#" class="btn btn-info btn-icon-only rounded-circle">
                    <i class="fab fa-dribbble"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="px-4">
              <img alt="image" src="{{ asset('assets/img/theme/team-4.jpg') }}" class="rounded-circle img-center img-fluid shadow shadow-lg--hover" style="width: 200px;">
              <div class="pt-4 text-center">
                <h5 class="title">
                  <span class="d-block mb-1">Ti</span>
                  <small class="h6 text-muted">Founder and CEO</small>
                </h5>
                <div class="mt-3">
                  <a href="#" class="btn btn-success btn-icon-only rounded-circle">
                    <i class="fab fa-twitter"></i>
                  </a>
                  <a href="#" class="btn btn-success btn-icon-only rounded-circle">
                    <i class="fab fa-facebook"></i>
                  </a>
                  <a href="#" class="btn btn-success btn-icon-only rounded-circle">
                    <i class="fab fa-dribbble"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section section-lg bg-gradient-default">
      <div class="container pt-lg pb-300">
        <div class="row text-center justify-content-center">
          <div class="col-lg-10">
            <h2 class="display-3 text-white">Build Websites Neater</h2>
            <p class="lead text-white">Make the website more organized and neat with doger.</p>
          </div>
        </div>
        <div class="row row-grid mt-5">
          <div class="col-lg-4">
            <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
              <i class="ni ni-settings text-primary"></i>
            </div>
            <h5 class="text-white mt-3">Organize Better</h5>
            <p class="text-white mt-3">Organize your website better with doger.</p>
          </div>
          <div class="col-lg-4">
            <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
              <i class='fas fa-chart-line'></i>
            </div>
            <h5 class="text-white mt-3">Grow your visitor</h5>
            <p class="text-white mt-3">Grow your visitor with targeted keyword.</p>
          </div>
          <div class="col-lg-4">
            <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
              <i class='fas fa-bell'></i>
            </div>
            <h5 class="text-white mt-3">Notification</h5>
            <p class="text-white mt-3">Notification will appear if something goes wrong with your website.</p>
          </div>
        </div>
      </div>
      <!-- SVG separator -->
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </section>
    <section class="section section-lg pt-lg-0 section-contact-us">
      <div class="container">
        <div class="row justify-content-center mt--300">
          <div class="col-lg-8">
            <div class="card bg-gradient-secondary shadow">
              <div class="card-body p-lg-5">
                <h4 class="mb-1">Want to know more?</h4>
                <p class="mt-0">Feel free to email us.</p>
                <div class="form-group mt-5">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-user-run"></i></span>
                    </div>
                    <input class="form-control" placeholder="Your name" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email address" type="email">
                  </div>
                </div>
                <div class="form-group mb-4">
                  <textarea class="form-control form-control-alternative" name="name" rows="4" cols="80" placeholder="Type a message..."></textarea>
                </div>
                <div>
                  <button type="button" class="btn btn-default btn-round btn-block btn-lg">Send Message</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section section-lg">
      <div class="container">
        <div class="row row-grid justify-content-center">
          <div class="col-lg-8 text-center">
            <h2 class="display-3">Do you love this awesome <span class="text-success">Feature from Doger?</span></h2>
            <p class="lead">Cause if you do, it can be yours for FREE.</p>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer class="footer has-cards">
    <div class="container">
      <div class="row row-grid align-items-center my-md">
        <div class="col-lg-6">
          <h3 class="text-primary font-weight-light mb-2">Thank you for supporting us!</h3>
          <h4 class="mb-0 font-weight-light">Let's get in touch on any of these platforms.</h4>
        </div>
        <div class="col-lg-6 text-lg-center btn-wrapper">
          <a target="_blank" href="https://twitter.com/" class="btn btn-neutral btn-icon-only btn-twitter btn-round btn-lg" data-toggle="tooltip" data-original-title="Follow us">
            <i class="fab fa-twitter"></i>
          </a>
          <a target="_blank" href="https://www.facebook.com/" class="btn btn-neutral btn-icon-only btn-facebook btn-round btn-lg" data-toggle="tooltip" data-original-title="Like us">
            <i class="fab fa-facebook"></i>
          </a>
          <a target="_blank" href="https://dribbble.com/" class="btn btn-neutral btn-icon-only btn-dribbble btn-lg btn-round" data-toggle="tooltip" data-original-title="Follow us">
            <i class="fab fa-dribbble"></i>
          </a>
          <a target="_blank" href="https://github.com/" class="btn btn-neutral btn-icon-only btn-github btn-round btn-lg" data-toggle="tooltip" data-original-title="Star on Github">
            <i class="fab fa-github"></i>
          </a>
        </div>
      </div>
      <hr>
      <div class="align-items-center justify-content-md-between">
        <div class="copyright">
          &copy; 2019 <a href="{{ url('/') }}" target="_blank">{{ config('app.name', 'Laravel') }}</a>.
        </div>
      </div>
    </div>
  </footer>
  <!-- Core -->
  <script src="{{ asset('assets/vendor/jquery/landing/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/popper/popper.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/headroom.js/dist/headroom.min.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('assets/js/argon-landing.js?v=1.1.0') }}"></script>
</body>

</html>
