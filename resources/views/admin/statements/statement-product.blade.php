    <div class="box box-success">
	    <div class="box-header with-border">
	      <h3 class="box-title">Product Statement</h3>

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

			                	<div class="panel-heading">Product Statement List</div>
			                	
			                	<hr />
			                	
			                	<div class="form-group">
				                  <label for="tablename" class="col-sm-3 control-label">Table Name</label>
				                  <div class="col-sm-6">
				                  	<select class="form-control" id="tablenameProd">
					                  	<option value="">---Select Table Name---</option>
					                  	<option value="product" {{ $stateDet->tablename == 'product' ? 'selected':'' }}>Products</option>
					                  	<option value="publishcontent" {{ $stateDet->tablename == 'publishcontent' ? 'selected':'' }}>Publish Content</option>
					                  </select>
				                  </div>
				                </div>

				                <hr />

				                <div class="panel-body" id="ajaxChild">
				                	<div  id="ajaxChildLoad">
				                    <table class="table table-hover table-bordered table-striped" style="width:100%">
				                        <thead>
				                            <tr>
				                            		<th>Statement ID</th>
				                            		<th>Statement Name</th>
				                                <th>Product ID</th>
				                                <th>Product Name</th>
				                                <th>Action</th>
				                            </tr>
				                        </thead>
				                        <tbody>
				                        	@foreach($statement as $key => $st)
				                        	<tr>
				                        		<td>{{ $st->id }}</td>
				                        		<td>{{ $st->title }}</td>
				                        		<td>{{ $st->product_id }}</td>
				                        		<td>{{ $st->ProductName }}</td>
				                        		<td><a href="{{ route('statements.product-link', ['id' => $st->product_id, 'sid' => $stateDet->id, 'link' => 0]) }}"
                            						class="unlink-prod" data-method="PUT">Unlink</a></td>
				                        	</tr>
				                        	@endforeach
				                        </tbody>
				                    </table>
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
	      <h3 class="box-title">All Survey</h3>

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

			                	<div class="panel-heading">Survey List</div>

				                <div class="panel-body">
				                    <table class="table table-hover table-bordered table-striped datatable2" style="width:100%">
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