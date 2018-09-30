@extends('front.layouts.main')

@section('title')
WCS Indonesia | {{ $node->title }}
@endsection

@section('keywords')
$node->keyword
@endsection

@section('description')
$node->description
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('theme/css/contact.css') }}">
@endsection

@section('js')
  <script>
    $(document).ready(function(){
     
    });
  </script>
@endsection


@section('content')
  
  <!--====================================================
                         HOME-P
  ======================================================-->
      <div id="home" class="home-p pages-head4 text-center">
        <div class="container">
          <h1 class="wow fadeInUp" data-wow-delay="0.1s">{{ $node->title }}</h1>
        </div><!--/end container-->
      </div> 

  <!--====================================================
                          ABOUT-P1
  ======================================================-->
  <section id="contact-p1" class="contact-p1">
    <div >
      <div class="container">
          <div class="row">
              <div class="col-md-8">
                  <div class="about-p1-cont">
                      {!! $node->content1 !!}
                  </div>
              </div>
              <div class="col-md-4">
                <div class="contact-p1-cont2"> 
                  <address class="address-details-f">
                    {!! str_replace("</p>", "", str_replace("<p>", "", App\Entities\Admin\Company::find(1)->DeliveryCondition))  !!}<br />
                    Phone: {{  App\Entities\Admin\Company::find(1)->phone1 }} <br>
                    Fax: {{  App\Entities\Admin\Company::find(1)->phone2 }} <br>
                    Email: <a href="mailto:{{ App\Entities\Admin\Company::find(1)->Email }}">{{ App\Entities\Admin\Company::find(1)->Email }}</a>
                  </address>
                  <ul class="list-inline social-icon-f top-data">
                    <li><a href="#" target="_empty"><i class="fa top-social fa-facebook" style="height: 35px; width:35px; line-height: 35px;"></i></a></li>
                    <li><a href="#" target="_empty"><i class="fa top-social fa-twitter" style="height: 35px; width:35px; line-height: 35px;"></i></a></li>
                    <li><a href="#" target="_empty"><i class="fa top-social fa-google-plus" style="height: 35px; width:35px; line-height: 35px;"></i></a></li> 
                  </ul>
                </div>
              </div>
          </div>
      </div>
    </div>
  </section>


<!--====================================================
                        CONTACT-P2 
======================================================--> 
<service class="contact-p2" id="contact-p2">
  <div class="container">
    <form action="{{ route('comments.store-front') }}" method="post">
      @csrf
      <div class="row con-form">
        <div class="col-md-4">
          <input type="text" name="name" placeholder="Full Name" class="form-control" required>
        </div>
        <div class="col-md-4">
          <input type="text" name="email" placeholder="Email" class="form-control" name="email" required>
        </div>
        <div class="col-md-4">
          <input type="text" name="subject" placeholder="Subject" class="form-control" required>
        </div>
        <div class="col-md-12"><textarea name="message" id="" placeholder="Message" style="padding: 15px;" required></textarea></div>
        <div class="col-md-12 sub-but"><button class="btn btn-general btn-white" role="button">Send</button></div>
      </div>
    </form>
  </div>
</service>

<!--====================================================
                       MAP
======================================================--> 
<section id="contact-add">
  <div id="map">
    <div class="map-responsive">
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.3781286227627!2d106.81791161476907!3d-6.213760395501839!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f401bd149845%3A0xfab22c8daef828ee!2sMayapada+Tower%2C+Jl.+Jend.+Sudirman+No.Kav.28%2C+RT.4%2FRW.2%2C+Kuningan%2C+Karet%2C+Kecamatan+Setiabudi%2C+Kota+Jakarta+Selatan%2C+Daerah+Khusus+Ibukota+Jakarta+12920!5e0!3m2!1sen!2sid!4v1538155980831" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
  </div> 
</section>

@endsection
