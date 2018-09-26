@extends('admin.layouts.master')

@section('title') 
Roles 
@endsection

@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href="{{ url('admin/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ url('admin/roles') }}">@yield('title')</a></li>
</ol>
@endsection

@section('css_custom')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
	<section class="content">

		<div class="box collapsed-box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Create New Roles</h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                title="Collapse">
	          <i class="fa fa-plus"></i></button>
	      </div>
	    </div>
	    <div class="box-body" style="display: none;">
	      <div class="row">

	        <div class="col-xs-12">
	        	<a class="btn btn-success" href="{{ route('roles.create') }}">Create New Role</a>
	        </div>

	      </div>

	    </div><!-- /.box-body -->
	  </div>

	  <!-- Default box -->
	  <div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Role</h3>

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
                	<div class="panel-heading">Role List</div>

	                <div class="panel-body">
	                    <table class="table table-hover table-bordered table-striped datatable" style="width:100%">
	                        <thead>
	                            <tr>
	                                <th>Role Id</th>
	                                <th>RoleName</th>
	                                <th>Description</th>
	                                <th>Last Update</th>
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
	        ajax: '{{ route('roles.getdatatablesdata') }}',
	        columns: [
	            {data: 'id', name: 'id'},
	            {data: 'RoleName', name: 'RoleName'},
	            {data: 'Description', name: 'Description'},
	            {data: 'updated_at', name: 'updated_at'},
	            {data: 'action', name: 'action', orderable: false, searchable: false}
	        ]
	    });
	});
	</script>
@endsection