@extends('front.layouts.main')

@section('title')
 {{ Menus::getLanguageString('idCreateTeamProject') }}
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

    $('body').on('click', '.openListTeamMember', function(){
      $('.selTeamMember').fadeIn('slow');
      $('.changeWhenListOpen').removeClass('col-md-12');
      $('.changeWhenListOpen').addClass('col-md-8');
    });

    $('body').on('click', '.closeListTeamMember', function(){
      $('.selTeamMember').hide();
      $('.changeWhenListOpen').removeClass('col-md-8');
      $('.changeWhenListOpen').addClass('col-md-12');
    });

    $('body').on('click', '.saveListTeamMember', function(){
      personid = [];
      $(".valuecheckdeptsublist").each(function( index, val ) {
        if($( this ).is(':checked')){
          personid.push({PersonID:$(this).attr('PersonID'), Checked:'Checked'});
        }else{
          personid.push({PersonID:$(this).attr('PersonID'), Checked:null});
        }
      });

      // console.log(personid);
      // return false;
      console.log(personid);
      $('.preloading').show();
      
      var formData = {
                CompanyIDTeam : $('#CompanyIDTeam').val(),
                PersonIDGroup : $('#PersonIDGroup').val(),
                PersonID : personid,
                _token  : $('meta[name="csrf-token"]').attr('content'),
                _method: 'PUT',
            };

      $.ajax({
        method:"POST",
        url:"{{ route('profile.projectteam.updatesublist') }}",
        data: formData,
        //dataType: "json",
        success: function(result){
            console.log(result);
            if(result.error == 0){
              alert('Success');
              $(".container-load").load("{{ route('profile.projectteam.index') }} .row-load");
              $('.preloading').hide();
            }else{
              alert('Failed to save data');
            }
        },
        error: function(e, r){
          alert("Error");
          $('.preloading').hide();
          console.log(e);
          console.log(r);
        }
      });

    });

    $('body').on('click', '.updateListTeamMember', function(){
      personid = [];
      
      $(".valuecheck").each(function( index, val ) {
        if($( this ).is(':checked')){
          personid.push({PersonID:$(this).attr('PersonID'), Checked:'Checked'});
        }else{
          personid.push({PersonID:$(this).attr('PersonID'), Checked:null});
        }
      });

      console.log(personid);
      // $('.preloading').show();

      var formData = {
                CompanyIDTeam : $('#CompanyIDTeam').val(),
                PersonIDGroup : $('#PersonIDGroup').val(),
                PersonID : personid,
                _token  : $('meta[name="csrf-token"]').attr('content'),
                _method: 'PUT',
            };

      $.ajax({
        method:"POST",
        url:"{{ route('profile.projectteam.updatelist') }}",
        data: formData,
        //dataType: "json",
        success: function(result){
            console.log(result);
            if(result.error == 0){
              alert('Success');
              $(".container-load").load("{{ route('profile.projectteam.index') }} .row-load");
              //$('.preloading').hide();
            }else{
              alert('Failed to save data');
            }
        },
        error: function(e, r){
          alert("Error");
          console.log(e);
          console.log(r);
        }
      });

    });

  });
</script>
@endsection

@section('content')

<section id="hvor" class="content-section hvorfor">
  <div class="container container-load">
    <div class="row row-load">
    <div class="col-md-12 changeWhenListOpen">
      <a href="{!! URL::previous() !!}" class="btn btn-primary" style="background-color: #337ab7;">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> Back To Previous Page
      </a>

      <a href="#" class="btn btn-info">
        <i class="fa fa-book" aria-hidden="true"></i> My Notes
      </a>
      
        <h2 style="text-align:center;margin:20px 0px;text-transform: capitalize;">
          {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
        </h2>

        <form method="get" id="formid" action="#">
        
        <div style="overflow:auto;height:500px">
          <table class="table table-bordered">
            <thead>
              <tr class="my_planHeader my_plan1">
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Position</th>
                <th>#</th>
                <th>Status</th>
              </tr>
            </thead>
            
            <tbody>
              
              @foreach($data as $keydata1 => $data1)
              <tr style="background:{{ $data1->Color }}">
                <td>{{ $keydata1+1 }}</td>
                <td>{{ $data1->first_name.' '.$data1->last_name }}</td>
                <td>{{ $data1->email }}</td>
                <td>{{ $data1->Type }}</td>
                <td>
                  <input type="checkbox" class="valuecheck" value="1" 
                  name="check[{{$keydata1}}]" {{ $data1->Checked }} {{ $data1->Dissabled }} PersonID="{{$data1->PersonID}}" />
                </td>
                <td>
                  @if($data1->SActive != null and $data1->SActive > 0)
                    {{ $data1->first_name }} Team
                  @endif
                </td>
                <input type="hidden" name="person[]" value="2">
              </tr>
              @endforeach
              @if(isset($data->data2))
                @foreach($data->data2 as $keydata2 => $valdata2)
                  <tr>
                    <th colspan="6" class="my_planHeader my_plan1"> List Person Departement {{ $valdata2->CompanyNameDept }}</th>
                  </tr>
                  @foreach($valdata2->subData as $keydata3 => $valdata3)
                    <tr style="background:{{ $valdata3->Color }}">
                      <td>{{ $keydata3+1 }}</td>
                      <td>{{ $valdata3->FirstName }}</td>
                      <td>{{ $valdata3->Email }}</td>
                      <td>{{ $valdata3->Type }}</td>
                      <td>
                        <input type="checkbox" class="valuecheckdeptsub" value="1" name="check[{{$keydata3}}]" 
                        {{ $valdata3->Checked }} {{ $valdata3->Dissabled }} />
                      </td>
                      <td>{{ $valdata3->TeamName }}</td>
                    </tr>
                  @endforeach
                @endforeach
              @endif
            </tbody>
          </table> 
        <input type="hidden" id="CompanyIDTeam" value="{{ $companyIDTeam }}">
        <input type="hidden" id="PersonIDGroup" value="{{ Auth::user()->id }}">
        
        <button type="button" id="form1" class="btn btn-success updateListTeamMember">
          <i class="fa fa-check" aria-hidden="true"></i> Save
        </button>
        
        <button type="button" id="form2" class="btn btn-success openListTeamMember">
          <i class="fa fa-list-alt" aria-hidden="true"></i> Select other person
        </button>
       </div>
     
     
      </form>
    </div><!-- End col-md-12 -->

    <div class="col-md-4 selTeamMember">

      <div class="preloading" style="position: absolute;top: 25%;right: 25%;">
        <img src="{{ URL::asset('images/preloading2.gif') }}" />
      </div>


      @foreach($dataCompany as $k1 => $v1)
        <h6 style="text-align:center;margin:20px 0px;text-transform: capitalize;">
          List Team Members of <br />
          {{ $v1['CompanyName'] }} Companys <br />
          Departement
        </h4>

        <div class="table-responsive" style="margin-bottom: 15px;">
        <form method="post" action="#">
          <table class="table table-bordered" style="margin-bottom: 20px;">
              @if( isset( $v1['subDataCom'] ) > 0)
                @foreach($v1['subDataCom'] as $keydata3 => $valdata3)
                  <tr class="my_planHeader my_plan1">
                    <th colspan="5">{{ $valdata3['CompanyName'] }}</th>
                  </tr>
                  <tr class="my_planHeader my_plan1">
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>#</th>
                  </tr>

                  <tbody class="subDepartementList">
                    @if( isset($valdata3['subCompanyUserData']) )
                        @foreach($valdata3['subCompanyUserData'] as $keydata4 => $valdata4)
                            <tr style="background:#ccc;">
                              <td>{{ $keydata4+1 }}</td>
                              <td>{{ $valdata4['first_name'] }} {{ $valdata4['last_name'] }}</td>
                              <td>{{ $valdata4['email'] }}</td>
                              <td>{{-- {{ $valdata4['type'] }} --}}</td>
                              <td>
                                <input type="checkbox" class="valuecheckdeptsublist" value="1" name="check[{{$keydata4}}]" 
                                PersonID="{{$valdata4['id']}}" {{-- {{ $valdata4->Checked }} --}} />
                              </td>
                            </tr>
                        @endforeach
                      @endif
                  </tbody>
                  
                  {{-- <tfoot>
                    <tr>
                      <td colspan="5">&nbsp;</td>
                    </tr>
                  </tfoot> --}}

                @endforeach
              @endif
          </table>
        </form>
        </div>
      @endforeach

      <button type="button" id="form" class="btn btn-danger closeListTeamMember">
        <i class="fa fa-times-circle" aria-hidden="true"></i> Close
      </button>

      <button type="button" id="form" class="btn btn-success saveListTeamMember">
        <i class="fa fa-check" aria-hidden="true"></i> Save
      </button>
    </div>
    </div>{{-- Row --}}

  </div>
</section>


        

</section>

@endsection