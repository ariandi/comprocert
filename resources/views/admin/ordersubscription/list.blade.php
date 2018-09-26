@extends('admin.layouts.master')

@section('title') Order Subscription @endsection

@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ route('ordersale.index') }}">@yield('title')</a></li>
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
						            	<p>{{ \Session::get('success') }}</p>
						          	</div>
						        @endif
			                   	<a href="{{ route('ordersubscriptions.create') }}" class="btn btn-primary form-group savelang pull-right">Create New Order</a>
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
			                                <th>OrderID</th>
			                                <th>Name</th>
			                                <th>Email</th>
			                                <th>Status</th>
			                                <th>Order Date</th>
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

		$("body").on("click", ".deleteorder", function(){
	       if (confirm('Are you sure to delete?')) {
	    	 	return true;
	    	 }else{
	    	 	return false;
	    	 }
	    });

		var table = $('#datatables').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('ordersubscriptions.getDatatablesData') }}",
			columns: [
				{data: 'id', name: 'id'},
				{data: 'DName', name: 'Name'},
				{data: 'DEmail', name: 'Email'},
				{data: 'Status', name: 'status'},
				{data: 'OrderDate', name: 'OrderDate'},
				{data: 'action', name: 'action', orderable: false, searchable: false}
			]
		});
	});
</script>
@endsection
