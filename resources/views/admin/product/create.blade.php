@extends('admin.layouts.master')

@section('title') 
Create Product
@endsection

@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href="{{ url('admin/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ url('admin/product') }}">Product</a></li>
    <li class="active"><a href="{{ url('admin/product/create') }}">@yield('title')</a></li>
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

		@if(isset($product->id))
			<div class="row" style="margin-bottom: 15px;">
				<div class="col-md-4 text-center" style="margin-bottom: 15px;">
					<button class="btn btn-success btn-block productTextAjax" type="button"
					target="{{ route('product.editajax', ['id' => $product->id]) }}">Product Detail</button>
				</div>

				<div class="col-md-4 text-center" style="margin-bottom: 15px;">
					<button class="btn btn-success btn-block productTextAjax" type="button" thirdparty="tinymce"
					target="{{ route('product.editproducttext', ['id' => $product->id]) }}">Product Text</button>
				</div>

				<div class="col-md-4 text-center" style="margin-bottom: 15px;">
					<button class="btn btn-success btn-block productTextAjax" type="button" 
					target="{{ route('product.editproductmedia', ['id' => $product->id]) }}">Product Images</button>
				</div>
			</div>
		@endif


		<form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" id="upload_form">
		{{ csrf_field() }}
		@if(isset($product->id))
			<input type="hidden" name="id" value="{{ $product->id }}" />
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
	      <h3 class="box-title">Product</h3>

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
			                  <label for="ProductNumber" class="col-sm-3 control-label">Product Number</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $product->ProductNumber or old('ProductNumber') }}" 
			                    placeholder="Product Number" name="ProductNumber">
			                  </div>
			                </div>
			                <div class="form-group">
			                  <label for="EAN" class="col-sm-3 control-label">EAN</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $product->EAN or old('EAN') }}" placeholder="EAN" name="EAN">
			                  </div>
			                </div>
		                </div>
		                <div class="col-md-6">
		                	<div class="form-group">
			                  <label for="ProductName" class="col-sm-3 control-label">Product Name</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $product->ProductName or old('ProductName') }}" placeholder="Product Name" name="ProductName">
			                  </div>
			                </div>
			                <div class="form-group">
			                  <label for="Active" class="col-sm-3 control-label">Active</label>

			                  <div class="col-sm-9">
			                  	@if($product->Active == 0)
			                    	<input type="checkbox" unchecked name="Active" style="position: relative;top: 7px;" value="1">
			                    @else
			                    	<input type="checkbox" checked name="Active" style="position: relative;top: 7px;" value="1">
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

		<div class="box box-success">
	    <div class="box-header with-border">
	      <h3 class="box-title">Classification</h3>

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
			                <div class="form-group">
			                  <label for="Classification" class="col-sm-2 control-label">Classification</label>

			                  <div class="col-sm-10">
			                    <select id="Classification" name="Classification" class="form-control">
			                    	<option value="">-----Select Classification------</option>
			                    	@foreach($classification as $keyCLass => $valClass)
			                    		@if(isset($product->ClassificationID))
				                    		@if( $product->ClassificationID == $valClass['key'] )
				                    			<option value="{{ $valClass['key'] }}" selected>{{ $valClass['value'] }}</option>
				                    		@else
				                    			<option value="{{ $valClass['key'] }}">{{ $valClass['value'] }}</option>
				                    		@endif
				                    	@else
				                    		@if( old('Classification') == $valClass['key'] )
				                    			<option value="{{ $valClass['key'] }}" selected>{{ $valClass['value'] }}</option>
				                    		@else
				                    			<option value="{{ $valClass['key'] }}">{{ $valClass['value'] }}</option>
				                    		@endif
			                    		@endif
			                    	@endforeach
			                    </select>
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
	      <h3 class="box-title">Supplier</h3>

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
	              		<div class="col-md-12">
			                <div class="form-group">
			                  <label for="Supplier" class="col-sm-2 control-label">Supplier</label>

			                  <div class="col-sm-10">
			                    <select id="Supplier" name="Supplier" class="form-control" style="width: 100%;height: 34px;">
			                    	<option value="">-----Select Supplier------</option>
			                    	@foreach($supplier as $keySupp => $valSupp)
			                    		@if(isset($product->SupplierID))
				                    		@if( $product->SupplierID == $valSupp['key'] )
				                    			<option value="{{ $valSupp['key'] }}" selected>{{ $valSupp['value'] }}</option>
				                    		@else
				                    			<option value="{{ $valSupp['key'] }}">{{ $valSupp['value'] }}</option>
				                    		@endif
				                    	@else
				                    		@if( old('Supplier') == $valSupp['key'] )
				                    			<option value="{{ $valSupp['key'] }}" selected>{{ $valSupp['value'] }}</option>
				                    		@else
				                    			<option value="{{ $valSupp['key'] }}">{{ $valSupp['value'] }}</option>
				                    		@endif
			                    		@endif
			                    	@endforeach
			                    </select>
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
	      <h3 class="box-title">Product Size</h3>

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
			                  <label for="Unit" class="col-sm-3 control-label">Unit</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $product->Unit or old('Unit') }}" placeholder="Unit" name="Unit">
			                  </div>
			                </div>
			                <div class="form-group">
			                  <label for="UnitPerLayer" class="col-sm-3 control-label">Unit per layer</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $product->UnitPerLayer or old('UnitPerLayer') }}" placeholder="Unit Per Layer" name="UnitPerLayer">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="ProductHeight" class="col-sm-3 control-label">Height (Cm)</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $product->ProductHeight or old('ProductHeight') }}" placeholder="Height" name="ProductHeight">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="ProductLength" class="col-sm-3 control-label">Length (Cm)</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $product->ProductLength or old('ProductLength') }}" placeholder="Length" name="ProductLength">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="Volume" class="col-sm-3 control-label">Volume</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $product->ProductVolume or old('ProductVolume') }}" placeholder="Volume" name="ProductVolume">
			                  </div>
			                </div>
		                </div>

		                <div class="col-md-6">
		                	<div class="form-group">
			                  <label for="QuantityPerUnit" class="col-sm-3 control-label">Number per unit</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $product->QuantityPerUnit or old('QuantityPerUnit') }}" placeholder="Number per unit" name="QuantityPerUnit">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="LayersPerPallet" class="col-sm-3 control-label">Layer per pallet</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $product->LayersPerPallet or old('LayersPerPallet') }}" placeholder="Layer per pallet" name="LayersPerPallet">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="ProductWidth" class="col-sm-3 control-label">Width (Cm)</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $product->ProductWidth or old('ProductWidth') }}" placeholder="Width" name="ProductWidth">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="ProductWeight" class="col-sm-3 control-label">Weight (Cm)</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $product->ProductWeight or old('ProductWeight') }}" placeholder="Weight" name="ProductWeight">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="ProductVolumeUnit" class="col-sm-3 control-label">Volume unit</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" value="{{ $product->ProductVolumeUnit or old('ProductVolumeUnit') }}" placeholder="Volume unit" name="ProductVolumeUnit">
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
	      <h3 class="box-title">Availability</h3>

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
			                  <label for="AvailableFrom" class="col-sm-3 control-label">Available from</label>

			                  <div class="col-sm-9">
			                    <div class="input-group date">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input type="text" class="form-control pull-right" id="AvailableFrom" placeholder="Available from" readonly name="ValidFrom" value="{{ $product->ValidFrom or old('ValidFrom') }}">
				                	</div>
			                  </div>
			                </div>

		                </div>

		                <div class="col-md-6">
		                	
		                	<div class="form-group">
			                  <label for="AvailableTo" class="col-sm-3 control-label">Available to</label>

			                  <div class="col-sm-9">
			                    <div class="input-group date">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input type="text" class="form-control pull-right" id="AvailableTo" placeholder="Available to" readonly name="ValidTo" value="{{ $product->ValidTo or old('ValidTo') }}">
				                	</div>
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
	      <h3 class="box-title">In Stock</h3>

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
	              		<div class="col-md-12">

			                <div class="form-group">
			                  <label for="Stock" class="col-sm-2 control-label">Stock</label>

			                  <div class="col-sm-10">					                  
					                <input type="text" class="form-control pull-right" id="Stock" placeholder="Stock" name="Stock" value="{{ $product->Stock or old('Stock') }}">
			                  </div>
			                </div>

		                </div>
	                </div>

	            </div	>

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
			                  <label for="UnitCustPrice" class="col-sm-3 control-label">Customer price</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" id="UnitCustPrice" placeholder="Customer price" name="UnitCustPrice" 
			                    value="{{ $product->UnitCustPrice or old('UnitCustPrice') }}">
			                  </div>
			                </div>
			                <div class="form-group">
			                  <label for="UnitCostPrice" class="col-sm-3 control-label">Cost price</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" id="UnitCostPrice" placeholder="Cost price" name="UnitCostPrice" 
			                    value="{{ $product->UnitCostPrice or old('UnitCostPrice') }}">
			                  </div>
			                </div>
		                </div>
		                <div class="col-md-6">
		                	<div class="form-group">
			                  <label for="Currency" class="col-sm-3 control-label">Currency</label>

			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" id="ProductCurrency" placeholder="Currency" name="ProductCurrency" 
			                    value="{{ $product->ProductCurrency or old('ProductCurrency') }}">
			                  </div>
			                </div>
			                <div class="form-group">
			                  <label for="VatID" class="col-sm-3 control-label">VAT Code</label>

			                  <div class="col-sm-9">
			                    <select class="form-control" id="VatID" name="VatID">
			                    	<option value="">-----Select Vat Code-----</option>
			                    	@foreach($vat as $keyVat => $valvat)
			                    		@if(isset($product->VatID))
				                    		@if( $product->VatID == $valvat['key'] ) 
				                    			<option value="{{ $valvat['key'] }}" selected>{{ $valvat['value'] }}</option>
				                    		@else
				                    			<option value="{{ $valvat['key'] }}">{{ $valvat['value'] }}</option>
				                    		@endif
				                    	@else
				                    		@if( old('VatID') == $valvat['key'] ) 
				                    			<option value="{{ $valvat['key'] }}" selected>{{ $valvat['value'] }}</option>
				                    		@else
				                    			<option value="{{ $valvat['key'] }}">{{ $valvat['value'] }}</option>
				                    		@endif
			                    		@endif
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
			$('#AvailableTo').datepicker({
				autoclose: true,
				orientation: 'bottom',
				format: 'yyyy-mm-dd'
		  });

		  $('#AvailableFrom').datepicker({
				autoclose: true,
				orientation: 'bottom',
				format: 'yyyy-mm-dd'
		  });

	    $('#Supplier').select2();

	    $('body').on('click', '.productTextAjax', function(){
	    	var target = $(this).attr('target');
	    	var thirdparty = $(this).attr('thirdparty');

	    	$.ajax({
	        method:"GET",
	        url:target,
	        success: function(result){
	            $("#ajaxLoad").html(result);

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

	    $('body').on('change', '.productTextLanguage', function(){
	    	
	    	var lang = $(this).val();
	    	var target = $(this).attr('target');

	    	$.ajax({
	        method:"GET",
	        url:target+'?lang='+lang,
	        success: function(result){
	            $("#ajaxLoad").html(result);
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
	            
	        },
	        error: function(e){
	          alert("Error");
	          console.log(e);
	        }
	      });
	    });

	    $('body').on('click', '.saveProductText', function(){
	    	tinyMCE.triggerSave();
	    	var formData = {
	                LanguageID : $('#LanguageID').val(),
	                ProductName : $('#ProductName').val(),
	                TeaserText : $('#TeaserText').val(),
	                SalesText : $('#SalesText').val(),
	                ProductText : $('#ProductText').val(),
	                TechnicalText : $('#TechnicalText').val(),
	                FeatureText : $('#FeatureText').val(),
	                _token  : $('meta[name="csrf-token"]').attr('content'),
	                _method: 'PUT',
	                id: $('#ProductTextID').val(),
	            }

	      console.log(formData);
	      // return false;

	      $.ajax({
	        method:"POST",
	        url:"{{ route('product.updateajax', ['id' => $product->id]) }}",
	        data: formData,
	        //dataType: "json",
	        success: function(result){
	            console.log(result);
	            if(result.error == 0){
	              alert("Update data Success");
	              $(".successProductText").fadeIn('slow');
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

	    var i = 1;
	    $("body").on('click', '.addproductmedia', function(){
	    	var addImage = '<div class="col-md-4">'
        									+'<div class="gmbr-node">'
          									+'<img src="/" class="img-responsive gmbr-node-img" id="viewImgAjax'+i+'" />'
        									+'</div>'
      									+'</div>'

      									+'<div class="col-md-8">'
          								+'<div class="form-group">'
            								+'<label for="inputMedia1">File input</label>'
            									+'<input type="file" class="form-control getImg" id="media_'+i+'" name="uploadImg[]" />'
            									+'<br />'
            									+'<input type="text" class="form-control" name="img_title[]" value="" />'
            									+'<br />'
            									+'<input type="text" class="form-control" name="externalurl[]" '
            									+'value="" placeholder="External Url" />'
          								+'</div>'
      									+'</div>'

      									+'<div class="clearfix" style="margin-bottom: 15px;"></div>';

      	$(".row-media").append(addImage);
      	i = i+1;
	    });

	    $("body").on('click', '.saveProductMedia', function(){

	    	$.ajax({
	        method:"POST",
	        url:"{{ route('product.updateproductmediaajax', ['id' => $product->id]) }}",
	        data: new FormData($("#upload_form")[0]),
	        contentType: false,
					cache: false,
					processData:false,
	        success: function(result){
	            console.log(result);
	            
	            if(result.error == 0){
	              alert("Update data Success");
	              $(".successProductMedia").fadeIn('slow');
	              $(".mediadb").val("");
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

	    $("body").on('click', '.deleteImg', function(e){

		    e.preventDefault();
		    var $this = $(this);

		    var getID = $this.attr('href');
		    getID = getID.split("/");
		    getID = getID[getID.length-1];

		    $.ajax({
		        type: 'post',
		        url: $this.attr('href'),
		        data: {_method: $this.data('method'), _token :$('meta[name="csrf-token"]').attr('content')},
		    }).done(function (data) {
		        alert('success');
		        $("#delete_"+getID).fadeOut('slow');
		        console.log(data);
		    });

	    });

	    function readURL(input, i) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#viewImgAjax'+i).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    	}

    	function readURLdb(input, i) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#viewImg_'+i).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    	}

	    $("body").on('change', '#media1', function(){
	        readURL(this);
	    });

	    $("body").on('change', '.getImg', function(){
	    		var mediaID = $(this).attr('id');
	    		mediaID = mediaID.split('_');
	    		readURL(this, mediaID[1]);
	    });

	    $("body").on('change', '.mediadb', function(){
	    		var mediaID = $(this).attr('id');
	    		mediaID = mediaID.split('_');
	    		readURLdb(this, mediaID[1]);
	    });

	});
	</script>
@endsection