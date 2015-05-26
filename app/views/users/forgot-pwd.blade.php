@extends('layouts.main')

@section('title') 
  Forget Password
@stop

@section('main-content')
<div class="container">
	<ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
	<div>
		<h3>Please enter your registered email address and we will send you the new password by email:</h3>
	</div>
	<div>
		{{ Form::open(array('url'=>'user/forgot-pwd', 'id'=>'forget-pwd', 'method'=>'POST')) }}
          <div class="form-group">
            {{ Form::label('email', 'Registered Email') }}
            {{ Form::text('email', Input::old('email')) }}
          </div>
          <div class="form-group">
            {{ Form::submit('Send Email', array('class'=>'btn btn-primary'))}}
            <!-- <button class="cancel-edit btn btn-primary">Cancel</button> -->
          </div>
      {{ Form::close()}}
	</div>
</div>
@stop