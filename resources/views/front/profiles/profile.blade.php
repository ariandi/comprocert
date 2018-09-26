@extends('front.layouts.main')

@section('title')
 {{ Menus::getLanguageString('idMyProfile') }}
@endsection

@section('addingStyle')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
.ui-datepicker-calendar {
    display: none;
    }​
    .garisbawah{
	  border-bottom: 1px white solid;
    border-left: 1px white solid;
    border-right: 1px white solid;
    background-color: #28a745;
  }
.warna{background: #28a745;}



</style>
@endsection

@section('addingScriptJs')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script type="text/javascript">
  window.onscroll = function() {
    if(window.pageYOffset >= 0){
      $('.menuatas').removeClass('navbar-shrink');
      $('.menuatas').addClass('navbar-shrink');
    }
  };

  $(document).ready(function(){
    $('.menuatas').addClass('navbar-shrink');

    $('body').on('click', '.saveProfile', function(){

      var formData = {
                email : $('#email').val(),
                first_name : $('#first_name').val(),
                last_name : $('#last_name').val(),
                years_date : $('#years_date').val(),
                gender : $('#gender').val(),
                address : $('#address').val(),
                mobile_phone : $('#mobile_phone').val(),
                _token  : $('meta[name="csrf-token"]').attr('content'),
                _method: 'PUT',
                id: {{ Auth::user()->id }},
            }

      console.log(formData);

      $.ajax({
        method:"POST",
        url:"{{ route('api.profile.update', ['id' => Auth::user()->id]) }}",
        data: formData,
        //dataType: "json",
        success: function(result){
            //console.log(result);
            if(result.error == 0){
              alert("Update data Success");
              $(".editProfile").show();
              $(".forLoadAjax").load("{{ route('api.profile.index') }}");
            }

        },
        error: function(e, r){
          alert("Error");
          console.log(e);
          console.log(r);
        }
      });
    });


    $('body').on('click', '.passwordStore', function(){
      var formData = {
                currentPassword : $('#current-password').val(),
                password : $('#password').val(),
                password_confirmation : $('#password_confirmation').val(),
                _token  : $('meta[name="csrf-token"]').attr('content'),
                _method: 'PUT',
                id: {{ Auth::user()->id }},
            };

      // console.log(formData);
      // return false;
      if(formData.password != formData.password_confirmation){
        alert('Password must be the same with confirm password');
        return false;
      }

      $.ajax({
        method:"POST",
        url:"{{ route('api.profile.passwordstore', ['id' => Auth::user()->id]) }}",
        data: formData,
        //dataType: "json",
        success: function(result){
            //console.log(result);
            if(result.error == 0){
              alert("Password Changed Success");
              $(".editProfile").show();
              $(".forLoadAjax").load("{{ route('api.profile.index') }}");
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


    $('body').on("click", '.yesdoitsubmit', function(){
      var formData = {
                note : $('#note').val(),
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
              alert("Success Adding My Notes");
              $(".editProfile").show();
              $(".forLoadAjax").load("{{ route('api.profile.index') }}");
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

    $('body').on('click', '.menuprofil', function(){
      $(".editProfile").show();
      $('.preloading').show();
      var target = $(this).attr('targets');
      //localStorage.setItem("halaman", target);
      $.ajax({
        method:"GET",
        url:target,
        success: function(result){
            $('.preloading').hide();
            $(".forLoadAjax").html(result);
        },
        error: function(e){
          alert("Error");
          console.log(e);
        }
      });
    });

    $("body").on('click', '.saveMyWay', function(){
      var id = $(this).attr('id');
      var myWhy = $('#myWhy_'+id).val();
      //alert(myWhy);
      var formData = {
          mywhy : myWhy,
          _token  : $('meta[name="csrf-token"]').attr('content'),
          _method : 'POST',
          id : id,
      };

      $.ajax({
        method:"POST",
        url:"{{ route('api.profile.actionstore') }}",
        data: formData,
        //dataType: "json",
        success: function(result){
            console.log(result);
            if(result.error == 0){
              alert("Success Adding My Why");
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

    $("body").on('click', '.saveMyWayCalendar', function(){
      var id = $(this).attr('idCalendar');
      var myWhy = $('#myWhy_'+id).val();
      var Note = $('.note_'+id).val();
      var NodeName = $('.NodeName_'+id).val();

      // alert(Note+' '+NodeName);
      // return false;

      var formData = {
          mywhy : myWhy,
          Note : Note,
          NodeName : NodeName,
          _token  : $('meta[name="csrf-token"]').attr('content'),
          _method : 'POST',
          id : id,
      };

      $.ajax({
        method:"POST",
        url:"{{ route('api.profile.storecalendar') }}",
        data: formData,
        //dataType: "json",
        success: function(result){
            console.log(result);
            if(result.error == 0){
              alert("Success Send Email");
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

    // add js by aziz
    $('[data-toggle="tooltip"]').tooltip();
    // Append table with add row form on add new button click

    $(document).on("click", ".add-new", function(){
      var targettable = $(this).attr("target");
      var actions = $(".table td:last-child").html();
      var date=new Date();
      var months=["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];
      var val=date.getDate()+" "+months[date.getMonth()]+" "+date.getFullYear();
      var titles = $(this).attr('title');
      var active = $(this).attr('active');
      $(this).attr("disabled", "disabled");
      var index = $(targettable+" tbody tr:last-child").index();
      var row = '<tr>' +
          '<td><input type="text" class="form-control" name="name" id="name">' +
          '    <input type="hidden" id="param" value="'+titles+'" class="form-control" name="tipe"></td>' +
          '<td>'+val+'</td>' +
          '<td>-</td>' +
          '<td>0</td>' +
          '<td> ' +
          '  <a class="addtr" data-toggle="tooltip" active="'+active+'" id="savenew"><i class="fa fa-plus-square-o"></i></a>' +
          '  <a class="edittr" data-toggle="tooltip" id="editenew" targets="'+targettable+'"><i class="fa fa-pencil"></i></a> '+
          '  <a class="deletetr" data-toggle="tooltip" id="deletenew" targets="'+targettable+'"><i class="fa fa-trash"></i></a></td>' +
        '</tr>';

      $(targettable).append(row);
      $(targettable+" tbody tr").eq(index + 1).find(".addtr, .edittr").toggle();
      $('[data-toggle="tooltip"]').tooltip();
    });
    // Add row on add button click
    $("body").on("click", ".addtr", function(){

      var empty = false;
      var input = $(this).parents("tr").find('input[type="text"]');
      var inputhidden = $('#param').val();
      var active  = $(this).attr("active");

      if($(this).attr('id') == "savenew") {

        input.each(function(){
          var nama = $(this).val();
          if(!$(this).val()){
            $(this).addClass("error");
            empty = true;
          }else{
            var formData = {
                NodeName : $(this).val(),
                tipe    : inputhidden,
                active  : active,
                _token  : $('meta[name="csrf-token"]').attr('content'),
                _method : 'POST',
            };
            $('.preloading').show();
            $.ajax({
              method:"POST",
              url:"{{ route('api.myanalyses.add') }}",
              data: formData,
              //dataType: "json",
              success: function(result){
                //console.log(result);
                $('.preloading').hide();
                $(".forLoadAjax").html(result);
              },
              error: function(e){
                alert("Error");
                console.log(e);
              }
            });
          }

        });

      }else{

        var active = $(this).attr('active');
        var node = $(this).attr('node');

        input.each(function(){
          var nama = $(this).val();
          if(!$(this).val()){
            $(this).addClass("error");
            empty = true;
          }else{

            var formData = {
                NodeName : $(this).val(),
                Active : active,
                Node : node,
                _token  : $('meta[name="csrf-token"]').attr('content'),
                _method : 'POST',
            };
            $('.preloading').show();
            $.ajax({
              method:"POST",
              url:"{{ route('api.myanalyses.save') }}",
              data: formData,
              //dataType: "json",
              success: function(result){

                $('.preloading').hide();
                $(".forLoadAjax").html(result);

                $('.textnotif').html("This analyses <b>"+nama+"</b> is updated");

                $('.notif').fadeIn("slow");


              },
              error: function(e){
                alert("Error");
                console.log(e);
              }
            });

            $(this).removeClass("error");

          }

        });


      }

      $(this).parents("tr").find(".error").first().focus();
      if(!empty){
        input.each(function(){
          $(this).parent("td").html($(this).val());
        });
        $(this).parents("tr").find(".addtr, .edittr").toggle();
        $(".add-new").removeAttr("disabled");
      }

    });
      // Edit row on edit button click
      $("body").on("click", ".edittr", function(){

        var targettable = $(this).attr("targets");
        var i = 0;
        $(this).parents(targettable+" tr").find("td:not(:last-child)").each(function(){
          i++;
          if(i == 1){
            $(this).html('<input type="text" class="form-control" value="' + $.trim($(this).text()) + '">');
          }

        });

        $(this).parents(targettable+" tr").find(".addtr, .edittr").toggle();
        $(".add-new").attr("disabled", "disabled");

      });
      // Delete row on delete button click
      $("body").on("click", ".deletetr", function(){
        var node = $(this).attr('node');
        var id = $(this).attr('id');

        if(id == "deletenew"){
          $(this).parents("tr").remove();
          $(".add-new").removeAttr("disabled");
        }else{

          if (confirm('Are you sure to delete?')) {
            var i = 0;
            var targettable = $(this).attr('targets');
            $(this).parents(targettable+" tr").find("td:not(:last-child)").each(function(){
              i++;
              if(i == 1){

                var formData = {
                    NodeName : $(this).text(),
                    Active : 0,
                    Node : node,
                    _token  : $('meta[name="csrf-token"]').attr('content'),
                    _method : 'POST',
                };
                $('.preloading').show();
                $.ajax({
                  method:"POST",
                  url:"{{ route('api.myanalyses.save') }}",
                  data: formData,
                  //dataType: "json",
                  success: function(result){
                    //console.log(result);

                    $('.preloading').hide();
                    $(".forLoadAjax").html(result);

                    $('.textnotif').html("This analyses <b>"+$(this).text()+"</b> is deleted");

                    $('.notif').fadeIn("slow");

                    $(this).parents("tr").remove();
                    $(".add-new").removeAttr("disabled");
                  },
                  error: function(e){
                    alert("Error");
                    console.log(e);
                  }
                });
              }

            });

          }

        }

      });
  });
</script>
@endsection

@section('content')


<section id="hvor" class="content-section hvorfor">
    <div class="container">
    <div class="preloading"><img src="{{ URL::asset('images/preloading2.gif') }}"/></div>
               <div class="col-12 col-md-12">
                  <div class="panel panel-info d-none d-lg-block">
                    <div class="panel-heading"><h3 class="panel-title">{{ Menus::getLanguageString('idMyProfile') }}</h3></div>
                              <div class="navbar dasar2">
                                      
                                      <a href="#" class="btn btn-success menuprofil" targets="{{ route('api.profile.edit', ['id' => Auth::user()->id]) }}" style="text-align: left;text-transform:none;">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                        {{ Menus::getLanguageString('idEditMyProfile') }}
                                      </a>
                                      
                                      <a href="#" class="btn btn-success menuprofil" targets="{{ route('api.profile.editpassword') }}" style="text-align:left;text-transform:none;">
                                        <i class="fa fa-key" aria-hidden="true"></i> 
                                        {{ Menus::getLanguageString('idUpdatePassword') }}
                                      </a>
                                      
                                      <a href="#" class="btn btn-success menuprofil" targets="{{ route('api.profile.subscription') }}" href="#" style="text-align:left;text-transform:none;">
                                        <i class="fa fa-users" aria-hidden="true"></i> 
                                        {{ Menus::getLanguageString('idSubscription') }}
                                      </a>
                                      
                                      <a href="#" class="btn btn-success menuprofil" targets="{{ route('api.profile.yesdoit') }}" style="text-align:left;color:#fff;text-transform:none;">
                                        <i class="fa fa-lightbulb-o" aria-hidden="true"></i> 
                                        {{ Menus::getLanguageString('idYesDoIt') }}
                                      </a>
                                      
                                      <a href="#" class="btn btn-success menuprofil" targets="{{ route('api.profile.action') }}" style="text-align:left;text-transform:none;">
                                        <i class="fa fa-check-circle-o" aria-hidden="true"></i> 
                                        {{ Menus::getLanguageString('idAction') }}
                                      </a>
                                      
                                      <a href="#" class="btn btn-success menuprofil" targets="{{ route('api.myanalyses.index') }}" style="text-align:left;text-transform:none;">
                                        <i class="fa fa-tasks"></i> 
                                        {{ Menus::getLanguageString('idMyOwnAnalyses') }}
                                    </a>
                                    
                                  </div>
                                <hr class="style1">
                      </div>
               </div>
               
                                
               

                              <nav class="navbar navbar-expand-lg navbar-light d-block d-lg-none">
               <button class="navbar-toggler navbar-toggler-right  d-block d-lg-none warna" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" style="font-size:15x;color:white;border:1px solid #bdb3b3;"><i class="fa fa-bars"></i>&nbsp;{{ Menus::getLanguageString('idMyProfile') }}</button>

                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                      <ul class="navbar-nav" style="border-top: 1px white solid;">
                        <li class="nav-item" style="border-bottom: 1px white solid;border-left: 1px white solid;border-right: 1px white solid;background-color: #28a745;">
                        <a href="#" class="btn btn-success menuprofil" targets="{{ route('api.profile.edit', ['id' => Auth::user()->id]) }}" style="text-align: left;text-transform:none;user-select: auto;"><i class="fa fa-pencil" aria-hidden="true"></i> {{ Menus::getLanguageString('idEdit') }} {{ Menus::getLanguageString('idMyProfile') }}</a>
                        </li>
                        <li class="nav-item" style="border-bottom: 1px white solid;border-left: 1px white solid;border-right: 1px white solid;background-color: #28a745;">
                        <a href="#" class="btn btn-success menuprofil" targets="{{ route('api.profile.editpassword') }}" style="text-align:left;text-transform:none;"><i class="fa fa-key" aria-hidden="true"></i> {{ Menus::getLanguageString('idUpdatePassword') }}</a>
                        </li>
                        <li class="nav-item" style="border-bottom: 1px white solid;border-left: 1px white solid;border-right: 1px white solid;background-color: #28a745;">
                        <a href="#" class="btn btn-success menuprofil" targets="{{ route('api.profile.subscription') }}" href="#" style="text-align:left;text-transform:none;"><i class="fa fa-users" aria-hidden="true"></i> {{ Menus::getLanguageString('idSubscription') }}</a>
                        </li>
                        <li class="nav-item" style="border-bottom: 1px white solid;border-left: 1px white solid;border-right: 1px white solid;background-color: #28a745;">
                        <a href="#" class="btn btn-success menuprofil" targets="{{ route('api.profile.yesdoit') }}" style="text-align:left;color:#fff;text-transform:none;"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> {{ Menus::getLanguageString('idYesDoIt') }}</a>
                        </li>
                        <li class="nav-item" style="border-bottom: 1px white solid;border-left: 1px white solid;border-right: 1px white solid;background-color: #28a745;">
                        <a href="#" class="btn btn-success menuprofil" href="#" targets="{{ route('api.profile.action') }}" style="text-align:left;text-transform:none;"><i class="fa fa-check-circle-o" aria-hidden="true"></i> {{ Menus::getLanguageString('idAction') }}</a>
                        </li>
                        <li class="nav-item" style="border-bottom: 1px white solid;border-left: 1px white solid;border-right: 1px white solid;background-color: #28a745;">
                        <a href="#" class="btn btn-success menuprofil" targets="{{ route('api.myanalyses.index') }}" style="text-align:left;text-transform:none;"><i class="fa fa-tasks"></i> {{ Menus::getLanguageString('idMyOwnAnalyses') }}</a>
                        </li>
                      </ul>
                    </div>
                  </nav>

<div class="col-md-3 col-lg-3 d-block d-md-none">
                    <img src="https://wisehouse.no/internett1/filefoto/2/Profile.jpg"title="Profile Pic" alt="Profile Pic"class="img-responsive fotoimg">
               </div> 


  <div class="container">
     <div class="col-md-12">
         <form method="post" action="/internett1/index.php?t=publish.profile">
            <div class="panel panel-info">

              <!-- <div class="panel-heading">
                <h3 class="panel-title">
                  {{ Menus::getLanguageString('idMyProfile') }}
                </h3>
              </div> -->


            
            
              <div class="panel-body">
                <div class="row table-user-information">
                  <div class=" col-md-9 col-lg-9 pagar forLoadAjax" style="word-break: break-word;">

                    <div class="row grsatas grsbawah">
                        <div class="col-25  kiri">
                          <label>{{ Menus::getLanguageString('idEmail') }}:</label></div>
                          <div class="col-75 kanan ujung">
                        <label>{{ Auth::user()->email }}</label></div>
                     </div>

                     <div class="row grsbawah">
                        <div class="col-25 kiri">
                          <label>{{ Menus::getLanguageString('idFirstName') }}:</label></div>
                          <div class="col-75 kanan ujung">
                        <label>{{ Auth::user()->first_name }}</label></div>
                     </div>
                        
                     <div class="row grsbawah">
                        <div class="col-25 kiri">
                          <label>{{ Menus::getLanguageString('idLastName') }}:</label></div>
                          <div class="col-75 kanan ujung">
                        <label>{{ Auth::user()->last_name }}</label></div>
                     </div>

                      <div class="row grsbawah">
                        <div class="col-25 kiri">
                          <label>{{ Menus::getLanguageString('idPosition') }}:</label></div>
                          <div class="col-75 kanan ujung">
                        <label></label></div>
                     </div>

                     <div class="row grsbawah">
                        <div class="col-25 kiri">
                          <label>{{ Menus::getLanguageString('idYearOfBirth') }}:</label></div>
                          <div class="col-75 kanan ujung">
                        <label>{{ Auth::user()->birth_date }}</label></div>
                     </div>

                     <div class="row grsbawah">
                        <div class="col-25 kiri">
                          <label>{{ Menus::getLanguageString('idGender') }}:</label></div>
                          <div class="col-75 kanan ujung">
                          <label>{{ Auth::user()->gender == 'M'? 'Male' : '' }}</label>
                          <label> {{ Auth::user()->gender == 'F'? 'Female' : '' }}</label>
                        </div>
                     </div>

                     <div class="row grsbawah">
                        <div class="col-25 kiri">
                          <label>{{ Menus::getLanguageString('idAddress') }}:</label></div>
                          <div class="col-75 kanan ujung">
                        <label>{{ Session()->get('userData')->Address ?? '' }}</label></div>
                     </div>

                     <div class="row grsbawah">
                        <div class="col-25 kiri">
                          <label>{{ Menus::getLanguageString('idMobilePhoneNumber') }}:</label></div>
                          <div class="col-75 kanan ujung">
                        <label>{{ Auth::user()->no_hp }}</label></div>
                     </div>
                  </div>
                  <div class="col-md-3 col-lg-3 d-none d-md-block">
                    <img src="https://wisehouse.no/internett1/filefoto/2/Profile.jpg"
                    title="Profile Pic"
                    alt="Profile Pic"
                    class="img-responsive fotoimg">
                  </div>
                </div>
               </div>{{-- Row --}}
              </div>{{-- Panel Body --}}
             <div class="panel-footer"></div>
            </div>
          </form>

              <!-- <a href="/internett1/index.php?t=publish.leaderreport" class="btn btn-primary" style="background-color: #337ab7;margin-bottom: 5px;">
                  <i class="glyphicon glyphicon-tasks"></i>Board Leder Report              </a> -->

                <div class="bawah">
                   <br />
          <br />

          <a href="{{ route('profile.analysis.index', ['NodeID' => 281]) }}">
            {!! Menus::setButton(['value' => '<i class="fa fa-check-circle-o" aria-hidden="true"></i> '.Menus::getLanguageString('idProsjektX'), 
                                'class' => 'bp btn btn-danger', 
                                'type' => 'button',
                                'name' => 'action_publish_prosjekt',
                                'id' => 'action_publish_prosjekt_id']) !!}
          </a>

          <a href="{{ route('profile.analysis.index', ['NodeID' => 649]) }}">
            {!! Menus::setButton(['value' => '<i class="fa fa-check-circle-o" aria-hidden="true"></i> '.Menus::getLanguageString('idLederX'), 
                                'class' => 'bp btn btn-danger', 
                                'type' => 'button',
                                'name' => 'action_publish_leader']) !!}
          </a>

          <a href="{{ route('profile.analysis.index', ['NodeID' => 282]) }}">
            {!! Menus::setButton(['value' => '<i class="fa fa-check-circle-o" aria-hidden="true"></i> '.Menus::getLanguageString('idLedergruppeX'), 
                                'class' => 'bp btn btn-danger', 
                                'type' => 'button',
                                'name' => 'action_publish_ledergruppe']) !!}
          </a>

          <br />

          <a href="{{ route('profile.analysis.index', ['NodeID' => 278]) }}">
            {!! Menus::setButton(['value' => '<i class="fa fa-tasks" aria-hidden="true"></i> '.Menus::getLanguageString('idTeamAnalysis'), 
                                'class' => 'bp btn btn-info', 
                                'type' => 'button',
                                'name' => 'action_publish_team']) !!}
          </a>

          <a href="{{ route('profile.analysis.index', ['NodeID' => 284]) }}">
            {!! Menus::setButton(['value' => '<i class="fa fa-tasks" aria-hidden="true"></i> '.Menus::getLanguageString('idGrunnX'), 
                                'class' => 'bp btn btn-info', 
                                'type' => 'button',
                                'name' => 'action_publish_grunn']) !!}
          </a>

          <a href="{{ route('profile.analysis.index', ['NodeID' => 279]) }}">
            {!! Menus::setButton(['value' => '<i class="fa fa-tasks" aria-hidden="true"></i> '.Menus::getLanguageString('idCompanyAnalysis'), 
                                'class' => 'bp btn btn-info', 
                                'type' => 'button',
                                'name' => 'action_publish_firma']) !!}
          </a>

          <a href="{{ route('profile.analysis.index', ['NodeID' => 280]) }}">
            {!! Menus::setButton(['value' => '<i class="fa fa-tasks" aria-hidden="true"></i> '.Menus::getLanguageString('idPersonAnalysis'), 
                                'class' => 'bp btn btn-info', 
                                'type' => 'button',
                                'name' => 'action_publish_person']) !!}
          </a>

          <a href="{{ route('profile.analysis.index', ['NodeID' => 283]) }}">
            {!! Menus::setButton(['value' => '<i class="fa fa-tasks" aria-hidden="true"></i> '.Menus::getLanguageString('idMalx'), 
                                'class' => 'bp btn btn-info', 
                                'type' => 'button',
                                'name' => 'action_publish_mal']) !!}
          </a>

          <a href="{{ route('profile.analysis.index', ['NodeID' => 650]) }}">
            {!! Menus::setButton(['value' => '<i class="fa fa-tasks" aria-hidden="true"></i> '.Menus::getLanguageString('idMeetingAnalysis'), 
                                'class' => 'bp btn btn-info', 
                                'type' => 'button',
                                'name' => 'action_publish_mote']) !!}
          </a>


          </div>
      
        </div>
      </div>
     <div style="clear: both;"></div>
  </div>
</div>
</section>

@endsection
