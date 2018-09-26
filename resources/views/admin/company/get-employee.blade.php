<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Employee List</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
    
  <div class="box-body">
    <div class="row">

        <div class="col-xs-12">
        	<div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>First name</th>
                  <th>Last name</th>
                  <th>Email</th>
                </tr>
                @foreach($companyPersonStruct as $key => $value)
	                <tr>
	                  <td>{{ $value->id }}</td>
	                  <td>{{ $value->first_name }}</td>
	                  <td>{{ $value->last_name }}</td>
	                  <td>{{ $value->email }}</td>
	                </tr>
                @endforeach
              </tbody></table>
            </div>
      	</div>

    </div><!-- /.box-body -->
  </div>
</div>