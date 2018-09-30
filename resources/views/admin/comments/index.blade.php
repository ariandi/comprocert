@extends('admin.layouts.master')

@section('title') 
Comment 
@endsection

@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href="{{ url('admin/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ url('admin/comments') }}">@yield('title')</a></li>
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
	      <h3 class="box-title">Comment</h3>

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
                	{{-- <div class="panel-heading">Comment List</div> --}}

	                <div class="panel-body">
	                    <table class="table table-hover table-bordered table-striped datatable" style="width:100%">
	                        <thead>
	                            <tr>
	                                <th>Id</th>
	                                <th>Name</th>
	                                <th>Email</th>
	                                <th>Subject</th>
	                                <th>Message</th>
	                                <th>Created At</th>
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
	        ajax: '{{ route('comments.getdatatablesdata') }}',
	        columns: [
	            {data: 'id', name: 'id'},
	            {data: 'name', name: 'name'},
	            {data: 'email', name: 'email'},
	            {data: 'subject', name: 'subject'},
	            {data: 'message', name: 'message'},
	            {data: 'created_at', name: 'created_at'},
	            {data: 'action', name: 'action', orderable: false, searchable: false}
	        ]
	    });
	});
	</script>
@endsection