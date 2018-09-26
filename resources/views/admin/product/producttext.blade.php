@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="alert alert-info successProductText" style="display: none;">
    <p>Success save the data.</p>
</div>

<div style="margin-bottom: 15px;">
	<button class="btn btn-primary" type="button">New Product Text</button>
</div>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Product text ( {{ $productText->LanguageID??null }} )</h3>
    <input type="hidden" id="ProductTextID" value="{{ $productText->id??null }}" />

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
	                  <label for="LanguageID" class="col-sm-3 control-label">Language</label>

	                  <div class="col-sm-9">
	                  	<select id="LanguageID" 
	                  	class="form-control productTextLanguage" target="{{ route('product.editproducttext', ['id' => $product->id]) }}">
	                  		<option value="">-------Select Language-------</option>
	                  		@foreach($langList as $ll)
	                  			@if($ll['key'] == $productText->LanguageID)
	                  				<option value="{{ $ll['key'] }}" selected>{{ $ll['value'] }}</option>
	                  			@else
	                  				<option value="{{ $ll['key'] }}">{{ $ll['value'] }}</option>
	                  			@endif
	                  		@endforeach
	                  	</select>
	                    {{-- <input type="text" class="form-control" value="{{ $product->ProductNumber or old('ProductNumber') }}" 
	                    placeholder="Product Number" name="ProductNumber" /> --}}
	                  </div>
	                </div>
	                <div class="form-group">
	                  <label for="ProductName" class="col-sm-3 control-label">Product Name</label>

	                  <div class="col-sm-9">
	                    <input type="text" class="form-control" value="{{ $productText->ProductName or old('ProductName') }}" 
	                    placeholder="Product Name" id="ProductName">
	                  </div>
	                </div>

	                <div class="form-group">
	                  <label for="TeaserText" class="col-sm-3 control-label">Teaser Text</label>

	                  <div class="col-sm-9">
	                  	<textarea name="TeaserText"
	                  		class="form-control" rows="10">{{ $productText->TeaserText or old('TeasetText') }}</textarea>
	                  </div>
	                </div>

	                <div class="form-group">
	                  <label for="SalesText" class="col-sm-3 control-label">Sales Text</label>

	                  <div class="col-sm-9">
	                  	<textarea name="SalesText" 
	                  		class="form-control" rows="10">{{ $productText->SalesText or old('SalesText') }}</textarea>
	                  </div>
	                </div>

	                <div class="form-group">
	                  <label for="ProductText" class="col-sm-3 control-label">Functions</label>

	                  <div class="col-sm-9">
	                  	<textarea name="ProductText" 
	                  		class="form-control" rows="10">{{ $productText->ProductText or old('ProductText') }}</textarea>
	                  </div>
	                </div>

	                <div class="form-group">
	                  <label for="TechnicalText" class="col-sm-3 control-label">Technical text</label>

	                  <div class="col-sm-9">
	                  	<textarea name="TechnicalText" 
	                  		class="form-control" rows="10">{{ $productText->TechnicalText or old('TechnicalText') }}</textarea>
	                  </div>
	                </div>

	                <div class="form-group">
	                  <label for="FeatureText" class="col-sm-3 control-label">Description</label>

	                  <div class="col-sm-9">
	                  	<textarea name="FeatureText" 
	                  		class="form-control" rows="10">{{ $productText->FeatureText or old('FeatureText') }}</textarea>
	                  </div>
	                </div>
                </div>
                <div class="col-md-6">
                	<div>&nbsp;</div>
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
				<input type="button" value="Save" class="btn btn-primary saveProductText" />
			</div>
		</div>
	</div>
</div>
