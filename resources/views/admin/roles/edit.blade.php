@extends('admin.layouts.master')

@section('title') 
Edit Role
@endsection

@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href="{{ url('admin/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ url('admin/roles') }}">Role</a></li>
    <li class="active"><a href="{{ route('roles.edit', $role->id) }}">@yield('title')</a></li>
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

		{{-- @if(isset($role->id))
			<div class="row" style="margin-bottom: 15px;">
				<div class="col-md-4 text-center" style="margin-bottom: 15px;">
					<button class="btn btn-success btn-block productTextAjax" type="button" thirdparty="tinymce"
					target="{{ route('roles.edit', ['id' => $role->id, 'ajax' => 1]) }}">Role Detail</button>
				</div>

				<div class="col-md-4 text-center" style="margin-bottom: 15px;">
					<button class="btn btn-success btn-block productTextAjax" type="button"
					target="{{ route('roles.edit', ['id' => $role->id]) }}">Employee List</button>
				</div>

				<div class="col-md-4 text-center" style="margin-bottom: 15px;">
					<button class="btn btn-success btn-block productTextAjax" type="button" 
					target="{{ route('roles.edit', ['id' => $role->id]) }}">Related Company</button>
				</div>
			</div>
		@endif --}}


		<form action="{{ route('roles.update',$role->id) }}" method="post" enctype="multipart/form-data" id="upload_form">
		{{ csrf_field() }}
		@if(isset($role->id))
			<input type="hidden" name="id" value="{{ $role->id }}" />
			<input type="hidden" name="_method" value="PUT" />
		@endif

			<input type="hidden" name="Priority" value="0" />
			<input type="hidden" name="ChangedByPersonID" value="{{ Auth::user()->id }}" />
			<input type="hidden" name="CreatedByPersonID" value="{{ Auth::user()->id }}" />

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
			                  <label for="RoleName" class="col-sm-3 control-label">Role name</label>
			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $role->RoleName or old('RoleName') }}" placeholder="Role name" name="RoleName">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Description" class="col-sm-3 control-label">Description</label>
			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $role->Description or old('Description') }}" placeholder="Description" 
			                    name="Description">
			                  </div>
			                </div>
			                
		                </div>

		                {{-- ////////////////Kanan////////////////////// --}}
		                <div class="col-md-6">
		                	
		                	<div class="form-group">
			                  <label for="Interface" class="col-sm-3 control-label">Interface</label>
			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $role->Interface or old('Interface') }}" placeholder="Interface" name="Interface">
			                  </div>
			                </div>

			                
			                <div class="form-group">
			                  <label for="Active" class="col-sm-3 control-label">Active</label>

			                  <div class="col-sm-9">
			                  	@if($role->Active == 0)
			                    	<input type="checkbox" unchecked name="Active" style="position: relative;top: 7px;" value="1">
			                    @else
			                    	<input type="checkbox" checked name="Active" style="position: relative;top: 7px;" value="1">
			                    @endif
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
			$('#PKPUsedDate').datepicker({
				autoclose: true,
				orientation: 'bottom',
				format: 'yyyy-mm-dd'
		  });

		  $('#InterestDate').datepicker({
				autoclose: true,
				orientation: 'bottom',
				format: 'yyyy-mm-dd'
		  });

		  $('#FoundedDate').datepicker({
				autoclose: true,
				orientation: 'bottom',
				format: 'yyyy-mm-dd'
		  });

	    tinymce.init({
						      selector: 'textarea',
						      entity_encoding : 'raw',
						      mode : 'specific_textareas',
						      //selector: 'textarea',
						      //editor_selector : 'mceEditor',
						      convert_urls: false,
						      language : 'en',
						      theme: 'modern',
						      plugins: [
						        'spellchecker,pagebreak,layer,table,save,insertdatetime,media,searchreplace,' +
						          'print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,' +
						          'nonbreaking,template,autoresize,' +
						          'anchor,charmap,hr,image,link,emoticons,code,textcolor,' +
						          'charmap,pagebreak'
						      ],
						      toolbar: 'insertfile undo redo| charmap | pagebreak | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  fontselect fontsizeselect | forecolor backcolor',
						      pagebreak_separator: "<!-- my page break -->",
						      image_advtab: true,
						      autoresize_max_height: 350
						    });

	    $('body').on('click', '.productTextAjax', function(){
	    	var target = $(this).attr('target');
	    	var thirdparty = $(this).attr('thirdparty');

	    	$.ajax({
	        method:"GET",
	        url:target,
	        success: function(result){
	            $("#ajaxLoad").html(result);

	            $('#getCompanyID').select2();

	            if(thirdparty == 'tinymce'){
	            	tinymce.remove();
	            	
	            	tinymce.init({
						      selector: 'textarea',
						      entity_encoding : 'raw',
						      mode : 'specific_textareas',
						      //selector: 'textarea',
						      //editor_selector : 'mceEditor',
						      convert_urls: false,
						      language : 'en',
						      theme: 'modern',
						      plugins: [
						        'spellchecker,pagebreak,layer,table,save,insertdatetime,media,searchreplace,' +
						          'print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,' +
						          'nonbreaking,template,autoresize,' +
						          'anchor,charmap,hr,image,link,emoticons,code,textcolor,' +
						          'charmap,pagebreak'
						      ],
						      toolbar: 'insertfile undo redo| charmap | pagebreak | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  fontselect fontsizeselect | forecolor backcolor',
						      pagebreak_separator: "<!-- my page break -->",
						      image_advtab: true,
						      autoresize_max_height: 350
						    });
	            }
	            
	        },
	        error: function(e){
	          alert("Error");
	          console.log(e);
	        }
	      });
	    });

	    

	    $('body').on('click', '.addComRelation', function(){
	    	// alert($('#getCompanyID').val());
	    	var formData = {
	                ToCompanyID : $('#getCompanyID').val(),
	                FromCompanyID : $('#CompanyID').val(),
	                FromCompanyRelationTypeID : 0,
	                ToCompanyRelationTypeID : 0,
	                Active : 1,
	                InsertedByPersonID : {{ Auth::user()->id }},
	                UpdatedByPersonID : {{ Auth::user()->id }},
	                _token  : $('meta[name="csrf-token"]').attr('content'),
	                _method: 'POST',
	            }

	      console.log(formData);
	      // return false;

	      $.ajax({
	        method:"POST",
	        url:"{{ route('companies.save-related-company') }}",
	        data: formData,
	        //dataType: "json",
	        success: function(result){
	            console.log(result);
	            if(result.error == 0){
	              alert("Update data Success");
	              $(".companyRelatedReload").load("{{ route('companies.get-related-company',$role->id) }} .companyRelatedReloadSuccess");
	              $(".successCompanyRelated").fadeIn('slow');
	            }else{
	            	alert("Error when update");
	            }

	        },
	        error: function(e, r){
	          alert("Error");
	          console.log(e);
	          console.log(r);
	        }
	      });
	    });
	});
	</script>
@endsection