@extends('admin.layouts.master')

@section('title')
Content Management
@endsection

@section('titlecontent')
Content Management
@endsection

@section('subtitlecontent')
List
@endsection

@section('content')
	<section class="content">

		@if (\Session::has('success'))
      <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
      </div><br />
    @endif

	  <!-- Default box -->
	  <div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Conten Management Page</h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                title="Collapse">
	          <i class="fa fa-minus"></i></button>
	        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
	          <i class="fa fa-times"></i></button>
	      </div>
	    </div>
	    <div class="box-body">
	      <div class="row">
	      	<div class="col-md-3">
	      		<div class="lvl1">
		      		<div class="h-new-node">
		      			<img src="{{ asset('images/folder1.png') }}" class="img-responsive" />
		      		</div>
		      		<div class="h-new-title">
		      			<a href="{{ route('nodes.create', ['parent' => 0, 'lvl' => 1]) }}">New Node</a>
		      		</div>

		      		<div class="clearfix"></div>

		      		<div class="b-node">
		      			@foreach($nodes as $node)
		      			<div class="c-menu-b">
			      			<div class="h-new-node">
			      				<a href="{{ URL::asset('/admin/nodes') }}?parent=$node->node->id/2/ajaxnode"
			      					id="{{ $node->node->id }}" class="lvl1clicked">
				      				<img src="{{ asset('images/folder1.png') }}" class="img-responsive" />
				      			</a>
				      		</div>
				      		<div class="h-new-title">
				      			<a href="{{ route('nodes.edit', ['id' => $node->node->id, 'parent' => session()->get('lvl1Val'), 'lvl' => $lvl]) }}">{{ $node->node->title }} ({{ $node->node->id }})</a>
				      		</div>

				      		<div class="clearfix"></div>
			      		</div>
			      		@endforeach

		      		</div>
	      		</div>

	      		<hr />
	      	</div>

	      	<div class="col-md-3 ajavlvl2">
	      		<hr />
	      	</div>

	      	<div class="col-md-3 ajavlvl3">
	      		<hr />
	      	</div>

	      	<div class="col-md-3 ajavlvl4">
	      		<hr />
	      	</div>

	      </div>
	    </div>
	    <!-- /.box-body -->
	    <div class="box-footer">
	      Footer
	    </div>
	    <!-- /.box-footer-->
	  </div>
	  <!-- /.box -->

	</section>
@endsection



{{-- /////////////////////////Jquery//////////////////////////////////// --}}
@section('addingScriptJs')
  <script type="text/javascript">

    $(document).ready(function(){

      $("body").on('click', '.lvl1clicked', function(e){
      	e.preventDefault();
      	var Parent = "{{ URL::asset('/admin/nodes') }}/"+$(this).attr('id')+"/2/ajaxnode";
      	$(".ajavlvl2").load(Parent);
      	$(".ajavlvl3load").remove();
      	$(".ajavlvl4load").remove();
      });

      $("body").on('click', '.lvl2clicked', function(e){
      	e.preventDefault();
      	var Parent = "{{ URL::asset('/admin/nodes') }}/"+$(this).attr('id')+"/3/ajaxnode";
      	$(".ajavlvl3").load(Parent);
      	$(".ajavlvl4load").remove();
      });

      $("body").on('click', '.lvl3clicked', function(e){
      	e.preventDefault();
      	var Parent = "{{ URL::asset('/admin/nodes') }}/"+$(this).attr('id')+"/4/ajaxnode";
      	$(".ajavlvl4").load(Parent);
      	//$(".ajavlvl4load").remove();
      });

    });

  </script>
@endsection
