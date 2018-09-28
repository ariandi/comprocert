@extends('admin.layouts.master')

@section('title')
Create Publish2
@endsection

@section('titlecontent')
Publish2
@endsection

@section('subtitlecontent')
create
@endsection

@section('content')
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Create Content Management Page</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="link-back-to-list">
        <a href="{{ route('nodes.index') }}">Back to list</a>
        <hr />
      </div>

      @if (\Session::has('success'))
      <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
      </div><br />
      @endif


      {!! Form::open(array('route' => 'nodes.store','method'=>'POST', 'files' => true)) !!}
        {{ method_field('post') }}
        <input type="hidden" value="{{ $parent }}" name="parent">
        <div class="box-body">
          <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            <label for="inputTitle1">Title</label>
            {!! Form::text('title', null, array('placeholder' => 'Field the title','class' => 'form-control')) !!}
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
          </div>

          <div class="form-group {{ $errors->has('template') ? 'has-error' : '' }}">
            <label for="inputAlias">Template</label>
            {!! Form::select('template', $arrTemplates, null, ['placeholder' => 'Pick a Template','class' => 'form-control' ]) !!}
            @if ($errors->has('template'))
                <span class="help-block">
                    <strong>{{ $errors->first('template') }}</strong>
                </span>
            @endif
          </div>

          <div class="form-group {{ $errors->has('alias') ? 'has-error' : '' }}">
            <label for="inputAlias">Alias</label>
            {!! Form::text('alias', null, array('placeholder' => 'Field the alias','class' => 'form-control')) !!}
            @if ($errors->has('alias'))
                <span class="help-block">
                    <strong>{{ $errors->first('alias') }}</strong>
                </span>
            @endif
          </div>

          <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label for="inputDescription">Description</label>
            {!! Form::text('description', null, array('placeholder' => 'Field the description','class' => 'form-control')) !!}
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
          </div>

          <div class="form-group {{ $errors->has('keyword') ? 'has-error' : '' }}">
            <label for="inputKeyword">Keyword</label>
            {!! Form::text('keyword', null, array('placeholder' => 'Field the keyword','class' => 'form-control')) !!}
            @if ($errors->has('keyword'))
                <span class="help-block">
                    <strong>{{ $errors->first('keyword') }}</strong>
                </span>
            @endif
          </div>

          <div class="form-group {{ $errors->has('content1') ? 'has-error' : '' }}">
            <label for="inputConten1">Content 1</label>
            {!! Form::textarea('content1', null, array('class' => 'form-control')) !!}
            @if ($errors->has('keyword'))
                <span class="help-block">
                    <strong>{{ $errors->first('keyword') }}</strong>
                </span>
            @endif
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      {!! Form::close() !!}
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
