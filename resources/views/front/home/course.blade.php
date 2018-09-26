@extends('front.layouts.main')

@section('title')
 
@endsection

@section('addingScriptJs')
<script type="text/javascript">
  window.onscroll = function() {
    if(window.pageYOffset >= 0){
      $('.menuatas').removeClass('navbar-shrink');
      $('.menuatas').addClass('navbar-shrink');
    }
  };

  $(document).ready(function(){
    $('.menuatas').addClass('navbar-shrink');
  });
</script>
@endsection

@section('content')

<div class="visible-lg besar" style="margin-top: -20px;">
  <header class="gambarutama">
	  <div class="intro-body">
     <!-- <div class="col-md-12 col-lg-12">  -->
     <div class="container">
	      <div class="row">
	        <div class="col-lg-6 bagianbawah" style="text-align: left;">
	          <h1 class="brand-heading regulasi1" style="margin-bottom: 0px;margin-left: -20px;">
	            <img src="{{ url('assets/img/logochange66.png') }}" class="img-responsive" alt="" />
	          </h1>
            <br>
            <br>
	          <h1 style="margin: 0 0 15px;"><b style="color: #901823;text-transform: none;">{{ Menus::getLanguageString('idC66H1') }}</b></h1>
            <h2 style="margin: 0 0 15px;color: #901823;text-transform: none;">{{ Menus::getLanguageString('idC66H2') }}</h2>
            
            
	          {{-- <ul class="list-unstyled" style="text-align: left;">
	            <li><h3 class="" style="color: #000; margin: 0;">• {{ Menus::getLanguageString('idOrganization1') }}</h3></li><!-- #f7b100 -->
	            <li><h3 class="" style="color: #000; margin: 0;">• {{ Menus::getLanguageString('idManagementTeam') }}</h3></li>
	            <li><h3 class="" style="color: #000; margin: 0;">• {{ Menus::getLanguageString('idYourLeaderRole') }}</h3></li>
	          </ul> --}}
            <br>
            <br>
            <br>
            <br>
            <h2 style="margin: 0 0 15px;color: #901823;">{{ Menus::getLanguageString('idC66H3') }}</h2> 
            
            

	         {{--  <a href="#vare_tjenester" class="btn btn-success js-scroll-trigger" style="background-color: #901823; border: 1px solid;"> {{ Menus::getLanguageString('idOurServices') }} </a> --}}

          </div>
          <div class="col-md-6">
          </div>


                   {{-- <div class="col-lg-6 tempat ml-md-auto" style="text-align: left;">
                    <div class="row" style="margin-top: 75px;">
                      <div class="col-md-12">
                        <div class="row" style="padding-left:40px;">
                            <div class="col-md-4">
                                  <div class="center-text">
                                   <div class="clip-wrap">

                                      <div class="clip-each border-style-thin1">
                                        <div class="overlay-content" style="color:black;">
                                          {{ Menus::getLanguageString('idMotivate') }}
                                        </div>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4" style="padding-left:40px;">
                               <div class="center-text">
                                  <div class="clip-wrap">
                                        <div class="clip-each border-style-thin2">
                                      <div class="overlay-content">{{ Menus::getLanguageString('idChange') }}</div>
                                   </div>
                                </div>
                              </div>
                          </div>

                          <div class="col-md-4" style="padding-left:65px">
                              <div class="center-text">
                                  <div class="clip-wrap">
                                    <div class="clip-each border-style-thin3">
                                      <div class="overlay-content">{{ Menus::getLanguageString('idAction') }}</div>
                                    </div>
                                  </div>
                              </div>
                          </div>

                          <div style="clear:both"></div>

                        </div>
                </div>
              </div>
	        </div> --}}
	      </div>
      </div>
	<!-- </div>  -->

            <div class="panel panel-info" style="opacity: 0.9;border-color: #000000;margin-top: 5px;">
              <div class="panel-heading clearfix" style="background-color: #000000;border-color: #f0f8ff00;padding-top: 35px;padding-bottom: 35px;">
              <div class="container">
                <form method="POST" action="{{ route('front.sendEmailSubscript') }}">
                <div class="form-group">
                  @csrf
                <div class="row">
                  
                  <div class="col-md-12">
                  <div class="seperator"></div>
                   <!-- <h1 class=" pull-left" style="color: white;">{{ Menus::getLanguageString('idC66S1') }}</h1>  -->
                    <div class="col-md-6" style="padding-left: 0px;">
                    <h1 class=" center" style="color: white;text-align: center;">{{ Menus::getLanguageString('idC66S1') }}</h1>                     
                    </div>
                    <div class="col-md-6">
                    <h1 class=" center" style="color: white;text-align: center;">{{ Menus::getLanguageString('idC66D1') }}</h1> 
                      </div>
                   </div>
                  
                  <div class="col-md-12">
                  <div class="seperator"></div>
                    <div class="col-md-6">
                      <h3 class="center" style="color: white;text-align: center;">{{ Menus::getLanguageString('idC66S2') }}</h3>  
                          </div>
                   <div class="col-md-6">
                   </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-12">
                  <div class="seperator"></div>
                   <div class="col-lg-6 col-md-6">
                    <div class="input-group" style="width: 100%; ">
                    <div class="seperator"></div>
                      <input type="text" name="name" class="form-control" aria-label="..." placeholder="Skriv inn navn">
                      </div><!-- /input-group -->
                      <br>
                      <div class="input-group" style="width: 100%;">
                      <input type="text" class="form-control" name="email" aria-label="..." placeholder="skriv inn e-post">
                    </div><!-- /input-group -->
                     <br>
                     <div class="input-group" style="width: 100%;text-align: left;">
                    <input type="submit" name="sendemail" tabindex="1" value="{{ Menus::getLanguageString('idC66S3') }}" class="btn btn-danger" id="" style="font-size: 24px;"> 
                     </div><!-- /input-group -->
                   </div><!-- /.col-lg-6 -->
                  <div class="w-100"></div>
                  <div class="col-md-3">
                  <a href='https://itunes.apple.com/us/app/change66/id1290125333?ls=1&mt=8'><img src="{{ url('assets/img/apple.png') }}" class="img-responsive" alt="" /></a>
                  </div>
                  <div class="col-md-3">
                  <a href='https://play.google.com/store/apps/details?id=com.wisehouse.change66v2&hl=en_US'><img src="{{ url('assets/img/googleplay.png') }}" class="img-responsive" alt="" /></a>
                  </div>
                    </div>
                  
                </div>
                </form>
              </div>
                   </div>


            {{--  <div class="panel-body">
                  <div class="btn-group pull-right">
                    <a href="#" class="btn btn-default btn-sm">## Lock</a>
                    <a href="#" class="btn btn-default btn-sm">## Delete</a>
                    <a href="#" class="btn btn-default btn-sm">## Move</a>
                  </div>
              </div> --}}
            </div>
          </div>

<svg class="clip-svg">
            <defs>
                <clipPath id="octagon-clip" clipPathUnits="objectBoundingBox">
                    <polygon points="0.3 0, 0.7 0, 1 0.0, 1 0.7, 0.7 1, 0.3 1, 0 0.7, 0 0.0" />
                </clipPath>
            </defs>
  </svg>
    </header>
     <div class="container-fluid" style="border-top: 10px solid white">
        &nbsp;
    </div>
</div>


<!-- untuk layar kecil -->

<div class="hidden-lg">

	  <div class="intro-body" style="background-image:url(https://change66.no/assets/img/latihan.jpg);background-repeat: round;margin-top: -20px;margin-bottom: -10px;">
     {{--  <img src="https://change66.no/assets/img/picrune.png" class="img-responsive"> --}}
     <!-- <div class="col-md-12 col-lg-12">  -->
     <div class="container">
	      <div class="row">
	        <div class="col-md-12 col-xs-10" style="text-align: left;">

	          <h3 class="brand-heading regulasi1" style="margin-top: 25px; margin-bottom: 0px;margin-left: -15px;">
	            <img src="{{ url('assets/img/logochange66.png') }}" class="img-responsive" alt="" style="max-width: 65%;" />
	          </h3>
	          <h4 style="margin: 0 0 15px;"><b style="color: #901823;text-transform: none;">{{ Menus::getLanguageString('idC66H1') }}</b></h4> 
            <h4 style="margin: 0 0 15px;color: #901823;text-transform: none;">{{ Menus::getLanguageString('idC66H2') }}</h4> 
           
            {{-- <ul class="list-unstyled" style="text-align: left;">
              <li><h3 class="" style="color: #000; margin: 0;">• {{ Menus::getLanguageString('idOrganization1') }}</h3></li><!-- #f7b100 -->
              <li><h3 class="" style="color: #000; margin: 0;">• {{ Menus::getLanguageString('idManagementTeam') }}</h3></li>
              <li><h3 class="" style="color: #000; margin: 0;">• {{ Menus::getLanguageString('idYourLeaderRole') }}</h3></li>
            </ul> --}}
            <br>
              <h4 style="margin: 0 0 15px;color: #901823;">{{ Menus::getLanguageString('idC66H3') }}</h4>
             

          </div>

          {{-- <div class="col-md-12 masthead3a tempat" style="text-align: center;">

                      <div class="center-text" style="float:center">
                         <div class="clip-wrap">
                       <div class="clip-each border-style-thin1">
                    <div class="overlay-content" style="color:black;">{{ Menus::getLanguageString('idMotivate') }}</div>
                  </div>
                </div>
            </div>

             <div class="center-text"  style="float:center">
                <div class="clip-wrap">
                      <div class="clip-each border-style-thin2">
                    <div class="overlay-content">{{ Menus::getLanguageString('idChange') }}</div>
                 </div>
              </div>
            </div>

             <div class="center-text" style="float:center">
                <div class="clip-wrap">
                      <div class="clip-each border-style-thin3">
                    <div class="overlay-content">{{ Menus::getLanguageString('idAction') }}</div>
                 </div>
              </div>
          </div>
          <svg class="clip-svg">
            <defs>
                <clipPath id="octagon-clip" clipPathUnits="objectBoundingBox">
                    <polygon points="0.3 0, 0.7 0, 1 0.0, 1 0.7, 0.7 1, 0.3 1, 0 0.7, 0 0.0" />
                </clipPath>
            </defs>
          </svg>
	      </div> --}}
      </div>
</div>
{{-- <div class="container-fluid" style="border-top: 10px solid white">
        &nbsp;
    </div> --}}
</div>

<section id="download" class="text-center" style="background-color: #000000;margin-bottom: -10px;">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <div class="panel-info" style="opacity: 0.9;border-color: #000000;margin-top: 5px;">
              <div class="clearfix" style="background-color: #000000;border-color: #f0f8ff00;padding-top: 35px;padding-bottom: 35px;">
              <div class="container">
               
                  <div class="col-md-6">
                      <h3 class=" pull-left" style="color: white;">{{ Menus::getLanguageString('idC66S1') }}</h3> 
                     
                  </div>
                  
                  <div class="">
                      <h4 class="  pull-left" style="color: white;">{{ Menus::getLanguageString('idC66S2') }}</h4> 
                      
                  </div>
                
                <div class="row">
                  <div class="col-lg-5">
                    <div class="input-group" style="width: 100%;">
                      <input type="text" class="form-control" aria-label="..." placeholder="Enter Name">
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-5 -->
                  <div class="col-lg-5">
                    <div class="input-group" style="width: 100%;">
                      <input type="text" class="form-control" aria-label="..." placeholder="Enter Email">
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-5 -->
                  <div class="col-lg-2" style="margin-top: -5px;">
                    <input type="submit" tabindex="1" value="{{ Menus::getLanguageString('idC66S3') }}" class="btn btn-danger" id="" style="font-size: 16px;"> 
                   
                  </div><!-- /.col-lg-2 -->
                </div><!-- /.row -->
                <br>
                <br>
                <div class="row">
                <hr style="height: 2px;background-color:white;">
                <div class="col-md-6">
                <h3 class=" pull-left" style="color: white;">Din reise for personlige utvikling begynner her, last ned Change 66 nå</h3>
                   <div class="col-md-3">
                   <a href='https://itunes.apple.com/us/app/change66/id1290125333?ls=1&mt=8'><img src="{{ url('assets/img/apple.png') }}" class="img-responsive" alt="" /></a>
                  </div>
                  <div class="col-md-3">
                  <a href='https://play.google.com/store/apps/details?id=com.wisehouse.change66v2&hl=en_US'><img src="{{ url('assets/img/googleplay.png') }}" class="img-responsive" alt="" /></a>
                  </div>
                </div>
                </div>
                  
              </div>
             {{-- <div class="panel-body">
                  <div class="btn-group pull-right">
                    <a href="#" class="btn btn-default btn-sm">## Lock</a>
                    <a href="#" class="btn btn-default btn-sm">## Delete</a>
                    <a href="#" class="btn btn-default btn-sm">## Move</a>
                  </div>
              </div> --}}
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>

    </div>


	<a href="https://www.wisehouse.no/internett1/index.php?t=publish.indexbaru&amp;NodeID=&amp;inline=edit" accesskey="E"></a>

  <!-- About Section -->

    <!-- <div class="container-fluid" style="border-top: 10px solid white">
        &nbsp;
    </div> -->
<br>
<br>

<!-- <div class="col-md-4 col-xs-12 align-middle">
         <div class="card" style="border: 1px solid; margin-bottom: 20px;">
         <a class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="//www.youtube.com/embed/wMuNjnNyaiA" allowfullscreen></iframe>
          </a>
         <h2>Video title</h2>
         <p>uraian</p>
	      </div>
        </div> -->



    <section class="download-section sectiondk tambahan2"></section>          
  	<section class="download-section sectiondk">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-xs-12 ">
                <div class="thumbnail">
                <a class="embed-responsive embed-responsive-16by9">
                <img src="{{ url('assets/img/se.png') }}" alt="Sample Image" class="tengah">
                     </a>
                    <div class="caption">
                        <h3>Opprett profil med firma avtale</h3>
                        <p>Ditt firma nå være opprettet som kunde først.</p>
                        <p><a href="#" class="btn btn-primary">Share</a> <a href="#" class="btn btn-default">Download</a></p>
                    </div>
                </div>
            </div>
          <div class="col-md-4 col-xs-12 align-middle">
                <div class="card" style="border: 1px solid; margin-bottom: 20px;">
                    <a class="embed-responsive embed-responsive-16by9">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/yfYAyoagpNs" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                     </a>
                    <h3>Opprett profil som privat person</h3>
                    <p>Du får gratis tilgang til våre verktøy for private brukere.</p>
                    <p><a href="#" class="btn btn-primary">Share</a> <a href="#" class="btn btn-default">Download</a></p>
                </div>    
        </div>
            <div class="col-md-4 col-xs-12 ">
                <div class="thumbnail">
                    <img src="{{ url('assets/img/se.png') }}" alt="Sample Image" class="tengah">
                    <div class="caption">
                        <h3>Grunnleggende om våre analyser</h3>
                        <p>Vi har mange standard analyser og du kan lage dine egne basert på 1000 vis av påstander og tilhørende spørsmål.</p>
                        <p><a href="#" class="btn btn-primary">Share</a> <a href="#" class="btn btn-default">Download</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>     
</div>
  </section>
  
 
      <div class="container">
         <hr style="height: 2px;">
        </div>
      
	

  		<section>
      <div class="container">
        <div class="row">
            <div class="col-md-4 col-xs-12 ">
                <div class="thumbnail">
                    <img src="{{ url('assets/img/se.png') }}" alt="Sample Image" class="tengah">
                    <div class="caption">
                        <h3>Gjennomfør en analyse</h3>
                        <p>Hva er viktig og hvordan analyseres og måles dine svar.</p>
                        <p><a href="#" class="btn btn-primary">Share</a> <a href="#" class="btn btn-default">Download</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 ">
                <div class="thumbnail">
                    <img src="{{ url('assets/img/se.png') }}" alt="Sample Image" class="tengah">
                    <div class="caption">
                        <h3>Hva viser en analyse</h3>
                        <p>Se hvilke faktorer som påvirker ditt resultat og få forslag til tiltak og forbedringsområder.</p>
                        <p><a href="#" class="btn btn-primary">Share</a> <a href="#" class="btn btn-default">Download</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 ">
                <div class="thumbnail">
                    <img src="{{ url('assets/img/se.png') }}" alt="Sample Image" class="tengah">
                    <div class="caption">
                        <h3>Opprett team</h3>
                        <p>Opprett team, inviter team medlemmer, se team resultater mm.</p>
                        <p><a href="#" class="btn btn-primary">Share</a> <a href="#" class="btn btn-default">Download</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>     
</div>
	</section>

 
      <div class="container">
         <hr style="height: 2px;">
        </div>
      
		

<section>
      <div class="container">
        <div class="row">
            <div class="col-md-4 col-xs-12 ">
                <div class="thumbnail">
                    <img src="{{ url('assets/img/se.png') }}" alt="Sample Image" class="tengah">
                    <div class="caption">
                        <h3>Lag din egen analyse eller opprett egne prosjekt analyser</h3>
                        <p>Lag en analyse for hvert prosjekt eller lag en egen analyse og del denne med dine kolleger eller familie.</p>
                        <p><a href="#" class="btn btn-primary">Share</a> <a href="#" class="btn btn-default">Download</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 ">
                <div class="thumbnail">
                    <img src="{{ url('assets/img/se.png') }}" alt="Sample Image" class="tengah">
                    <div class="caption">
                        <h3>Mine tiltak og gjør det</h3>
                        <p>Hvordan iverksette og gjennomføre tiltak, lag notater og del resultatet.</p>
                        <p><a href="#" class="btn btn-primary">Share</a> <a href="#" class="btn btn-default">Download</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 ">
                <div class="thumbnail">
                    <img src="{{ url('assets/img/se.png') }}" alt="Sample Image" class="tengah">
                    <div class="caption">
                        <h3>Hjelp og support</h3>
                        <p>Hvordan få teknisk support fra vår support avdeling.</p>
                        <p><a href="#" class="btn btn-primary">Share</a> <a href="#" class="btn btn-default">Download</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>     
</div>
	</section>


@endsection
