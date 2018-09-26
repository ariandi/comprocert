@extends('admin.layouts.master')

@section('title') 
Statement
@endsection

@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href="{{ url('admin/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ url('admin/statements') }}">@yield('title')</a></li>
</ol>
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
	      <h3 class="box-title">Statement Page</h3>

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
	      	<div class="col-md-2">
	      		<div class="lvl1">
		      		<div class="h-new-node">
		      			<img src="{{ asset('images/folder1.png') }}" class="img-responsive" />
		      		</div>
		      		<div class="h-new-title">
		      			<a href="{{ route('statements.create', ['parent' => session()->get('lvl1Val'), 'lvl' => 1]) }}">New Statement</a>
		      		</div>

		      		<div class="clearfix"></div>

		      		<div class="b-node">
		      			@foreach($statementstr as $statement)
			      			@if($statement->statement['id'] != null and $statement->statement['active'] == 1)
				      			<div class="c-menu-b">
					      			<div class="h-new-node">
					      				<a href="{{ route('statements.index', ['parent' => $statement->statement['id'], 'lvl' => 2]) }}"
					      					id="{{ $statement->statement['id'] }}" class="lvl1clicked">
						      				<img src="{{ asset('images/folder1.png') }}" class="img-responsive" />
						      			</a>
						      		</div>
						      		<div class="h-new-title">
						      			<a href="{{ route('statements.edit', ['id' => $statement->statement['id'], 'parent' => 0, 'lvl' => 1]) }}">
						      				{{ $statement->statement['title'] }} ({{ $statement->statement['id'] }})
						      			</a>
						      		</div>

						      		<div class="clearfix"></div>
					      		</div>
					      	@endif
			      		@endforeach

		      		</div>
	      		</div>

	      		<hr />
	      	</div>

	      	<div class="col-md-2 ajavlvl2">
	      		<hr />
	      	</div>

	      	<div class="col-md-2 ajavlvl3">
	      		<hr />
	      	</div>

	      	<div class="col-md-2 ajavlvl4">
	      		<hr />
	      	</div>

	      	<div class="col-md-2 ajavlvl5">
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
      	var Parent = "{{ URL::asset('/admin/statements/ajax-list') }}/"+$(this).attr('id')+"/2";
      	$(".ajavlvl2").load(Parent);
      	$(".ajavlvl3load").remove();
      	$(".ajavlvl4load").remove();
      	$(".ajavlvl5load").remove();
      });

      $("body").on('click', '.lvl2clicked', function(e){
      	e.preventDefault();
      	var Parent = "{{ URL::asset('/admin/statements/ajax-list') }}/"+$(this).attr('id')+"/3";
      	$(".ajavlvl3").load(Parent);
      	$(".ajavlvl4load").remove();
      	$(".ajavlvl5load").remove();
      });

      $("body").on('click', '.lvl3clicked', function(e){
      	e.preventDefault();
      	var Parent = "{{ URL::asset('/admin/statements/ajax-list') }}/"+$(this).attr('id')+"/4";
      	$(".ajavlvl4").load(Parent);
      	$(".ajavlvl5load").remove();
      	//$(".ajavlvl4load").remove();
      });

      $("body").on('click', '.lvl4clicked', function(e){
      	e.preventDefault();
      	var Parent = "{{ URL::asset('/admin/statements/ajax-list') }}/"+$(this).attr('id')+"/5";
      	$(".ajavlvl5").load(Parent);
      	//$(".ajavlvl4load").remove();
      });

    });

  </script>
@endsection
