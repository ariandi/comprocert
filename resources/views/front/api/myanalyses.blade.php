
<style type="text/css">
    body {
        color: #404E67;
        font-family: 'Open Sans', sans-serif;
	}
	.table-wrapper {
		/*width: 700px;*/
		margin: 30px auto;
        /* background: #fff; */
        /*padding: 20px;*/	
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .table-title {
        padding-bottom: 10px;
        margin: 0 0 10px;
    }
    .table-title h2 {
        margin: 6px 0 0;
        font-size: 22px;
    }
    .table-title .add-new {
        float: right;
		height: 30px;
		font-weight: bold;
		font-size: 12px;
		text-shadow: none;
		min-width: 100px;
		border-radius: 50px;
		line-height: 13px;
    }
	.table-title .add-new i {
		margin-right: 4px;
	}
    table.table {
        /* table-layout: fixed; */
    }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table th:last-child {
        width: 100px;
    }
    table.table td a {
		cursor: pointer;
        display: inline-block;
        margin: 0 5px;
		min-width: 24px;
    }    
	table.table td a.addtr {
        color: #27C46B;
    }
    table.table td a.edittr {
        color: #FFC107;
    }
    table.table td a.deletetr {
        color: #E34724;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table td a.addtr i {
        font-size: 24px;
    	margin-right: -1px;
        position: relative;
        top: 3px;
    }    
    table.table .form-control {
        height: 32px;
        line-height: 32px;
        box-shadow: none;
        border-radius: 2px;
    }
	table.table .form-control.error {
		border-color: #f50000;
	}
	table.table td .addtr {
		display: none;
	}
</style>
	<div class="">
		<div class="col-md-12">
			<section class="content">
   				<div class="row">
   					<div class="col-md-12">
   						<div class="alert alert-success notif" style="display: none;">
					    	<strong>Success!</strong>
					    	<span class="textnotif"></span>
					  	</div>
   						<div class="box">
							   
						   
   							<div class="box-body">
							   <div class="table-responsive">
   								<div class="table-wrapper">
						            <div class="table-title">
						                <div class="row">
						                    <div class="col-sm-8"><h2>{{ Menus::getLanguageString('idMyOwnAnalyses') }}</h2></div>
						                    <div class="col-sm-4">
						                        <button type="button" active="3" class="btn btn-info add-new" title="myanalysis" target=".myanalysis">
						                        	<i class="fa fa-plus"></i> {{ Menus::getLanguageString('idCreatemyX') }} 
						                        </button>
						                    </div>
						                </div>
									</div>
									
						            <table class="table myanalysis table-bordered" style="background:white;">
						                <thead>
						                   	<tr>
						                    	<th style="min-width:150px">{{ Menus::getLanguageString('idName') }}</th>
	   											<th style="min-width:150px">{{ Menus::getLanguageString('idCreatedDate') }}</th>
	   											<th style="min-width:150px">{{ Menus::getLanguageString('idModifiedTime') }}</th>
	   											<th style="min-width:150px">{{ Menus::getLanguageString('idTotalStatements') }}</th>
	   											<th style="min-width:100px"><em class="fa fa-cog"></em></th>
						                    </tr>
						                </thead>
						                <tbody>
						                	@foreach ($datamyanalist as $key=>$value)
   											<tr>
   												<td>
   													<a href="{{ route('analyses.detail', ['id' => $value->child_id,'tipe' => 'myanalyse']) }}">
   														{{ $value->title }}
   													</a>
   												</td>
   												<td>{{ $value->created_at }}</td>
   												<td>{{ $value->updated_at }}</td>
   												<td>{{ $value->totalstatement }}</td>
   												 <td>
													<a class="addtr" active="{{ $value->active }}" node="{{ $value->child_id }}" data-toggle="tooltip"><i class="fa fa-plus-square-o"></i></a>
						                            <a class="edittr" active="{{ $value->active }}" node="{{ $value->child_id }}" data-toggle="tooltip" targets=".myanalysis"><i class="fa fa-pencil"></i></a>
						                            <a class="deletetr" active="0" node="{{ $value->child_id }}" data-toggle="tooltip" targets=".myanalysis"><i class="fa fa-trash"></i></a>
						                        </td>
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
   			</section>
		</div>
	</div>

	<div class="">
		<div class="col-md-12">
			<section class="content">
   				<div class="row">
   					<div class="col-md-12">
   						<div class="box">
   							
   							<div class="box-body">
							  <div class="table-responsive">
   								<div class="table-wrapper">
						            <div class="table-title">
						                <div class="row">
						                    <div class="col-sm-8"><h2>{{ Menus::getLanguageString('idMyProjectA') }}</h2></div>
						                    <div class="col-sm-4">
						                        <button type="button" active="4" class="btn btn-info add-new" title="myprojectanalysis" target=".myprojectanalises"><i class="fa fa-plus"></i> {{ Menus::getLanguageString('idYourProjectA') }} </button>
						                    </div>
						                </div>
									</div>
									
						            <table class="table myprojectanalises table-bordered" style="background:white;">
						                <thead>
						                   	<tr>
						                    	<th style="min-width:150px">{{ Menus::getLanguageString('idName') }}</th>
	   											<th style="min-width:150px">{{ Menus::getLanguageString('idCreatedDate') }}</th>
	   											<th style="min-width:150px">{{ Menus::getLanguageString('idModifiedTime') }}</th>
	   											<th style="min-width:150px">{{ Menus::getLanguageString('idTotalStatements') }}</th>
	   											<th style="min-width:100px"><em class="fa fa-cog"></em></th>
						                    </tr>
						                </thead>
						                <tbody>
						                   	@foreach ($datamyprojectanalist as $keys=>$values)
	   											<tr>
	   												<td>
	   													<a href="{{ route('analyses.detail', ['id' => $values->child_id,'tipe' => 'myprojectanalyse']) }}">
	   														{{ $values->title }}
	   													</a>
	   												</td>
	   												<td>{{ $values->created_at }}</td>
	   												<td>{{ $values->updated_at }}</td>
	   												<td>{{ $values->totalstatement }}</td>
	   												<td>
														<a class="addtr" active="{{ $values->active }}" node="{{ $values->child_id }}" data-toggle="tooltip"><i class="fa fa-plus-square-o"></i></a>
							                            <a class="edittr" active="{{ $values->active }}" node="{{ $values->child_id }}" data-toggle="tooltip" targets=".myprojectanalises"><i class="fa fa-pencil"></i></a>
							                            <a class="deletetr" active="0" node="{{ $values->child_id }}"  data-toggle="tooltip" targets=".myprojectanalises"><i class="fa fa-trash"></i></a>
						                        	</td>
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
   			</section>
		</div>
	</div>