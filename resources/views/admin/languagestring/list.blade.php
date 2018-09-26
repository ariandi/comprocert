@extends('admin.layouts.master')

@section('title')
Language String
@endsection

@section('titlecontent')
Language String
@endsection

@section('subtitlecontent')
List
@endsection

@section('style')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
	<section class="content">

	  <!-- Default box -->
	  <div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Language String Page</h3>

	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                title="Collapse">
	          <i class="fa fa-minus"></i></button>
	        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
	          <i class="fa fa-times"></i></button>
	      </div>
	    </div>
	    <div class="box-body">
	      <div class="row">
	        {{-- <div class="col-xs-12 text-center"> --}}
	        <div class="col-xs-12">
	          	
	          	<div class="panel panel-default">
                	<div class="panel-heading">Add Language String</div>

	                <div class="panel-body" id="bodyPanel">
	                	
	                	<form class="form-inline loadform" method="post">
	                	  {{ csrf_field() }}
	                	  <input type="hidden" id="langs-id" />
			              <div class="box-body row">
			              	<div class="col-md-2">
				                <div class="form-group wd-100">
				                  {{ Form::select('language_id', $arrLangList, null,
                                    ['placeholder' => 'Select Language ID', 
                                    	'class' => 'form-control', 'id' => 'language_id' ]) }}
				                </div>
			                </div>

			                <div class="col-md-4">
				                <div class="form-group">
				                  <input type="text" class="form-control" id="languagestringtextid" placeholder="Language String Text ID" />
				                </div>
				            </div>

				            <div class="col-md-4">
				                <div class="form-group">
				                  <input type="text" class="form-control" id="languagestring" placeholder="Language String" />
				                </div>
				            </div>

				            <div class="col-md-2">
				            	<button type="button" class="btn btn-primary form-group savelang">Submit</button>
			                </div>
			              </div>
			              <!-- /.box-body -->
			            </form>

	            	</div>
	            </div>

	          	<div class="panel panel-default">
                	<div class="panel-heading">Language String List</div>

	                <div class="panel-body">
	                    <table class="table table-hover table-bordered table-striped datatable" style="width:100%">
	                        <thead>
	                            <tr>
	                                <th>Id</th>
	                                <th>Langauge ID</th>
	                                <th>Language String Text ID</th>
	                                <th>Langauge String</th>
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
	        ajax: '{{ route('languagestring.getLangs') }}',
	        columns: [
	            {data: 'id', name: 'id'},
	            {data: 'language_id', name: 'language_id'},
	            {data: 'language_string_text_id', name: 'language_string_text_id'},
	            {data: 'language_string', name: 'language_string'},
	            {data: 'action', name: 'action', orderable: false, searchable: false}
	        ]
	    });

	    $('body').on('click', '.savelang', function(){
	    	var formData = {
                language_id : $('#language_id').val(),
                language_string_text_id : $('#languagestringtextid').val(),
                language_string : $('#languagestring').val(),
                _token  : $('meta[name="csrf-token"]').attr('content'),
                _method: 'post',
                id: $('#langs-id').val(),
            }

            $.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

			if(formData.language_id == '' || formData.language_string_text_id == '' || formData.language_string == ''){
				alert('Fill All Data.')
				return false;
			}

			console.log(formData);

			$.ajax({
	            type: 'post',
	            url: '{{ route('languagestring.storeLangs') }}',
	            data: formData,
	        }).done(function (data) {
	            if(data == 'Success'){
	            	alert(data);
	            	$('#langs-id').val('');
	            	$('#language_id').val('');
	    			$("#languagestringtextid").val('');
	    			$("#languagestring").val('');
	            	table.ajax.reload();
	            }else{
	            	alert(data);
	            }
	        });
	    });

	    $("body").on('click', '.editLangs', function(){
	    	var id = $(this).attr('id');
	    		id = id.split("_");
	    		id = id[1];
	    		languageid = $(this).attr('languageid');
	    		textid = $(this).attr('textid');
	    		langstr = $(this).attr('langstr');
	    		
	    		$('#language_id').val(languageid);
	    		$("#languagestringtextid").val(textid);
	    		$("#languagestring").val(langstr);
	    		$("#langs-id").val(id);
	    });
	});
	</script>
@endsection