<div id="personRole">
<div class="box box-default" id="box-personRole">
	<div class="box-header with-border" id="box-personInformation-collapse-trigger" style="cursor: pointer;">
		<h3 class="box-title">Person Role</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-12">
			<table class="table table-striped table-bordered">
	      <tbody>
	      <tr>
	        <th>Role ID</th>
	        <th>Role Name</th>
	        <th>Description</th>
	        <th>Action</th>
	      </tr>
	      @foreach($rolePerson as $rP)
		      <tr>
		        <td>{{ $rP->RoleID }}</td>
		        <td>{{ $rP->RoleName }}</td>
		        <td>{!! $rP->Descriptionm !!}</td>
		        <td><a href="#" class="remove-person-role" id="{{ $rP->id }}">Remove</a></td>
		      </tr>
	      @endforeach
	    	</tbody>
	   	</table>
	   	</div>
		</div>
	</div>
</div>
</div>

<div class="box box-default" id="box-roleList">
	<div class="box-header with-border" id="box-personInformation-collapse-trigger" style="cursor: pointer;">
		<h3 class="box-title">Person Role</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<div class="box-body">
		<table class="table table-hover table-bordered table-striped datatable" style="width:100%">
        <thead>
            <tr>
                <th>Role Id</th>
                <th>RoleName</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
	</div>
</div>
{{-- <div class="panel">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-offset-5 col-md-2 text-center">
				<a href="{{ route('person') }}" class="btn btn-default">Cancel</a>
				&nbsp;
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
		</div>
	</div>
</div> --}}