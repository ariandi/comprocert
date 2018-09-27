<!--
author: Ariandi Nugraha
author Email: db_duabelas@yahoo.com
-->

<!DOCTYPE html>
<html lang="en">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta property="og:locale" content="nb_NO" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="@yield('keywords')">
  <meta name="description" content="@yield('description')">
  <meta name="author" content="Ariandi Nugraha">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="shortcut icon" href="{{ asset('images/wcs-bahanicon.ico') }}">

  <title>@yield('title')</title>

  <!-- Global Stylesheets -->
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
  <link href="{{ asset('theme/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('theme/font-awesome-4.7.0/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/css/animate/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/css/owl-carousel/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/css/owl-carousel/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/css/style.css') }}">
  @yield('css')

</head>

<body id="page-top">

  <!--====================================================
                         HEADER
  ======================================================--> 

  <header>

    <!-- Top Navbar  -->
    <div class="top-menubar">
      <div class="topmenu">
        <div class="container">
          <div class="row">
            <div class="col-md-7">
              <ul class="list-inline top-contacts">
                <li>
                  <i class="fa fa-envelope"></i> Email: <a href="mailto:info@wcs-indonesia.com">info@wcs-indonesia.com</a>
                </li>
                <li>
                  <i class="fa fa-phone"></i> Hotline: (012) 876 10 75
                </li>
              </ul>
            </div> 
            <div class="col-md-5">
              <ul class="list-inline top-data">
                <li><a href="#" target="_empty"><i class="fa top-social fa-facebook"></i></a></li>
                <li><a href="#" target="_empty"><i class="fa top-social fa-twitter"></i></a></li>
                <li><a href="#" target="_empty"><i class="fa top-social fa-google-plus"></i></a></li> 
                {{-- <li><a href="#" class="log-top" data-toggle="modal" data-target="#login-modal">Login</a></li>  --}} 
              </ul>
            </div>
          </div>
        </div>
      </div> 
    </div> 
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav" data-toggle="affix">
      <div class="container">
        <a class="navbar-brand smooth-scroll" href="index.html">
          <img src="{{ asset('images/wcsindologo.jpg') }}" alt="logo">
        </a> 
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> 
              <span class="navbar-toggler-icon"></span>
        </button>  
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
              @foreach ( Menus::getNavbar(['NodeID' => 1]) as $element )
                @if( count(Menus::getNavbar(['NodeID' => $element->id])) > 0 )
                  <li class="nav-item dropdown" >
                    <a class="nav-link dropdown-toggle smooth-scroll" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $element->title }}</a> 
                    <div class="dropdown-menu dropdown-cust" aria-labelledby="navbarDropdownMenuLink">
                      @foreach ( Menus::getNavbar(['NodeID' => $element->id]) as $element2 )
                        <a class="dropdown-item" href="{{ Url('/'.$element2->alias) }}">{{ $element2->title }}</a>
                      @endforeach
                    </div>
                  </li>
                @else
                  <li class="nav-item">
                    <a class="nav-link smooth-scroll" href="{{ Url('/'.$element->alias) }}">{{ $element->title }}</a>
                  </li>
                @endif
              @endforeach
              <li>
                <i class="search fa fa-search search-btn"></i>
                <div class="search-open">
                  <div class="input-group animated fadeInUp">
                    <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                    <span class="input-group-addon" id="basic-addon2">Go</span>
                  </div>
                </div>
              </li> 
              <li>
                <div class="top-menubar-nav">
                  <div class="topmenu ">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-9">
                          <ul class="list-inline top-contacts">
                            <li>
                              <i class="fa fa-envelope"></i> Email: <a href="mailto:db_duabelas@yahoo.com.com">db_duabelas@yahoo.com.com</a>
                            </li>
                            <li>
                              <i class="fa fa-phone"></i> Hotline: (021) 876 10 75
                            </li>
                          </ul>
                        </div> 
                        <div class="col-md-3">
                          <ul class="list-inline top-data">
                            <li><a href="#" target="_empty"><i class="fa top-social fa-facebook"></i></a></li>
                            <li><a href="#" target="_empty"><i class="fa top-social fa-twitter"></i></a></li>
                            <li><a href="#" target="_empty"><i class="fa top-social fa-google-plus"></i></a></li> 
                            <li><a href="#" class="log-top" data-toggle="modal" data-target="#login-modal">Login</a></li>  
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div> 
                </div>
              </li>
          </ul>  
        </div>
      </div>
    </nav>
  </header> 

  <!--====================================================
                      LOGIN OR REGISTER
  ======================================================-->
  <section id="login">
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="fa fa-times" aria-hidden="true"></span>
                    </button>
                </div>
                <div id="div-forms">
                    <form id="login-form">
                        <h3 class="text-center">Login</h3>
                        <div class="modal-body">
                            <label for="username">Username</label> 
                            <input id="login_username" class="form-control" type="text" placeholder="Enter username " required>
                            <label for="username">Password</label> 
                            <input id="login_password" class="form-control" type="password" placeholder="Enter password" required>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Remember me
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <div>
                                <button type="submit" class="btn btn-general btn-white">Login</button>
                            </div>
                            <div>
                                <button id="login_register_btn" type="button" class="btn btn-link">Register</button>
                            </div>
                        </div>
                    </form>
                    <form id="register-form" style="display:none;">
                        <h3 class="text-center">Register</h3>
                        <div class="modal-body"> 
                            <label for="username">Username</label> 
                            <input id="register_username" class="form-control" type="text" placeholder="Enter username" required>
                            <label for="register_email">E-mailId</label> 
                            <input id="register_email" class="form-control" type="text" placeholder="Enter eMail" required>
                            <label for="register_password">Password</label> 
                            <input id="register_password" class="form-control" type="password" placeholder="Password" required>
                        </div>
                        <div class="modal-footer">
                            <div>
                                <button type="submit" class="btn btn-general btn-white">Register</button>
                            </div>
                            <div>
                                <button id="register_login_btn" type="button" class="btn btn-link">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </section>

  @yield('content')

  <!--====================================================
                        FOOTER
  ======================================================--> 
      <footer> 
          <div id="footer-s1" class="footer-s1">
            <div class="footer">
              <div class="container">
                <div class="row">
                  <!-- About Us -->
                  <div class="col-md-3 col-sm-6 ">
                    <div><img src="{{ asset('theme/img/logo-w.png') }}" alt="" class="img-fluid"></div>
                    <ul class="list-unstyled comp-desc-f">
                       <li><p>Businessbox is a corporate business theme. You can customize what ever you think to make your website much better from your great ideas. </p></li> 
                    </ul><br> 
                  </div>
                  <!-- End About Us -->

                  <!-- Recent News -->
                  <div class="col-md-3 col-sm-6 ">
                    <div class="heading-footer"><h2>Useful Links</h2></div>
                    <ul class="list-unstyled link-list">
                      <li><a href="about.html">About us</a><i class="fa fa-angle-right"></i></li> 
                      <li><a href="project.html">Project</a><i class="fa fa-angle-right"></i></li> 
                      <li><a href="careers.html">Career</a><i class="fa fa-angle-right"></i></li> 
                      <li><a href="faq.html">FAQ</a><i class="fa fa-angle-right"></i></li> 
                      <li><a href="contact.html">Contact us</a><i class="fa fa-angle-right"></i></li> 
                    </ul>
                  </div>
                  <!-- End Recent list -->

                  <!-- Recent Blog Entries -->
                  <div class="col-md-3 col-sm-6 ">
                    <div class="heading-footer"><h2>Recent Post Entries</h2></div>
                    <ul class="list-unstyled thumb-list">
                      <li>
                        <div class="overflow-h">
                          <a href="#">Praesent ut consectetur diam.</a>
                          <small>02 OCT, 2017</small>
                        </div>
                      </li>
                      <li>
                        <div class="overflow-h">
                          <a href="#">Maecenas pharetra tellus et fringilla.</a>
                          <small>02 OCT, 2017</small>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <!-- End Recent Blog Entries -->

                  <!-- Latest Tweets -->
                  <div class="col-md-3 col-sm-6">
                    <div class="heading-footer"><h2>Get In Touch</h2></div>
                    <address class="address-details-f">
                      25, Dist town Street, Logn <br>
                      California, US <br>
                      Phone: 800 123 3456 <br>
                      Fax: 800 123 3456 <br>
                      Email: <a href="mailto:info@wcs-indonesia.com">info@wcs-indonesia.com</a>
                    </address>  
                    <ul class="list-inline social-icon-f top-data">
                      <li><a href="#" target="_empty"><i class="fa top-social fa-facebook"></i></a></li>
                      <li><a href="#" target="_empty"><i class="fa top-social fa-twitter"></i></a></li>
                      <li><a href="#" target="_empty"><i class="fa top-social fa-google-plus"></i></a></li> 
                    </ul>
                  </div>
                  <!-- End Latest Tweets -->
                </div>
              </div><!--/container -->
            </div> 
          </div>

          <div id="footer-bottom">
              <div class="container">
                  <div class="row">
                      <div class="col-md-12">
                          <div id="footer-copyrights">
                              <p>Copyrights &copy; 2017 All Rights Reserved by WCS Indonesia. <a href="#">Privacy Policy</a> <a href="#">Terms of Services</a></p>
                          </div>
                      </div> 
                  </div>
              </div>
          </div>
          <a href="#home" id="back-to-top" class="btn btn-sm btn-green btn-back-to-top smooth-scrolls hidden-sm hidden-xs" title="home" role="button">
              <i class="fa fa-angle-up"></i>
          </a>
      </footer>

      <!--Global JavaScript -->
      <script src="{{ asset('theme/js/jquery/jquery.min.js') }}"></script>
      <script src="{{ asset('theme/js/popper/popper.min.js') }}"></script>
      <script src="{{ asset('theme/js/bootstrap/bootstrap.min.js') }}"></script>
      <script src="{{ asset('theme/js/wow/wow.min.js') }}"></script>
      <script src="{{ asset('theme/js/owl-carousel/owl.carousel.min.js') }}"></script>

      <!-- Plugin JavaScript -->
      <script src="{{ asset('theme/js/jquery-easing/jquery.easing.min.js') }}"></script> 
      <script src="{{ asset('theme/js/custom.js') }}"></script> 
      @yield('js')

</body>
</html>
