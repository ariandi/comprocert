  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Update Content Management Page</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#node_detail" data-toggle="tab" aria-expanded="true">Node Detail</a></li>
          <li class="pull-right"><a href="{{ route('nodes.index') }}" class="text-muted">Back to list</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="node_detail">

            @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div><br />
            @endif

              <div class="box-body">
                  <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', $nodes->title, array('class' => 'form-control')) }}

                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="form-group {{ $errors->has('template') ? 'has-error' : '' }}">
                    {{ Form::label('template', 'Templates') }}
                    {{ Form::select('template', $arrTemplates, $nodes->template,
                                    ['placeholder' => 'Pick a Template...', 'class' => 'form-control']) }}

                    @if ($errors->has('keyword'))
                        <span class="help-block">
                            <strong>{{ $errors->first('keyword') }}</strong>
                        </span>
                    @endif
                  </div>


                  <div class="form-group {{ $errors->has('alias') ? 'has-error' : '' }}">
                    {{ Form::label('alias', 'Alias') }}
                    {{ Form::text('alias', $nodes->alias, array('class' => 'form-control')) }}

                    @if ($errors->has('alias'))
                        <span class="help-block">
                            <strong>{{ $errors->first('alias') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    {{ Form::label('description', 'Description') }}
                    {{ Form::text('description', $nodes->description, array('class' => 'form-control')) }}

                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="form-group {{ $errors->has('keyword') ? 'has-error' : '' }}">
                    {{ Form::label('keyword', 'Keyword') }}
                    {{ Form::text('keyword', $nodes->keyword, array('class' => 'form-control')) }}

                    @if ($errors->has('keyword'))
                        <span class="help-block">
                            <strong>{{ $errors->first('keyword') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="form-group {{ $errors->has('active') ? 'has-error' : '' }}">
                    {{ Form::label('active', 'Active') }}
                    {{ Form::checkbox('active', 1, $nodes->active, ['class' => '']) }}
                  </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              
          </div>
          <!-- /.tab-pane -->
          
        </div>
        <!-- /.tab-content -->
      </div>

    </div>
    <!-- /.box-body -->
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->