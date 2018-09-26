<div class="alert alert-info successCompanyRelated" style="display: none;">
    <p>Success save the data.</p>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Company Relation</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
    
  <div class="box-body">
    <div class="row">

        <div class="col-xs-12">
          <div>
            <span style="font-size: 20px;font-weight: bold;">Create Company Relation</span>
          </div>
          <form>
            <div class="row">
              <div class="col-md-4">
                <input type="hidden" name="CompanyID" id="CompanyID" value="{{ $company->id }}">
                <select name="getCompanyID" class="form-control" id="getCompanyID">
                  <option value="">-------Select Related Company--------</option>
                  @foreach($companyAll as $ca)
                    <option value="{{ $ca->id }}">{{ $ca->CompanyName }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <button class="btn btn-success addComRelation" type="button">Create Relation</button>
              </div>
            </div>
          </form>
          <hr style="border: 1px solid #16a659;" />
        	<div class="box-body table-responsive no-padding companyRelatedReload">
              
              <table class="table table-hover companyRelatedReloadSuccess">
                <tbody><tr>
                  <th>ID</th>
                  <th>From Company Name</th>
                  <th>To Company Name</th>
                  <th>To Company ID</th>
                </tr>
                @foreach($companyRelationStruct as $key => $value)
	                <tr>
	                  <td>{{ $key+1 }}</td>
	                  <td>{{ $value::getCompanyName($value->FromCompanyID) }}</td>
	                  <td>{{ $value::getCompanyName($value->ToCompanyID) }}</td>
	                  <td>{{ $value->ToCompanyID }}</td>
	                </tr>
                @endforeach
              </tbody></table>
            </div>
      	</div>

    </div><!-- /.box-body -->
  </div>
</div>