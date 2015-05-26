@section('title') 
  Customer Profile
@stop

@section('header')
  {{ HTML::style('css/customer-management.css') }}
@stop

@section('main-content')
<div class="container">
	<ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  <h1>Add Address</h1>
  {{ Form::open(array('url'=>'customer/address', 'method'=>'POST')) }}
	<div class="form-group">
      <label for="apt_num" class='col-md-2 control-label'>Apartment Number</label>
      {{ Form::text('apt_num', null, array('placeholder'=>'If Applicable')) }}
    </div>
    <div class="form-group">
      <label for="street" class='col-md-2 control-label'>Street*</label>
      {{ Form::text('street', null) }}
    </div>
    <div class="form-group">
      <label for="city" class='col-md-2 control-label'>City*</label>
      {{ Form::text('city', null) }}
    </div>
    <div class="form-group">
      <label for="Province" class='col-md-2 control-label'>Province*</label>
      {{ Form::text('province', null) }}
    </div>
    <div class="form-group">
      <label for="country" class='col-md-2 control-label'>Country*</label>
      {{ Form::text('country', null) }}
    </div>
    <div class="form-group">
      <label for="postal_code" class='col-md-2 control-label'>Postal Code*</label>
      {{ Form::text('postal_code', null) }}
    </div>
    <div class="form-group">
      <label for="note" class='col-md-2 control-label'>Notes</label>
      {{ Form::textarea('note', null, array('placeholder'=>'For The Delivery Driver.')) }}
    </div>
    {{ Form::hidden('cust_id', $customer->cust_id) }}

      <div class="col-md-offset-2 col-md-12" style="padding:0;">
        <button type="submit" class="btn btn-default" id="add-btn">Submit</button>
      </div>
    
  {{ Form::close()}}
</div>
@stop