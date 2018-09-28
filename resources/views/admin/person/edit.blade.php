@extends('admin.layouts.master')

@section('title') Edit Person @endsection

@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
	<li><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li><a href="{{ route('persons.index') }}">Person</a></li>
	<li class="active">@yield('title')</li>
</ol>
@endsection

@section('css_custom')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
<section class="content">

	<div class="row" style="margin-bottom:15px;">
		<div class="col-md-4">
			<button type="button" class="btn btn-success btn-block userTarget" 
			target="{{ route('person.edit-ajax', $user['data']->id) }}">User Detail</button>
		</div>

		<div class="col-md-4">
			<button type="button" class="btn btn-success btn-block userTarget" 
			target="{{ route('person.person-role', $user['data']->id) }}">User Role</button>
		</div>
	</div>

	<form method="post" action="{{ route('persons.update', [$user['data']->id]) }}">
		@method('PUT')
		@csrf
		<div id="ajaxLoad">
		<div class="box box-default" id="box-personInformation">
			<div class="box-header with-border" id="box-personInformation-collapse-trigger" style="cursor: pointer;">
				<h3 class="box-title">Person Information</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					<!-- <div class="col-md-12">
					@foreach ($errors->all() as $message)
						<li>{{ $message }}</li>
					@endforeach
					</div> -->
					@if (\Session::has('success'))
					<div class="col-md-12">
						<div class="alert alert-success">
							<p>{{ \Session::get('success') }}</p>
						</div>
					</div>
					@endif
					<div class="col-md-6">
						<div class="form-group">
							<label for="firstName">First Name</label>
							<input type="text" name="first_name" id="first_name" value="{{ $user['data']->first_name }}" class="form-control" />
							<small class="text-red">{{ $errors->first('first_name') }}</small>
						</div>
						<div class="form-group">
							<label for="birthDate">Date of birth</label>
							<div class="input-group date">
								<span class="input-group-addon">
			                        <i class="fa fa-calendar"></i>
			                    </span>
			                    <input type="text" name="birth_date" id="birth_date" value="{{ $user['data']->birth_date }}" class="form-control" readonly="" />
			                </div>
			                <small class="text-red">{{ $errors->first('birth_date') }}</small>
						</div>
						<div class="form-group">
							<label for="email">E-mail</label>
							<input type="email" name="email" id="email" value="{{ $user['data']->email }}" class="form-control" />
							<small class="text-red">{{ $errors->first('email') }}</small>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="passwordold" id="password" class="form-control" />
							<small class="text-red">{{ $errors->first('password') }}</small>
						</div>
						<div class="form-group">
							<label for="confirmPassword">Confirm Password</label>
							<input type="password" name="password_confirmationold" id="confirmPassword" class="form-control" />
							<small class="text-red">{{ $errors->first('password_confirmation') }}</small>
						</div>
						<div class="form-group">
							<label for="company">Company(s)</label>
							<select class="js-example-basic-multiple form-control" name="companies[]" multiple="multiple">
							@foreach ($companies as $company)
								<option value="{{ $company->id }}" {{ ((in_array($company->id, $user['hasCompany'])) ? 'selected':'') }} >{{ $company->CompanyName }}</option>
							@endforeach
							</select>
							<small class="text-red">{{ $errors->first('companies') }}</small>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="lastName">Last Name </label>
							<input type="text" name="last_name" id="last_name" value="{{ $user['data']->last_name }}" class="form-control" />
							<small class="text-red">{{ $errors->first('last_name') }}</small>
						</div>
						<div class="form-group">
							<label for="gender">Gender</label>
							{{ Form::select('gender', ['M' => 'Male', 'F' => 'Female'], $user['data']->gender, ['placeholder' => 'Select Gender', 'class' => 'form-control', 'id' => 'gender' ]) }}
							<small class="text-red">{{ $errors->first('gender') }}</small>
						</div>
						<div class="form-group">
							<label for="mobilePhoneNumber">Mobile Phone</label>
							<input type="text" name="no_hp" id="no_hp" value="{{ $user['data']->no_hp }}" class="form-control" />
							<small class="text-red">{{ $errors->first('no_hp') }}</small>
						</div>
						<div class="form-group">
							<label for="languageID">Language</label>
							{{ Form::select('lang_id', $languages, $user['data']->lang_id, ['placeholder' => 'Select Language', 'class' => 'form-control', 'id' => 'lang_id' ]) }}
							<small class="text-red">{{ $errors->first('lang_id') }}</small>
						</div>
						<div class="form-group">
							<label for="role">Role</label>
							{{ Form::select('role', $roles, $user['data']->role, ['placeholder' => 'Select Role', 'class' => 'form-control', 'id' => 'role' ]) }}
							<small class="text-red">{{ $errors->first('role') }}</small>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box box-default" id="box-invoiceAddress"> <!-- .collapsed-box is name class for collapse box by default -->
			<div class="box-header with-border" id="box-invoiceAddress-collapse-trigger" style="cursor: pointer;">
				<h3 class="box-title">Invoice Address</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						Coming Soon
					</div>
				</div>
			</div>
		</div>
		<div class="box box-default" id="box-deliveryAddress">
			<div class="box-header with-border" id="box-deliveryAddress-collapse-trigger" style="cursor: pointer;">
				<h3 class="box-title">Delivery Address</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						Coming Soon
					</div>
				</div>
			</div>
		</div>
		<div class="box box-default" id="box-variousInformation">
			<div class="box-header with-border" id="box-variousInformation-collapse-trigger" style="cursor: pointer;">
				<h3 class="box-title">Various information</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						Coming Soon
					</div>
				</div>
			</div>
		</div>
		<div class="box box-default" id="box-log">
			<div class="box-header with-border" id="box-log-collapse-trigger" style="cursor: pointer;">
				<h3 class="box-title">Log</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						Coming Soon
					</div>
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-offset-5 col-md-2 text-center">
						<a href="{{ route('persons.index') }}" class="btn btn-default">Cancel</a>
						&nbsp;
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>
			</div>
		</div>
	</div>{{-- ////////////////////////////////////////Ajax Load ///////////////////////////////////--}}
	</form>
</section>
@endsection

@section('js_custom')
{{-- <script type="module" src="{{asset('assets/admin/plugins/moment/moment.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

	$('#birth_date').datepicker({
		autoclose: true,
		orientation: 'bottom',
		format: 'yyyy-mm-dd',
		todayHighlight: true
  });

	$('body').on('click', '.userTarget', function(){
		var target = $(this).attr('target');
		// var thirdparty = $(this).attr('thirdparty');

		$.ajax({
	    method:"GET",
	    url:target,
	    success: function(result){
	        $("#ajaxLoad").html(result);

	        $('#birthDate').datepicker({
						autoclose: true,
						orientation: 'bottom',
						format: 'dd MM yyyy',
						startView: 4
			    });

			    $('.js-example-basic-multiple').select2({
			    	maximumSelectionLength: 5
			    });

			    $.each(['personInformation', 'invoiceAddress', 'deliveryAddress', 'variousInformation', 'log'], function(key, value) {
						$('#box-' + value + '-collapse-trigger').on('click', function() {
							$('#box-' + value).boxWidget('toggle');
						});
					});

					var table = $('.datatable').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{{ route('person.list-of-role', $user['data']->id) }}',
			        columns: [
			            {data: 'id', name: 'id'},
			            {data: 'RoleName', name: 'RoleName'},
			            {data: 'Description', name: 'Description'},
			            {data: 'action', name: 'action', orderable: false, searchable: false}
			        ]
			    });

					var i = 1;
			    $('body').on('click', '.insertRole', function( event ) {
						  event.preventDefault();
						  var role_id = $(this).attr('role_id');
						  var formData = {
			            user_id : $('#user_id_'+role_id).val(),
			            role_id : role_id,
			            _token  : $('meta[name="csrf-token"]').attr('content'),
			            _method: 'post',
			        }
			        console.log(formData);
			        $.ajax({
			            type: 'post',
			            url: '{{ url('admin/persons/input-person-role') }}/'+formData.user_id+'/'+formData.role_id,
			            data: formData,
			        }).done(function (data) {
			            if(data.error == '0'){
			            	alert('input data success');
			            	table.ajax.reload();
			            	$("#personRole").load("{{ route('person.person-role',$user['data']->id) }} #box-personRole");
			            }else{
			            	alert('error');
			            }
			        });
			    });

				  $('body').on('click', '.remove-person-role', function(event){
			    		event.preventDefault();
			    		var id = $(this).attr('id');
						  var formData = {
			            _token  : $('meta[name="csrf-token"]').attr('content'),
			            _method: 'delete',
			        }
			        console.log(formData);
			        $.ajax({
			            type: 'post',
			            url: '{{ url('admin/persons/delete-person-role/') }}/'+id,
			            data: formData,
			        }).done(function (data) {
			            if(data.error == '0'){
			            	alert('remove data success');
			            	table.ajax.reload();
			            	$("#personRole").load("{{ route('person.person-role',$user['data']->id) }} #box-personRole");
			            }else{
			            	alert('error');
			            }
			        });
			    });

			    i = i+1;
			    console.log(i);

	    },
	    error: function(e){
	      alert("Error");
	      console.log(e);
	    }
	  });
	});

	

	// $( "form#personRoleForm" ).on( "submit", function( event ) {
	//   event.preventDefault();
	// });
});
</script>

<script type="text/javascript">	
$(function () {
	$('#birthDate').datepicker({
		autoclose: true,
		orientation: 'bottom',
		format: 'dd MM yyyy',
		startView: 4
    });

    $('.js-example-basic-multiple').select2({
    	maximumSelectionLength: 5
    });
});
</script>

<script>
$(function () {
	$.each(['personInformation', 'invoiceAddress', 'deliveryAddress', 'variousInformation', 'log'], function(key, value) {
		$('#box-' + value + '-collapse-trigger').on('click', function() {
			$('#box-' + value).boxWidget('toggle');
		});
	});
});
</script>
@endsection