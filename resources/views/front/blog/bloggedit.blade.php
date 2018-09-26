@extends('front.layouts.main')

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


    $( "#inputTitle1" ).on( "keyup", function( event ) {
      
    //$("#inputTitle1").keyup(function(){

        var str = $( "#inputTitle1" ).val();

        $("#inputAlias").val("no/blogg/"+str);
        $("#inputDescription").val($(this).val());
        $("#inputKeyword").val($(this).val());

    });

  });
</script>
@endsection

@section('content')

<section id="hvor" class="content-section hvorfor" style="padding-top: 100px;">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        @if (\Session::has('success'))
          <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
          </div>
        @endif

        <div class="card">
          <h4>Edit Blogg</h4>
            {{ Form::model($nodes, array('route' => array('blogg.update', $nodes->id), 'method' => 'POST', 'files' => true)) }}
            {{csrf_field()}}
            <input type="hidden" value="43" name="parent">
            <input type="hidden" value="{{ $nodestr->child_node_id }}" name="nodestr" id="nodestr" />
            <input type="hidden" value="{{ $nodestr->id }}" name="nodestrid" id="nodestrid" />
            <input type="hidden" id="inputTemplate" placeholder="Enter Title Here" value="{!! $nodes->template !!}" name="template" class="form-control">
            <input type="hidden" class="form-control" id="inputAlias" placeholder="Enter Alias Here" value="{!! $nodes->alias !!}" name="alias">
            <input type="hidden" class="form-control" id="inputDescription" placeholder="Enter Description Here" value="{!! $nodes->description !!}" name="description">
            <input type="hidden" class="form-control" id="inputKeyword" placeholder="Enter Keyword Here" value="{!! $nodes->keyword !!}" name="keyword">
            <input name="active" type="hidden" value="1" id="active">
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
              <label for="inputTitle1">Title</label>
              <input type="text" class="form-control" id="inputTitle1" placeholder="Enter Title Here" value="{!! $nodes->title !!}" name="title">
              @if ($errors->has('title'))
                  <span class="help-block">
                      <strong>{{ $errors->first('title') }}</strong>
                  </span>
              @endif
            </div>

            <div class="form-group {{ $errors->has('content1') ? 'has-error' : '' }}">
              <label for="inputConten1">Content </label>
              <textarea class="form-control mceEditor" id="inputConten1" placeholder="Enter Content Here" name="content1">
                {!! $nodes->content1 !!}
              </textarea>
              @if ($errors->has('content1'))
                  <span class="help-block">
                      <strong>{{ $errors->first('content1') }}</strong>
                  </span>
              @endif
            </div>

            <button type="submit" class="btn btn-primary pull-right">Save </button>
            <a class="btn btn-primary pull-left" href="#">Cancel </a>
          </form>
        </div>
      </div>

      <div class="col-lg-4 mx-auto">
        <div class="card">
          <h3 style="margin: 0 0 5px;">Related Post</h3>
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