@extends('admin.layouts.master')

@section('title') New Order @endsection

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
	var dataprod = <?php echo $data['dataprod']; ?>;

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
	<form method="post" action="{{ route('ordersubscriptions.store') }}">
		{{ csrf_field() }}
		<div class="box box-default" id="box-personInformation">
			<div class="box-header with-border" id="box-personInformation-collapse-trigger" style="cursor: pointer;">
				<h3 class="box-title">Order Information</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">
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
			                    	<input type="text" name="iname" id="iname" value="" class="form-control" />
									<small class="text-red"></small>
			                  	</div>
			                </div>
							<div class="form-group">
								<label class="col-sm-3 control-label">E-mail</label>
								<div class="col-sm-9">
									<input type="email" name="iemail" id="iemail" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Address </label>
								<div class="col-sm-9">
									<input type="text" name="iaddress" id="iaddress" value="" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Place </label>
								<div class="col-sm-9">
									<input type="text" name="iplace" id="iplace" value="" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" >Posttal code </label>
								<div class="col-sm-9">
									<input type="text" name="ipostcode" id="ipostcode" size="10" value="" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Country </label>
								<div class="col-sm-9">
									<input type="text" name="icountry" id="icountry" value="" class="form-control" />
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
									<input type="text" name="dname" id="dname" value="" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">E-mail</label>
								<div class="col-sm-9">
									<input type="email" name="demail" id="demail" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Address </label>
								<div class="col-sm-9">
									<input type="text" name="daddress" id="daddress" value="" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Place </label>
								<div class="col-sm-9">
									<input type="text" name="dplace" id="dplace" value="" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Posttal code </label>
								<div class="col-sm-9">
									<input type="text" name="dpostcode" id="dpostcode" size="10" value="" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" >Country </label>
								<div class="col-sm-9">
									<input type="text" name="dcountry" id="dcountry" value="" class="form-control" />
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
											<option value="{{ $value->id }}"> {{ $value->first_name }} {{ $value->last_name }}</option>
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
					                  <input type="text" class="form-control pull-right tanggalan" id="OrderDate" placeholder="Order Date" readonly name="OrderDate" value="">
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
					                  <input type="text" class="form-control pull-right tanggalan" id="AvailableFrom" placeholder="Delivery Date" readonly name="DeliveryDate" value="">
				                	</div>
									
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">tax free </label>
								<div class="col-sm-9">
									<input type="checkbox" name="EnableTaxFree" id="EnableTaxFree" value="1" class="" style="position: relative;top: 7px;" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Internel reference </label>
								<div class="col-sm-9">
									<input type="text" name="Internelreference" id="Internelreference" size="10" value="" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Status  </label>
								<div class="col-sm-9">
									<select name="Status" class="form-control">
										<option value="">--Pilih--</option>
										<option value="Invoiced">Invoiced</option>
										<option value="rip">Lost orders</option>
										<option value="progress" selected="selected">On going</option>
										<option value="pickfinished">Pick finished</option>
										<option value="pickinprogress">Pick in progress</option>
										<option value="recieved">Received</option>
										<option value="sendt">Send</option>
									</select>
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Discount </label>
								<div class="col-sm-9">
									<input type="text" name="discounts" id="discount" size="10" value="" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Retail CompanyID  </label>
								<div class="col-sm-9">
									<input type="text" name="RetailCompanyID" id="RetailCompanyID" value="" class="form-control" />
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
											<option value="{{ $value->id }}"> {{ $value->first_name }} {{ $value->last_name }}</option>
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
					                  <input type="text" class="form-control pull-right tanggalan" id="required" placeholder="required" readonly name="required" value="">
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
					                  <input type="text" class="form-control pull-right tanggalan" id="sent" placeholder="sent" readonly name="sent" value="">
				                	</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Active </label>
								<div class="col-sm-9">
									<input type="checkbox" checked="checked" name="active" id="active" value="1" class="" style="position: relative;top: 7px;" />
									<small class="text-red"></small>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Client reference	 </label>
								<div class="col-sm-9">
									<input type="text" name="clientreference" id="clientreference" size="10" value="" class="form-control" />
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
									<input type="text" name="Frequency" id="Frequency" value="" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Retail Kick back Percent</label>
								<div class="col-sm-9">
									<input type="text" name="RetailKickbackPercent" id="RetailKickbackPercent" value="" class="form-control" />
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
									<textarea rows="10" class="form-control" name="CommentInternal"></textarea>
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
									<textarea rows="10" class="form-control" name="CommentCustomer"></textarea>
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
					<div class="col-md-offset-5 col-md-2 text-center">
						<a href="{{ route('ordersubscriptions.index') }}" class="btn btn-default">Cancel</a>
						&nbsp;
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
</section>
@endsection