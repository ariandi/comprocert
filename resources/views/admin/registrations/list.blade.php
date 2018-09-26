@extends('admin.layouts.master')

@section('title') Registration List @endsection

@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ route('ordersale.index') }}">@yield('title')</a></li>
</ol>
@endsection
@section('content')
<section class="content">
	  <!-- Default box -->
	  <div class="box">
	    <div class="box-header with-border">
	    	 <h3 class="box-title">@yield('title')</h3>
		   	<div class="box-tools pull-right">
		        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
		         	<i class="fa fa-minus"></i>
		       	</button>
		       	<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
		          	<i class="fa fa-times"></i>
		       	</button>
		   	</div>
	    </div>
	    <div class="box-body">
	    	<div class="row">
	        	<div class="col-xs-12">
	        		<div class="panel-group">
				    	<div class="panel panel-default">
			                <div class="panel-body">
			                	@if (\Session::has('success'))
						          	<div class="alert alert-success">
						            	<p>{{ \Session::get('success') }}</p>
						          	</div>
						        @endif
			                   	<a href="{{ route('registrations.create') }}" class="btn btn-primary form-group savelang pull-right">Create New Activity</a>
			            	</div>
			            </div>
				  	</div>
				  	<div class="panel-group">
				    	<div class="panel panel-default">
		                	<div class="panel-heading">@yield('title')</div>

			                <div class="panel-body">
			                	
			                    <table class="table table-hover table-bordered table-striped" id="datatables" style="width:100%">
			                        <thead>
			                            <tr>
			                                <th>ID</th>
			                                <th>Title</th>
			                                <th>Group</th>
			                                <th>From</th>
			                                <th>Location</th>
			                                <th>Antall</th>
			                                <th>Responsible</th>
			                                <th>Action</th>
			                            </tr>
			                        </thead>
			                    </table>
			                    
			            	</div>
			            </div>
				  	</div>
	        	</div>
	        </div>
	    </div>
	  	<!-- /.box -->
	  	<div class="box-footer">
	      	<div class="row">
	        	<div class="col-xs-12">
	        		<!-- <button type="button" class="btn btn-primary form-group savelang pull-right">Save</button> -->
	        	</div>
	        </div>
	    </div>
	</section>
@endsection
