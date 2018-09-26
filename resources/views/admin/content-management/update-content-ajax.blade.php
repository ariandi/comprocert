  <!-- Default box -->
  <div class="box">
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

              <div class="form-group {{ $errors->has('content1') ? 'has-error' : '' }}"> 
                <label for="content1">Content</label>
                <textarea class="form-control" name="content1" type="text" id="content1">{{ $nodes->content1 }}</textarea>
                @if ($errors->has('content1'))
                    <span class="help-block">
                        <strong>{{ $errors->first('content1') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group {{ $errors->has('content2') ? 'has-error' : '' }}">
                <label for="content2">Content 2</label>
                <textarea class="form-control" name="content2" type="text" id="content2">{{ $nodes->content2 }}</textarea>
                @if ($errors->has('content2'))
                    <span class="help-block">
                        <strong>{{ $errors->first('content2') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group {{ $errors->has('content3') ? 'has-error' : '' }}">
                <label for="content3">Content 3</label>
                <textarea class="form-control" name="content3" type="text" id="content3">{{ $nodes->content3 }}</textarea>
                @if ($errors->has('content3'))
                    <span class="help-block">
                        <strong>{{ $errors->first('content3') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group {{ $errors->has('content4') ? 'has-error' : '' }}">
                <label for="content4">Content 4</label>
                <textarea class="form-control" name="content4" type="text" id="content4">{{ $nodes->content4 }}</textarea>
                @if ($errors->has('content4'))
                    <span class="help-block">
                        <strong>{{ $errors->first('content4') }}</strong>
                    </span>
                @endif
              </div>

              <div class="box-footer">
                <button type="button" class="btn btn-primary save-node-content">Submit</button>
              </div>

    </div>
    <!-- /.box-body -->
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->