@extends('admin.layouts.master')

@section('title') 
Create Role Action
@endsection

@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href="{{ url('admin/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ url('admin/roles/role-action-list') }}">Role</a></li>
    <li class="active"><a href="{{ route('roles.role-action-create') }}">@yield('title')</a></li>
</ol>
@endsection

@section('css_custom')
<link href="{{ URL::asset('assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<style type="text/css">
	.select2-container .select2-selection--single{
		height: 34px;
	}
</style>
@endsection

@section('content')
	<section class="content">

		<form action="{{ route('roles.role-action-store') }}" method="post" enctype="multipart/form-data" id="upload_form">
		{{ csrf_field() }}
		@if(isset($role->id))
			<input type="hidden" name="id" value="{{ $role->id }}" />
			<input type="hidden" name="_method" value="PUT" />
		@endif

			<input type="hidden" name="Access" value="{{ $role->Access }}" />
			<input type="hidden" name="ChangedByPersonID" value="{{ $role->ChangedByPersonID }}" />
			<input type="hidden" name="CreatedByPersonID" value="{{ $role->CreatedByPersonID }}" />

		<div id="ajaxLoad">

		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

		@if (\Session::has('success'))
      <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
      </div><br />
    @endif

		<div class="box box-success">
	    <div class="box-header with-border">
	      <h3 class="box-title">Role Data</h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                title="Collapse">
	          <i class="fa fa-minus"></i></button>
	      </div>
	    </div>
		    
		  <div class="box-body">
		    <div class="row">

		        <div class="col-xs-12">

              <div class="form-horizontal">

	              	<div class="row">
	              		<div class="col-md-6">

	              			<div class="form-group">
			                  <label for="Module" class="col-sm-3 control-label">Module</label>
			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $role->Module or old('Module') }}" placeholder="Role Module" name="Module">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Action" class="col-sm-3 control-label">Action</label>
			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $role->Action or old('Action') }}" placeholder="Action" 
			                    name="Action">
			                  </div>
			                </div>
			                
		                </div>

		                {{-- ////////////////Kanan////////////////////// --}}
		                <div class="col-md-6">
		                	
		                	<div class="form-group">
			                  <label for="Interface" class="col-sm-3 control-label">Role</label>
			                  <div class="col-sm-9">
			                  	<select class="form-control" name="RoleID" id="RoleID">
			                  		<option></option>
			                  		@foreach($roles as $r)
			                  			<option value="{{ $r->id }}" {{ $r->id==$role->RoleID?'selected':'' }}>
			                  				{{ $r->id }} - {{ $r->RoleName }}
			                  			</option>
			                  		@endforeach
			                  	</select>
			                  </div>
			                </div>

		                </div>
	                </div>
	            </div>

		      	</div>

		    </div><!-- /.box-body -->
		  </div>
		</div>

	  <div class="panel">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-offset-5 col-md-2 text-center">
						<a href="#" class="btn btn-default">Cancel</a>
						&nbsp;
						<input type="submit" value="Save" class="btn btn-primary" />
					</div>
				</div>
			</div>
		</div>

		</div> {{-- ///////////////Ajax Call///////////// --}}

		</form>

	</section>
@endsection

@section('addingFileJs')
	<script src="{{ URL::asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=xspx9ax4f39yi8pjfnpoe60sz9x5mz1xewzmxt918nsl47sh"></script>
@endsection

@section('addingScriptJs')
	<script type="text/javascript">
	$(document).ready(function() {
			
			$('#RoleID').select2({
			    placeholder: "Select a role",
			    allowClear: true
			});
	    
	});
	</script>
@endsection