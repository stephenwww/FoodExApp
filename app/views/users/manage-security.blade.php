@extends('layouts.main')

@section('title') 
  Edit Security
@stop

@section('main-content')
<div class="container">
<dl>
  <div id="email">
    <ul>
        @if (Session::has('msg'))
          <li>{{ Session::get('msg') }}</li>
        @endif
    </ul>
    <div class="data-area" {{ (Session::has('edit_email') or Session::has('edit_pwd')) ? "hidden" : "" }} >
      <dt>Email:</dt>
      <dd>{{ $user->email }}</dt>
    </div>
    <div class="edit-area" {{ Session::has('edit_email') ? "" : "hidden"}}>
      <h2>Change Email</h2>
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      {{ Form::open(array('url'=>'user/edit-email', 'id'=>'update-email', 'method'=>'PUT')) }}
          <div class="form-group">
            {{ Form::label('email', 'New Email') }}
            {{ Form::text('email') }}
          </div>
          <div class="form-group">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password') }}
          </div>
          <div class="form-group">
            {{ Form::submit('Submit', array('class'=>'btn btn-primary'))}}
            <button class="cancel-edit btn btn-primary">Back</button>
          </div>
      {{ Form::close()}}
    </div>   
  </div>
  <div id="pwd">
    <div class="edit-area" {{ Session::has('edit_pwd') ? "" : "hidden"}}>
      <h2>Edit Password</h2>
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      {{ Form::open(array('url'=>'user/edit-pwd', 'id'=>'update-pwd', 'method'=>'PUT')) }}
          <div class="form-group">
            {{ Form::label('old_password', 'Old Password') }}
            {{ Form::password('old_password') }}
          </div>
          <div class="form-group">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password') }}
          </div>
          <div class="form-group">
            {{ Form::label('password_confirmation', 'Confirm Password') }}
            {{ Form::password('password_confirmation') }}
          </div>
          <div class="form-group">
            {{ Form::submit('Submit', array('class'=>'btn btn-primary'))}}
            <button class="cancel-edit btn btn-primary">Cancel</button>
          </div>
      {{ Form::close()}}
    </div>
  </div>
    <button id="change-email" class="btn btn-primary">Change Email</button>
    <button id="change-pwd" class="btn btn-primary">Change Password</button>
</dl>
</div>
  {{ HTML::script('js/customer_security.js') }}
@stop