@extends('layouts.main')

@section('title') 
  Customer Profile
@stop

@section('main-content')
<div class="container">
	<ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  {{ Form::open(array('url'=>'customer/address', 'method'=>'PUT')) }}
	<div class="form-group">
    <label for="apt_num" class='col-md-2 control-label'>Apartment Number</label>
      {{ Form::text('apt_num', $address->apt_num, array('placeholder'=>'Apartment Number')) }}
    </div>
    <div class="form-group">
      <label for="street" class='col-md-2 control-label'>Street*</label>
      {{ Form::text('street', $address->street, array('placeholder'=>'Street Name')) }}
    </div>
    <div class="form-group">
      <label for="city" class='col-md-2 control-label'>City*</label>
      {{ Form::text('city', $address->city, array('placeholder'=>'City')) }}
    </div>
    <div class="form-group">
      <label for="Province" class='col-md-2 control-label'>Province*</label>
      {{ Form::text('province', $address->province, array('placeholder'=>'Province')) }}
    </div>
    <div class="form-group">
      <label for="country" class='col-md-2 control-label'>Country*</label>
      {{ Form::text('country', $address->country, array('placeholder'=>'Country')) }}
    </div>
    <div class="form-group">
      <label for="postal_code" class='col-md-2 control-label'>Postal Code*</label>
      {{ Form::text('postal_code', $address->postal_code, array('placeholder'=>'Postal Code')) }}
    </div>
    <div class="form-group">
      <label for="note" class='col-md-2 control-label'>Notes</label>
      {{ Form::textarea('note', $address->note, array('placeholder'=>'Note')) }}
    </div>
    <div class="form-group">
      <div class="col-md-offset-2 col-md-12" style="padding:0;">
        <button type="submit" class="btn btn-default" id="add-btn">Submit</button>
      </div>
    </div>
    {{ Form::hidden('cust_addr_id', $address->cust_addr_id) }}
  {{ Form::close()}}
</div>
@stop