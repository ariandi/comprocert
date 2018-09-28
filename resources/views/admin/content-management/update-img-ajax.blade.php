  <!-- Default box -->
  <div class="box imgLoad">
    <div id="imgLoadAjax">
    <div class="box-header with-border">
      <h3 class="box-title">Update Content Text Page</h3>

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

                  @if($nodes->getImages)
                    <input type="hidden" name="mediastorage_id1" value="{{ $nodes->getImages->id }}" />
                  @endif

                  <div class="col-md-3">
                    <div class="gmbr-node">
                      <img src="{{ $nodes->getImages?url( Storage::url($nodes->getImages->path )):'' }}" 
                      class="img-responsive gmbr-node-img" />
                    </div>
                  </div>

                  <div class="col-md-9">
                      <div class="form-group {{ $errors->has('media1') ? 'has-error' : '' }}">
                        <label for="inputMedia1">File input</label>
                        <input type="file" class="form-control" name="media1" />
                        <br />
                        <input type="text" class="form-control" name="img_title1" 
                        value="{{ $nodes->getImages?$nodes->getImages->title:'' }}">
                        <br />
                        <input type="text" class="form-control"
                        name="externalurl1" value="{{ $nodes->getImages?$nodes->getImages->external_url:'' }}" 
                        placeholder="External Url">
                      </div>
                  </div>

                  <div class="clearfix"></div>
                  <br />
                  <br />

                  {{-- ////////////////////////////////////////Lanjut kang hajar///////////////////// --}}

                  @if($nodes->getImages2)
                    <input type="hidden" name="mediastorage_id2" value="{{ $nodes->getImages2 ? $nodes->getImages2->id : '' }}" />
                  @endif

                  <div class="col-md-3">
                    <div class="gmbr-node">
                      <img src="{{ $nodes->getImages2?url(Storage::url($nodes->getImages2->path)):'' }}" 
                      class="img-responsive gmbr-node-img" />
                    </div>
                  </div>

                  <div class="col-md-9">
                      <div class="form-group {{ $errors->has('media2') ? 'has-error' : '' }}">
                        <label for="inputMedia1">File input 2</label>
                        <input type="file" class="form-control" name="media2">
                        <br />
                        <input type="text" class="form-control" name="img_title2" 
                        value="{{ $nodes->getImages2 ? $nodes->getImages2->title : '' }}">
                        <br />
                        <input type="text" class="form-control"
                        name="externalurl2" value="{{ $nodes->getImages2 ? $nodes->getImages2->external_url : '' }}" 
                        placeholder="External Url">
                      </div>
                  </div>

                  <div class="clearfix"></div>
                  <br />
                  <br />


                  {{-- ////////////////////////////////////////Lanjut kang hajar///////////////////// --}}

                  @if($nodes->getImages3)
                    <input type="hidden" name="mediastorage_id3" value="{{ $nodes->getImages3 ? $nodes->getImages3->id : '' }}" />
                  @endif

                  <div class="col-md-3">
                    <div class="gmbr-node">
                      <img src="{{ $nodes->getImages3?url(Storage::url($nodes->getImages3->path)):'' }}" 
                      class="img-responsive gmbr-node-img" />
                    </div>
                  </div>

                  <div class="col-md-9">
                      <div class="form-group {{ $errors->has('media3') ? 'has-error' : '' }}">
                        <label for="inputMedia1">File input 3</label>
                        <input type="file" class="form-control" name="media3">
                        <br />
                        <input type="text" class="form-control" name="img_title3" 
                        value="{{ $nodes->getImages3 ? $nodes->getImages3->title : '' }}">
                        <br />
                        <input type="text" class="form-control"
                        name="externalurl3" value="{{ $nodes->getImages3 ? $nodes->getImages3->external_url : '' }}" 
                        placeholder="External Url">
                      </div>
                  </div>

                  <div class="clearfix"></div>
                  <br />
                  <br />


                  {{-- ////////////////////////////////////////Lanjut kang hajar///////////////////// --}}

                  @if($nodes->getImages4)
                    <input type="hidden" name="mediastorage_id4" value="{{ $nodes->getImages4 ? $nodes->getImages4->id : '' }}" />
                  @endif

                  <div class="col-md-3">
                    <div class="gmbr-node">
                      <img src="{{ $nodes->getImages4?url(Storage::url($nodes->getImages4->path)):'' }}" 
                      class="img-responsive gmbr-node-img" />
                    </div>
                  </div>

                  <div class="col-md-9">
                      <div class="form-group {{ $errors->has('media4') ? 'has-error' : '' }}">
                        <label for="inputMedia1">File input 4</label>
                        <input type="file" class="form-control" name="media4">
                        <br />
                        <input type="text" class="form-control" name="img_title4" 
                        value="{{ $nodes->getImages4 ? $nodes->getImages4->title : '' }}">
                        <br />
                        <input type="text" class="form-control"
                        name="externalurl4" value="{{ $nodes->getImages4 ? $nodes->getImages4->external_url : '' }}" 
                        placeholder="External Url">
                      </div>
                  </div>

                  <div class="clearfix"></div>
                  <br />
                  <br />
                  {{-- ////////////////////////////////////////Lanjut kang hajar///////////////////// --}}

                  <hr />
              </div>

            <div class="box-footer">
              <button type="button" class="btn btn-primary save-node-img">Submit</button>
            </div>

    </div>
    <!-- /.box-body -->
    <!-- /.box-footer-->
    </div>
  </div>
  <!-- /.box -->