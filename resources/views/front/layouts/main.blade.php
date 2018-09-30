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
                  <i class="fa fa-envelope"></i> Email: <a href="mailto:{{ App\Entities\Admin\Company::find(1)->Email }}">{{ App\Entities\Admin\Company::find(1)->Email }}</a>
                </li>
                <li>
                  <i class="fa fa-phone"></i> Hotline: {{ App\Entities\Admin\Company::find(1)->phone1 }}
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
        <a class="navbar-brand smooth-scroll" href="/">
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
                      CONTACT HOME
  ======================================================-->
  <div class="overlay-contact-h"></div>
  <section id="contact-h" class="bg-parallax contact-h-bg">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="contact-h-cont">
            <h3 class="cl-white">{{ Menus::getNodeWithImg(['NodeID' => 38])->title }}</h3><br>
            <form action="{{ route('comments.store') }}" method="post">
              @csrf
              <div class="form-group cl-white">
                <label for="name">Your Name</label>
                <input type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter name" name="name" required> 
              </div>  
              <div class="form-group cl-white">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" required> 
              </div>  
              <div class="form-group cl-white">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" aria-describedby="subjectHelp" placeholder="Enter subject" name="subject" required> 
              </div>  
              <div class="form-group cl-white">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="3" required name="message"></textarea>
              </div>  
              <button class="btn btn-general btn-white" role="button"><i fa fa-right-arrow></i>GET CONVERSATION</button>
            </form>
          </div>
        </div>
      </div>
    </div>         
  </section> 

  <!--====================================================
                         NEWS
  ======================================================-->
  <section id="comp-offer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 col-sm-6  desc-comp-offer wow fadeInUp" data-wow-delay="0.2s">
          <h2>Latest News</h2>
          <div class="heading-border-light"></div> 
          <button class="btn btn-general btn-green" role="button">See More</button>
        </div>

        @foreach (Menus::getNavbar(['NodeID' => 29, 'limit' => 3]) as $element)
          <div class="col-md-3 col-sm-6 desc-comp-offer wow fadeInUp" data-wow-delay="0.4s">
            <div class="desc-comp-offer-cont">
              <div class="thumbnail-blogs">
                  <div class="caption">
                    <i class="fa fa-chain"></i>
                  </div>
                  <img src="{{ url(Storage::url($element->medianode1)) }}" class="img-fluid" alt="...">
              </div>
              <h3>{{ $element->title }}</h3>
              <p class="desc">{!! $element->content4 !!}</p>
              <a href="{{ $element->alias }}"><i class="fa fa-arrow-circle-o-right"></i> Learn More</a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

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
                    <div><img src="{{ url(Storage::url(Menus::getNodeWithImg(['NodeID' => 33])->medianode1)) }}" alt="" class="img-fluid"></div>
                    <ul class="list-unstyled comp-desc-f">
                       <li>{!! Menus::getNodeWithImg(['NodeID' => 33])->content1 !!}</li> 
                    </ul><br> 
                  </div>
                  <!-- End About Us -->

                  <!-- Recent News -->
                  <div class="col-md-3 col-sm-6 ">
                    <div class="heading-footer"><h2>Useful Links</h2></div>
                    <ul class="list-unstyled link-list">
                      @foreach ( Menus::getNavbar(['NodeID' => 1]) as $elfoot )
                        <li>
                          @if ( count(Menus::getNavbar(['NodeID' => $elfoot->id])) > 0 )
                            <a href="{{ Menus::getNavbar(['NodeID' => $elfoot->id])[0]->alias }}">{{ $elfoot->title }}</a>
                          @else
                            <a href="{{ $elfoot->alias }}">{{ $elfoot->title }}</a>
                          @endif
                          <i class="fa fa-angle-right"></i>
                        </li>
                      @endforeach 
                    </ul>
                  </div>
                  <!-- End Recent list -->

                  <!-- Recent Blog Entries -->
                  <div class="col-md-3 col-sm-6 ">
                    <div class="heading-footer"><h2>Recent Post Entries</h2></div>
                    <ul class="list-unstyled thumb-list">
                      @foreach (Menus::getNavbar(['NodeID' => 29, 'limit' => 2]) as $element)
                        <li>
                          <div class="overflow-h">
                            <a href="{{ Url('/'.$element->alias) }}">{{ $element->title }}.</a>
                            <small>{{ date('d M, Y', strtotime($element->created_at)) }}</small>
                          </div>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                  <!-- End Recent Blog Entries -->

                  <!-- Latest Tweets -->
                  <div class="col-md-3 col-sm-6">
                    <div class="heading-footer"><h2>Get In Touch</h2></div>
                    <address class="address-details-f">
                      {!! str_replace("</p>", "", str_replace("<p>", "", App\Entities\Admin\Company::find(1)->DeliveryCondition))  !!}<br />
                      Phone: {{  App\Entities\Admin\Company::find(1)->phone1 }} <br>
                      Fax: {{  App\Entities\Admin\Company::find(1)->phone2 }} <br>
                      Email: <a href="mailto:{{ App\Entities\Admin\Company::find(1)->Email }}">{{ App\Entities\Admin\Company::find(1)->Email }}</a>
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
                              <p>Copyrights &copy; 2018 All Rights Reserved by WCS Indonesia. 
                              @foreach (Menus::getNavbar(['NodeID' => 33, 'limit' => 2]) as $term)
                              <a href="{{ $term->alias }}">{{ $term->title }}</a> 
                              {{-- <a href="#">Terms of Services</a> --}}
                              @endforeach
                              </p>
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

      @if (\Session::has('success-message'))
        <script src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
        <script type="text/javascript">
          $.notify({
            title: '<strong>Success!</strong>',
            message: 'Success send meesage to us.'
          },{
            type: 'success'
          });
        </script>
      @endif
      
      @yield('js')

</body>
</html>
