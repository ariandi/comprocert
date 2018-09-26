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
						<a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('delete-statement').submit();" class="btn btn-danger">Delete</a>
						&nbsp;
						<input type="submit" value="Save" class="btn btn-primary" />
					</div>
				</div>
			</div>
		</div>

		</div> {{-- ///////////////Ajax Call///////////// --}}

		</form>

		<form id="delete-statement" action="{{ route('statements.destroy',$statement->id) }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="DELETE" />
    </form>


    <div class="box box-success">
	    <div class="box-header with-border">
	      <h3 class="box-title">Child Statement</h3>

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
	  								<div class="col-md-12">
	  									
	  									<div class="panel panel-default">

			                	<div class="panel-heading">Child Statement List</div>

				                <div class="panel-body" id="ajaxChild">
				                	<div  id="ajaxChildLoad">
				                    <table class="table table-hover table-bordered table-striped" style="width:100%">
				                        <thead>
				                            <tr>
				                                <th>No</th>
				                                <th>Title</th>
				                                <th>Action</th>
				                                <th>Priority</th>
				                            </tr>
				                        </thead>
				                        <tbody>
				                        	@foreach($statementchildstr as $key => $st)
				                        	<tr>
				                        		<td>{{ $key+1 }}</td>
				                        		<td>{{ $st->title }} ( {{ $st->child_id }} )</td>
				                        		<td><a href="{{ route('statements.link-unlink', ['id' => $st->id, 'parent' => $statement->id, 'link' => 0]) }}"
                            						class="unlink" id="{{ $st->id }}" data-method="PUT">Unlink</a></td>
				                        		<td><input type="text" id="{{ $st->id }}" class="form-control priorityChild" value="{{ $st->priority }}"/></td>
				                        	</tr>
				                        	@endforeach
				                        </tbody>
				                    </table>
				                    <div class="pull-right">
				                    	<button type="button" class="btn btn-success savePriority">Save Priority</button>
				                    </div>

				                    <div style="clear: both"></div>
				                  </div>
				            		</div>

					            </div>

	  								</div>
	                </div>
	            </div>

		      	</div>

		    </div><!-- /.box-body -->
		  </div>
		</div>



		<div class="box box-success">
	    <div class="box-header with-border">
	      <h3 class="box-title">All Statement</h3>

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
	  								<div class="col-md-12">
	  									
	  									<div class="panel panel-default">

			                	<div class="panel-heading">Statement List</div>

				                <div class="panel-body">
				                    <table class="table table-hover table-bordered table-striped datatable" style="width:100%">
				                        <thead>
				                            <tr>
				                                <th>Id</th>
				                                <th>Title</th>
				                                <th>Action</th>
				                            </tr>
				                        </thead>
				                        
				                    </table>
				            		</div>

					            </div>

	  								</div>
	                </div>
	            </div>

		      	</div>

		    </div><!-- /.box-body -->
		  </div>
		</div>