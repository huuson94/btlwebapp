@extends('backend.layout.main')
@section('content')
<h1>Create Category</h1>
{{ Form::open(array('route' => 'admin-category.store')) }}
<div class="form-group">
	<label class="control-label col-sm-2" for="title">Title</label>
	<div class="col-sm-10">
		{{Form::text('title', null, array('class'=>'form-control', 'id'=>'email','placeholder'=>'Title'))}}
	</div>
</div>

<div class="box-footer">
	<div class="form-group">
		<label class="control-label col-sm-2">&nbsp;</label>
		<div class="col-sm-10">
			<button class="btn btn-sm btn-success" type="submit">Submit</button>
			<button class="btn btn-sm btn-default" type="reset">Reset</button>
		</div>
	</div>
	<div class="clearfix"></div>
</div>

{{ Form::close() }}
@if ($errors->any())
<ul>
	{{ implode('', $errors->all('<li class="error">:message</li>')) }}
</ul>
@endif
@stop