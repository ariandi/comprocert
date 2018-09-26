@extends('front.layouts.main')

@section('title')
 {{ Menus::getLanguageString('idLogin') }}
@endsection

@section('addingStyle')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
@endsection

@section('addingScriptJs')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

<script type="text/javascript">
  window.onscroll = function() {
    if(window.pageYOffset >= 0){
      $('.menuatas').removeClass('navbar-shrink');
      $('.menuatas').addClass('navbar-shrink');
  }
};

$(document).ready(function(){
    $('.menuatas').addClass('navbar-shrink');
    //$('#company').select2();

    $("body").on('click', '#mySubmit', function(){

        if($('.companys').is(':checked')) { }
        else{

            if($('#company').val() == "" || $('#company').val() == null){

                alert('Company Must Selected a');
                return false;
            }
            
        }
    });
    var datacom;

    datacom = <?php echo file_get_contents('https://www.wisehouse.no/api/companies/show-all') ?>;
    //console.log(datacom.data);

    $('body').on('keyup','.emailtext',function(){

        var texts = $(this).val().split('@');
        $('#companyselect').children('option:not(:first)').remove();
        
        $('#tampilcompany').html("");

        var totalhasil = 0;
        var dataarray = [];

        datacom.data.forEach(function (arrayItem) {
            var company_approved = arrayItem.company_approve;
            
            if(company_approved != null && arrayItem.company_approve != ""){

                var com_apv = company_approved.split(',');
                if(com_apv.indexOf(texts[1]) != -1 && texts[1] != "" && texts[1] != null ){
                    totalhasil = totalhasil + 1;
                    dataarray.push({id:arrayItem.id,namecompany:arrayItem.CompanyName,approve:arrayItem.company_approve});
                }else{

                }
            }

        });

        dataarray.forEach(function(arrayItems){

                if(dataarray.length > 1){

                    $('#tampilcompany').append("<p><input type='radio' class='companys' name='companyid' value='"+arrayItems.id+"' > "+arrayItems.namecompany+"</p>");
                    $('#tampilcompanyid').html("");
                    $('.comp').show();

                }else if (dataarray.length == 1){

                    $('#tampilcompanyid').html("<input type='hidden' id='company' name='companyid' value='"+arrayItems.id+"' >");
                    $('#tampilcompany').html("");
                    $('.comp').hide();

                }else{

                    console.log('kosong');

                }
        });
        
        if(dataarray.length == 0){

            $('#tampilcompanyid').html("{{ Menus::getLanguageString('idC66CnF') }}");
            $('.comp').hide();

        }

    });
    

});
</script>
<script type="text/javascript">
    // var text1 = $('#textAlert').val();
    
    // $.confirm({

    //         useBootstrap: false,
    //         title: "<h3><center></center</h3>",
    //         content: text1,
    //         buttons: {
    //         // confirm: function () {
    //         //     title: "Bekreft/Confirm"
    //         //     $.alert('Confirmed!');
    //         // },
    //         Bekreft: {
    //             text: 'Bekreft/Confirm',
    //             btnClass: 'btn-blue',
    //             keys: ['enter', 'shift'],
    //             action: function(){
    //                 $.alert('Confirmed!');
    //             }
    //         }
    //     }
    // });
</script>
@endsection

@section('content')
<style>
.select2-results{color:black; }
.jconfirm .jconfirm-box div.jconfirm-title-c .jconfirm-title {
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    font-size: inherit;
    font-family: inherit;
    display: contents;
    vertical-align: middle;
    color: black;
}
.jconfirm .jconfirm-box div.jconfirm-content-pane .jconfirm-content {
    overflow: auto;
    color: black;
}
.jconfirm.jconfirm-white .jconfirm-box, .jconfirm.jconfirm-light .jconfirm-box {
    -webkit-box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    border-radius: 5px;
    border: 2px solid red;
}

</style>

<section id="hvor" class="content-section hvorfor"> <!--  content-section-ari -->
    <div class="container">
     <h2><center>{{ Menus::getLanguageString('idHeaderTextLogin') }}</center></h2>
     <div class="row">
        @if (\Session::has('message'))
            <div class="alert alert-success">
                <p>{{ \Session::get('message') }}</p>
            </div>
        @endif
        {{--
        <!-- <div class="col-md-4">
            <div style="padding:15px 25px; background-color:#73a1b9;border-radius: 3px;">
                <h3><center><span class="fa fa-log-in" aria-hidden="true"></span>{{ Menus::getLanguageString('idLogIn') }}</center></h3>
                
                <form class="form-horizontal" method="POST" action="{{ route('loginfront') }}">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

                        <label for="exampleInputEmail1">
                            <span class="fa fa-envelope jarakicon" aria-hidden="true"></span>
                            {{ Menus::getLanguageString('idEmailAddress') }}
                        </label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif

                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                        <label for="exampleInputPassword1">
                            <span class="fa fa-lock jarakicon" aria-hidjarakiconden="true"></span>
                            {{ Menus::getLanguageString('idPassword') }}
                        </label>

                        <input id="password" type="password" class="form-control" name="password" required>
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif

                    </div>

                    <div class="form-group">

                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ Menus::getLanguageString('idRememberMe') }}
                        </label>
                    </div>

                    <div class="form-group">
                        <a class="hoverlink" href="{{ url('/no/Personvernerklæring') }}">{{ Menus::getLanguageString('idByCreating') }}</a>
                    </div>

                    <button type="submit" class="btn log" style="background-color: #5cb85c;color: #fff;margin-bottom: 0.5rem;text-transform: none;">
                        <span class="fa fa-log-in" aria-hidden="true"></span>
                        {{ Menus::getLanguageString('idLogIn') }}
                    </button>

                    <div class="form-group">
                        <a class="hoverlink" style="text-transform: none;" href="{{ route('password.request') }}">
                            {{ Menus::getLanguageString('idForgotYourPassword') }}
                        </a>
                    </div>
                </form>

                <div id="demo" class="collapse" style="margin-top: 30px;">
                    <div class="form-group">
                        Skriv inn din epost i feltet under og trykk send og vi vil sende deg et nytt passord

                        <form accept-charset="UTF-8" action="/" name="auto_name" method="post"  id="auto_name" enctype="multipart/form-data">
                            <input type="text" value=""  size="33"  tabindex="5"  class="form-control" placeholder="Enter Your Email" style="width:70%;display: initial;margin-right:5px;"/>
                            <input type="submit"  value="Send"  size="20"  tabindex="6"  class="btn btn-primary" style="background:#337ab7"  />
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
        --}}
        <div class="col-sm-offset-2 col-md-8">
            <div style="padding:15px 25px; background-color:#73a1b9;border-radius: 3px;">
                <h3>
                    <center><span class="fa fa-user" aria-hidden="true"></span> {{ Menus::getLanguageString('idRegisterForm') }}</center>
                </h3>

                <ul class="nav nav-tabs">
                    <li class="active" style="padding-left: 0px; ">
                        <a data-toggle="tab" href="#companyuser" class="hoveregis">{{ Menus::getLanguageString('idCompanyUsers') }}</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#priveteuser" class="hoveregis">{{ Menus::getLanguageString('idPrivateUsers') }}</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="companyuser" class="tab-pane fadein active">
                        <br><br>
                        <!--  <form method="POST" action="{{ route('register') }}"> -->
                             <form method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control" name="fromapp" id="FromApp" value="0">
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label>
                                    <span class="fa fa-pencil jarakicon" aria-hidden="true"></span> {{ Menus::getLanguageString('idFirstName') }}
                                </label>
                                <input id="first_name" type="text" class="form-control" name="firstname" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label>
                                    <span class="fa fa-pencil jarakicon" aria-hidden="true"></span>{{ Menus::getLanguageString('idLastName') }}
                                </label>
                                <input type="text" class="form-control" name="lastname" id="last_name" value="{{ old('last_name') }}" required>

                                @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label>
                                    <span class="fa fa-envelope jarakicon" aria-hidden="true"></span> {{ Menus::getLanguageString('idEmailAddress') }}
                                </label>
                                <input id="email2" type="email" class="form-control emailtext" name="email" value="{{ old('email') }}" required>
                                <div id="tampilcompanyid"></div>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="comp form-group{{ $errors->has('company') ? ' has-error' : '' }}" style="display: none;">
                                <label style="margin-right:7px;">
                                    <i class="fa fa-building" aria-hidden="true" style="margin-right:7px;"></i> {{ Menus::getLanguageString('idCompany') }}
                                </label>
                                
                                <div id="tampilcompany">
                                    
                                </div>
                                    
                                @if ($errors->has('company'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                @endif

                                <div style="margin-top:8px;">
                                        <p>{{ Menus::getLanguageString('idSelectTeamText1') }}</p>
                                        <p>{{ Menus::getLanguageString('idByCreating2') }}</p>

                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label>
                                    <span class="fa fa-lock jarakicon" aria-hidden="true"></span> {{ Menus::getLanguageString('idPassword') }}
                                </label>
                                <input id="password2" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>
                                    <span class="fa fa-lock jarakicon" aria-hidden="true"></span>{{ Menus::getLanguageString('idPassword1') }}
                                </label>

                                <input id="password-confirm" type="password"
                                class="form-control" name="password_confirmation" required>
                            </div>

                            <div class="form-group">
                                <a class="hoverlink" href="{{ url('/no/Personvernerklæring') }}">{{ Menus::getLanguageString('idByCreating') }}</a>
                            </div>

                            <button type="submit" class="btn log capitalize " id="mySubmit"
                            style="background-color: #5cb85c;color: #fff;">
                                <span class="fa fa-user" aria-hidden="true"></span>
                                {{ Menus::getLanguageString('idRegister') }}
                            </button>
                        </form>
                    </div>
                    <div id="priveteuser" class="tab-pane fade">
                        <br><br>
                        <form method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control" name="fromapp" id="FromApp" value="0">
                            <input type="hidden" name="privateuser" value="1">
                            <input type="hidden" name="private" value="1">
                            <input type="hidden" name="company" value="1">
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label>
                                    <span class="fa fa-pencil jarakicon" aria-hidden="true"></span> {{ Menus::getLanguageString('idFirstName') }}
                                </label>
                                <input id="first_name2" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label>
                                    <span class="fa fa-pencil jarakicon" aria-hidden="true"></span>{{ Menus::getLanguageString('idLastName') }}
                                </label>
                                <input type="text" class="form-control" name="last_name" id="last_name2" value="{{ old('last_name') }}" required>

                                @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label>
                                    <span class="fa fa-envelope jarakicon" aria-hidden="true"></span> {{ Menus::getLanguageString('idEmailAddress') }}
                                </label>
                                <input id="email22" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label>
                                    <span class="fa fa-lock jarakicon" aria-hidden="true"></span> {{ Menus::getLanguageString('idPassword') }}
                                </label>
                                <input id="password22" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>
                                    <span class="fa fa-lock jarakicon" aria-hidden="true"></span>{{ Menus::getLanguageString('idPassword1') }}
                                </label>

                                <input id="password-confirm2" type="password"
                                class="form-control" name="password_confirmation" required>
                            </div>

                            <div class="form-group">
                                <a class="hoverlink" href="{{ url('/no/Personvernerklæring') }}">
                                    {{ Menus::getLanguageString('idByCreating3') }}
                                </a>
                            </div>

                            <button type="submit" class="btn log capitalize mySubmit" id=""
                            style="background-color: #5cb85c;color: #fff;">
                                <span class="fa fa-user" aria-hidden="true"></span>
                                {{ Menus::getLanguageString('idRegister') }}
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</section>
@endsection
