@extends('admin.layouts.master')

@section('title')
  Update Publish2
@endsection

@section('titlecontent')
  Publish2
@endsection

@section('subtitlecontent')
  update
@endsection

@section('addingFileJs')
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=xspx9ax4f39yi8pjfnpoe60sz9x5mz1xewzmxt918nsl47sh">
  </script>
@endsection

@section('addingScriptJs')
  <script type="text/javascript">
    tinymce.init({
      selector: 'textarea',
      entity_encoding : 'raw',
      mode : 'specific_textareas',
      //selector: 'textarea',
      //editor_selector : 'mceEditor',
      convert_urls: false,
      language : 'en',
      theme: 'modern',
      plugins: [
        'spellchecker,pagebreak,layer,table,save,insertdatetime,media,searchreplace,' +
          'print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,' +
          'nonbreaking,template,autoresize,' +
          'anchor,charmap,hr,image,link,emoticons,code,textcolor,' +
          'charmap,pagebreak'
      ],
      toolbar: 'insertfile undo redo| charmap | pagebreak | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  fontselect fontsizeselect | forecolor backcolor',
      pagebreak_separator: "<!-- my page break -->",
      image_advtab: true,
      autoresize_max_height: 350
    });

    $(document).ready(function(){
      $("body").on('click', '.saveChild', function(){
        var data = [];
        $(".priorityChild").each(function(i, k){
          //console.log(i);
          //console.log($(k).val());
          //console.log($(k).attr('id'));
          data.push({'id' : $(k).attr('id'), 'val' : $(k).val()});
        });

        $.ajax({
            type: 'post',
            url: '{{ route('nodes.editpriority', ['id' => $nodestr->child_node_id]) }}',
            data: {_method: 'post', _token :$('meta[name="csrf-token"]').attr('content'), data:data},
        }).done(function (data) {
            if(data == 'Success'){
              alert('success');
              $(".loadnewchild").load("{{ route('nodes.edit', ['id' => $nodestr->child_node_id, 'parent' => $parent, 'lvl' => 2 ]) }} #loadtablechild");
            }else{
              alert('Not Save, Something wrong.!');
            }
            console.log(data);
        });
      });

      $("body").on('click', '.link', function(e){

        e.preventDefault();

        var $this = $(this);
        var id = $this.attr('keyid');
        var data = {NodeID : id, ParentNodeID : $("#nodestr").val()};

        $.ajax({
            type: 'post',
            url: $this.attr('href'),
            data: {_method: $this.data('method'), _token :$('meta[name="csrf-token"]').attr('content'), data:data},
        }).done(function (data) {
            if(data == 'Success'){
              alert('success');
              $this
                .closest("tr")
                .remove();
              $(".loadnewnode").load("{{ route('nodes.edit', ['id' => $nodestr->child_node_id, 'parent' => $parent, 'lvl' => 2  ]) }} #loadtablenode");
              $(".loadnewchild").load("{{ route('nodes.edit', ['id' => $nodestr->child_node_id, 'parent' => $parent, 'lvl' => 2 ]) }} #loadtablechild");
            }else{
              alert('Not Save, Something wrong.!');
            }
            console.log(data);
        });
      });


      $("body").on('click', '.unlink', function(e){

        e.preventDefault();

        var $this = $(this);
        var id = $this.attr('id');

        $.ajax({
            type: 'post',
            url: $this.attr('href'),
            data: {_method: $this.data('method'), _token :$('meta[name="csrf-token"]').attr('content'), id:id},
        }).done(function (data) {
            if(data == 'Success'){
              alert('success');
              $this
                .closest("tr")
                .remove();
              $(".loadnewnode").load("{{ route('nodes.edit', ['id' => $nodestr->child_node_id, 'parent' => $parent, 'lvl' => 2 ]) }} #loadtablenode");
              $(".loadnewchild").load("{{ route('nodes.edit', ['id' => $nodestr->child_node_id, 'parent' => $parent, 'lvl' => 2 ]) }} #loadtablechild");
            }else{
              alert('Not Save, Something wrong.!');
            }
            console.log(data);
        });
      });

      $('body').on('click', '.productTextAjax', function(){
        var target = $(this).attr('target');
        var thirdparty = $(this).attr('thirdparty');

        $.ajax({
          method:"GET",
          url:target,
          success: function(result){
              $("#ajaxLoad").html(result);

              if(thirdparty == 'tinymce'){
                tinymce.remove();
                
                tinymce.init({
                  selector: 'textarea',
                  entity_encoding : 'raw',
                  mode : 'specific_textareas',
                  //selector: 'textarea',
                  //editor_selector : 'mceEditor',
                  convert_urls: false,
                  language : 'en',
                  theme: 'modern',
                  plugins: [
                    'spellchecker,pagebreak,layer,table,save,insertdatetime,media,searchreplace,' +
                      'print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,' +
                      'nonbreaking,template,autoresize,' +
                      'anchor,charmap,hr,image,link,emoticons,code,textcolor,' +
                      'charmap,pagebreak'
                  ],
                  toolbar: 'insertfile undo redo| charmap | pagebreak | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  fontselect fontsizeselect | forecolor backcolor',
                  pagebreak_separator: "<!-- my page break -->",
                  image_advtab: true,
                  autoresize_max_height: 350
                });
              }
              
          },
          error: function(e){
            alert("Error");
            console.log(e);
          }
        });
      });

      $('body').on('click', '.save-node-content', function(){
        tinyMCE.triggerSave();
        var sendParams = {
          _method : 'put',
          _token : $('meta[name="csrf-token"]').attr('content'),
          content1 : $('#content1').val(),
          content2 : $('#content2').val(),
          content3 : $('#content3').val(),
          content4 : $('#content4').val(),
        }

        $.ajax({
            type: 'post',
            url: '{{ route('nodes.content-text-update', ['id' => $nodes->id]) }}',
            data: sendParams,
        }).done(function (data) {
            if(data == 'Success'){
              alert('save data success');
            }else{
              alert('Not Save, Something wrong.!');
            }
            console.log(data);
        });
      });

      $("body").on('click', '.save-node-img', function(){

        $.ajax({
          method:"POST",
          url:"{{ route('nodes.content-img-update', ['id' => $nodes->id]) }}",
          data: new FormData($("#upload_form")[0]),
          contentType: false,
          cache: false,
          processData:false,
          success: function(result){
              console.log(result);
              if(result == 'Success'){
                alert("Update data Success");
                $(".imgLoad").load('{{ route('nodes.content-img', ['id' => $nodes->id, 'parent' => $parent]) }} #imgLoadAjax');
              }else{
                alert("Error when update");
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
<section class="content">

  @if(isset($nodes->id))
    <div class="row" style="margin-bottom: 15px;">
      <div class="col-md-4 text-center" style="margin-bottom: 15px;">
        <button class="btn btn-success btn-block productTextAjax" type="button"
        target="{{ route('nodes.content-detail', ['id' => $nodes->id, 'parent' => $parent]) }}">Node Detail</button>
      </div>

      <div class="col-md-4 text-center" style="margin-bottom: 15px;">
        <button class="btn btn-success btn-block productTextAjax" type="button" thirdparty="tinymce"
        target="{{ route('nodes.content-text', ['id' => $nodes->id]) }}">Nodes Content Text</button>
      </div>

      <div class="col-md-4 text-center" style="margin-bottom: 15px;">
        <button class="btn btn-success btn-block productTextAjax" type="button" 
        target="{{ route('nodes.content-img', ['id' => $nodes->id]) }}">Nodes Images</button>
      </div>
    </div>
  @endif

  {{ Form::model($nodes, ['route' => ['nodes.update', $nodes->id], 'method' => 'PUT', 'files' => true, 'id' => 'upload_form']) }}

  <div id="ajaxLoad">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Update Content Management Page</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#node_detail" data-toggle="tab" aria-expanded="true">Node Detail</a></li>
          <li class="pull-right"><a href="{{ route('nodes.index') }}" class="text-muted">Back to list</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="node_detail">

            @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div><br />
            @endif

              <input type="hidden" value="{{ $parent }}" name="parent" id="parent" />
              <input type="hidden" value="{{ $nodestr->child_node_id }}" name="nodestr" id="nodestr" />
              <input type="hidden" value="{{ $nodestr->id }}" name="nodestrid" id="nodestrid" />

              <div class="box-body">
                  <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', null, array('class' => 'form-control')) }}

                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="form-group {{ $errors->has('template') ? 'has-error' : '' }}">
                    {{ Form::label('template', 'Templates') }}
                    {{ Form::select('template', $arrTemplates, null,
                                    ['placeholder' => 'Pick a Template...', 'class' => 'form-control']) }}

                    @if ($errors->has('keyword'))
                        <span class="help-block">
                            <strong>{{ $errors->first('keyword') }}</strong>
                        </span>
                    @endif
                  </div>


                  <div class="form-group {{ $errors->has('alias') ? 'has-error' : '' }}">
                    {{ Form::label('alias', 'Alias') }}
                    {{ Form::text('alias', null, array('class' => 'form-control')) }}

                    @if ($errors->has('alias'))
                        <span class="help-block">
                            <strong>{{ $errors->first('alias') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    {{ Form::label('description', 'Description') }}
                    {{ Form::text('description', null, array('class' => 'form-control')) }}

                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="form-group {{ $errors->has('keyword') ? 'has-error' : '' }}">
                    {{ Form::label('keyword', 'Keyword') }}
                    {{ Form::text('keyword', null, array('class' => 'form-control')) }}

                    @if ($errors->has('keyword'))
                        <span class="help-block">
                            <strong>{{ $errors->first('keyword') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="form-group {{ $errors->has('active') ? 'has-error' : '' }}">
                    {{ Form::label('active', 'Active') }}
                    {{ Form::checkbox('active', 1, null, ['class' => '']) }}
                  </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <a href="#" onclick="event.preventDefault();
                document.getElementById('delete-statement').submit();" class="btn btn-danger">Delete</a>
                &nbsp;
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>

            
          </div>
        </div>
        <!-- /.tab-content -->
      </div>

    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="row">
        <div class="col-md-12">
          {{-- <div class="Head-Footer">
            <h3 class="box-title">Child Node</h3>
          </div> --}}

          <div class="Content-Footer">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Node is Child Page</h3>

                <div class="box-tools">
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">«</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">»</a></li>
                  </ul>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding loadnewchild">

                {{-- This for table child --}}
                <div id="loadtablechild">
                  <table class="table" id="">
                    <tbody>
                      <tr>
                        <th style="width: 50px">#</th>
                        <th>Node Name</th>
                        <th>Link</th>
                        <th>Priority</th>
                      </tr>

                      @foreach($nodechildstr as $nkey => $nval)

                      @php
                      array_push($arrNodeID, $nval->child_node_id);
                      @endphp

                      <tr>
                        <td>{{ $nkey+1 }}.</td>
                        <td>{{ $nval->node->title }} ({{ $nval->node->id }})</td>
                        <td>
                          <a href="{{ route('nodes.editunlink', ['id' => $nodes->id]) }}"
                            class="unlink" id="{{ $nval->id }}" data-method="post">Unlink</a>
                        </td>
                        <td>
                          <input type="text" id="{{ $nval->id }}" class="form-control priorityChild" value="{{ $nval->priority }}"/>
                        </td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>

                  <button type="button" class="btn btn-success saveChild pull-right">Save Child</button>
                  <div class="clearfix"></div>
                  <br />
                </div>
                {{-- End This for table child --}}
              </div>
              <!-- /.box-body -->


            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->


  <div class="box">
    <div class="box-body">

    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="row">
        <div class="col-md-12">
          {{-- <div class="Head-Footer">
            <h3 class="box-title">Child Node</h3>
          </div> --}}

          <div class="Content-Footer">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">All Unrelated Node</h3>

                <div class="box-tools">
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">«</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">»</a></li>
                  </ul>
                </div>
              </div><!-- /.box-header -->



              <div class="box-body no-padding loadnewnode">
                {{-- This for all node list --}}
                <table class="table" id="loadtablenode">
                  <tbody>
                    <tr>
                      <th style="width: 50px">#</th>
                      <th>Node Name</th>
                      <th>Action{{-- @php print_r($arrNodeID)@endphp --}}</th>
                    </tr>

                    @foreach( \App\Http\Controllers\Admin\NodeController::getNodeNotIn($arrNodeID) as $nikey => $notIn )
                      <tr>
                        <td>{{ $nikey+1 }}</td>
                        <td>{{ $notIn->title }} ({{ $notIn->id }})</td>
                        <td colspan="2">
                          <a href="{{ route('nodes.editlink', ['id' => $nodes->id]) }}" class="link"
                            keyid="{{ $notIn->id }}" data-method="post">
                            Link
                          </a>
                        </td>
                      </tr>
                    @endforeach

                  </tbody>
                </table>

                <div class="clearfix"></div>
                <br />
                {{-- End This for all node list --}}
              </div>
              <!-- /.box-body -->

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.box-footer-->
  </div>

  </div><!--////////////Ajax Load//////////////////-->
  {{ Form::close() }}


  <form id="delete-statement" action="{{ route('nodes.destroy',$nodes->id) }}" method="POST" style="display: none;">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="DELETE" />
  </form>

</section>
@endsection
