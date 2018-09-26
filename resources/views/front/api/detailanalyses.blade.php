@extends('front.layouts.main')

@section('title')
 {{ Menus::getLanguageString('idMyProfile') }} {{ Menus::getLanguageString('idAnalysis') }}
@endsection

@section('addingScriptJs')
<script type="text/javascript">
  window.onscroll = function() {
    if(window.pageYOffset >= 0){
      $('.menuatas').removeClass('navbar-shrink');
      $('.menuatas').addClass('navbar-shrink');
    }
  };

  $( "#addNote" ).click(function() {
    $( "#showNote" ).slideDown( "slow", function() {
        // Animation complete.
    });
  });

  $('.addstatement').click(function(){
    var id = $(this).attr('id');
    var number = $(this).attr('number');
    var tipe = $(this).attr('tipe');
    var url = "{{ route('api.myanalyses.liststatement',['mainnode' =>':id' ,'subnode' => ':number','tipe'=>':tipe' ]) }}";
    url = url.replace(':id', id).replace(':number', number).replace(':tipe', tipe);
    
    $.ajax({
      method:"GET",
      url:url,
      success: function(result){
          //alert(result);
          $('.datastatement'+id).html(result);
      },
      error: function(e){
        alert("Error");
        console.log(e);
      }
    });
  });

  $(document).ready(function(){
    $('.menuatas').addClass('navbar-shrink');

    $('body').on('click', '.closeSelectPersonTeam', function(){
      $('#selectPersonTeam').remove();
    });

    $('body').on('click', '.ButtonBottom', function(e){
      // e.preventDafault();
      e.preventDefault();
      var target = $(this).attr('href');
      $('.preloading').show();
      $.ajax({
          method:"GET",
          url:target,
          success: function(result){
              $('.preloading').hide();
              $('#showSelectPersonTeam').html(result);
              $( "#showSelectPersonTeam" ).slideDown( "slow");
              $("#nodeid").val("{{ $NodeID }}");
          },
          error: function(e){
            alert("Error");
            $('.preloading').hide();
            console.log(e);
          }
        });
     });
  });
</script>
@endsection

@section('content')

<section id="hvor" class="content-section hvorfor">

<div class="container">
  <div class="row">
    <div class="col-md-12">

      <center>
        @if (\Session::has('invite'))
          <div class="alert alert-success">
              <h4><span class="glyphicon glyphicon-ok"></span>
                {{ \Session::get('success') }}
              </h4>
          </div>
        @endif

        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <h2 style="text-transform: capitalize;">{{ $data['NodeName'] }} {{ Menus::getLanguageString('IdReport') }}</h2>
              </div>
            </div>

            <h2 style="text-transform: capitalize;">
              {{ Menus::getLanguageString('IdScore') }}
              {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} {{ $tim }}
              {{ $bulan['name'][$thisMonth] ?? date('F y') }}
            </h2>
            
          </div>

          <div id="showNote" style="width: 100%;display: none;">
            <div style="width: 49%;float: center;">
              <table class="table table-bordered" >
                <tr>
                  <th> <i class="fa fa-book" aria-hidden="true"></i> Note in a statement</th>
                </tr>
                <tr>
                  <td>
                    <div style="font-size: 18px;color: #443838;margin-bottom: 8px;">{{-- {{ $data->nodeName }} --}}</div>
                    <textarea style="width: 100%;padding: 15px;" rows="8" class="note"></textarea>
                    <button type="button" class="btn btn-success savenoteleftdet">Save</button>
                    <button type="button" class="btn btn-danger tutup">Close</button>
                  </td>
                </tr>
              </table>
            </div>

            <div style="width: 49%;float: left;">

            </div>

            <div style="clear: both;"></div>
          </div>
        </div>

        <div class="row">
          <div class="hilang col-md-12" style="font-size:25px">
            @if($dateSel['year'] == date('Y')-1)
              <a href="{{ route('profile.analysis.index', ['NodeID' => $NodeID, 'year' => date('Y')-1]) }}">
                <font color="black">{{ Menus::getLanguageString('idLastYear') }}</font>
              </a>
            @else
              <a href="{{ route('profile.analysis.index', ['NodeID' => $NodeID, 'year' => date('Y')-1]) }}">
                {{ Menus::getLanguageString('idLastYear') }}
              </a>
            @endif
            |
            @if($dateSel['year'] == date('Y'))
              <a href="{{ route('profile.analysis.index', ['NodeID' => $NodeID]) }}">
                <font color="black">{{ Menus::getLanguageString('idThisYear') }}</font>
              </a>
            @else
              <a href="{{ route('profile.analysis.index', ['NodeID' => $NodeID]) }}">
                {{ Menus::getLanguageString('idThisYear') }}
              </a>
            @endif

          </div>
        </div>

        <div class="row">
          <div class="col-md-12" style="font-size:25px;">
            <p class='months'>
              @if($data['SurveyRes'] == 0)
                @if($dateSel['year'] == date('Y')-1)
                  No Survey in {{ date('Y')-1 }} <br />
                @else
                  No Survey in {{ date('Y') }} <br />
                @endif
              @endif

              @for($i=0; $i<12; $i++)

                @if($bulan['numb'][$i] == $dateSel['month'])
                  <a class='hilang'
                  href='{{ route('profile.analysis.index',
                          ['NodeID' => $NodeID, 'year' => $dateSel['year'], 'month' => $dateSel['month']]) }}'>
                          <font color='black'><u>{{ $bulan['name'][$i] }}</u></font>
                  </a>
                  <span class='ada'><font color='black'><u>{{ $bulan['name'][$i] }}</u></font></span>
                @else
                  <a class='hilang' href='{{ route('profile.analysis.index',
                          ['NodeID' => $NodeID, 'year' => $dateSel['year'], 'month' => $bulan['numb'][$i]]) }}'>
                          {{ $bulan['name'][$i] }}
                  </a>
                  <span class='ada'>{{ $bulan['name'][$i] }}</span>
                @endif

              @endfor
              <br />
            </p>
          </div>
        </div>

      </center>

    </div>

    {{-- @if (\Session::has('note'))
      <div class="alert alert-success">
          <h4><span class="glyphicon glyphicon-ok"></span>
            {{ \Session::get('success') }}
          </h4>
      </div>
    @endif --}}

  </div> {{-- ///////////////Row///////////////// --}}

  <div class="row">
    {{-- <div class="col-4 mx-auto">
      <div class="card card-body">col-4 mx-auto</div>
    </div> --}}
    
    @foreach($data['dataAnalysis'] as $keyData => $valData)
      
      @if($keyData == 2)
        <div class="col-md-3"></div>
         <div class="col-md-6" style="margin-bottom: 25px;">
      @else
        <div class="col-md-6" style="margin-bottom: 25px;">
      @endif
      <?php #print_r($valData->title);exit; ?>

        <table class="table table-striped table-bordered col-md-6 mx-auto">
          <thead>
            <tr>
              <td colspan="2" class="my_surveyHeader my_survey hilang"
              style="background:{{ $valData->parentColorN }} !important; ">
                {{ $valData->title }}
              </td>
              <td colspan="2" class="my_surveyHeader my_survey ada">
                {{ $valData->title }} 
              </td>
            </tr>

            <tr class="ada">
              <td colspan="1">
                <ul class="list-inline">
                  <li style="float: left;">
                    <a>Dec</a>
                  </li>
                  <li style="float: left;">
                    <a>Jan</a>
                  </li>
                  <li style="float: left;">
                    <a>Feb</a>
                  </li>
                  <li style="float: left;">
                    <a>Mar</a>
                  </li>
                  <li style="float: left;">
                    <a>Apr</a>
                  </li>
                  <li style="float: left;">
                    <a>May</a>
                  </li>
                  <li style="float: left;">
                    <a>Jun</a>
                  </li>
                  <li style="float: left;">
                    <a>Jul</a>
                  </li>
                </ul>
              </td>
            </tr>
          </thead>

          <tbody>
            @if(isset($valData->dataChild))

              @foreach($valData->dataChild as $dataChild )
              <tr>
                <td>
                  <div class="col-md-1 col-sm-1 col-xs-1 hilang">
                      <a href="{{ route('profile.analysisdetleft.index', ['NodeID' => $dataChild->id]) }}"
                        class="bullet" style="background: {{ $dataChild->childColorN }}">
                      </a>
                  </div>

                  <div class="col-md-11 col-sm-11 col-xs-11 hilang" style="margin-left: 7px;">
                    {{ $dataChild->title }}
                  </div>

                    <table class="ada" cellpadding="0" cellspacing="0" style="border: 0px solid;margin-left: -6px;">
                      <tbody>
                        <tr>
                          <td>
                            <a href="#" class="bullet" style="background: "></a>
                          </td>

                          <td>
                            <a href="#" class="bullet" style="background: "></a>
                          </td>

                          <td>
                            <a href="#" class="bullet" style="background: green"></a>
                          </td>

                          <td>
                            <a href="#" class="bullet" style="background: green"></a>
                          </td>

                          <td>
                            <a href="#" class="bullet" style="background: green"></a>
                          </td>

                          <td>
                            <a href="#" class="bullet" style="background: green"></a>
                          </td>

                          <td>
                            <a href="#" class="bullet" style="background: yellow"></a>
                          </td>

                          <td>
                            <a href="#" class="bullet" style="background: yellow"></a>
                          </td>

                          <td>Prosjektmedarbeidernes kunnskaper og erfaringer med prosjektarbeid</td>
                        </tr>
                      </tbody>
                    </table>

                </td>

                <td style="width:25%" class="hilang kanan">
                  @if($valData->title == 'PERSONRESULTATER' || $valData->title == 'SAKSRESULTATER')
                      <a href="{{ route('profile.analysisdetright.index', ['NodeID' => $dataChild->id]) }}"
                      class="bullet hilang" style="background: {{ $dataChild->childColor2  }}"></a>
                      <div class="bullet ada" style="background: {{ $dataChild->childColor2  }} !important;"></div>
                  @endif

                  <a  href="#" id="idmodal" class="btn btn-primary idmodal">
                      <em class="fa fa-pencil"></em>
                  </a>
                  <a href="{{ route('api.myanalyses.removestatement',['id'=>$dataChild->id,'parent'=>$valData->id,'mainnode'=>$NodeID,'tipe'=>$tipe]) }}" class="btn btn-danger idmodal">
                    <em class="fa fa-remove"></em>
                  </a>
                </td>
              </tr>

              @endforeach
            @endif

          </tbody>
        </table>

        <a href="{{ route('profile.analysissurvey.index', ['NodeID' => $valData->id, 'page' => 1, 'ParentNodeID' => $NodeID]) }}" class="btn btn-primary extra hilang"
        style="background:#fff;color:black;border: 1px solid;">
          {{ Menus::getLanguageString('idOH') }}
        </a>

        <a number="{{ $keyData + 99 }}" data-toggle="modal" data-target="#myModal{{ $valData->id }}" id="{{ $valData->id }}" tipe="{{ $tipe }}" class="btn btn-success extra hilang addstatement">
          {{ Menus::getLanguageString('idAddInStatement') }}
        </a>

       
        <!-- Modal -->
        <div id="myModal{{ $valData->id }}" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header" style="display: block;">
                <a href="#" class="close" data-dismiss="modal" ><i class="fa fa-window-close"></i></a>
                <h4 class="modal-title">{{ $valData->title }}</h4>
              </div>
              <div class="modal-body">
                <div class="datastatement{{ $valData->id }}"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>

      </div>
      <!-- @if($keyData == 2)
        <div class="col-md-3"></div>
      @endif -->
    @endforeach
    
    <div style="width: 100%">
      <div class="preloading" style="position: absolute;top:170%;right:50%;">
        <img src="{{ URL::asset('images/preloading2.gif') }}" />
      </div>
      <div id="showSelectPersonTeam" style="display: none;width: 100%" class="row">

      </div>
    </div>

  </div> {{-- ///////////////Row///////////////// --}}
  <div class="row">
      <div class="col-md-12">
          <a href="{{ route('profile.analysissurveyall.index', ['NodeID' => $NodeID]) }}" class="bp btn btn-primary btn-lg"
          style="margin-right:5px;text-transform: capitalize;">
            {{ Menus::getLanguageString('idAllQuestions') }}
          </a>

          <a href="{{ route('profile.analysis.index', ['NodeID' => $NodeID, 'year' => $dateSel['year'],
                                                        'month' => $dateSel['month'], 'team' => 'team']) }}"
          class="bp btn btn-info btn-lg" style="margin-right:5px;text-transform: capitalize;">
            {{ Menus::getLanguageString('idMyGroup') }}
          </a>

          <a href="{{ route('api.profile.selectpersonteam', ['PersonID' => Auth::user()->id]) }}"
            class="bp btn btn-warning btn-lg ButtonBottom" style="margin-right:5px;text-transform: capitalize;">
            {{ Menus::getLanguageString('idSelectPerson') }}
          </a>

        
          <a href="{{ route('analyses.detail', ['id' => $NodeID,'tipe' => 'myanalyse']) }}" class="bp btn btn-primary btn-lg" style="margin-right:5px;text-transform: capitalize;">
            {{ Menus::getLanguageString('idMe') }}
          </a>

        
          <a href="{{ route('api.analyses.deleteanalyses', ['PersonID' => Auth::user()->id]) }}" class="bp btn btn-success btn-lg ButtonBottom" style="text-transform: capitalize;">
            {{ Menus::getLanguageString('idDelete') }}
          </a>

        
          <a href="{{ route('api.invite.member', ['PersonID' => Auth::user()->id]) }}" class="bp btn btn-success btn-lg ButtonBottom" style="text-transform: capitalize;">
            {{ Menus::getLanguageString('idInviteTeamMembers') }}
          </a>

          @if($tipe == "myprojectanalyse")
         
          <a href="{{ route('profile.projectteam.index') }}" class="bp btn btn-success btn-lg" style="text-transform: capitalize;white-space: normal;
      text-align: left;">
            {{ Menus::getLanguageString('idCPTA') }}
          </a>

          @endif

          <button type="button" onclick="window.print();return false;"
          name="" class="bp btn btn-success btn-lg" style="text-transform: capitalize;">
            {{ Menus::getLanguageString('idPrint') }}
          </button>

      </div>
  </div>
</div> {{-- /////////////Container////////////// --}}

</section>




</section>

@endsection
