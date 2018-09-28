@extends('admin.layouts.master')

@section('title') 
Edit Company
@endsection

@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href="{{ url('admin/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ url('admin/companies') }}">Company</a></li>
    <li class="active"><a href="{{ route('companies.edit', ['id' => $company->id]) }}">@yield('title')</a></li>
</ol>
@endsection

@section('css_custom')
<link href="{{ URL::asset('assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<style type="text/css">
	.select2-container .select2-selection--single{
		height: 34px;
	}
</style>
@endsection

@section('content')
	<section class="content">

		@if(isset($company->id))
			<div class="row" style="margin-bottom: 15px;">
				<div class="col-md-4 text-center" style="margin-bottom: 15px;">
					<button class="btn btn-success btn-block productTextAjax" type="button" thirdparty="tinymce"
					target="{{ route('companies.edit', ['id' => $company->id, 'ajax' => 1]) }}">Company Detail</button>
				</div>

				<div class="col-md-4 text-center" style="margin-bottom: 15px;">
					<button class="btn btn-success btn-block productTextAjax" type="button"
					target="{{ route('companies.get-employee', ['id' => $company->id]) }}">Employee List</button>
				</div>

				<div class="col-md-4 text-center" style="margin-bottom: 15px;">
					<button class="btn btn-success btn-block productTextAjax" type="button" 
					target="{{ route('companies.get-related-company', ['id' => $company->id]) }}">Related Company</button>
				</div>
			</div>
		@endif


		<form action="{{ route('companies.update',$company->id) }}" method="post" enctype="multipart/form-data" id="upload_form">
		{{ csrf_field() }}
		@if(isset($company->id))
			<input type="hidden" name="id" value="{{ $company->id }}" />
			<input type="hidden" name="_method" value="PUT" />
		@endif

		<div id="ajaxLoad">

		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

		@if (\Session::has('success'))
      <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
      </div><br />
    @endif

		<div class="box box-success">
	    <div class="box-header with-border">
	      <h3 class="box-title">Company Prospect</h3>

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
			                  <label for="CompanyName" class="col-sm-3 control-label">Company name</label>
			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->CompanyName or old('CompanyName') }}" placeholder="Company name" name="CompanyName">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="CompanyNumber" class="col-sm-3 control-label">Company number</label>
			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->CompanyNumber or old('CompanyNumber') }}" placeholder="Company number" name="CompanyNumber">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="phone2" class="col-sm-3 control-label">Phone 2</label>

			                  <div class="col-sm-9">
			                  	<input type="text" class="form-control" 
			                    value="{{ $company->phone2 or old('phone2') }}" placeholder="Phone 2" name="phone2">
			                  </div>
			                </div>
			                <div class="form-group">
			                  <label for="phone3" class="col-sm-3 control-label">Customer</label>

			                  <div class="col-sm-9">
			                  	<input type="text" class="form-control" 
			                    value="{{ $company->phone3 or old('phone3') }}" placeholder="Phone 3" name="phone3">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="ClassificationID" class="col-sm-3 control-label">Classification</label>

			                  <div class="col-sm-9">
			                  	<select name="ClassificationID" class="form-control">
			                  		@foreach($classification as $kclass => $vclass)
			                  			<option value="{{ $vclass['key'] }}">{{ $vclass['val'] }}</option>
			                  		@endforeach
			                  	</select>
			                  </div>
			                </div>
			                
		                </div>

		                {{-- ////////////////Kanan////////////////////// --}}
		                <div class="col-md-6">
		                	
		                	<div class="form-group">
			                  <label for="Email" class="col-sm-3 control-label">Company email</label>
			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->Email or old('Email') }}" placeholder="Company email" name="Email">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="WWW" class="col-sm-3 control-label">Company website</label>
			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->WWW or old('WWW') }}" placeholder="Company website" name="WWW">
			                  </div>
			                </div>

		                	<div class="form-group">
			                  <label for="phone1" class="col-sm-3 control-label">Phone</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->phone1 or old('phone1') }}" placeholder="Phone 1" name="phone1">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Active" class="col-sm-3 control-label">Active</label>

			                  <div class="col-sm-9">
			                  	@if($company->Active == 0)
			                    	<input type="checkbox" unchecked name="Active" style="position: relative;top: 7px;" value="1">
			                    @else
			                    	<input type="checkbox" checked name="Active" style="position: relative;top: 7px;" value="1">
			                    @endif
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Type" class="col-sm-3 control-label">Type</label>

			                  <div class="col-sm-9">
			                  	<select name="Type" class="form-control">
			                  		@foreach($type as $ktype => $vtype)
			                  			<option value="{{ $vtype['key'] }}">{{ $vtype['val'] }}</option>
			                  		@endforeach
			                  	</select>
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
	      <h3 class="box-title">Economy</h3>

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
			                  <label for="Unit" class="col-sm-3 control-label">Term of delivery</label>

			                  <div class="col-sm-9">
			                  	<textarea name="DeliveryCondition">
			                  		{{ $company->DeliveryCondition or old('DeliveryCondition') }}
			                  	</textarea>
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Unit" class="col-sm-3 control-label">Vat outgoing account</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->VatOutAccount or old('VatOutAccount') }}" placeholder="Vat outgoing account" name="VatOutAccount">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Unit" class="col-sm-3 control-label">Vat invesment account</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->VatInvestmentAccount or old('VatInvestmentAccount') }}" 
			                    placeholder="Vat invesment account" name="VatInvestmentAccount">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Unit" class="col-sm-3 control-label">Account for sale</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->AccountSale or old('AccountSale') }}" placeholder="Account Sale" name="AccountSale">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Unit" class="col-sm-3 control-label">Hour price</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->HourPrice or old('HourPrice') }}" placeholder="Hour Price" name="HourPrice">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Unit" class="col-sm-3 control-label">Cost price</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->CostPrice or old('CostPrice') }}" placeholder="Cost Price" name="CostPrice">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Unit" class="col-sm-3 control-label">PKP Number</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->PKPNumber or old('PKPNumber') }}" placeholder="PKP Number" name="PKPNumber">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="EnableSaleNumberSequence" class="col-sm-3 control-label">Turn on salesnumbering</label>

			                  <div class="col-sm-9">
			                    @if($company->EnableSaleNumberSequence == 0)
			                    	<input type="checkbox" unchecked name="EnableSaleNumberSequence" style="position: relative;top: 7px;" value="1">
			                    @else
			                    	<input type="checkbox" checked name="EnableSaleNumberSequence" style="position: relative;top: 7px;" value="1">
			                    @endif
			                  </div>
			                </div>
			                <div class="form-group">
			                  <label for="EnableCashNumberSequence" class="col-sm-3 control-label">Turn on cash numbering</label>

			                  <div class="col-sm-9">
			                    @if($company->EnableCashNumberSequence == 0)
			                    	<input type="checkbox" unchecked name="EnableCashNumberSequence" style="position: relative;top: 7px;" value="1">
			                    @else
			                    	<input type="checkbox" checked name="EnableCashNumberSequence" style="position: relative;top: 7px;" value="1">
			                    @endif
			                  </div>
			                </div>
			                <div class="form-group">
			                  <label for="EnableSalaryNumberSequence" class="col-sm-3 control-label">Turn on salary numbering</label>

			                  <div class="col-sm-9">
			                    @if($company->EnableSalaryNumberSequence == 0)
			                    	<input type="checkbox" unchecked name="EnableSalaryNumberSequence" style="position: relative;top: 7px;" value="1">
			                    @else
			                    	<input type="checkbox" checked name="EnableSalaryNumberSequence" style="position: relative;top: 7px;" value="1">
			                    @endif
			                  </div>
			                </div>
			                <div class="form-group">
			                  <label for="EnableWeeklysaleNumberSequence" class="col-sm-3 control-label">Turn on weekly salesnumbering</label>

			                  <div class="col-sm-9">
			                    @if($company->EnableWeeklysaleNumberSequence == 0)
			                    	<input type="checkbox" unchecked name="EnableWeeklysaleNumberSequence" style="position: relative;top: 7px;" value="1">
			                    @else
			                    	<input type="checkbox" checked name="EnableWeeklysaleNumberSequence" style="position: relative;top: 7px;" value="1">
			                    @endif
			                  </div>
			                </div>
			                
		                </div>

		                {{-- ////////////////////////////Kanan//////////////////////////////////// --}}
		                <div class="col-md-6">
		                	<div class="form-group">
			                  <label for="QuantityPerUnit" class="col-sm-3 control-label">Term of payment</label>

			                  <div class="col-sm-9">
			                  	<textarea name="PaymentCondition">
			                  			{{ $company->PaymentCondition or old('PaymentCondition') }}
			                  	</textarea>
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Unit" class="col-sm-3 control-label">Vat incomming account</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->VatInAccount or old('VatInAccount') }}" placeholder="Vat incomming account" name="VatInAccount">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Unit" class="col-sm-3 control-label">Vat account</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->VatAccount or old('VatAccount') }}" 
			                    placeholder="Vat account" name="VatAccount">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Unit" class="col-sm-3 control-label">Account investment</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->AccountInvestment or old('AccountInvestment') }}" 
			                    placeholder="Account Investment" name="AccountInvestment">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Unit" class="col-sm-3 control-label">Travel price</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->TravelPrice or old('TravelPrice') }}" placeholder="Travel Price" name="TravelPrice">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Unit" class="col-sm-3 control-label">Account plan ID</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->AccountPlanID or old('AccountPlanID') }}" placeholder="Account plan ID" 
			                    name="AccountPlanID">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Unit" class="col-sm-3 control-label">PKP Used Date</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" id="PKPUsedDate" readonly="true" 
			                    value="{{ $company->PKPUsedDate or old('PKPUsedDate') }}" placeholder="PKP Used Date" name="PKPUsedDate">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="EnableBankNumberSequence" class="col-sm-3 control-label">Turn on banknumber</label>

			                  <div class="col-sm-9">
			                    @if($company->EnableBankNumberSequence == 0)
			                    	<input type="checkbox" unchecked name="EnableBankNumberSequence" style="position: relative;top: 7px;" value="1">
			                    @else
			                    	<input type="checkbox" checked name="EnableBankNumberSequence" style="position: relative;top: 7px;" value="1">
			                    @endif
			                  </div>
			                </div>
			                <div class="form-group">
			                  <label for="EnableBuyNumberSequence" class="col-sm-3 control-label">Turn on order number</label>

			                  <div class="col-sm-9">
			                    @if($company->EnableBuyNumberSequence == 0)
			                    	<input type="checkbox" unchecked name="EnableBuyNumberSequence" style="position: relative;top: 7px;" value="1">
			                    @else
			                    	<input type="checkbox" checked name="EnableBuyNumberSequence" style="position: relative;top: 7px;" value="1">
			                    @endif
			                  </div>
			                </div>
			                <div class="form-group">
			                  <label for="EnableAutoNumberSequence" class="col-sm-3 control-label">Turn on auto numbering</label>

			                  <div class="col-sm-9">
			                    @if($company->EnableAutoNumberSequence == 0)
			                    	<input type="checkbox" unchecked name="EnableAutoNumberSequence" style="position: relative;top: 7px;" value="1">
			                    @else
			                    	<input type="checkbox" checked name="EnableAutoNumberSequence" style="position: relative;top: 7px;" value="1">
			                    @endif
			                  </div>
			                </div>
			                
		                </div>

	                </div>

	            </div	>

		      	</div>

		    </div><!-- /.box-body -->
		  </div>
		</div>



		<div class="box box-success collapsed-box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Interest</h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                title="Collapse">
	          <i class="fa fa-plus"></i></button>
	      </div>
	    </div>
		    
		  <div class="box-body" style="display: none;">
		    <div class="row">

		        <div class="col-xs-12">

              <div class="form-horizontal">

	              	<div class="row">
	              		<div class="col-md-6">
			                <div class="form-group">
			                  <label for="InterestRate" class="col-sm-3 control-label">Interest</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->InterestRate or old('InterestRate') }}" placeholder="Interest" name="InterestRate">
			                  </div>
			                </div>
			                <div class="form-group">
			                  <label for="ShareValue" class="col-sm-3 control-label">Nominal value</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->ShareValue or old('ShareValue') }}" placeholder="Nominal value" name="ShareValue">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="VoucherBankNumber" class="col-sm-3 control-label">Voucher account number</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->VoucherBankNumber or old('VoucherBankNumber') }}" placeholder="Voucher account number" name="VoucherBankNumber">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="VoucherBuyNumber" class="col-sm-3 control-label">Voucher procurement number</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->VoucherBuyNumber or old('VoucherBuyNumber') }}" placeholder="Voucher procurement number" name="VoucherBuyNumber">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="VoucherCashNumber" class="col-sm-3 control-label">Voucher pay desk number</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->VoucherCashNumber or old('VoucherCashNumber') }}" placeholder="Voucher pay desk number" name="VoucherCashNumber">
			                  </div>
			                </div>
		                </div>

		                <div class="col-md-6">
		                	<div class="form-group">
			                  <label for="InterestDate" class="col-sm-3 control-label">Interest day</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->InterestDate or old('InterestDate') }}" placeholder="Interest day" name="InterestDate" id="InterestDate" readonly="true">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="ShareNumber" class="col-sm-3 control-label">Number of share</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->ShareNumber or old('ShareNumber') }}" placeholder="Number of share" name="ShareNumber">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="VoucherSaleNumber" class="col-sm-3 control-label">Voucher sales number</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->VoucherSaleNumber or old('VoucherSaleNumber') }}" placeholder="Voucher sales number" name="VoucherSaleNumber">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="VoucherSalaryNumber" class="col-sm-3 control-label">Voucher salary account</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->VoucherSalaryNumber or old('VoucherSalaryNumber') }}" placeholder="Voucher salary account" name="VoucherSalaryNumber">
			                  </div>
			                </div>

			                {{-- <div class="form-group">
			                  <label for="ProductVolumeUnit" class="col-sm-3 control-label">Volume unit</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->ProductVolumeUnit or old('ProductVolumeUnit') }}" placeholder="Volume unit" name="ProductVolumeUnit">
			                  </div>
			                </div> --}}
		                </div>

	                </div>

	            </div	>

		      	</div>

		    </div><!-- /.box-body -->
		  </div>
		</div>


		<div class="box box-success collapsed-box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Open Hour</h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                title="Collapse">
	          <i class="fa fa-plus"></i></button>
	      </div>
	    </div>
		    
		  <div class="box-body" style="display: none;">
		    <div class="row">

		        <div class="col-xs-12">

              <div class="form-horizontal">

	              	<div class="row">
	              		<div class="col-md-6">
			                <div class="form-group">
			                  <label for="OpenMon" class="col-sm-3 control-label">Open Monday</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->OpenMon or old('OpenMon') }}" placeholder="Open Monday" name="OpenMon">
			                  </div>
			                </div>
			                <div class="form-group">
			                  <label for="OpenTue" class="col-sm-3 control-label">Open Tuesday</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->OpenTue or old('OpenTue') }}" placeholder="Open Tuesday" name="OpenTue">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="OpenWed" class="col-sm-3 control-label">Open wednesday</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->OpenWed or old('OpenWed') }}" placeholder="Open wednesday" name="OpenWed">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="OpenThu" class="col-sm-3 control-label">Open Thursday</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->OpenThu or old('OpenThu') }}" placeholder="Open Thursday" name="OpenThu">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="OpenFri" class="col-sm-3 control-label">Open Friday</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->OpenFri or old('OpenFri') }}" placeholder="Open Friday" name="OpenFri">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="OpenSat" class="col-sm-3 control-label">Open Saturday</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->OpenSat or old('OpenSat') }}" placeholder="Open Saturday" name="OpenSat">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="OpenSun" class="col-sm-3 control-label">Open Sunday</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->OpenSun or old('OpenSun') }}" placeholder="Open Sunday" name="OpenSun">
			                  </div>
			                </div>
		                </div>


		                {{-- //////////////////////////Kanan////////////////////// --}}
		                <div class="col-md-6">
		                	<div class="form-group">
			                  <label for="CloseMon" class="col-sm-3 control-label">Close Monday</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->CloseMon or old('CloseMon') }}" placeholder="Close Monday" name="CloseMon">
			                  </div>
			                </div>
			                <div class="form-group">
			                  <label for="CloseTue" class="col-sm-3 control-label">Close Tuesday</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->CloseTue or old('CloseTue') }}" placeholder="Close Tuesday" name="CloseTue">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="CloseWed" class="col-sm-3 control-label">Close wednesday</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->CloseWed or old('CloseWed') }}" placeholder="Close wednesday" name="CloseWed">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="CloseThu" class="col-sm-3 control-label">Close Thursday</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->CloseThu or old('CloseThu') }}" placeholder="Close Thursday" name="CloseThu">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="CloseFri" class="col-sm-3 control-label">Close Friday</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->CloseFri or old('CloseFri') }}" placeholder="Close Friday" name="CloseFri">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="CloseSat" class="col-sm-3 control-label">Close Saturday</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->CloseSat or old('CloseSat') }}" placeholder="Close Saturday" name="CloseSat">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="CloseSun" class="col-sm-3 control-label">Close Sunday</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->CloseSun or old('CloseSun') }}" placeholder="Close Sunday" name="CloseSun">
			                  </div>
			                </div>
		                </div>

	                </div>

	            </div	>

		      	</div>

		    </div><!-- /.box-body -->
		  </div>
		</div>




		<div class="box box-success collapsed-box">
	    <div class="box-header with-border">
	      <h3 class="box-title">VAT</h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                title="Collapse">
	          <i class="fa fa-plus"></i></button>
	      </div>
	    </div>
		    
		  <div class="box-body" style="display: none;">
		    <div class="row">

		        <div class="col-xs-12">

              <div class="form-horizontal">

	              	<div class="row">
	              		<div class="col-md-6">

			                <div class="form-group">
			                  <label for="EnableTaxFree" class="col-sm-3 control-label">Turn on taxfree status</label>

			                  <div class="col-sm-9">
			                  	@if($company->EnableTaxFree == 0)
			                    	<input type="checkbox" unchecked name="EnableTaxFree" style="position: relative;top: 7px;" value="1">
			                    @else
			                    	<input type="checkbox" checked name="EnableTaxFree" style="position: relative;top: 7px;" value="1">
			                    @endif
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Frittisisteledd" class="col-sm-3 control-label">Fritt i siste ledd</label>
			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->Frittisisteledd or old('Frittisisteledd') }}" placeholder="Fritt i siste ledd" name="Frittisisteledd">
			                  </div>
			                </div>
			              </div>

		                {{-- ////////////////Kanan////////////////////// --}}
		                <div class="col-md-6">

		                	<div class="form-group">
			                  <label for="EnableVat" class="col-sm-3 control-label">Turn on VAT</label>

			                  <div class="col-sm-9">
			                    @if($company->EnableVat == 0)
			                    	<input type="checkbox" unchecked name="EnableVat" style="position: relative;top: 7px;" value="1">
			                    @else
			                    	<input type="checkbox" checked name="EnableVat" style="position: relative;top: 7px;" value="1">
			                    @endif
			                  </div>
			                </div>

		                </div>
	                </div>
	            </div>

		      	</div>

		    </div><!-- /.box-body -->
		  </div>
		</div>




		<div class="box box-success collapsed-box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Various information</h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                title="Collapse">
	          <i class="fa fa-plus"></i></button>
	      </div>
	    </div>
		    
		  <div class="box-body" style="display: none;">
		    <div class="row">

		        <div class="col-xs-12">

              <div class="form-horizontal">

	              	<div class="row">
	              		<div class="col-md-6">

	              			<div class="form-group">
			                  <label for="Status" class="col-sm-3 control-label">Status</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->Status or old('Status') }}" 
			                    placeholder="Status" name="Status">
			                  </div>
			                </div>
			                
			                <div class="form-group">
			                  <label for="Information" class="col-sm-3 control-label">Information about the unit</label>

			                  <div class="col-sm-9">
			                  	<textarea name="Information">
			                  		{{ $company->Information or old('Information') }}
			                  	</textarea>
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="TagLine" class="col-sm-3 control-label">Motto</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->TagLine or old('TagLine') }}" placeholder="Motto" name="TagLine">
			                  </div>
			                </div>
			                
		                </div>

		                {{-- ////////////////////////////Kanan//////////////////////////////////// --}}
		                <div class="col-md-6">

			                <div class="form-group">
			                  <label for="FoundedDate" class="col-sm-3 control-label">Establish date</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->FoundedDate or old('FoundedDate') }}" placeholder="Establish date" name="FoundedDate" id="FoundedDate" readonly="true">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="SalePersonID" class="col-sm-3 control-label">Sales responsible</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->SalePersonID or old('SalePersonID') }}" 
			                    placeholder="Sales responsible" name="SalePersonID">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="AddRegCode" class="col-sm-3 control-label">Additonal Reg Code</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->AddRegCode or old('AddRegCode') }}" 
			                    placeholder="Additonal Reg Code" name="AddRegCode">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="OrgNumber" class="col-sm-3 control-label">Organisation number</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->OrgNumber or old('OrgNumber') }}" placeholder="Organisation number" name="OrgNumber">
			                  </div>
			                </div>
			                
		                </div>

	                </div>
	            </div	>
		      	</div>

		    </div><!-- /.box-body -->
		  </div>
		</div>



		<div class="box box-success collapsed-box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Social Network</h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                title="Collapse">
	          <i class="fa fa-plus"></i></button>
	      </div>
	    </div>
		    
		  <div class="box-body" style="display: none;">
		    <div class="row">

		        <div class="col-xs-12">

              <div class="form-horizontal">

	              	<div class="row">
	              		<div class="col-md-6">

	              			<div class="form-group">
			                  <label for="Facebook" class="col-sm-3 control-label">Facebook</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $company->Facebook or old('Facebook') }}" 
			                    placeholder="Facebook" name="Facebook">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Twitter" class="col-sm-3 control-label">Twitter</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->Twitter or old('Twitter') }}" placeholder="Twitter" name="Twitter">
			                  </div>
			                </div>
			                
		                </div>

		                {{-- ////////////////////////////Kanan//////////////////////////////////// --}}
		                <div class="col-md-6">

			                <div class="form-group">
			                  <label for="LinkedIn" class="col-sm-3 control-label">LinkedIn</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $company->LinkedIn or old('LinkedIn') }}" placeholder="LinkedIn" name="LinkedIn">
			                  </div>
			                </div>
			                
		                </div>

	                </div>

	            </div	>

		      	</div>

		    </div><!-- /.box-body -->
		  </div>
		</div>



		<div class="box box-success collapsed-box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Log</h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                title="Collapse">
	          <i class="fa fa-plus"></i></button>
	      </div>
	    </div>
		    
		  <div class="box-body" style="display: none;">
		    <div class="row">

		        <div class="col-xs-12">

              <div class="form-horizontal">

	              	<div class="row">
	              		<div class="col-md-6">

	              			<div class="form-group">
			                  <label for="Facebook" class="col-sm-3 control-label">Updated By</label>

			                  <div class="col-sm-9">
			                  	<input type="text" value="{{ $company->UpdatedByPersonID }}" readonly="true" class="form-control" />
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Twitter" class="col-sm-3 control-label">Created By</label>

			                  <div class="col-sm-9">
			                    <input type="text" value="{{ $company->InsertedByPersonID }}" readonly="true" class="form-control" />
			                  </div>
			                </div>
			                
		                </div>

		                {{-- ////////////////////////////Kanan//////////////////////////////////// --}}
		                <div class="col-md-6">

			                <div class="form-group">
			                  <label for="LinkedIn" class="col-sm-3 control-label">Updated</label>

			                  <div class="col-sm-9">
			                  	<input type="text" value="{{ $company->updated_at }}" readonly="true" class="form-control" />
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="LinkedIn" class="col-sm-3 control-label">Date when created</label>

			                  <div class="col-sm-9">
			                    <input type="text" value="{{ $company->created_at }}" readonly="true" class="form-control" />
			                  </div>
			                </div>
						                
		                </div>

	                </div>

	            </div	>

		      	</div>

		    </div><!-- /.box-body -->
		  </div>
		</div>

	  <div class="panel">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-offset-5 col-md-2 text-center">
						<a href="#" class="btn btn-default">Cancel</a>
						&nbsp;
						<input type="submit" value="Save" class="btn btn-primary" />
					</div>
				</div>
			</div>
		</div>

		</div> {{-- ///////////////Ajax Call///////////// --}}

		</form>

	</section>
@endsection

@section('addingFileJs')
	<script src="{{ URL::asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=xspx9ax4f39yi8pjfnpoe60sz9x5mz1xewzmxt918nsl47sh"></script>
@endsection

@section('addingScriptJs')
	<script type="text/javascript">
	$(document).ready(function() {
			$('#PKPUsedDate').datepicker({
				autoclose: true,
				orientation: 'bottom',
				format: 'yyyy-mm-dd'
		  });

		  $('#InterestDate').datepicker({
				autoclose: true,
				orientation: 'bottom',
				format: 'yyyy-mm-dd'
		  });

		  $('#FoundedDate').datepicker({
				autoclose: true,
				orientation: 'bottom',
				format: 'yyyy-mm-dd'
		  });

	    tinymce.init({
						      selector: 'textarea',
						      entity_encoding : 'raw',
						      mode : 'specific_textareas',
						      //selector: 'textarea',
						      //editor_selector : 'mceEditor',
						      convert_urls: false,
						      language : 'en',
						      theme: 'modern',
						      plugins: [
						        'spellchecker,pagebreak,layer,table,save,insertdatetime,media,searchreplace,' +
						          'print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,' +
						          'nonbreaking,template,autoresize,' +
						          'anchor,charmap,hr,image,link,emoticons,code,textcolor,' +
						          'charmap,pagebreak'
						      ],
						      toolbar: 'insertfile undo redo| charmap | pagebreak | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  fontselect fontsizeselect | forecolor backcolor',
						      pagebreak_separator: "<!-- my page break -->",
						      image_advtab: true,
						      autoresize_max_height: 350
						    });

	    $('body').on('click', '.productTextAjax', function(){
	    	var target = $(this).attr('target');
	    	var thirdparty = $(this).attr('thirdparty');

	    	$.ajax({
	        method:"GET",
	        url:target,
	        success: function(result){
	            $("#ajaxLoad").html(result);

	            $('#getCompanyID').select2();

	            if(thirdparty == 'tinymce'){
	            	tinymce.remove();
	            	
	            	tinymce.init({
						      selector: 'textarea',
						      entity_encoding : 'raw',
						      mode : 'specific_textareas',
						      //selector: 'textarea',
						      //editor_selector : 'mceEditor',
						      convert_urls: false,
						      language : 'en',
						      theme: 'modern',
						      plugins: [
						        'spellchecker,pagebreak,layer,table,save,insertdatetime,media,searchreplace,' +
						          'print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,' +
						          'nonbreaking,template,autoresize,' +
						          'anchor,charmap,hr,image,link,emoticons,code,textcolor,' +
						          'charmap,pagebreak'
						      ],
						      toolbar: 'insertfile undo redo| charmap | pagebreak | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  fontselect fontsizeselect | forecolor backcolor',
						      pagebreak_separator: "<!-- my page break -->",
						      image_advtab: true,
						      autoresize_max_height: 350
						    });
	            }
	            
	        },
	        error: function(e){
	          alert("Error");
	          console.log(e);
	        }
	      });
	    });

	    

	    $('body').on('click', '.addComRelation', function(){
	    	// alert($('#getCompanyID').val());
	    	var formData = {
	                ToCompanyID : $('#getCompanyID').val(),
	                FromCompanyID : $('#CompanyID').val(),
	                FromCompanyRelationTypeID : 0,
	                ToCompanyRelationTypeID : 0,
	                Active : 1,
	                InsertedByPersonID : {{ Auth::user()->id }},
	                UpdatedByPersonID : {{ Auth::user()->id }},
	                _token  : $('meta[name="csrf-token"]').attr('content'),
	                _method: 'POST',
	            }

	      console.log(formData);
	      // return false;

	      $.ajax({
	        method:"POST",
	        url:"{{ route('companies.save-related-company') }}",
	        data: formData,
	        //dataType: "json",
	        success: function(result){
	            console.log(result);
	            if(result.error == 0){
	              alert("Update data Success");
	              $(".companyRelatedReload").load("{{ route('companies.get-related-company',$company->id) }} .companyRelatedReloadSuccess");
	              $(".successCompanyRelated").fadeIn('slow');
	            }else{
	            	alert("Error when update");
	            }

	        },
	        error: function(e, r){
	          alert("Error");
	          console.log(e);
	          console.log(r);
	        }
	      });
	    });
	});
	</script>
@endsection