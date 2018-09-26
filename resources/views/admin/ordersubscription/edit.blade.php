@extends('admin.layouts.master')

@section('title') Order Edit @endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" />
@endsection

@section('addingScriptJs')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ URL::asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script type="text/javascript">

	var company = <?php echo $data['company']; ?>;
	var person = <?php echo $data['person']; ?>;
	var dataprod = <?php echo $data['dataproduk']; ?>;

</script>

<script type="text/javascript" src="{{ URL::asset('assets/js/ordersubscription.js') }}"></script>

@endsection
@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ route('ordersubscriptions.index') }}">@yield('title')</a></li>
</ol>
@endsection

@section('content')
<section class="content">
	{{ Form::model($orderid, array('route' => array('ordersubscriptions.update', $orderid), 'method' => 'PUT', 'files' => true)) }}
		{{ csrf_field() }}
		<div class="box box-default" id="box-personInformation">
			<div class="box-header with-border" id="box-personInformation-collapse-trigger" style="cursor: pointer;">
				<h3 class="box-title">Order Information</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">
				@if (\Session::has('success'))
		          	<div class="alert alert-success">
		            	<p>{{ \Session::get('success') }}</p>
		          	</div>
		        @endif
				<div class="form-horizontal">
					<div class="row">
						<div class="col-md-6">

							<ul class="nav nav-tabs">
							    <li class="active"><a data-toggle="tab" href="#home">Select Company</a></li>
							    <li><a data-toggle="tab" href="#menu1">Select Person</a></li>
							</ul>

							<div class="tab-content">
								<br>
								<div id="home" class="tab-pane fade in active">
									<div class="form-group">
										<label class="col-sm-3 control-label">Select Company</label>

					                  	<div class="col-sm-9">

					                  		<input type="hidden" name="CompanyID" id="companyid" value="" class="form-control" />
					                    	<input type="text" name="Company" id="namecompany" nomor="company" value="" class="form-control caridata" placeholder="Please write here" />
											<small class="text-red"></small>
					                  	</div>
									</div>
								</div>
								<div id="menu1" class="tab-pane fade">
									<div class="form-group">
										<label class="col-sm-3 control-label">Select Person</label>

					                  	<div class="col-sm-9">
					                  		<input type="hidden" name="PersonID" id="personid" value="" class="form-control" />
					                    	<input type="text" name="person" id="nameperson" nomor="person" value="" class="form-control caridata" />
											<small class="text-red"></small>
					                  	</div>
									</div>
								</div>

							</div>
							
						</div>
					</div>
	              	<div class="row">
	              		<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-3 control-label">Invoice Address </label>
							</div>
							<div class="form-group">
			                  	<label class="col-sm-3 control-label">Name</label>

			                  	<div class="col-sm-9">
			                    	<input type="text" name="iname" id="iname" value="{{ $data['order']['IName'] }}" class="form-control" />
									<small class="text-red"></small>
			                  	</div>
			                </div>
							<div class="form-group">
								<label class="col-sm-3 control-label">E-mail</label>
								<div class="col-sm-9">
									<input type="email" value="{{ $data['order']['IEmail'] }}" name="iemail" id="iemail" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Address </label>
								<div class="col-sm-9">
									<input type="text" name="iaddress" id="iaddress" value="{{ $data['order']['IAddress'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Place </label>
								<div class="col-sm-9">
									<input type="text" name="iplace" id="iplace" value="{{ $data['order']['ICity'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" >Posttal code </label>
								<div class="col-sm-9">
									<input type="text" name="ipostcode" id="ipostcode" size="10" value="{{ $data['order']['IZipCode'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Country </label>
								<div class="col-sm-9">
									<input type="text" name="icountry" id="icountry" value="{{ $data['order']['ICountry'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-3 control-label">Delivery Address </label>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Name </label>
								<div class="col-sm-9">
									<input type="text" name="dname" id="dname" value="{{ $data['order']['DName'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">E-mail</label>
								<div class="col-sm-9">
									<input type="email" value="{{ $data['order']['DEmail'] }}" name="demail" id="demail" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Address </label>
								<div class="col-sm-9">
									<input type="text" name="daddress" id="daddress" value="{{ $data['order']['DAddress'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Place </label>
								<div class="col-sm-9">
									<input type="text" name="dplace" id="dplace" value="{{ $data['order']['DCity'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Posttal code </label>
								<div class="col-sm-9">
									<input type="text" name="dpostcode" id="dpostcode" size="10" value="{{ $data['order']['DZipCode'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" >Country </label>
								<div class="col-sm-9">
									<input type="text" name="dcountry" id="dcountry" value="{{ $data['order']['DCountry'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box box-default" id="box-invoiceAddress"> <!-- .collapsed-box is name class for collapse box by default -->
			<div class="box-header with-border" id="box-invoiceAddress-collapse-trigger" style="cursor: pointer;">
				<h3 class="box-title">Order Header</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">
				<div class="form-horizontal">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-3 control-label">Sales person </label>
								<div class="col-sm-9">
									<select name="SalesPerson" class="form-control">
										<option value="">--Pilih--</option>
										@foreach($data['getEmployee'] as $key=>$value)
											<option value="{{ $value->id }}" {{ $data['order']['SalePersonID'] == $value->id ? 'selected':'' }}> {{ $value->first_name }} {{ $value->last_name }}</option>
										@endforeach
									</select>
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Order date</label>
								<div class="col-sm-9">
									<div class="input-group date">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input type="text" class="form-control pull-right tanggalan" id="OrderDate" placeholder="Order Date" readonly name="OrderDate" value="{{ $data['order']['OrderDate'] }}">
				                	</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Delivery date </label>
								<div class="col-sm-9">

									<div class="input-group date">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input type="text" class="form-control pull-right tanggalan" id="Delivery" placeholder="Delivery Date" readonly name="DeliveryDate" value="{{ $data['order']['DeliveryDate'] }}">
				                	</div>
									
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">tax free </label>
								<div class="col-sm-9">
									<input type="checkbox" name="EnableTaxFree" {{ $data['order']['EnableTaxFree'] != "" ? 'checked':'' }} id="EnableTaxFree" value="1" class="" style="position: relative;top: 7px;" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Internel reference </label>
								<div class="col-sm-9">
									<input type="text" name="Internelreference" id="Internelreference" size="10" value="{{ $data['order']['RefInternal'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Status  </label>
								<div class="col-sm-9">
									<select name="Status" class="form-control">
										<option value="">--Pilih--</option>
										<option value="Invoiced" {{ $data['order']['Status'] == "Invoiced" ? 'selected':'' }}>Invoiced</option>
										<option value="rip" {{ $data['order']['Status'] == "rip" ? 'selected':'' }}>Lost orders</option>
										<option value="progress" {{ $data['order']['Status'] == "progress" ? 'selected':'' }}>On going</option>
										<option value="pickfinished" {{ $data['order']['Status'] == "pickfinished" ? 'selected':'' }}>Pick finished</option>
										<option value="pickinprogress" {{ $data['order']['Status'] == "pickinprogress" ? 'selected':'' }}>Pick in progress</option>
										<option value="recieved" {{ $data['order']['Status'] == "recieved" ? 'selected':'' }}>Received</option>
										<option value="sendt" {{ $data['order']['Status'] == "sendt" ? 'selected':'' }}>Send</option>
									</select>
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Discount </label>
								<div class="col-sm-9">
									<input type="text" name="discounts" id="discounts" size="10" value="{{ $data['order']['Discount'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Retail CompanyID  </label>
								<div class="col-sm-9">
									<input type="text" name="RetailCompanyID" id="RetailCompanyID" value="{{ $data['order']['RetailCompanyID'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-3 control-label">Responsible  </label>
								<div class="col-sm-9">
									<select name="responsible" class="form-control">
										<option value="">--Pilih--</option>
										@foreach($data['getEmployee'] as $key=>$value)
											<option value="{{ $value->id }}" {{ $data['order']['ResponsiblePersonID'] == $value->id ? 'selected':'' }}> {{ $value->first_name }} {{ $value->last_name }}</option>
										@endforeach
									</select>
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Required delivery</label>
								<div class="col-sm-9">
									<div class="input-group date">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input type="text" class="form-control pull-right tanggalan" id="required" placeholder="required" readonly name="required" value="{{ $data['order']['RequiredDate'] }}">
				                	</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Sent </label>
								<div class="col-sm-9">
									<div class="input-group date">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input type="text" class="form-control pull-right tanggalan" id="sent" placeholder="sent" readonly name="sent" value="{{ $data['order']['DateShipped'] }}">
				                	</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Active </label>
								<div class="col-sm-9">
									<input type="checkbox" {{ $data['order']['Active'] == 1 ? "checked":""}} name="active" id="active" value="1" class="" style="position: relative;top: 7px;" />
									<small class="text-red"></small>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Client reference	 </label>
								<div class="col-sm-9">
									<input type="text" name="clientreference" id="clientreference" size="10" value="{{ $data['order']['RefCustomer'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Total client price  </label>
								<div class="col-sm-9">
									<input type="text" name="icountry" id="icountry" value="" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Frequency  </label>
								<div class="col-sm-9">
									<input type="text" name="Frequency" id="Frequency" value="{{ $data['order']['Frequency'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label">Retail Kick back Percent</label>
								<div class="col-sm-9">
									<input type="text" name="RetailKickbackPercent" id="RetailKickbackPercent" value="{{ $data['order']['RetailKickbackPercent'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box box-default" id="box-deliveryAddress">
			<div class="box-header with-border" id="box-deliveryAddress-collapse-trigger" style="cursor: pointer;">
				<h3 class="box-title">Comment</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">
				<div class="form-horizontal">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-3 control-label">
									Project name internal Internal comments
								</label>
								<div class="col-sm-9">
									<textarea rows="10" class="form-control" name="CommentInternal">{{ $data['order']['CommentInternal'] }}</textarea>
									<small class="text-red"></small>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-3 control-label">
									Project name client	Client comments
								</label>
								<div class="col-sm-9">
									<textarea rows="10" class="form-control" name="CommentCustomer">{{ $data['order']['CommentCustomer'] }}</textarea>
									<small class="text-red"></small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box box-default" id="box-variousInformation">
			<div class="box-header with-border" id="box-variousInformation-collapse-trigger" style="cursor: pointer;">
				<h3 class="box-title">OrderLine</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<button type="button" class="btn btn-success pull-right add-newline" target=".tableline" >
				         	<i class="fa fa-plus"></i> Add new line
				       	</button>
				       	<br><br>
				       	<div class="table-responsive">
						<table class="table myanalysis table-bordered tableline table-striped w-auto" style="background:white; margin-top: 5px;">
			                <thead>
			                   	<tr>
			                    	<th width="10%">Extention</th>
									<th>ProductName</th>
									<th>Ordered</th>
									<th>Delivery</th>
									<th>CostPrice</th>
									<th>CustPrice</th>
									<th>Discount</th>
									<th>VAT</th>
									<th>SUM</th>
									<th><em class="fa fa-cog"></em></th>
			                    </tr>
			                </thead>
			                <tbody>
			               		@foreach($data['orderline'] as $keyline => $values )
			               		<tr>
									<td> 
										
	          							<input type="hidden" id="productid{{ $values->LineNum }}" value="" nomor="{{ $values->LineNum }}" class="form-control" value="{{ $values->ProductID }}" name="productid[]">
	          							<input type="hidden" value="{{ $values->LineNum }}" class="form-control caridata" name="linenum[]" nomor="{{ $values->LineNum }}" id="linenum{{ $values->LineNum }}">
	          							<input type="hidden" value="{{ $values->id }}" class="form-control caridata" name="id[]" nomor="{{ $values->LineNum }}" id="id{{ $values->LineNum }}">

	          							{{ $values->LineNum }}
									</td>
									<td>
										<input type="text" value="{{ $values->ProductName }}" class="form-control caridata" name="productname[]" nomor="{{ $values->LineNum }}" id="name{{ $values->LineNum }}">  
									</td>
									<td>
										<input type="text" value="{{ $values->QuantityOrdered }}" class="form-control caridata" size="2" nomor="{{ $values->LineNum }}" name="ordered[]" id="ordered{{ $values->LineNum }}">
									</td>
									<td>
										<input type="text" value="{{ $values->QuantityDelivered }}" class="form-control caridata" size="2" nomor="{{ $values->LineNum }}" name="delivered[]" id="delivered{{ $values->LineNum }}">
									</td>
									<td>
										<input type="text" value="{{ $values->UnitCostPrice }}" class="form-control caridata" size="2" name="costprice[]" nomor="{{ $values->LineNum }}" id="costprice{{ $values->LineNum }}">
									</td>
									<td>
										<input type="text" value="{{ $values->UnitCustPrice }}" class="form-control caridata" size="2" name="custprice[]" nomor="{{ $values->LineNum }}" id="custprice{{ $values->LineNum }}">
									</td>
									<td>
										<input type="text" value="{{ $values->Discount }}" class="form-control caridata" size="2" name="discount[]" nomor="{{ $values->LineNum }}" id="discount{{ $values->LineNum }}">
									</td>
									<td>
										<input type="hidden" value="{{ $values->Vat }}" class="form-control caridata" size="2" name="vat[]" nomor="{{ $values->LineNum }}" id="vat{{ $values->LineNum }}"><span id="vattext{{ $values->LineNum }}">0%</span>
									</td>
									<td>
										<input type="hidden" value="" class="form-control caridata" size="2" name="sum[]" nomor="{{ $values->LineNum }}" id="sum{{ $values->LineNum }}"><span id="sumtext{{ $values->LineNum }}">0</span>
									</td>
									<td>   
										<a href="{{ route ('ordersubscriptions.delete',['id'=>$values->id,'table'=>'ordersubscriptionlines']) }}" class="deletetr btn btn-default" data-toggle="tooltip" id="deletenew" targets=".tableline">
	          	  							<i class="fa fa-trash"></i>
	          	  						</a>
									</td>
								</tr>
								<tr class="dtln{{ $values->LineNum }}">	
									<td>Available from</td>	
									<td colspan="3">		
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control pull-right tanggall" id="availablefrom" placeholder="Available From" readonly="" name="availablefrom[]" value="{{ $values->ValidFromDate }}">
										</div>	
									</td>	
									<td>Available to</td>	
									<td colspan="3">		
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control pull-right tanggall" id="availableto" placeholder="Available To" readonly="" name="availableto[]" value="{{ $values->	ValidToDate }}">
										</div>	
									</td>	
									<td></td>
								</tr>
								<tr class="dtln{{ $values->LineNum }}">	
									<td>Comment</td>	
									<td colspan="7">		
										<input type="text" name="commentline[]" id="commentline{{ $values->LineNum }}" nomor="{{ $values->LineNum }}" value="{{ $values->Comments }}" class="form-control">	
									</td>	
									<td></td>
								</tr>
			               		@endforeach			                       
			                </tbody>
						</table>
						</div>
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
					<div class="col-md-offset-5 col-md-4 text-center">
						<a href="{{ route('ordersubscriptions.index') }}" class="btn btn-default">Cancel</a>
						&nbsp;
						<button type="submit" class="btn btn-primary">Save</button>
						&nbsp;
						<a href="{{ route('ordersubscriptions.invoiced',['id'=>$orderid]) }}" class="btn btn-warning pull-right">Generate To Invoice</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
</section>
@endsection