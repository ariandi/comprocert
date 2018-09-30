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
<link rel="stylesheet" href="{{ asset('theme/css/news.css') }}">
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
    <h1 class="wow fadeInUp" data-wow-delay="0.1s">{{ $node->title }}</h1>
    <p>Discover more</p>
  </div><!--/end container-->
</div> 

<!--====================================================
                      NEWS DETAILS
======================================================--> 
<section id="single-news-p1" class="single-news-p1">
  <div class="container">
    <div class="row">

      <!-- left news details -->
      <div class="col-md-8">
        <div class="single-news-p1-cont">
          <div class="single-news-img">
            <img src="{{ url(Storage::url($node->getImages->path)) }}" alt="{{ $node->title }}" class="img-fluid">
          </div>
          <div class="single-news-desc">
            <h3>{{ $node->title }}</h3>
            <ul class="list-inline">
              <li>Posted: <span class="text-theme-colored2"> {{ date('d/m/Y', strtotime($node->created_at)) }}</span></li>
              <li>By: <span class="text-theme-colored2">Admin</span></li>
              <li><i class="fa fa-comments-o"></i> 0 comments</li>
            </ul>
            <hr>
            <div class="bg-light-gray">
              {!! $node->content1 !!}
            </div>
            
          </div>
        </div>  
        <hr>
      </div>

      <!-- Right news details -->
      <div class="col-md-4">
        <div class="small-news-box">
          @foreach (Menus::getNavbar(['NodeID' => 29, 'limit' => 3]) as $newList)
            <a href="">
              <div class="right-side-sn-cont">
                <img src="{{ url(Storage::url($newList->medianode1)) }}" alt="" class="img-fluid">
                {!! substr($newList->content1, 0, 62) !!}...</p>
                <small><fa class="fa-watch"> {{ date('d M, y', strtotime($newList->created_at)) }}</fa></small>
              </div>
            </a>
          @endforeach
        </div>
        <div class="ad-box-sn"> 
          <h3 class="pb-2">Our Services</h3>
          @foreach (Menus::getNavbar(['NodeID' => 37, 'limit' => 3]) as $serList)
            <div class="card">
              <div class="desc-comp-offer-cont">
              <div class="thumbnail-blogs">
                  <div class="caption">
                    <i class="fa fa-chain"></i>
                  </div>
                  <img src="{{ url(Storage::url($serList->medianode1)) }}" class="img-fluid" alt="...">
              </div>
              <h3>{{ $serList->title }}</h3>
              <p class="desc">Clamp meter connected to an AC monitors the current flow and indicates usage (range) through green, orange and red colour codes.</p>
              <a href="{{ Url('/'.$serList->alias) }}"><i class="fa fa-arrow-circle-o-right"></i> Learn More</a>
              </div>
            </div>
          @endforeach

        </div>
      </div> 
    </div>
  </div>
</section>

@endsection
