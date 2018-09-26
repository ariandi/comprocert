@extends('front.layouts.main')

@section('title')
 {{ Menus::getLanguageString('idAnalysis') }} {{ Menus::getLanguageString('idDetailRight') }}
@endsection

@section('addingScriptJs')
<script type="text/javascript">
  window.onscroll = function() {
    if(window.pageYOffset >= 0){
      $('.menuatas').removeClass('navbar-shrink');
      $('.menuatas').addClass('navbar-shrink');
    }
  };

  // $( '.addNote' ).click(function() (e) {
  //     e.preventDefault();
  //     var id = $(this).attr('id');
  //     $( "#showNote_"+id ).fadeIn( "slow", function() {
  //       // Animation complete.
  //     });
  //   });

  $( '.addNote' ).click(function(e) {
      e.preventDefault();
      var id = $(this).attr('id');
      $( '#showNote_'+id ).fadeIn('slow');
    });

   $('.tutup').click(function(){
      var id = $(this).attr('id');
      $( '#showNote_'+id ).fadeOut('slow');
    });

  $(document).ready(function(){
    $('.menuatas').addClass('navbar-shrink');

    // $( "#addNote" ).click(function() {
    //   $( "#showNote" ).slideDown( "slow", function() {
    //     // Animation complete.
    //   });
    // });

    // $('.tutup').click(function(){
    //   $( "#showNote" ).slideUp( "slow", function() {
    //     // Animation complete.
    //   });
    // });

    // $('.savenoteleftdet').click(function(){
    //   var formData = {
    //             note : $('.note').val(),
    //             NodeiD : {{ $NodeID }},
    //             _token  : $('meta[name="csrf-token"]').attr('content'),
    //             _method: 'POST',
    //         }

    //   $.ajax({
    //     method:"POST",
    //     url:"{{ route('profile.analysis.yesdoitstorebynode') }}",
    //     data: formData,
    //     //dataType: "json",
    //     success: function(result){
    //         console.log(result);
    //         if(result.error == 0){
    //           alert("Save data Success");
    //           $("#showNote").slideUp("slow");
    //           $('.note').val('');
    //         }

    //     },
    //     error: function(e, r){
    //       alert("Error");
    //       console.log(e);
    //       console.log(r);
    //     }
    //   });

    // });

  });
</script>
@endsection

@section('content')

<section id="hvor" class="content-section hvorfor">

<div class="container">
  <div class="row">

    <a href="{!! URL::previous() !!}" class="btn btn-primary" style="margin-bottom: 10px;text-transform: none;">
      <i class="fa fa-arrow-left" aria-hidden="true"></i> {{ Menus::getLanguageString('idBackToPreviousPage') }}
    </a>

    <h2 style="margin-bottom: 20px;text-transform: capitalize;">{{ $data['nodeName'] }}</h2>

      @foreach($data['data'] as $Prod)
      <div class="table-responsive" style="margin-bottom: 50px;">
      <div style="padding: 15px; background: #2b2828;color: #fff;">{{ $Prod->title }}</div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <td style="min-width: 150px;background: #ddd;">
              {{ Menus::getLanguageString('idQuestion') }} <i class="fa fa-arrow-right" aria-hidden="true"></i>
              <br>{{ Menus::getLanguageString('idPerson') }} <i class="fa fa-arrow-down" aria-hidden="true"></i>
              <br>
              <a href="#" class="btn btn-primary addNote" style="padding: 1px 7px;display: initial;" id="{{ $Prod->id }}" >
                <i class="fa fa-pencil" aria-hidden="true" style="padding-left: 5px;"></i>
              </a>
            </td>

            @foreach($Prod->subdata as $Prodsub)
              <td style="min-width:200px;">
                {{ $Prodsub->ProductName }}
              </td>
            @endforeach

          </tr>
        </thead>

        <tbody>
          <tr>
            <td style="width: 150px;">
              {{ Auth::user()->first_name }}
            </td>
            @foreach($Prod->subdata as $Prodsub2)
              <td style="min-width:200px;">
                <div class="bullet-det-right" style="background:{{ $Prodsub2->warna  }}"></div>
              </td>
            @endforeach
          </tr>
        </tbody>
      </table>
      </div>
      <div id="showNote_{{ $Prod->id }}" style="width: auto;display: none;">
        <div style="width: auto;float: left;">
          <table class="table table-bordered" >
            <tr>
              <th> <i class="fa fa-book" aria-hidden="true"></i> {{ Menus::getLanguageString('idNoteStatement') }}</th>
            </tr>
            <tr>
              <td>
                <div style=" font-size: 18px;color: #443838;margin-bottom: 8px;">{{ $Prod->title }}</div>
                <textarea style="width: 100%;padding: 15px;" rows="8" class="note"></textarea>
                <button type="button" class="btn btn-success">{{ Menus::getLanguageString('idSave') }}</button>
                <button type="button" class="btn btn-danger tutup" id="{{ $Prod->id }}">{{ Menus::getLanguageString('idCancel') }}</button>
              </td>
            </tr>
          </table>
        </div>

        <div style="width: auto;float: left;">

        </div>

        <div style="clear: both;"></div>
      </div>
      @endforeach

      {{-- <div id="showNote" style="width: 100%;display: none;">
        <div style="width: auto;float: left;">
          <table class="table table-bordered" >
            <tr>
              <th> <i class="fa fa-book" aria-hidden="true"></i> Note in a statement</th>
            </tr>
            <tr>
            <td>
                <div style="font-size: 18px;color: #443838;margin-bottom: 8px;">{{ $data->nodeName }}</div>
                <textarea style="width: 100%;padding: 15px;" rows="8" class="note"></textarea>
                <button type="button" class="btn btn-success savenoteleftdet">Save</button>
                <button type="button" class="btn btn-danger tutup">Close</button>
              </td>
            </tr>
          </table>
        </div>

        <div style="width: auto;float: left;">

        </div>

        <div style="clear: both;"></div>
      </div> --}}

  </div> {{-- ///////////////Row///////////////// --}}
</div> {{-- /////////////Container////////////// --}}

</section>




</section>

@endsection
