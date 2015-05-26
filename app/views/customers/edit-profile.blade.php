@extends('layouts.main')

@section('title') 
  Customer Profile
@stop

@section('main-content')
<div class="container">
  {{ Form::open(array('url'=>'customer/profile', 'method'=>'PUT')) }}
    <h2>My Profile</h2>
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
    <div class="form-group">
      {{ Form::text('first_name', $customer->first_name, array('placeholder'=>'First Name')) }}
    </div>
    <div class="form-group">
      {{ Form::text('last_name', $customer->last_name, array('placeholder'=>'Last Name')) }}
    </div>
    <div class="form-group">
      {{ Form::text('cust_tel', $customer->cust_tel, array('placeholder'=>'Telephone Number')) }}
    </div>
    <div class="form-group">
      {{ Form::submit('Submit', array('class'=>'btn btn-primary'))}}
    </div>
  {{ Form::close()}}
</div>
@stop