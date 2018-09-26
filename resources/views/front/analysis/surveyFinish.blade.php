@extends('front.layouts.main')

@section('title')
 {{ Menus::getLanguageString('idSurveyFinish') }}
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

<section id="hvor" class="content-section hvorfor">

<div class="container">
  <div class="row">

    <div class="col-md-12 p">
      <h2 style="margin-bottom: 20px;text-align:center;text-transform: capitalize;">{{ Menus::getLanguageString('idSurveyFinish') }}</h2>

      <a href="{{ route('profile.analysis.index', ['NodeID' => $NodeID]) }}" class="btn btn-primary">
        {{ Menus::getLanguageString('idBackToAnalyse') }}
      </a>
    </div><!-- end col-md-12 -->

  </div><!-- row -->
</div>

</section>




</section>

@endsection
