@extends('admin.layouts.master')

@section('title') 
Create Certificate
@endsection

@section('breadcrumb')
<h1>@yield('title')</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('admin/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ url('admin/certificates') }}">Certificates</a></li>
    <li class="active"><a href="{{ url('admin/certificates/create') }}">@yield('title')</a></li>
</ol>
@endsection

@section('css_custom')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<style type="text/css">
	.select2-container .select2-selection--single{
		height: 34px;
	}
</style>
@endsection

@section('content')
	<section class="content">

		{!! Form::open(['route'=> 'certificates.store' , 'method' => 'POST', 'files'=>true]) !!}

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
          <p>{{ Session::get('success') }}</p>
      </div><br />
    @endif

		<div class="box box-success">
	    <div class="box-header with-border">
	      <h3 class="box-title">Certificate</h3>

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

	              		{{-- ///////////////////////////Kiri///////////// --}}
	              		<div class="col-md-6">
			                <div class="form-group">
			                  <label for="company_id" class="col-sm-3 control-label">Company Name</label>

			                  <div class="col-sm-9">
			                    {!! Form::select('company_id', $companies, null, ['placeholder' => 'Pilih Salah satu', 'class' => 'form-control sel2']) !!}
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="certificate_no" class="col-sm-3 control-label">Certificate No</label>

			                  <div class="col-sm-9">
			                    {!! Form::text('certificate_no', null, ['placeholder' => 'Certificate No', 'class' => 'form-control']) !!}
			                  </div>
			                </div>
		                </div>
		                {{-- ///////////////////////////End Kiri///////////// --}}

		                {{-- ///////////////////////////Kanan///////////// --}}
		                <div class="col-md-6">
		                	<div class="form-group">
			                  <label for="file" class="col-sm-3 control-label">File</label>
			                  <div class="col-sm-9">
			                    {!! Form::file('file', array('class' => 'form-control text-center')) !!}
			                  </div>
			                </div>

			                @if($cert->id)
				                <div class="form-group">
				                  <label for="status" class="col-sm-3 control-label">Status</label>

				                  <div class="col-sm-9">
				                  	{!! Form::select('status', $status, null, ['placeholder' => 'Pilih Salah satu', 'class' => 'form-control sel2']) !!}
				                  </div>
				                </div>
			                @endif
		                </div>
		                {{-- ///////////////////////////End Kanan///////////// --}}

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

		{!! Form::close() !!}

	</section>
@endsection

@section('addingFileJs')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endsection

@section('addingScriptJs')
	<script type="text/javascript">
	$(document).ready(function() {
			
	    $('.sel2').select2();

	});
	</script>
@endsection