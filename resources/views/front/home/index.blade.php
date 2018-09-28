@extends('front.layouts.main')

@section('title')
WCS Indonesia | Certification Body
@endsection

@section('keywords')
Home
@endsection

@section('description')
Home
@endsection

@section('css')
@endsection

@section('js')
  <script>
    $(document).ready(function(){
     
    });
  </script>
@endsection


@section('content')
  
  <!--====================================================
                           HOME
  ======================================================-->
  <section id="home">
    <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel"> 
      <!-- Carousel items -->
      <div class="carousel-inner">
          <div class="carousel-item active slides">
            <div class="overlay"></div>
            <div class="slide-1"></div>
              <div class="hero ">
                <hgroup class="wow fadeInUp">
                    <h1>We Help <span ><a href="" class="typewrite" data-period="2000" data-type='[ " Certification", " Training"]'>
                      <span class="wrap"></span></a></span> </h1>
                    <h3>Welcome to WCS Indonesia</h3>        
                    <h3>World Certification Services (WCS) is a UKAS Accredited Certification Body providing Assessment and Certification Services against many international standards, including ISO 9001, ISO 14001 and OHSAS 18001.</h3>
                </hgroup>
                <button class="btn btn-general btn-green wow fadeInUp" role="button">Contact Now</button>
              </div>           
          </div> 
      </div> 
    </div> 
  </section> 

  <!--====================================================
                          ABOUT
  ======================================================-->
  <section id="about" class="about">
    <div class="container">
      <div class="row title-bar">
        <div class="col-md-12">
          <h1 class="wow fadeInUp">{{ $homeContent1->title }}</h1>
          <div class="heading-border"></div>
          <p class="wow fadeInUp" data-wow-delay="0.4s">{!! $homeContent1->content2 !!}</p>
          <div class="title-but">
            <a class="btn btn-general btn-green" role="button" href="{!! $homeContent1->alias !!}">Read More</a>
          </div>
        </div>
      </div>
    </div>  
    <!-- About right side withBG parallax -->
    <div class="container-fluid">
      <div class="row"> 
        @foreach ($tigaIcon as $ti)
          <div class="col-md-4 {{ $ti->alias }}">
            <div class="about-content-box wow fadeInUp" data-wow-delay="{{ $ti->description }}">
              <i class="{{ $ti->keyword }}"></i>
              <h5>{{ $ti->title }}</h5>
              <p class="desc">{!! $ti->content1 !!}</p>
            </div>
          </div>
        @endforeach
      </div> 
    </div>       
  </section>

  <!--====================================================
                          OFFER
  ======================================================-->
  <section id="comp-offer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 col-sm-6 desc-comp-offer wow fadeInUp" data-wow-delay="0.2s">
          <h2>{{ $whatWeOffer->title }}</h2>
          <div class="heading-border-light"></div> 
          <button class="btn btn-general btn-green" role="button">See Curren Offers</button>
          <a class="btn btn-general btn-white" role="button" href="{{ url('contact') }}">Contact Us Today</a>
        </div>
        @foreach ($whatWeOfferChild as $wwoc)
          <div class="col-md-3 col-sm-6 desc-comp-offer wow fadeInUp" data-wow-delay="0.4s">
            <div class="desc-comp-offer-cont">
              <div class="thumbnail-blogs">
                  <div class="caption">
                    <i class="fa fa-chain"></i>
                  </div>
                  <img src="{{ url(Storage::url($wwoc->path)) }}" class="img-fluid" alt="...">
              </div>
              <h3>{{ $wwoc->title }}</h3>
              <p class="desc">{{ $wwoc->keyword }}</p>
              <a href="{{ $wwoc->alias }}"><i class="fa fa-arrow-circle-o-right"></i> Learn More</a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  

  <!--====================================================
                    COMPANY THOUGHT
  ======================================================-->
  <div class="overlay-thought"></div>
  <section id="thought" class="bg-parallax thought-bg">
    <div class="container">
      <div id="thought-desc" class="row title-bar title-bar-thought owl-carousel owl-theme">
        <div class="col-md-12 ">
          <div class="heading-border bg-white"></div>
          <p class="wow fadeInUp" data-wow-delay="0.4s">Businessbox will deliver value to all the stakeholders and will attain excellence and leadership through such delivery of value. We will strive to support the stakeholders in all activities related to us. Businessbox provide great things.</p>
          <h6>John doe</h6>
        </div>
        <div class="col-md-12 thought-desc">
          <div class="heading-border bg-white"></div>
          <p class="wow fadeInUp" data-wow-delay="0.4s">Ensuring quality in Businessbox is an obsession and the high quality standards set by us are achieved through a rigorous quality assurance process. Quality assurance is performed by an independent team of trained experts for each project. </p>
          <h6>Tom John</h6>
        </div>
      </div>
    </div>         
  </section> 
      
  <!--====================================================
                     SERVICE-HOME
  ======================================================--> 
  <section id="service-h">
      <div class="container-fluid">
        <div class="row" >
          <div class="col-md-6" >
            <div class="service-himg" > 
              <iframe src="https://www.youtube.com/embed/754f1w90gQU?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
            </div>
          </div>
          <div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="service-h-desc">
              <h3>We are Providing great Services</h3>
              <div class="heading-border-light"></div> 
              <p>Businessbox offer the full spectrum of services to help organizations work better. Everything from creating standards of excellence to training your people to work in more effective ways.</p>  
            <div class="service-h-tab"> 
              <nav class="nav nav-tabs" id="myTab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-expanded="true">Developing</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile">Training</a> 
                <a class="nav-item nav-link" id="my-profile-tab" data-toggle="tab" href="#my-profile" role="tab" aria-controls="my-profile">Medical</a> 
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><p>Nulla est ullamco ut irure incididunt nulla Lorem Lorem minim irure officia enim reprehenderit. Magna duis labore cillum sint adipisicing exercitation ipsum. Nostrud ut anim non exercitation velit laboris fugiat cupidatat. Commodo esse dolore fugiat sint velit ullamco magna consequat voluptate minim amet aliquip ipsum aute. exercitation ipsum. Nostrud ut anim non exercitation velit laboris fugiat cupidatat. Commodo esse dolore fugiat sint velit ullamco magna consequat voluptate minim amet aliquip ipsum aute. </p></div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                  <p>Nulla est ullamco ut irure incididunt nulla Lorem Lorem minim irure officia enim reprehenderit. Magna duis labore cillum sint adipisicing exercitation ipsum. Nostrud ut anim non exercitation velit laboris fugiat cupidatat. Commodo esse dolore fugiat sint velit ullamco magna consequat voluptate minim amet aliquip ipsum aute</p>
                </div> 
                <div class="tab-pane fade" id="my-profile" role="tabpanel" aria-labelledby="my-profile-tab">
                  <p>Nulla est ullamco ut irure incididunt nulla Lorem Lorem minim irure officia enim reprehenderit. Magna duis labore cillum sint adipisicing exercitation ipsum. Nostrud ut anim non exercitation velit laboris fugiat cupidatat. Commodo esse dolore fugiat sint velit ullamco magna consequat voluptate minim amet aliquip ipsum aute</p>
                </div> 
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>  
  </section>

  <!--====================================================
                        CLIENT
  ======================================================-->
  {{-- <section id="client" class="client">
    <div class="container">
      <div class="row title-bar">
        <div class="col-md-12">
          <h1 class="wow fadeInUp">Our Client Say</h1>
          <div class="heading-border"></div>
          <p class="wow fadeInUp" data-wow-delay="0.4s">We committed to helping you maintain your Brand Value.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="client-cont wow fadeInUp" data-wow-delay="0.1s">
            <img src="{{ asset('theme/img/client/avatar-6.jpg') }}" class="img-fluid" alt="">
            <h5>Leesa len</h5>
            <h6>DSS CEO & Cofounder</h6>
            <i class="fa fa-quote-left"></i>
            <p>The Businessbox service - it helps fill our Business, and increase our show up rate every single time.</p>
          </div>
        </div>
        <div class="col-md-6 col-sm-12">
          <div class="client-cont wow fadeInUp" data-wow-delay="0.3s">
            <img src="{{ asset('theme/img/client/avatar-2.jpg') }}" class="img-fluid" alt="">
            <h5>Dec Bol</h5>
            <h6>TEMS founder</h6>
            <i class="fa fa-quote-left"></i>
            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece.</p>
          </div>
        </div>
      </div>
    </div>        
  </section>   --}}
@endsection
