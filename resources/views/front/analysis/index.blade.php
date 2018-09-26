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

  $(document).ready(function(){

    $('.menuatas').addClass('navbar-shrink');

    $( "#addNote" ).click(function() {
      $( "#showNote" ).slideDown( "slow", function() {
        // Animation complete.
      });
    });

   $('.tutup').click(function(){
      $( "#showNote" ).slideUp( "slow", function() {
        // Animation complete.
      });
    });

   $('body').on('click', '.saveyesdoit', function(){

      var formData = {
                note : $('.noteatasyesdoit').val(),
                _token  : $('meta[name="csrf-token"]').attr('content'),
                _method: 'POST',
                id: {{ Auth::user()->id }},
            };

      // console.log(formData);
      // return false;
      if(formData.note == ""){
        alert('Note Field Must Fill');
        return false;
      }

      $.ajax({
        method:"POST",
        url:"{{ route('api.profile.yesdoitstore') }}",
        data: formData,
        //dataType: "json",
        success: function(result){
            console.log(result);
            if(result.error == 0){
              alert("Success Adding Yes Do It");
              $( "#showNote" ).slideUp( "slow", function() {
                $('.noteatasyesdoit').val('');
              });
            }else{
              alert(result.msg);
              return false;
            }

        },
        error: function(e){
          alert("Error");
          console.log(e);
        }
      });

   });


   $( '.Note2' ).click(function(e) {
      e.preventDefault();
      var id = $(this).attr('id');
      $( '#showNote2_'+id ).fadeIn("slow");
    });

   $('.tutup2').click(function(){
      var id = $(this).attr('id');
      $( '#showNote2_'+id ).fadeOut('slow');
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

   $('body').on('click', '.closeSelectPersonTeam', function(){
      $('#selectPersonTeam').remove();
   });

   $('body').on('click', '.closeDeleteAnalyses', function(){
      $('#deleteanalyses').remove();
   });


   $('body').on('click', '.closeInviteTeam', function(){
      $( "#showSelectPersonTeam" ).slideUp( "slow");
      $('#inviteTeamMember').remove();
   });

   $('body').on('click', '.sendemail', function(){
     var extraquestion = $('#extraquestion').val();

     if(extraquestion == 0){
        $('#extraquestion').addClass("error");
        return false;
     }else if( !$('#note').val()){
        $('#note').addClass("error");
        return false;
     }else{
        $('#note').removeClass("error");
        $('#extraquestion').removeClass("error");
        return true;
     }

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
              <h4 style="margin: 0px;"><span class="glyphicon glyphicon-ok"></span>
                {{ \Session::get('invite') }}
              </h4>
          </div>
        @endif

        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <h2 style="text-transform: capitalize;">
                  @if($NameLanguagestring === "-")
                    {{ $data['NodeName'] }}  {{ Menus::getLanguageString('IdReport') }}
                  @else
                    {{ Menus::getLanguageString('idLeadergroupxreport') }}
                  @endif

                </h2>
              </div>
            </div>

            <h2 style="text-transform: capitalize;">
              {{ Menus::getLanguageString('IdScore') }}
              {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
              {{ $bulan['name'][$thisMonth] ?? date('F y') }}
            </h2>
            <div class="col-md-12 hilang" style="padding-bottom: 25px;">
                <a id="addNote" class="btn btn-primary" style="padding: 5px 15px 5px;display: initial;text-transform: capitalize;">
                  <span class="fa fa-pencil" style="padding-left: 5px;"></span>
                  {{ Menus::getLanguageString('idYesDoIt') }}
                </a>
              </div>
          </div>

          <div id="showNote" style="width: 100%;display: none;">
            <div style="width: 49%;float: center;">
              <table class="table table-bordered" >
                <tr>
                  <th> <i class="fa fa-book" aria-hidden="true"></i> {{ Menus::getLanguageString('idNoteStatement') }}</th>
                </tr>
                <tr>
                  <td>
                    <div style="font-size: 18px;color: #443838;margin-bottom: 8px;">{{-- {{ $data->nodeName }} --}}</div>
                    <textarea style="width: 100%;padding: 15px;" rows="8" class="noteatasyesdoit"></textarea>
                    <button type="button" class="btn btn-success saveyesdoit">{{ Menus::getLanguageString('idSave') }}</button>
                    <button type="button" class="btn btn-danger tutup">{{ Menus::getLanguageString('idCancel') }}</button>
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
                   {{ date('Y')-1 }} <br />
                @else
                   {{ date('Y') }} <br />
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

  </div> {{-- ///////////////Row///////////////// --}}

  <div class="row">
    {{-- <div class="col-4 mx-auto">
      <div class="card card-body">col-4 mx-auto</div>
    </div> --}}
    @foreach($data['dataAnalysis'] as $keyData => $valData)
      @if($keyData == 2)
        <div class="col-md-3"></div>
      @endif
      <div class="col-md-6" style="margin-bottom: 25px;">
        <table class="table table-striped table-bordered mx-auto">
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
                  @foreach($dateSel['monthprint'] as $monthprint)
                    <li style="float: left;width: 45px;">
                      <a>{{ $monthprint }}</a>
                    </li>
                  @endforeach
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

                    {{-- <table class="ada" cellpadding="0" cellspacing="0" style="border: 0px solid;margin-left: -6px;width: 100%;">
                      <tbody>
                        <tr>
                          @foreach($valData->parentColorN8 as $kPrint => $dataPrint)
                            <td style="width: 50px;">
                              <a href="#" class="bulletprint" style="background: {{ $dataPrint }}"></a>
                            </td>
                          @endforeach

                          <td style="width: 60%;">{{ $dataChild->title }}</td>
                        </tr>
                      </tbody>
                    </table> --}}

                </td>

                <td style="width:5%" class="hilang kanan">
                  @if($valData->title == 'PERSONRESULTATER' || $valData->title == 'SAKSRESULTATER')
                      <a href="{{ route('profile.analysisdetright.index', ['NodeID' => $dataChild->id]) }}"
                      class="bullet hilang" style="background: {{ $dataChild->childColor2  }}"></a>
                      <div class="bullet ada" style="background: {{ $dataChild->childColor2  }} !important;"></div>
                  @endif

                  <a href="#" class="btn btn-primary Note2" style="padding: 1px 7px;display: initial;" id="{{ $valData->id }}">
                    <span class="fa fa-pencil" style="padding-left: 5px;"></span>
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

      </div>

      <div class="col-md-6" id="showNote2_{{$valData->id}}" style="width: 100%;display: none;">
        <div>
          <div style="width: 100%;float: center;">
            <table class="table table-bordered" >
              <tr>
                <th> <i class="fa fa-book" aria-hidden="true"></i> {{ Menus::getLanguageString('idNoteStatement') }}</th>
              </tr>
              <tr>
                <td>
                  <div style="font-size: 18px;color: #443838;margin-bottom: 8px;">{{-- {{ $data->nodeName }} --}}</div>
                  <textarea style="width: 100%;padding: 15px;" rows="4" class="note"></textarea>
                  <button type="button" class="btn btn-success ">{{ Menus::getLanguageString('idSave') }}</button>
                  <button type="button" class="btn btn-danger tutup2" id="{{ $valData->id }}">
                    {{ Menus::getLanguageString('idCancel') }}
                  </button>
                </td>
              </tr>
            </table>
          </div>

          {{-- <div style="width: 49%;float: left;">

          </div> --}}

          <div style="clear: both;"></div>
        </div>
      </div>

      @if($keyData == 2)
        <div class="col-md-3"></div>
      @endif

    @endforeach

    <div style="width: 100%">
      <div class="preloading" style="position: absolute;top:130%;right:50%;">
        <img src="{{ URL::asset('images/preloading2.gif') }}" />
      </div>
      <div id="showSelectPersonTeam" style="display: none;width: 100%" class="row">

      </div>
    </div>


    <div class="col-md-12 hilang" style="text-transform: capitalize;">

      @if(in_array($NodeID, [281, 649, 282, 278, 284, 279, 280, 283, 650]))
        <a href="{{ route('profile.analysissurveyall.index', ['NodeID' => $NodeID]) }}" class="bp btn btn-primary btn-lg"
        style="margin-right:5px;text-transform: capitalize;">
          {{ Menus::getLanguageString('idAllQuestions') }}
        </a>
      @endif

      @if(in_array($NodeID, [281, 282, 278, 279, 283]))
        <a href="{{ route('profile.analysis.index', ['NodeID' => $NodeID, 'year' => $dateSel['year'],
                                                      'month' => $dateSel['month'], 'team' => 'team']) }}"
        class="bp btn btn-info btn-lg" style="margin-right:5px;text-transform: capitalize;">
          {{ Menus::getLanguageString('idMyGroup') }}
        </a>
      @endif

      @if(in_array($NodeID, [281, 282, 278, 279, 283]))
        <a href="{{ route('api.profile.selectpersonteam', ['PersonID' => Auth::user()->id, 'NodeID' => $NodeID]) }}"
          class="bp btn btn-warning btn-lg ButtonBottom" style="margin-right:5px;text-transform: capitalize;">
          {{ Menus::getLanguageString('idSelectPerson') }}
        </a>
      @endif

      @if(in_array($NodeID, [281, 282, 278, 279, 283]))
        <a href="{{ route('profile.analysis.index', ['NodeID' => $NodeID]) }}" class="bp btn btn-primary btn-lg" style="margin-right:5px;text-transform: capitalize;">
          {{ Menus::getLanguageString('idMe') }}
        </a>
      @endif

      @if(in_array($NodeID, [281, 282, 649, 278, 284, 279, 280, 283, 650]))
        <a href="{{ route('api.analyses.deleteanalyses', ['PersonID' => Auth::user()->id]) }}" class="bp btn btn-success btn-lg ButtonBottom" style="text-transform: capitalize;">
          {{ Menus::getLanguageString('idDelete') }}
        </a>
      @endif

      @if(in_array($NodeID, [281, 282, 278, 279, 283]))
        <a href="{{ route('api.invite.member', ['PersonID' => Auth::user()->id]) }}" class="bp btn btn-success btn-lg ButtonBottom" style="text-transform: capitalize;">
          {{ Menus::getLanguageString('idInviteTeamMembers') }}
        </a>
      @endif

      <!-- @if(in_array($NodeID, [281, 282, 278, 279, 283]))
        <a href="{{ route('profile.projectteam.index') }}" class="bp btn btn-success btn-lg" style="text-transform: capitalize;white-space: normal;
    text-align: left;">
          {{ Menus::getLanguageString('idCPTA') }}
        </a>
      @endif -->

      @if(in_array($NodeID, [281, 282, 649, 278, 284, 279, 280, 283, 650]))
        <button type="button" onclick="window.print();return false;"
        name="" class="bp btn btn-success btn-lg" style="text-transform: capitalize;">
          {{ Menus::getLanguageString('idPrint') }}
        </button>
      @endif
    </div>

    <div class="col-md-12" style="margin-top: 15px;">
      <p style="margin-bottom: -10px; text-align: center;">{{ Menus::getLanguageString('idXUtvikletAvBoS') }}</p>
    </div>

  </div> {{-- ///////////////Row/////////////////tete --}}
</div> {{-- /////////////Container////////////// --}}

</section>

@endsection
