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
<link rel="stylesheet" href="{{ asset('theme/css/about.css') }}">
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
      <div id="home" class="home-p pages-head1 text-center">
          <div class="container">
              {!! $node->content4 !!}
          </div>
          <!--/end container-->
      </div>

  <!--====================================================
                          ABOUT-P1
  ======================================================-->
      <section id="about-p1">
        <div id="">
          <div class="container">
              <div class="row">

                  @if( isset($node->getImages4) )
                  <div class="col-md-12">
                    <img src="{{ url(Storage::url($node->getImages4->path)) }}" class="img-responsive" style="margin:auto;display: block;max-width: 100%;">
                  </div>
                  @endif

                  <div class="col-md-8">
                      <div class="about-p1-cont">
                          {!! $node->content1 !!}
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="about-p1-img">
                          @if( isset($node->getImages->path) )
                            <img src="{{ url(Storage::url($node->getImages->path)) }}" class="img-fluid wow fadeInUp" data-wow-delay="0.1s" alt="...">
                          @endif
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </section>

@endsection
