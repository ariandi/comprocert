@extends('admin.layouts.master')

@section('title') 
Product 
@endsection

@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href="{{ url('admin/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ url('admin/product') }}">@yield('title')</a></li>
</ol>
@endsection

@section('css_custom')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
	<section class="content">

		<div class="box collapsed-box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Create New Product</h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                title="Collapse">
	          <i class="fa fa-plus"></i></button>
	      </div>
	    </div>
	    <div class="box-body" style="display: none;">
	      <div class="row">

	        <div class="col-xs-12">
	        	<a class="btn btn-success" href="{{ route('products.create') }}">Create New Product</a>
	        </div>

	      </div>

	    </div><!-- /.box-body -->
	  </div>

	  <!-- Default box -->
	  <div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Products</h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                title="Collapse">
	          <i class="fa fa-minus"></i></button>
	      </div>
	    </div>
	    <div class="box-body">
	      <div class="row">

	        <div class="col-xs-12">

	          	<div class="panel panel-default">
                	<div class="panel-heading">Product List</div>

	                <div class="panel-body">
	                    <table class="table table-hover table-bordered table-striped datatable" style="width:100%">
	                        <thead>
	                            <tr>
	                                <th>Id</th>
	                                <th>Product Number</th>
	                                <th>Product Name</th>
	                                <th>Classification</th>
	                                <th>Supplier</th>
	                                <th>Cost Price</th>
	                                <th>Cust Price</th>
	                                <th>Action</th>
	                            </tr>
	                        </thead>
	                    </table>
	            	</div>
	            </div>

	        </div>

	      </div>
	      <div class="ajax-content">
	      </div>
	    </div>
	    <!-- /.box-body -->
	    <div class="box-footer">
	      Footer
	    </div>
	    <!-- /.box-footer-->
	  </div>
	  <!-- /.box -->

	</section>
@endsection

@section('addingFileJs')
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
@endsection

@section('addingScriptJs')
	<script type="text/javascript">
	$(document).ready(function() {
	    var table = $('.datatable').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{{ route('products.getdatatablesdata') }}',
	        columns: [
	            {data: 'id', name: 'products.id'},
	            {data: 'ProductNumber', name: 'products.ProductNumber'},
	            {data: 'ProductName', name: 'producttexts.ProductName', orderable: true, searchable: true},
	            {data: 'ClassificationID', name: 'products.ClassificationID'},
	            {data: 'SupplierID', name: 'products.SupplierID'},
	            {data: 'UnitCostPrice', name: 'products.UnitCostPrice'},
	            {data: 'UnitCustPrice', name: 'products.UnitCustPrice'},
	            {data: 'action', name: 'action', orderable: false, searchable: false}
	        ]
	    });

	  //   $('body').on('click', '.savelang', function(){
	  //   	var formData = {
   //              language_id : $('#language_id').val(),
   //              language_string_text_id : $('#languagestringtextid').val(),
   //              language_string : $('#languagestring').val(),
   //              _token  : $('meta[name="csrf-token"]').attr('content'),
   //              _method: 'post',
   //              id: $('#langs-id').val(),
   //          }

   //          $.ajaxSetup({
			//     headers: {
			//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			//     }
			// });

			// if(formData.language_id == '' || formData.language_string_text_id == '' || formData.language_string == ''){
			// 	alert('Fill All Data.')
			// 	return false;
			// }

			// console.log(formData);

			// $.ajax({
	  //           type: 'post',
	  //           url: '{{ route('languagestring.storeLangs') }}',
	  //           data: formData,
	  //       }).done(function (data) {
	  //           if(data == 'Success'){
	  //           	alert(data);
	  //           	$('#langs-id').val('');
	  //           	$('#language_id').val('');
	  //   			$("#languagestringtextid").val('');
	  //   			$("#languagestring").val('');
	  //           	table.ajax.reload();
	  //           }else{
	  //           	alert(data);
	  //           }
	  //       });
	  //   });

	    // $("body").on('click', '.editLangs', function(){
	    // 	var id = $(this).attr('id');
	    // 		id = id.split("_");
	    // 		id = id[1];
	    // 		languageid = $(this).attr('languageid');
	    // 		textid = $(this).attr('textid');
	    // 		langstr = $(this).attr('langstr');
	    		
	    // 		$('#language_id').val(languageid);
	    // 		$("#languagestringtextid").val(textid);
	    // 		$("#languagestring").val(langstr);
	    // 		$("#langs-id").val(id);
	    // });
	});
	</script>
@endsection