@extends('admin.layouts.master')

@section('title') 
Sync 
@endsection

@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href="{{ url('admin/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ url('admin/sync') }}">@yield('title')</a></li>
</ol>
@endsection

@section('content')
	<section class="content">

		@if (\Session::has('success'))
      <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
      </div><br />
    @endif

		<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Syncronize</h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                title="Collapse">
	          <i class="fa fa-minus"></i></button>
	      </div>
	    </div>
	    <div class="box-body">
	      <div class="row">

	      	<div class="col-md-3 text-center" style="margin-bottom: 15px;">
						<a class="btn btn-primary btn-block" 
						href="{{ route('sync.rangeproduct') }}">Range Product</a>
					</div>
					
					<div style="clear:both;"></div>
					
					<div class="col-md-3 text-center" style="margin-bottom: 15px;">
						<a class="btn btn-primary btn-block" 
						href="{{ route('sync.product') }}">Product</a>
					</div>
					
					<div style="clear:both;"></div>
					
					<div class="col-md-3 text-center" style="margin-bottom: 15px;">
						<a class="btn btn-primary btn-block" 
						href="{{ route('sync.company') }}">Company</a>
					</div>

					<div style="clear:both;"></div>
					
					<div class="col-md-3 text-center" style="margin-bottom: 15px;">
						<a class="btn btn-primary btn-block" 
						href="{{ route('sync.extraques') }}">Extraquestion & SsClub</a>
					</div>

					<div style="clear:both;"></div>
					
					<div class="col-md-3 text-center" style="margin-bottom: 15px;">
						<a class="btn btn-primary btn-block" 
						href="{{ route('sync.role') }}">Role</a>
					</div>

					<div style="clear:both;"></div>
					
					<div class="col-md-3 text-center" style="margin-bottom: 15px;">
						<a class="btn btn-primary btn-block" 
						href="{{ route('sync.statement') }}">Statement</a>
					</div>
	      </div>

	    </div><!-- /.box-body -->
	  </div>

	</section>
@endsection

@section('addingScriptJs')
	<script type="text/javascript">
	$(document).ready(function() {
	    
	});
	</script>
@endsection