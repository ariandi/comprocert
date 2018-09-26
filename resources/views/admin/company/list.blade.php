@extends('admin.layouts.master')

@section('title') 
Companies / Customers 
@endsection

@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href="{{ url('admin/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ url('admin/companies') }}">@yield('title')</a></li>
</ol>
@endsection

@section('css_custom')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
	<section class="content">

		<div class="box collapsed-box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Create New Company</h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                title="Collapse">
	          <i class="fa fa-plus"></i></button>
	      </div>
	    </div>
	    <div class="box-body" style="display: none;">
	      <div class="row">

	        <div class="col-xs-12">
	        	<a class="btn btn-success" href="{{ route('companies.create') }}">Create New Company</a>
	        </div>

	      </div>

	    </div><!-- /.box-body -->
	  </div>

	  <!-- Default box -->
	  <div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Company</h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                title="Collapse">
	          <i class="fa fa-minus"></i></button>
	      </div>
	    </div>
	    <div class="box-body">
	      <div class="row">

	        <div class="col-xs-12">

	          	<div class="panel panel-default">
                	<div class="panel-heading">Company List</div>

	                <div class="panel-body">
	                    <table class="table table-hover table-bordered table-striped datatable" style="width:100%">
	                        <thead>
	                            <tr>
	                                <th>Company Id</th>
	                                <th>Company Name</th>
	                                <th>Total Discount</th>
	                                <th>Organisation Number</th>
	                                <th>External ID</th>
	                                <th>City</th>
	                                <th>Action</th>
	                            </tr>
	                        </thead>
	                    </table>
	            	</div>
	            </div>

	        </div>

	      </div>
	      <div class="ajax-content">
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

@section('addingFileJs')
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
@endsection

@section('addingScriptJs')
	<script type="text/javascript">
	$(document).ready(function() {
	    var table = $('.datatable').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{{ route('companies.getdatatablesdata',['parent' => $parent]) }}',
	        columns: [
	            {data: 'id', name: 'companies.id'},
	            {data: 'CompanyName', name: 'companies.CompanyName'},
	            {data: 'Discount', name: 'companies.Discount'},
	            {data: 'OrgNumber', name: 'companies.OrgNumber'},
	            {data: 'ExternalID', name: 'companies.ExternalID'},
	            {data: 'DCity', name: 'companies.DCity'},
	            {data: 'action', name: 'action', orderable: false, searchable: false}
	        ]
	    });
	});
	</script>
@endsection