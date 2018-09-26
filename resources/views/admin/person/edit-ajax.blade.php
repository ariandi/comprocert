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
					<input type="text" name="firstName" id="firstName" value="{{ $user['data']->first_name }}" class="form-control" />
					<small class="text-red">{{ $errors->first('firstName') }}</small>
				</div>
				<div class="form-group">
					<label for="birthDate">Date of birth</label>
					<div class="input-group date">
						<span class="input-group-addon">
	                        <i class="fa fa-calendar"></i>
	                    </span>
	                    <input type="text" name="birthDate" id="birthDate" value="{{ $user['data']->birth_date }}" class="form-control" readonly="" />
	                </div>
	                <small class="text-red">{{ $errors->first('birthDate') }}</small>
				</div>
				<div class="form-group">
					<label for="email">E-mail</label>
					<input type="email" name="email" id="email" value="{{ $user['data']->email }}" class="form-control" />
					<small class="text-red">{{ $errors->first('email') }}</small>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="form-control" />
					<small class="text-red">{{ $errors->first('password') }}</small>
				</div>
				<div class="form-group">
					<label for="confirmPassword">Confirm Password</label>
					<input type="password" name="password_confirmation" id="confirmPassword" class="form-control" />
					<small class="text-red">{{ $errors->first('password_confirmation') }}</small>
				</div>
				<div class="form-group">
					<label for="company">Company(s)</label>
					<select class="js-example-basic-multiple form-control" name="company[]" multiple="multiple">
					@foreach ($companies as $company)
						<option value="{{ $company->id }}" {{ ((in_array($company->id, $user['hasCompany'])) ? 'selected':'') }} >{{ $company->CompanyName }}</option>
					@endforeach
					</select>
					<small class="text-red">{{ $errors->first('company') }}</small>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="lastName">Last Name </label>
					<input type="text" name="lastName" id="lastName" value="{{ $user['data']->last_name }}" class="form-control" />
					<small class="text-red">{{ $errors->first('lastName') }}</small>
				</div>
				<div class="form-group">
					<label for="gender">Gender</label>
					{{ Form::select('gender', ['M' => 'Male', 'F' => 'Female'], $user['data']->gender, ['placeholder' => 'Select Gender', 'class' => 'form-control', 'id' => 'gender' ]) }}
					<small class="text-red">{{ $errors->first('gender') }}</small>
				</div>
				<div class="form-group">
					<label for="mobilePhoneNumber">Mobile Phone</label>
					<input type="text" name="mobilePhoneNumber" id="mobilePhoneNumber" value="{{ $user['data']->no_hp }}" class="form-control" />
					<small class="text-red">{{ $errors->first('mobilePhoneNumber') }}</small>
				</div>
				<div class="form-group">
					<label for="languageID">Language</label>
					{{ Form::select('languageID', $languages, $user['data']->lang_id, ['placeholder' => 'Select Language', 'class' => 'form-control', 'id' => 'language_id' ]) }}
					<small class="text-red">{{ $errors->first('languageID') }}</small>
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