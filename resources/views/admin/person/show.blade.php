@extends('admin.layouts.master')

@section('title') Person @endsection

@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ route('persons.index') }}">@yield('title')</a></li>
</ol>
@endsection

@section('css_custom')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
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
						            	{{ \Session::get('success') }}
						          	</div>
				        		@endif
			                   	<a href="{{ route('persons.create') }}" class="btn btn-primary form-group savelang pull-right">Add Person</a>
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
			                                <th>First Name</th>
			                                <th>Last Name</th>
			                                <th>Email</th>
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

@section('js_custom')
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#datatables').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('persons.getAPI') }}",
			columns: [
				{data: 'first_name', name: 'first_name'},
				{data: 'last_name', name: 'last_name'},
				{data: 'email', name: 'email'},
				{data: 'action', name: 'action', orderable: false, searchable: false}
			]
		});
	});
</script>
@endsection