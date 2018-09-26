@extends('front.layouts.main')

@section('title')
 {{ $node->title }}
@endsection

<style type="text/css">
  .navbar{
    margin-bottom: 0px !important;
  }
</style>
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
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: ''}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
@endsection

@section('content')

  <section>
        <img class="img-responsive gambarbk" src="{{ $bgslide1->getImages?Storage::url($bgslide1->getImages->path):"" }}" style="margin-top: 0px;">
  </section>

  	<section id="hvor" class="content-section hvorfor" style="padding-top: 60px;">
        <div class="container">
          <div class="row">
            <div class="col-lg-2">
                <div id="google_translate_element"></div>
            </div>
            <div class="col-lg-6">
              @auth

                <a href="{{ route('blogg.bloggcreate') }}">
                <button class="btn btn-default pull-right" style="text-transform: none">
                  <span class="fa fa fa-plus"> {{ Menus::getLanguageString('idAddBlogg') }}</span>
                </button>
                </a>
              @else

              @endauth
            </div>
            <div class="col-lg-4">
              <form class="navbar-form pull-right" action="{{ Route('blogg.stores') }}" method="POST">
                <button type="submit" class="btn btn-default pull-right" >
                  <span class="fa fa-search"></span>
                </button>
                <input type="text" name="search_name" class="form-control pull-right" placeholder="{{ Menus::getLanguageString('idSearch') }}..." id="searchInput" style="width:200px;border-right:0px solid #fff; border-radius: 0px;"/>
              </form>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-lg-8 mx-auto" style="word-break: break-word;" >
              <div class="card">
                <div class="row">
                  <div class="col-md-10 pull-left">
                    <h2>{!! $node->title !!}</h2>
                  </div>
                  <div class="col-md-2">
                    @auth

                      <h5 class="pull-right">
                        <a href="{{ Route('blogg.edit', ['id' => $node->id,'parent'=>43]) }}">
                          <span class="fa fa-pencil"></span> {{ Menus::getLanguageString('idEdit') }}
                        </a>
                      </h5>

                    @else

                    @endauth

                  </div>
                </div>
                <h5>{!! $node->description !!}, {!! date('Y M d',strtotime($node->created_at)) !!}</h5>
                <div class="{{-- fakeimg --}}" style="background-image: url('{{-- $bgslide2->getImages?URL::asset($bgslide2->getImages->path):"" --}}');">
                  {{-- <img src="{{ $bgslide2->getImages?URL::asset($bgslide2->getImages->path):"" }}" class="img-responsive"> --}}
                </div>

                {!! $node->content1 !!}

              </div>
            </div>

            <div class="col-lg-4 mx-auto">
              <div class="card">
                <h3 style="margin: 0 0 5px;">{{ Menus::getLanguageString('idRelatedBlogg') }}</h3>
                @foreach($sideNode as $sn)
                  <a class="fakeimgs" href="/{{ $sn->node->alias }}">
                    {{ $sn->node->title }}
                  </a>
                @endforeach
              </div>
            </div>

          </div>
        </div>
      </section>

@endsection
