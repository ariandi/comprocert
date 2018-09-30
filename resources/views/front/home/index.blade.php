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
        @foreach ($quotesChild as $qc)
          <div class="col-md-12 ">
            <div class="heading-border bg-white"></div>
            <p class="wow fadeInUp" data-wow-delay="0.4s">
              {!! strip_tags($qc->content1) !!}
            </p>
            <h6>{{ $qc->title }}</h6>
          </div>
        @endforeach
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
              <h3>{{ $provided->title }}</h3>
              <div class="heading-border-light"></div>
              {!! $provided->content1 !!} 
            <div class="service-h-tab"> 
              <nav class="nav nav-tabs" id="myTab" role="tablist">
                @foreach ($providedChild as $kpc => $pc)
                  <a class="nav-item nav-link {{ $kpc==0?'active':'' }}" id="nav-{{ $pc->id }}-tab" data-toggle="tab" href="#nav-{{ $pc->id }}" role="tab" aria-controls="nav-{{ $pc->id }}" aria-expanded="{{ $kpc==0?'true':'false' }}">{{ $pc->title }}</a>
                @endforeach
              </nav>
              <div class="tab-content" id="nav-tabContent">
                @foreach ($providedChild as $kpc2 => $pc2)
                  <div class="tab-pane fade {{ $kpc2==0?'show active':'' }}" id="nav-{{ $pc2->id }}" role="tabpanel" aria-labelledby="nav-{{ $pc2->id }}-tab">
                    {!! $pc2->content2 !!}
                  </div>
                @endforeach
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
