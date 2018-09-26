@extends('admin.layouts.master')

@section('title') 
Create Statement
@endsection

@section('breadcrumb')
<h1>@yield('title')<!-- <small></small> --></h1>
<ol class="breadcrumb">
    <li><a href="{{ url('admin/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{ url('admin/statements') }}">Statement</a></li>
    <li class="active"><a href="{{ route('statements.create') }}">@yield('title')</a></li>
</ol>
@endsection

@section('css_custom')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
	<section class="content">

		@if(isset($statement->id))
			<div class="row" style="margin-bottom: 15px;">
				<div class="col-md-4 text-center" style="margin-bottom: 15px;">
					<button class="btn btn-success btn-block productTextAjax" type="button"
					target="{{ route('statements.edit-ajax', ['id' => $statement->id]) }}">Statement Detail</button>
				</div>

				<div class="col-md-4 text-center" style="margin-bottom: 15px;">
					<button class="btn btn-success btn-block productTextAjax" type="button" thirdparty="tinymce"
					target="{{ route('statements.get-product', ['id' => $statement->id]) }}">Product Related</button>
				</div>
			</div>
		@endif

		<form action="{{ route('statements.update', ['id' => $statement->id, 'parent' => $parent, 'lvl' => session()->get('lvl1Val')]) }}" method="post" enctype="multipart/form-data" id="upload_form">
		{{ csrf_field() }}
		@if(isset($statement->id))
			<input type="hidden" name="id" value="{{ $statement->id }}" />
			<input type="hidden" name="_method" value="PUT" />
		@endif

			<input type="hidden" name="InsertedByPersonID" value="{{ Auth::user()->id }}" />
			<input type="hidden" name="UpdatedByPersonID" value="{{ Auth::user()->id }}" />
			<input type="hidden" name="tablename" value="statements" />
			<input type="hidden" name="primarykey" value="0" />

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
	      <h3 class="box-title">Statement Data</h3>

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
			                  <label for="title" class="col-sm-3 control-label">Statement Title</label>
			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $statement->title or old('title') }}" placeholder="Statement Title name" name="title">
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="description" class="col-sm-3 control-label">Description</label>
			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $statement->description or old('description') }}" placeholder="Description" 
			                    name="description">
			                  </div>
			                </div>
			                
		                </div>

		                {{-- ////////////////Kanan////////////////////// --}}
		                <div class="col-md-6">
		                	
		                	<div class="form-group">
			                  <label for="active" class="col-sm-3 control-label">Active</label>
			                  <div class="col-sm-9">
			                    <input type="text" class="form-control" 
			                    value="{{ $statement->active or old('active') }}" placeholder="Active" name="active">
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
						<a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('delete-statement').submit();" class="btn btn-danger">Delete</a>
						&nbsp;
						<input type="submit" value="Save" class="btn btn-primary" />
					</div>
				</div>
			</div>
		</div>

		</form>

		<form id="delete-statement" action="{{ route('statements.destroy',$statement->id) }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="DELETE" />
    </form>


    <div class="box box-success">
	    <div class="box-header with-border">
	      <h3 class="box-title">Child Statement</h3>

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
	  									
	  									<div class="panel panel-default">

			                	<div class="panel-heading">Child Statement List</div>

				                <div class="panel-body" id="ajaxChild">
				                	<div  id="ajaxChildLoad">
				                    <table class="table table-hover table-bordered table-striped" style="width:100%">
				                        <thead>
				                            <tr>
				                                <th>No</th>
				                                <th>Title</th>
				                                <th>Action</th>
				                                <th>Priority</th>
				                            </tr>
				                        </thead>
				                        <tbody>
				                        	@foreach($statementchildstr as $key => $st)
				                        	<tr>
				                        		<td>{{ $key+1 }}</td>
				                        		<td>{{ $st->title }} ( {{ $st->child_id }} )</td>
				                        		<td><a href="{{ route('statements.link-unlink', ['id' => $st->id, 'parent' => $statement->id, 'link' => 0]) }}"
                            						class="unlink" id="{{ $st->id }}" data-method="PUT">Unlink</a></td>
				                        		<td><input type="text" id="{{ $st->id }}" class="form-control priorityChild" value="{{ $st->priority }}"/></td>
				                        	</tr>
				                        	@endforeach
				                        </tbody>
				                    </table>
				                    <div class="pull-right">
				                    	<button type="button" class="btn btn-success savePriority">Save Priority</button>
				                    </div>

				                    <div style="clear: both"></div>
				                  </div>
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
	      <h3 class="box-title">All Statement</h3>

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
	  									
	  									<div class="panel panel-default">

			                	<div class="panel-heading">Statement List</div>

				                <div class="panel-body">
				                    <table class="table table-hover table-bordered table-striped datatable" style="width:100%">
				                        <thead>
				                            <tr>
				                                <th>Id</th>
				                                <th>Title</th>
				                                <th>Action</th>
				                            </tr>
				                        </thead>
				                        
				                    </table>
				            		</div>

					            </div>

	  								</div>
	                </div>
	            </div>

		      	</div>

		    </div><!-- /.box-body -->
		  </div>
		</div>

		</div> {{-- ///////////////Ajax Call///////////// --}}

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
	        ajax: '{{ route('statements.get-data-tables-data',$statement->id) }}',
	        pageLength: 100,
	        columns: [
	            {data: 'id', name: 'id'},
	            {data: 'title', name: 'Title'},
	            {data: 'action', name: 'action', orderable: false, searchable: false}
	        ]
	    });

	    $("body").on('click', '.unlink', function(e){

        e.preventDefault();

        var $this = $(this);

        $.ajax({
            type: 'post',
            url: $this.attr('href'),
            data: {_method: $this.data('method'), _token :$('meta[name="csrf-token"]').attr('content')},
        }).done(function (data) {     
            console.log(data);
            alert(data);
            $('#ajaxChild').load('{{ route('statements.edit',['id' => $statement->id, 'parent' => $parent, 'lvl' => session()->get('lvl')]) }} #ajaxChildLoad');
            table.ajax.reload();
        });
      });

      $('body').on('click', '.savePriority', function(){
      	var data = [];
      	$('.priorityChild').each(function(){
      		data.push({'id' : $(this).attr('id'), 'val' : $(this).val()});
      	});

      	$.ajax({
            type: 'post',
            url: '{{ route('statements.priority') }}',
            data: {_method: 'PUT', _token :$('meta[name="csrf-token"]').attr('content'), data:data},
        }).done(function (data) {     
            console.log(data);
            alert(data);
            $('#ajaxChild').load('{{ route('statements.edit',['id' => $statement->id, 'parent' => $parent, 'lvl' => session()->get('lvl')]) }} #ajaxChildLoad');
        });

      });

      $('body').on('click', '.productTextAjax', function(){
	    	var target = $(this).attr('target');
	    	var thirdparty = $(this).attr('thirdparty');

	    	$.ajax({
	        method:"GET",
	        url:target,
	        success: function(result){
	            $("#ajaxLoad").html(result);
	            var table = $('.datatable').DataTable({
					        processing: true,
					        serverSide: true,
					        ajax: '{{ route('statements.get-data-tables-data',$statement->id) }}',
					        pageLength: 100,
					        columns: [
					            {data: 'id', name: 'id'},
					            {data: 'title', name: 'Title'},
					            {data: 'action', name: 'action', orderable: false, searchable: false}
					        ]
					    });

					    var table2 = $('.datatable2').DataTable({
					        processing: true,
					        serverSide: true,
					        ajax: '{{ route('statements.get-product-all',$statement->id) }}',
					        pageLength: 100,
					        columns: [
					            {data: 'id', name: 'id'},
					            {data: 'ProductName', name: 'ProductName'},
					            {data: 'action', name: 'action', orderable: false, searchable: false}
					        ]
					    });

					  $('body').on('click', '.unlink-prod', function(e){
					  	e.preventDefault();
					  	var $this = $(this);
					  	$.ajax({
			            type: 'post',
			            url: $this.attr('href'),
			            data: {_method: $this.data('method'), _token :$('meta[name="csrf-token"]').attr('content')},
			        }).done(function (data) {     
			            console.log(data);
			            alert(data);
			            $('#ajaxLoad').load('{{ route('statements.get-product', ['id' => $statement->id]) }}', function(){
									    var table2 = $('.datatable2').DataTable({
									        processing: true,
									        serverSide: true,
									        ajax: '{{ route('statements.get-product-all',$statement->id) }}',
									        pageLength: 100,
									        columns: [
									            {data: 'id', name: 'id'},
									            {data: 'ProductName', name: 'ProductName'},
									            {data: 'action', name: 'action', orderable: false, searchable: false}
									        ]
									    });
									});    
			            // table2.ajax.reload();
			        });
					  });


	        },
	        error: function(e){
	          alert("Error");
	          console.log(e);
	        }
	      });
	    });

	    $('body').on('change', '#tablenameProd', function(){
	    	$.ajax({
            type: 'post',
            url: '{{ route('statements.edit-tablename',$statement->id) }}',
            data: {_method: 'PUT', _token :$('meta[name="csrf-token"]').attr('content'), data:$(this).val()},
        }).done(function (data) {     
            console.log(data);
            alert(data);
        });
	    })
	});
	</script>
@endsection