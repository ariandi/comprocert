@extends('front.layouts.main')

@section('title')
 {{ Menus::getLanguageString('idSurvelAll') }}
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
    <form method="post" action="{{ route('profile.analysissurvey.storeall', ['NodeID' => $NodeID]) }}" style="width: 100%;">
    {{csrf_field()}}
    <h2 style="margin-bottom: 20px;text-align:center;">{{ $data['nodeName'] }}</h2>

      <div class="col-md-12 p">

        <div class="progress">
          <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:{{ $persentase['b'] }}%">
            {{ $persentase['b'] }}% {{ Menus::getLanguageString('idCompleteSurvey') }}
          </div>
        </div>

        <div class="pageinfo">
          {{ Menus::getLanguageString('idPage') }} {{ $data['page'] }} {{ Menus::getLanguageString('idOf') }} {{ $persentase['a'] }}
        </div>

        <div class="pageinfo">
          Showing {{ Menus::getLanguageString('idQuestion') }} from {{ $data['from'] }} to {{ $data['perPage'] }} Of 
          {{ $data['countData'] }} {{ Menus::getLanguageString('idQuestion') }}

        <table class="table">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($dataArr['dataAnalysis'] as $dataChildSub)

                <tr>
                  <td>{{ $dataChildSub->ProductName }}</td>
                  <td>
                    <div class="">
                      <input id="inputGradient" class="extraquestion" type="range" name="Score[{{ $dataChildSub->ProductID }}]" min="1" max="5.00000"
                      value="{{ $dataChildSub->Score }}" onchange="rangeSuccess7407.value=value">
                    </div>
                  </td>

                  <td style="width: 20%;">
                    @if($dataChildSub->Score == 0)
                      <input type="checkbox" name="Not[{{ $dataChildSub->ProductID }}]" value="1" checked="checked">{{ Menus::getLanguageString('idNotRelevant') }}
                    @else
                      <input type="checkbox" name="Not[{{ $dataChildSub->ProductID }}]" value="1">{{ Menus::getLanguageString('idNotRelevant') }}
                    @endif

                    <input type="hidden" name="ProductID[{{ $dataChildSub->ProductID }}]" value="{{ $dataChildSub->ProductID }}">
                  </td>
                </tr>

            @endforeach
          </tbody>
        </table>
      </div><!-- end col-md-12 -->

      <div class="col-md-12" style="margin-top: 30px;">

      <input type="hidden" name="page" value="{{ $data['page'] }}">
      <input type="hidden" name="totalpage" value="{{ $persentase['a'] }}">
      <button type="submit" class="btn btn-success btn-lg">
        {{ Menus::getLanguageString('idSave') }}
      </button>

      </div>
      </form>


  </div><!-- row -->
</div>

</section>




</section>

@endsection
