@extends('front.layouts.main')

@section('title')
 {{ $node->title }}
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

  <section>
        <img class="img-responsive gambarbk" src="{{ $node->getImages?Storage::url($node->getImages->path):'' }}">
        
  </section>

  	<section id="hvor" class="content-section hvorfor">
        <div class="container">
          <div class="row">

            <div class="col-lg-4 mx-auto">
              @foreach($sideNode as $sn)
                <a class="aside-link" href="/{{ $sn->node->alias }}"> {{ $sn->node->title }}</a>
              @endforeach
            </div>

            <div class="col-lg-8 mx-auto" style="word-break: break-word;" >
              {!! $node->content1 !!}
            </div>
           {{--  <table class="table table-responsive table-bordered table-striped emp-grid main" width="100%" cellpadding="1" style="color: black;">
                <thead>
                  <tr>
                      <th>Title</th>
                      <th>RegistrationFromDateTime</th>
                      <th>RegistrationPlaceName</th>
                      <th>LecturerPersonID</th>
                      <th></th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>
                          <a href=""></a>
                      </td>

                      <td></td>
                      <td>
                          
                      </td>
                      <td>
                      
                      </td>
                      <td>
                        <div class="col-md-10" align="right">
                          <div class="btn-group" >
                            <a class="btn btn-primary" href="" data-toggle="modal" data-target="#myModal" role="button">idLittReg6</a>
                          </div>
                        </div>
                        <div class="modal" id="myModal" role="dialog" align="left">
                          <div class="modal-dialog">
                              <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">
                                        Registration
                                      </h4>
                                  </div>
                                  <div class="modal-body">
                          
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                      <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                      Close</button>
                              </div>
                            </div>
                          </div>
                          </div>
                      </td>
                  </tr>
              </tbody>
            </table> --}}
          </div>
        </div>
      </section>

@endsection
