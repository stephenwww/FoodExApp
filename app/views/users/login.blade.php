@extends('layouts.main')

@section('title')
  Login
@stop

{{ HTML::style('css/login.css') }}

@section('main-content')
  <div class="container", id="login">
	<ul>
	  @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
	  @endforeach
	</ul>        	
    <h2><span class="fontawesome-lock"></span>Login</h2>
	{{ Form::open(array('url' => 'user/login', 'method' => 'POST')) }}
	  <fieldset>
	    @include('common.user_errors')
	    <div class="form-group">
	      <p> 
  		    {{ Form::label('email', 'Email Address') }}
  		    {{ Form::email('email', Input::old('email'), array('id' => "email", 'placeholder'=>'example@foodex.ca')) }}
	      </p>
	      <p>
		    {{ Form::label('password', 'Password') }}
		    {{ Form::password('password', array('id'=>"password" , 'placeholder'=>'password'))}}
	      </p>
	    </div>
	    <p>{{ Form::submit('Submit', array('class'=>"btn btn-primary btn-block btn-lg", 'id'=>"submit")) }}</p>
	  </fieldset>
	{{ Form::close() }}
	<span>{{ HTML::link('user/forgot-pwd', "Forget Password") }}</span>
  </div>
@stop


<!-- <div id="login">
		<h2><span class="fontawesome-lock"></span>Sign In</h2>
		<form action="javascript:void(0);" method="POST">
			<fieldset>
				<p><label for="email">E-mail address</label></p>
				<p><input type="email" id="email" placeholder="mail@address.com"></p> 
				<p><label for="password">Password</label></p>
				<p><input type="password" id="password" placeholder="password"></p> 
				<p><input type="submit" value="Sign In"></p>

			</fieldset>

		</form>

	</div> <!-- end login -->
