@extends('layouts.main')

@section('title')
  Sign Up
@stop

@section('main-content')

  <!-- {{ HTML::style('css/user/main.css')}} -->
  {{ HTML::style('css/login.css')}}
    
<div class="container" id="login">
	  <ul>
	    @foreach($errors->all() as $error)
	      <li>{{ $error }}</li>
	    @endforeach
	  </ul>

	  <h2 class="form-signup-heading">Please Register</h2>

	{{ Form::open(array('url' => 'user/signup', 'method' => 'POST')) }}
	<fieldset>
	  <div class="form-group">
	    <p>
	    	{{ Form::label('email', 'Email Address') }}
	    	{{ Form::email('email', null, array('placeholder'=>'example@foodex.ca')) }}
	    </p>

	 	<p>
	 		{{ Form::label('password', 'Password') }}
	    	{{ Form::password('password', array('placeholder'=>'password')) }}
	 	</p>
	 	<p>
	 		{{ Form::label('password_confirmation', 'Confirm Password') }}
	    	{{ Form::password('password_confirmation', array('placeholder'=>'confirm password')) }}
	 	</p>
	 	<p>
	    	{{ Form::submit('Register', array('class'=>'btn btn-primary btn-block btn-lg', 'id'=>'submit'))}}
	  	</p>
	  </div>  
	    {{ Form::hidden('role', $role) }}
	</fieldset>
	{{ Form::close()}}
</div>




@stop