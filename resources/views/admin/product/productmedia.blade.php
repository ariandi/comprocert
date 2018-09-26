@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="alert alert-info successProductMedia" style="display: none;">
    <p>Success save the data.</p>
</div>

<div style="margin-bottom: 15px;">
	<button class="btn btn-primary addproductmedia" type="button">New Product Image</button>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Product Media ( {{ $productmedia->id??null }} ) / Product ID ( {{ $product->id }} )</h3>
    <input type="hidden" id="ProductMediaID" value="" />

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
    
  <div class="box-body">
    <div class="row row-media">

    	<input type="hidden" id="ProductID" value="{{ $product->id }}" />

    	@if($mediastorage != null)
    	@foreach($mediastorage as $keyMedia => $valMedia)
    		<div id="delete_{{ $valMedia->id }}">
		      <input type="hidden" name="mediastorage_id[]" value="{{ $valMedia->id }}" />

		      <div class="col-md-4">
		        <div class="gmbr-node">
		          <img src="{{ url('storage/'.$valMedia->path) }}" class="img-responsive gmbr-node-img" id="viewImg_{{ $keyMedia+1 }}" />
		        </div>
		      </div>

		      <div class="col-md-8">
		          <div class="form-group">
		            <label for="inputMedia1">File input</label>
		            <input type="file" class="form-control mediadb" name="mediadb[]" id="mediadb_{{ $keyMedia+1 }}" />
		            <br />
		            <input type="text" class="form-control" name="img_titledb[]" value="{{ $valMedia->title }}" />
		            <br />
		            <input type="text" class="form-control"
		            name="externalurldb[]" value="{{ $valMedia->external_url }}" placeholder="External Url" />
		            <br />
		            <a class="btn btn-danger deleteImg" data-method="delete" 
		            href="{{ route('product.deleteproductmediaajax', ['id' => $valMedia->id]) }}">
		            	Delete
		            </a>
		          </div>
		      </div>
		      <div class="clearfix" style="margin-bottom: 15px;"></div>
	      </div>
      @endforeach
      @endif

    </div><!-- row -->
  </div>
</div>

<div class="panel">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-offset-5 col-md-2 text-center">
				<a href="#" class="btn btn-default">Cancel</a>
				&nbsp;
				<input type="button" value="Save" class="btn btn-primary saveProductMedia" />
			</div>
		</div>
	</div>
</div>
