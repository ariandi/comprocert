@extends('admin.layouts.master')

@section('title') Order Edit @endsection
@section('addingFileJs')
	
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" />
@endsection

@section('addingScriptJs')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ URL::asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function(){

		$('.tanggalan').datepicker({
				autoclose: true,
				orientation: 'bottom',
				format: 'yyyy-mm-dd'
		});

		$(document).on("click", ".add-newline", function(){
	      var targettable = $(this).attr("target");
	      var actions = $(".tableline td:last-child").html();
	      var date=new Date();
	      var months=["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];
	      var val=date.getDate()+" "+months[date.getMonth()]+" "+date.getFullYear();
	      var titles = $(this).attr('title');
	      var active = $(this).attr('active');
	      //$(this).attr("disabled", "disabled");
	      var nomor =$(targettable+' tr').length * 10;
	      var minNumber = 1; // le minimum
          var maxNumber = 100; // le maximum
          var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber);
	      var index = $(targettable+" tbody tr:last-child").index();
	      var row = '<tr>' +
	          	'<td>' + 
	          	'<input type="hidden" value="" class="form-control caridata" name="id[]" nomor="'+randomnumber+'" id="id'+randomnumber+'}">'+
	          	' <input type="hidden" value="'+randomnumber+'" class="form-control caridata" name="linenum[]" nomor="'+randomnumber+'" id="linenum'+randomnumber+'">'+
	          		nomor+
	          	'</td>' +
	          	'<td><input type="text" class="form-control caridata" name="productname[]" nomor="'+randomnumber+'" id="name'+randomnumber+'">' +
	          	'    <input type="hidden" id="productid'+randomnumber+'" value="'+titles+'" nomor="'+randomnumber+'" class="form-control" name="productid[]"></td>' +
	          	'<td><input type="text" class="form-control caridata" size="2" nomor="'+randomnumber+'" name="ordered[]" id="ordered'+randomnumber+'"></td>' +
	          	'<td><input type="text" class="form-control caridata" size="2" nomor="'+randomnumber+'" name="delivered[]" id="delivered'+randomnumber+'"></td>' +
	          	'<td><input type="text" class="form-control caridata" size="2" name="costprice[]" nomor="'+randomnumber+'" id="costprice'+randomnumber+'"></td>' +
	          	'<td><input type="text" class="form-control caridata" size="2" name="custprice[]" nomor="'+randomnumber+'" id="custprice'+randomnumber+'"></td>' +
	          	'<td><input type="text" class="form-control caridata" size="2" name="discount[]" nomor="'+randomnumber+'" id="discount'+randomnumber+'"></td>' +
	          	'<td>'+
	          		'<input type="hidden" class="form-control caridata" size="2" name="vat[]" nomor="'+randomnumber+'" id="vat'+randomnumber+'">'+
	          		'<span id="vattext'+randomnumber+'">0%</span>'+
	          	'</td>' +
	          	'<td>'+
	          		'<input type="hidden" class="form-control caridata" size="2" name="sum[]" nomor="'+randomnumber+'" id="sum'+randomnumber+'">'+
	          		'<span id="sumtext'+randomnumber+'">0</span></td>' +
	          	'<td> ' +
	          	'  <a class="deletetr btn btn-default" data-toggle="tooltip" id="deletenew" targets="'+targettable+'"><i class="fa fa-trash"></i></a></td>' +
	        '</tr>';
	      
	      $(targettable).append(row);
	      $(targettable+" tbody tr").eq(index + 1).find(".addtr, .edittr").toggle();
	      $('[data-toggle="tooltip"]').tooltip();
	    });

	    $("body").on("click", ".deletetr", function(){
	        var node = $(this).attr('node');
	        var id = $(this).attr('id');
	        var link = $(this).attr('href');

	        if(link){
	        	 if (confirm('Are you sure to delete?')) {
	        	 	return true;
	        	 }else{
	        	 	return false;
	        	 }
	        	 
	        }else{
	        	$(this).parents("tr").remove();
          		$(".add-new").removeAttr("disabled");
	        }
	    });

	    $("body").on("keyup", ".caridata", function(){
	        var id = $(this).attr('id');
	        var nomor = $(this).attr('nomor');
	        if(id == "namecompany"){
	        	var projects = <?php echo $data['company']; ?>;
	        }else if(id == "nameperson"){
	        	var projects = <?php echo $data['person']; ?>;
	        }else{
	        	var projects = <?php echo $data['dataproduk']; ?>;
	        }

	        
	        if(id == "name"+nomor){

			    $( "#"+id ).autocomplete({
			      minLength: 0,
			      source: function(request, response) {
				        var results = $.ui.autocomplete.filter(projects, request.term);
				        response(results.slice(0, 15));
				  },
			      focus: function( event, ui ) {
			        //$( this ).val( ui.item.value );
			        return false;
			      },
			      select: function( event, ui ) {
			      	if(id != "namecompany" && id != "nameperson"){

				        $( this ).val( ui.item.ProductName );
				        $( '#productid'+nomor ).val( ui.item.id );
				 		$('#custprice'+nomor).val(ui.item.UnitCustPrice);
				 		$('#costprice'+nomor).val(ui.item.UnitCostPrice);
				 		$('#vattext'+nomor).html(ui.item.VatID+"%");
				 		
				 		$('#discount'+nomor).val("0");

				 		if($('#ordered'+nomor).val()){

							if($('#discount'+nomor).val() != '' ){
								var totalharga = $('#ordered'+nomor).val() * $('#custprice'+nomor).val();
								var totaldiskon = ($('#discount'+nomor).val() * ($('#ordered'+nomor).val() * $('#custprice'+nomor).val())) / 100;
								var total = totalharga - totaldiskon;
								$('#sumtext'+nomor).html(total);
							}else{
								var total = $('#ordered'+nomor).val() * $('#custprice'+nomor).val();
								$('#sumtext'+nomor).html(total);
							}

				 		}else{
				 			$('#ordered'+nomor).val("0");
				 			$('#delivered'+nomor).val("0");
				 		}
				 	}else if(id == "namecompany"){
				 		$( this ).val( ui.item.CompanyName );
				 		$('#personid').val("0");
				 		$('#companyid').val(ui.item.desc);
				 		$('#iname').val(ui.item.CompanyName); $('#dname').val(ui.item.CompanyName);
				 		$('#iemail').val(ui.item.Email); $('#demail').val(ui.item.Email);
				 		$('#iaddress').val(ui.item.address1); $('#daddress').val(ui.item.address1);
				 		$('#iplace').val(ui.item.address2); $('#dplace').val(ui.item.address2);
				 		//$('#ipostcode').val(); $('#dpostcode').val();
				 		$('#icountry').val("-"); $('#dcountry').val("-");
				 	}else if(id == "nameperson"){
				 		$( this ).val( ui.item.first_name+" "+ui.item.last_name );
				 		
				 		$('#companyid').val(0);
				 		$('#personid').val(ui.item.desc);
				 		$('#iname').val(ui.item.first_name+" "+ui.item.last_name); $('#dname').val(ui.item.first_name+" "+ui.item.last_name);
				 		$('#iemail').val(ui.item.email); $('#demail').val(ui.item.email);
				 	}
			        return false;
			      }
			    })
			    .autocomplete( "instance" )._renderItem = function( ul, item ) {
			    	if(id != "namecompany" && id != "nameperson"){
				      return $( "<li style ='cursor:pointer; border-bottom: 1px solid #000; background: #d0c0c0;width: 20%;list-style: none;position: relative;left: -40px;padding-left: 10px'>" )
				        .append( "<div>" + item.ProductName + "</div>" )
				        .appendTo( ul );
				   	}else if(id == "nameperson"){
				      return $( "<li style ='cursor:pointer; border-bottom: 1px solid #000; background: #d0c0c0;width: 20%;list-style: none;position: relative;left: -40px;padding-left: 10px'>" )
				        .append( "<div>" + item.first_name +" "+item.last_name+ "</div>" )
				        .appendTo( ul );
				   	}else if (id == "namecompany"){
				   		 return $( "<li style ='cursor:pointer;border-bottom: 1px solid #000; background: #d0c0c0;width: 20%;list-style: none;position: relative;left: -40px;padding-left: 10px'>" )
				        .append( "<div>" + item.CompanyName + "</div>" )
				        .appendTo( ul );
				   	}
			    };
			}

			if( id == "ordered"+nomor ){
				var total = parseInt($('#ordered'+nomor).val().replace(",", "")) * parseInt($('#custprice'+nomor).val().replace(",", ""));
				$('#delivered'+nomor).val($(this).val());
				//alert($('#delivered'+nomor).val());
				$('#sumtext'+nomor).html(total);
			}

			if( id == "discount"+nomor ){
				if($(this).val() != '' ){
					var totalharga = $('#ordered'+nomor).val() * $('#custprice'+nomor).val();
					var totaldiskon = ($(this).val() * ($('#ordered'+nomor).val() * $('#custprice'+nomor).val())) / 100;
					var total = totalharga - totaldiskon;
					$('#sumtext'+nomor).html(total);
				}else{
					var total = $('#ordered'+nomor).val() * $('#custprice'+nomor).val();
					$('#sumtext'+nomor).html(total);
				}
				
			}
	    });

	    
	});
</script>
@endsection
@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="#">@yield('title')</a></li>
</ol>
@endsection

@section('content')
<section class="content">
	 {{ Form::model($orderid, array('route' => array('ordersale.update', $orderid), 'method' => 'PUT', 'files' => true)) }}
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
					                  		<input type="hidden" name="CompanyID" id="companyid" value="{{ $data['ordercust']['CompanyID'] }}" class="form-control" />
					                    	<input type="text" name="Company" id="namecompany" nomor="company" value="" class="form-control caridata" placeholder="Please write here" />
											<small class="text-red"></small>
					                  	</div>
									</div>
								</div>
								<div id="menu1" class="tab-pane fade">
									<div class="form-group">
										<label class="col-sm-3 control-label">Select Person</label>

					                  	<div class="col-sm-9">
					                  		<input type="hidden" name="PersonID" id="personid" value="{{ $data['ordercust']['PersonID'] }}" class="form-control" />
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
			                    	<input type="text" name="iname" id="iname" value="{{ $data['ordercust']['IName'] }}" class="form-control" />
									<small class="text-red"></small>
			                  	</div>
			                </div>
							<div class="form-group">
								<label class="col-sm-3 control-label">E-mail</label>
								<div class="col-sm-9">
									<input type="email" value="{{ $data['ordercust']['IEmail'] }}" name="iemail" id="iemail" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Address </label>
								<div class="col-sm-9">
									<input type="text" name="iaddress" id="iaddress" value="{{ $data['ordercust']['IAddress'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Place </label>
								<div class="col-sm-9">
									<input type="text" name="iplace" id="iplace" value="{{ $data['ordercust']['ICity'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" >Posttal code </label>
								<div class="col-sm-9">
									<input type="text" name="ipostcode" id="ipostcode" size="10" value="{{ $data['ordercust']['IZipCode'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Country </label>
								<div class="col-sm-9">
									<input type="text" name="icountry" id="icountry" value="{{ $data['ordercust']['ICountry'] }}" class="form-control" />
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
									<input type="text" name="dname" id="dname" value="{{ $data['ordercust']['DName'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">E-mail</label>
								<div class="col-sm-9">
									<input type="email" value="{{ $data['ordercust']['DEmail'] }}" name="demail" id="demail" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Address </label>
								<div class="col-sm-9">
									<input type="text" name="daddress" id="daddress" value="{{ $data['ordercust']['DAddress'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Place </label>
								<div class="col-sm-9">
									<input type="text" name="dplace" id="dplace" value="{{ $data['ordercust']['DCity'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Posttal code </label>
								<div class="col-sm-9">
									<input type="text" name="dpostcode" id="dpostcode" size="10" value="{{ $data['ordercust']['DZipCode'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" >Country </label>
								<div class="col-sm-9">
									<input type="text" name="dcountry" id="dcountry" value="{{ $data['ordercust']['DCountry'] }}" class="form-control" />
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
											<option value="{{ $value->id }}" {{ $data['ordercust']['ContactPersonID'] == $value->id ? 'selected':'' }}> {{ $value->first_name }} {{ $value->last_name }}</option>
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
					                  <input type="text" value="{{ date('Y-m-d',strtotime($data['ordercust']['OrderDate'])) }}" class="form-control pull-right tanggalan" id="OrderDate" placeholder="Order Date" readonly name="OrderDate" value="">
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
					                  <input type="text" value="{{ date('Y-m-d',strtotime($data['ordercust']['DeliveryDate'])) }}" class="form-control pull-right tanggalan" id="AvailableFrom" placeholder="Delivery Date" readonly name="DeliveryDate" value="">
				                	</div>
									
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">tax free </label>
								<div class="col-sm-9">
									<input type="checkbox" {{ $data['ordercust']['EnableTaxFree'] != "" ? 'checked':'' }} name="EnableTaxFree" id="EnableTaxFree" value="1" class="" style="position: relative;top: 7px;" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Internel reference </label>
								<div class="col-sm-9">
									<input type="text" value="{{ $data['ordercust']['RefInternal'] }}" name="Internelreference" id="Internelreference" size="10" value="" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Status  </label>
								<div class="col-sm-9">
									
									<select name="Status" class="form-control">
										<option value="">--Pilih--</option>
										<option value="Invoiced" {{ $data['ordercust']['Status'] == "Invoiced" ? 'selected':'' }}>Invoiced</option>
										<option value="rip" {{ $data['ordercust']['Status'] == "rip" ? 'selected':'' }}>Lost orders</option>
										<option value="progress" {{ $data['ordercust']['Status'] == "progress" ? 'selected':'' }}>On going</option>
										<option value="pickfinished" {{ $data['ordercust']['Status'] == "pickfinished" ? 'selected':'' }}>Pick finished</option>
										<option value="pickinprogress" {{ $data['ordercust']['Status'] == "pickinprogress" ? 'selected':'' }}>Pick in progress</option>
										<option value="recieved" {{ $data['ordercust']['Status'] == "recieved" ? 'selected':'' }}>Received</option>
										<option value="sendt" {{ $data['ordercust']['Status'] == "sendt" ? 'selected':'' }}>Send</option>
									</select>
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Discount </label>
								<div class="col-sm-9">
									<input type="text" name="discount" id="discount" size="10" value="" class="form-control" />
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
											<option value="{{ $value->id }}" {{ $data['ordercust']['ResponsiblePersonID'] == $value->id ? 'selected':'' }}> {{ $value->first_name }} {{ $value->last_name }}</option>
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
					                  <input type="text" value="{{ date('Y-m-d',strtotime($data['ordercust']['RequiredDate'])) }}" class="form-control pull-right tanggalan" id="required" placeholder="required" readonly name="required" value="">
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
					                  <input type="text" value="{{ date('Y-m-d',strtotime($data['ordercust']['DateShipped'])) }}" class="form-control pull-right tanggalan" id="sent" placeholder="sent" readonly name="sent" value="">
				                	</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Active </label>
								<div class="col-sm-9">
									<input type="checkbox" {{ $data['ordercust']['Active'] == 1 ? "checked":""}} name="active" id="active" value="1" class="" style="position: relative;top: 7px;" />
									<small class="text-red"></small>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Client reference	 </label>
								<div class="col-sm-9">
									<input type="text" value="{{ $data['ordercust']['RefCustomer'] }}" name="clientreference" id="clientreference" size="10" value="" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Total client price  </label>
								<div class="col-sm-9">
									<input type="text" name="TotalCustPrice" id="TotalCustPrice" value="{{ $data['ordercust']['TotalCustPrice'] }}" class="form-control" />
									<small class="text-red"></small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Dpack </label>
								<div class="col-sm-9">
									<input type="text" name="Dpack" id="Dpack" size="10" value="{{ $data['ordercust']['Dpack'] }}" class="form-control" />
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
									<textarea rows="10" class="form-control" name="CommentInternal">{{ $data['ordercust']['CommentInternal'] }}</textarea>
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
									<textarea rows="10" class="form-control" name="CommentCustomer">{{ $data['ordercust']['CommentCustomer'] }}</textarea>
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
			               		@foreach($data['ordercustline'] as $keyline => $values )
			               		<tr>
			               			<td>{{ $values->LineNum }}</td>
	          						<td>
	          							<input type="text" class="form-control caridata" name="productname[]" nomor="{{ $values->LineNum }}" id="name{{ $values->LineNum }}" value="{{ $values->ProductName }}">
	          							<input type="hidden" id="productid{{ $values->LineNum }}" value="" nomor="{{ $values->LineNum }}" class="form-control" value="{{ $values->ProductID }}" name="productid[]">
	          							<input type="hidden" value="{{ $values->LineNum }}" class="form-control caridata" name="linenum[]" nomor="{{ $values->LineNum }}" id="linenum{{ $values->LineNum }}">
	          							<input type="hidden" value="{{ $values->id }}" class="form-control caridata" name="id[]" nomor="{{ $values->LineNum }}" id="id{{ $values->LineNum }}">
	          						</td>
	          						<td>
	          							<input type="text" value="{{ number_format($values->QuantityOrdered,0) }}" class="form-control caridata" size="2" nomor="{{ $values->LineNum }}" name="ordered[]" id="ordered{{ $values->LineNum }}">
	          						</td>
	          						<td>
	          							<input type="text" value="{{ number_format($values->QuantityDelivered,0) }}" class="form-control caridata" size="2" nomor="{{ $values->LineNum }}" name="delivered[]" id="delivered{{ $values->LineNum }}">
	          						</td>
	          						<td>
	          							<input type="text" value="{{ number_format($values->UnitCostPrice,2) }}" class="form-control caridata" size="2" name="costprice[]" nomor="{{ $values->LineNum }}" id="costprice{{ $values->LineNum }}">
	          						</td>
	          						<td>
	          							<input type="text" value="{{ number_format($values->UnitCustPrice,2) }}" class="form-control caridata" size="2" name="custprice[]" nomor="{{ $values->LineNum }}" id="custprice{{ $values->LineNum }}">
	          						</td>
	          						<td>
	          							<input type="text" value="{{ number_format($values->Discount,2) }}" class="form-control caridata" size="2" name="discount[]" nomor="{{ $values->LineNum }}" id="discount{{ $values->LineNum }}">
	          						</td>
	          						<td>
	          							<input type="hidden" value="{{ $values->Vat }}" class="form-control caridata" size="2" name="vat[]" nomor="{{ $values->LineNum }}" id="vat{{ $values->LineNum }}">

	          							<span id="vattext{{ $values->LineNum }}">0%</span>
	          						</td>
						          	<td>
						          		<input type="hidden" class="form-control caridata" size="2" name="sum[]" nomor="+randomnumber+'" id="sum{{ $values->LineNum }}">
						          		<span id="sumtext{{ $values->LineNum }}">
						          			{{ number_format(($values->QuantityDelivered * $values->UnitCustPrice) - (($values->QuantityDelivered * $values->UnitCustPrice) * $values->Discount / 100),2) }}
						          		</span>
						          	</td>
						          	<td>
	          	  						<a href="{{ route ('ordersale.delete',['id'=>$values->id,'table'=>'Ordercustline']) }}" class="deletetr btn btn-default" data-toggle="tooltip" id="deletenew" targets=".tableline">
	          	  							<i class="fa fa-trash"></i>
	          	  						</a>
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
						<a href="{{ route('ordersale.index') }}" class="btn btn-default">Cancel</a>
						&nbsp;
						<button type="submit" class="btn btn-primary">Save</button>
						&nbsp;
						<a href="{{ route('ordersale.invoiced',['id'=>$orderid]) }}" class="btn btn-warning pull-right">Generate To Invoice</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
</section>
@endsection