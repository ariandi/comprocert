@extends('admin.layouts.master')

@section('title') 
Create Statement
@endsection

@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href="{{ url('admin/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ url('admin/statements') }}">Statement</a></li>
    <li class="active"><a href="{{ route('statements.create') }}">@yield('title')</a></li>
</ol>
@endsection

@section('content')
	<section class="content">

		<form action="{{ route('statements.store', ['parent' => $parent, 'lvl' => session()->get('lvl1Val')]) }}" method="post" enctype="multipart/form-data" id="upload_form">
		{{ csrf_field() }}
		@if(isset($statement->id))
			<input type="hidden" name="id" value="{{ $statement->id }}" />
			<input type="hidden" name="_method" value="PUT" />
		@endif

			<input type="hidden" name="InsertedByPersonID" value="{{ Auth::user()->id }}" />
			<input type="hidden" name="UpdatedByPersonID" value="{{ Auth::user()->id }}" />
			<input type="hidden" name="tablename" value="statements" />
			<input type="hidden" name="primarykey" value="0" />

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
	      <h3 class="box-title">Statement Data</h3>

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
			                  <label for="title" class="col-sm-3 control-label">Statement Title</label>
			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $statement->title or old('title') }}" placeholder="Statement Title name" name="title">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="description" class="col-sm-3 control-label">Description</label>
			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $statement->description or old('description') }}" placeholder="Description" 
			                    name="description">
			                  </div>
			                </div>
			                
		                </div>

		                {{-- ////////////////Kanan////////////////////// --}}
		                <div class="col-md-6">
		                	
		                	<div class="form-group">
			                  <label for="active" class="col-sm-3 control-label">Active</label>
			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $statement->active or old('active') }}" placeholder="Active" name="active">
			                  </div>
			                </div>

			                
			                {{-- <div class="form-group">
			                  <label for="primarykey" class="col-sm-3 control-label">Primary Key</label>

			                  <div class="col-sm-9">
			                  	<input type="text" class="form-control" 
			                    value="{{ $statement->primarykey or old('primarykey') }}" placeholder="Description" 
			                    name="primarykey">
			                  </div>
			                </div> --}}

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

@section('addingScriptJs')
	<script type="text/javascript">
	$(document).ready(function() {
			
	});
	</script>
@endsection