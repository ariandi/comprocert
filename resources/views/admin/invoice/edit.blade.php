@extends('admin.layouts.master')

@section('title') Edit Invoice @endsection
@section('addingFileJs')
	
@endsection


@section('addingStyle')

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
<script type="text/javascript" src="{{ URL::asset('assets/js/invoice.js') }}"></script>

@endsection
@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ route('invoice.index') }}">@yield('title')</a></li>
</ol>
@endsection

@section('content')
<section class="content">
	{{ Form::model($invoiceid, array('route' => array('invoice.update', $invoiceid), 'method' => 'PUT', 'files' => true)) }}
		{{ csrf_field() }}
		<div class="box box-default" id="box-personInformation">
			<div class="box-header with-border" id="box-personInformation-collapse-trigger" style="cursor: pointer;">
				<h3 class="box-title">Invoice Information</h3>
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
			                    	<input type="text" name="iname" id="iname" value="{{ $data['invoice']->IName }}" class="form-control" />
									<small class="text-red"></small>
			                  	</div>
			                </div>
							<div class="form-group">
								<label class="col-sm-3 control-label">E-mail</label>
								<div class="col-sm-9">
									<input type="email" value="{{ $data['invoice']->IEmail }}" name="iemail" id="iemail" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Address </label>
								<div class="col-sm-9">
									<input type="text" value="{{ $data['invoice']->IAddress }}" name="iaddress" id="iaddress" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Place </label>
								<div class="col-sm-9">
									<input type="text" name="iplace" id="iplace" value="{{ $data['invoice']->ICity }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" >Posttal code </label>
								<div class="col-sm-9">
									<input type="text" name="ipostcode" id="ipostcode" size="10" value="{{ $data['invoice']->IZipCode }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Country </label>
								<div class="col-sm-9">
									<input type="text" name="icountry" id="icountry" value="{{ $data['invoice']->ICountry }}" class="form-control" />
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
									<input type="text" name="dname" id="dname" value="{{ $data['invoice']->DName }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">E-mail</label>
								<div class="col-sm-9">
									<input type="email" value="{{ $data['invoice']->DEmail }}" name="demail" id="demail" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Address </label>
								<div class="col-sm-9">
									<input type="text" name="daddress" id="daddress" value="{{ $data['invoice']->DAddress }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Place </label>
								<div class="col-sm-9">
									<input type="text" name="dplace" id="dplace" value="{{ $data['invoice']->DCity }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Posttal code </label>
								<div class="col-sm-9">
									<input type="text" name="dpostcode" id="dpostcode" size="10" value="{{ $data['invoice']->DZipCode }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" >Country </label>
								<div class="col-sm-9">
									<input type="text" name="dcountry" id="dcountry" value="{{ $data['invoice']->DCountry }}" class="form-control" />
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
				<h3 class="box-title">Invoice Header</h3>
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
											<option value="{{ $value->id }}" {{ $data['invoice']['SalePersonID'] == $value->id ? 'selected':'' }}> {{ $value->first_name }} {{ $value->last_name }}</option>
										@endforeach
									</select>
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Invoice Date</label>
								<div class="col-sm-9">
									<div class="input-group date">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input type="text" class="form-control pull-right tanggalan" id="InvoiceDate" placeholder="Invoice Date" readonly name="InvoiceDate" value="{{ $data['invoice']->InvoiceDate }}">
				                	</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Due date </label>
								<div class="col-sm-9">

									<div class="input-group date">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input type="text" class="form-control pull-right tanggalan" id="Duedate" placeholder="Due Date" readonly name="DueDate" value="{{ $data['invoice']->DueDate }}">
				                	</div>
									
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Sendt Date </label>
								<div class="col-sm-9">
									<div class="input-group date">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input type="text" class="form-control pull-right tanggalan" id="DateShipped" placeholder="DateShipped" readonly name="DateShipped" value="{{ $data['invoice']->DateShipped }}">
				                	</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Status  </label>
								<div class="col-sm-9">
									<select name="Status" class="form-control">
										<option value="">--Pilih--</option>
										<option value="credit" {{ $data['invoice']['Status'] == "credit" ? 'selected':'' }}>Credit</option>
										<option value="sendt" {{ $data['invoice']['Status'] == "sendt" ? 'selected':'' }}>Dispatch</option>
										<option value="rip" {{ $data['invoice']['Status'] == "rip" ? 'selected':'' }}>Lost revenue</option>
										<option value="akonto" {{ $data['invoice']['Status'] == "akonto" ? 'selected':'' }}>On account</option>
										<option value="progress" {{ $data['invoice']['Status'] == "progress" ? 'selected':'' }}>On going</option>
										<option value="payed" {{ $data['invoice']['Status'] == "payed" ? 'selected':'' }}>Paid</option>
									</select>
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Internel reference </label>
								<div class="col-sm-9">
									<input type="text" name="Internelreference" id="Internelreference" size="10" value="{{ $data['invoice']->RefInternal }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label">Terms of delivery </label>
								<div class="col-sm-9">
									<input type="text" name="DeliveryCondition" id="DeliveryCondition" size="10" value="{{ $data['invoice']->DeliveryCondition }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"> *	  </label>
								<div class="col-sm-9">
									<select name="CurrencyID" class="form-control">
										<option value="">--Pilih--</option>
										<option value="DK" {{ $data['invoice']['CurrencyID'] == "DK" ? 'selected':'' }}>DK Danske</option>
										<option value="USD" {{ $data['invoice']['CurrencyID'] == "USD" ? 'selected':'' }}>USD Dollar</option>
										<option value="EUR" {{ $data['invoice']['CurrencyID'] == "EUR" ? 'selected':'' }}>EUR Euro</option>
										<option value="NOK" {{ $data['invoice']['CurrencyID'] == "NOK" ? 'selected':'' }}>NOK Kroner</option>
										<option value="GBP" {{ $data['invoice']['CurrencyID'] == "GBP" ? 'selected':'' }}>GBP Pund</option>
										<option value="IDR" {{ $data['invoice']['CurrencyID'] == "IDR" ? 'selected':'' }}>IDR Rupia</option>
										<option value="SEK" {{ $data['invoice']['CurrencyID'] == "SEK" ? 'selected':'' }}>SEK Svenske</option>
										
									</select>
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Retail CompanyID  </label>
								<div class="col-sm-9">
									<input type="text" name="RetailCompanyID" id="RetailCompanyID" value="{{ $data['invoice']->RetailCompanyID }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-3 control-label">Period  </label>
								<div class="col-sm-9">
									<p>{{ date('Y-m') }}</p>
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Responsible  </label>
								<div class="col-sm-9">
									<select name="responsible" class="form-control">
										<option value="">--Pilih--</option>
										@foreach($data['getEmployee'] as $key=>$value)
											<option value="{{ $value->id }}" {{ $data['invoice']['ResponsiblePersonID'] == $value->id ? 'selected':'' }}> {{ $value->first_name }} {{ $value->last_name }}</option>
										@endforeach
									</select>
									<small class="text-red"></small>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Date of payment</label>
								<div class="col-sm-9">
									<div class="input-group date">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input type="text" class="form-control pull-right tanggalan" id="PaymentDate" placeholder="PaymentDate" readonly name="PaymentDate" value="{{ $data['invoice']->PaymentDate }}">
				                	</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label">Delivery date</label>
								<div class="col-sm-9">
									<div class="input-group date">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input type="text" class="form-control pull-right tanggalan" id="DeliveryDate" placeholder="DeliveryDate" readonly name="DeliveryDate" value="{{ $data['invoice']->DeliveryDate }}">
				                	</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Active </label>
								<div class="col-sm-9">
									<input type="checkbox" {{ $data['invoice']['Active'] == 1 ? "checked":""}} name="active" id="active" value="1" class="" style="position: relative;top: 7px;" />
									<small class="text-red"></small>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Client reference	 </label>
								<div class="col-sm-9">
									<input type="text" name="clientreference" id="clientreference" size="10" value="{{ $data['invoice']['RefCustomer'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Terms of payment  </label>
								<div class="col-sm-9">
									<input type="text" name="PaymentCondition" id="PaymentCondition" value="{{ $data['invoice']['PaymentCondition'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Dpack </label>
								<div class="col-sm-9">
									<input type="text" name="Dpack" id="Dpack" size="10" value="{{ $data['invoice']['Dpack'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Retail Kick back Percent</label>
								<div class="col-sm-9">
									<input type="text" name="RetailKickbackPercent" id="RetailKickbackPercent" value="{{ $data['invoice']['RetailKickbackPercent'] }}" class="form-control" />
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
								<label class="col-sm-3 control-label">Internal project name	 </label>
								<div class="col-sm-9">
									<input type="text" name="ProjectNameInternal" id="ProjectNameInternal" value="{{ $data['invoice']['ProjectNameInternal'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">
									Internal comments
								</label>
								<div class="col-sm-9">
									<textarea rows="10" class="form-control" name="CommentInternal">{{ $data['invoice']['CommentInternal'] }}</textarea>
									<small class="text-red"></small>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-3 control-label">Project name	 </label>
								<div class="col-sm-9">
									<input type="text" name="ProjectNameCustomer" id="ProjectNameCustomer" value="{{ $data['invoice']['ProjectNameCustomer'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">
									Client comments
								</label>
								<div class="col-sm-9">
									<textarea rows="10" class="form-control" name="CommentCustomer">{{ $data['invoice']['CommentCustomer'] }}</textarea>
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
				<h3 class="box-title">Invoice Line</h3>
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
			               		@foreach($data['invoiceline'] as $keyline => $values )
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
										<a href="{{ route ('invoice.delete',['id'=>$values->id,'table'=>'Invoiceoutlines']) }}" class="deletetr btn btn-default" data-toggle="tooltip" id="deletenew" targets=".tableline">
	          	  							<i class="fa fa-trash"></i>
	          	  						</a>
									</td>
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
					<div class="col-md-offset-5 col-md-2 text-center">
						<a href="{{ route('person') }}" class="btn btn-default">Cancel</a>
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