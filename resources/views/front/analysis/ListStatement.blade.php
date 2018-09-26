<div>
	<div class="data{{ $data['mainnode'] }}">
		<div class="col-md-12">
			<form action="{{ route('api.myanalyses.addstatement') }}" method="post">
			{{csrf_field()}}

			<input type="hidden" name="parentnode" value="{{ $data['mainnode'] }}">
			<input type="hidden" name="tipe" value="{{ $data['tipe'] }}">

			<table class="table table-striped table-bordered col-md-6 mx-auto" style="margin-bottom: 0px;">
				<thead>
					<tr>
						<th>
							<span class="col-md-2">{{ Menus::getLanguageString('idName') }}</span>
							<input id="{{ $data['mainnode'] }}" type="text" class="form-control col-md-8 pull-right search" value="">
						</th>
						<th style="width: 10%">
							<h3 id="{{ $data['mainnode'] }}" class="tutup" style="margin: 0px;cursor: pointer;">
								<i class="fa fa-window-close"></i>
							</h3>
						</th>
					</tr>
				</thead>
			</table>
			<div style="max-height: 400px;overflow: overlay;">
			<table class="table table-striped table-bordered col-md-6 mx-auto" id="datatable{{ $data['mainnode'] }}">
				<tbody>
					@foreach ($data['statements'] as $key => $value)

					<tr>
						<td>{{ $value->Title }}</td>
						<td style="width: 10.7%">
							<input type="checkbox" name="statement[]" value="{{ $value->NodeID }}">
						</td>
					</tr>

					@endforeach
				</tbody>
			</table>
			</div>
			<input type="submit" name="simpan" value="Simpan" class="btn btn-success">
			</form>
		</div>
	</div>
</div>
@section('addingScriptJs')
<script type="text/javascript">
 $(document).ready(function(){
    $('.tutup').click(function(){
      	var id = $(this).attr('id');
      	$('.data'+id).slideUp( "slow", function() {
        // Animation complete.
    	});
    });

    $(".search").on("keyup", function() {
    	var id = $(this).attr('id');
	    var value = $(this).val().toLowerCase();
	    $("#datatable"+id+" tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
  	});

  });
</script>
@section('content')
