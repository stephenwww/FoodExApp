@extends('layouts.main')

@section('title')
  Manage Profile
@stop

@section('main-content')

<div class="container">
  <!-- Contact Info Form Open -->
  {{ Form::open(array('action'=>'RestaurantController@postManageContactInfo', 'method'=>'POST')) }}
  <ul>
    @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
  <h2 class="page-header">Contact Info</h2>
  <!-- Restaurant Name Form -->
  <div class="row">
    <div class="col-md-12">
    <div class="form-group">
      <label for="res_name" class='col-md-1 control-label'>Restaurant Name</label>
      <div class="col-md-11">
        {{ Form::text('res_name', $restaurant->res_name,
          array('placeholder'=>'Restaurant Name', 'class' => 'form-control')) }}
      </div>
    </div>
  </div>
  </div>
  <!-- Open/Close Form -->


  <!-- Phone Number Row -->
  <?php
    $tel1 = substr($restaurant->res_tel, 0, 3);
    $tel2 = substr($restaurant->res_tel, 3, 3);
    $tel3 = substr($restaurant->res_tel, 6, 4);
  ?>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">

        <label for="res_tel" class='col-md-1 control-label'>Phone Number</label>
      <div class="col-md-3">
       {{ Form::text('res_tel1', $tel1,
          array('placeholder'=>'000', 'class' => 'form-control')) }}
      </div>

        <label for="res_tel2" class='col-md-1 control-label'>-</label>
      <div class="col-md-3">
       {{ Form::text('res_tel2', $tel2,
          array('placeholder'=>'000', 'class' => 'form-control')) }}
      </div>

      <label for="res_tel3" class='col-md-1 control-label'>-</label>
      <div class="col-md-3">
       {{ Form::text('res_tel3', $tel3,
          array('placeholder'=>'0000', 'class' => 'form-control')) }}
      </div>
      
    </div>
  </div>
  </div>

  <!-- Email Row -->
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="res_email" class="col-md-1 control-label">Email Address</label>
        <div class="col-md-11">
       {{ Form::text('res_email', $restaurant->res_email,
          array('placeholder'=>'Email Address', 'class' => 'form-control')) }}        
      </div>
      </div>
    </div>
  </div>

  <!-- Submit Button -->
  <div class="form-group">
    <div class="col-md-offset-11 col-md-12">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
  <!-- Contact Info Form Close -->
  {{ Form::close() }}

  <!-- Location Form Open -->
  {{ Form::open(array('action'=>'RestaurantController@postManageLocation', 'method'=>'POST')) }}
  <h2 class="page-header">Location</h2>
  <!-- Street Row -->
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="res_street" class="col-md-1 control-label">Street</label>
        <div class="col-md-11">
       {{ Form::text('res_street', $restaurant->res_street,
          array('placeholder'=>'Street', 'class' => 'form-control')) }}   
        </div>
      </div>
    </div>
  </div>

  <!-- City Row -->
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="res_city" class="col-md-1 control-label">City</label>
        <div class="col-md-11">
       {{ Form::text('res_city', $restaurant->res_city,
          array('placeholder'=>'City', 'class' => 'form-control')) }}  
        </div>
      </div>
    </div>
  </div>

  <!-- Province Row -->
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="res_province" class="col-md-1 control-label">Province/ State</label>
        <div class="col-md-11">
       {{ Form::text('res_province', $restaurant->res_province,
          array('placeholder'=>'Province/State', 'class' => 'form-control')) }}  
        </div>
      </div>
    </div>
  </div>

  <!-- Country Row -->
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="res_country" class="col-md-1 control-label">Country</label>
        <div class="col-md-11">
       {{ Form::text('res_country', $restaurant->res_country,
          array('placeholder'=>'Country', 'class' => 'form-control')) }}  
        </div>
      </div>
    </div>
  </div>

  <!-- Postal Code Row -->
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="res_postalcode" class="col-md-1 control-label">Postal Code</label>
        <div class="col-md-11">
       {{ Form::text('res_postalcode', $restaurant->res_postalcode,
          array('placeholder'=>'Postal Code', 'class' => 'form-control')) }}  
        </div>
      </div>
    </div>
  </div>

  <!-- Submit Button -->
  <div class="form-group">
    <div class="col-md-offset-11 col-md-12">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
  <!-- Location Form Close -->
  {{ Form::close() }}


  <!-- About Us Form Open -->
  {{ Form::open(array('action'=>'RestaurantController@postManageAboutUs', 'method'=>'POST', 'files'=>true)) }}
  <h2 class="page-header">About Us</h2>
  <!-- Restaurant logo_path -->
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="img" class='col-md-1 control-label'>Logo Image</label>
        <div class="col-md-11">
          {{ Form::file('img') }}
        </div>
      </div>
    </div>
  </div>
  <!-- About Us TextArea Row -->
  <div class="row">
    <div class="col-md-offset-1 col-md-11">
      <div class='form-group'>
        <label for='about_us' class 'col-md-1 control-label'></label>
        <div class='col-md-12'>
          {{ Form::textarea('about_us', $restaurant->about_us,
          array('placeholder'=>'About You', 'class' => 'form-control', 'rows' => 3)) }}  
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="img" class='col-md-1 control-label'>Delivery?</label>
        <div class="col-md-11">
          {{ Form::checkbox('is_deliver', null, $restaurant->is_deliver) }}
        </div>
      </div>
    </div>
  </div>


  <!-- Submit Button -->
  <div class="form-group">
    <div class="col-md-offset-11 col-md-12">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
  <!-- Location Form Close -->
  {{ Form::close() }}


  <!-- Restaurant Hours Open Form -->
  {{ Form::open(array('action'=>'RestaurantController@postManageHours', 'method'=>'POST')) }}
  <?php function getAMPM($time){ return date('h:i A', strtotime($time));}?>
  <h2 class="page-header">Hours</h2>
  <div class="col-md-12">
    <table class="table">
        <tr>
        <th>Closed</th>
        <th>{{ Form::checkbox('mon_isClosed', $reshours->mon_isClosed, $reshours->mon_isClosed); }} Monday</th>
        <th>{{ Form::checkbox('tues_isClosed', $reshours->tues_isClosed, $reshours->tues_isClosed); }} Tuesday</th>
        <th>{{ Form::checkbox('weds_isClosed', $reshours->weds_isClosed, $reshours->weds_isClosed); }} Wednesday</th>
        <th>{{ Form::checkbox('thurs_isClosed', $reshours->thurs_isClosed, $reshours->thurs_isClosed); }} Thursday</th>
        <th>{{ Form::checkbox('fri_isClosed', $reshours->fri_isClosed, $reshours->fri_isClosed); }} Friday</th>
        <th>{{ Form::checkbox('sat_isClosed', $reshours->sat_isClosed, $reshours->sat_isClosed); }} Saturday</th>
        <th>{{ Form::checkbox('sun_isClosed', $reshours->sun_isClosed, $reshours->sun_isClosed); }} Sunday</th>
      </tr>
      <tr>
        <th>Open Time</th>
        <td>{{ Form::text('open_mon', getAMPM($reshours->open_mon), array('class' => 'form-control')) }}</td>
        <td>{{ Form::text('open_tues', getAMPM($reshours->open_tues), array('class' => 'form-control')) }}</td> 
        <td>{{ Form::text('open_weds', getAMPM($reshours->open_weds), array('class' => 'form-control')) }}</td> 
        <td>{{ Form::text('open_thurs', getAMPM($reshours->open_thurs), array('class' => 'form-control')) }}</td> 
        <td>{{ Form::text('open_fri', getAMPM($reshours->open_fri), array('class' => 'form-control')) }}</td> 
        <td>{{ Form::text('open_sat', getAMPM($reshours->open_sat), array('class' => 'form-control')) }}</td> 
        <td>{{ Form::text('open_sun', getAMPM($reshours->open_sun), array('class' => 'form-control')) }}</td> 
      </tr>
      <tr>
        <th>Close Time</th>
        <td>{{ Form::text('close_mon', getAMPM($reshours->close_mon), array('class' => 'form-control')) }}</td>
        <td>{{ Form::text('close_tues', getAMPM($reshours->close_tues), array('class' => 'form-control')) }}</td> 
        <td>{{ Form::text('close_weds', getAMPM($reshours->close_weds), array('class' => 'form-control')) }}</td> 
        <td>{{ Form::text('close_thurs', getAMPM($reshours->close_thurs), array('class' => 'form-control')) }}</td> 
        <td>{{ Form::text('close_fri', getAMPM($reshours->close_fri), array('class' => 'form-control')) }}</td> 
        <td>{{ Form::text('close_sat', getAMPM($reshours->close_sat), array('class' => 'form-control')) }}</td> 
        <td>{{ Form::text('close_sun', getAMPM($reshours->close_sun), array('class' => 'form-control')) }}</td> 
      </tr>
    </table>
  </div>

  <!-- Submit Button -->
  <div class="form-group">
    <div class="col-md-offset-11 col-md-12">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
  <!-- Restaurant Hours Form Close -->
  {{ Form::close() }}


  <!-- Cuisines Form Open -->
  {{ Form::open(array('action'=>'RestaurantController@postManageCuisines', 'method'=>'POST')) }}
  <h2 class="page-header">Cuisines</h2>

  <div class='row'>
    <div class="input-group">
      <div class='col-md-offset-2 col-md-12'>
      @foreach($restaurant->cuisines as $rescuis)
        {{ Form::checkbox($rescuis->cuisine_id, $rescuis->cuisine_id, true).' '.$rescuis->cuisine_name }}
      @endforeach

      @foreach($othercuisines as $cuisine)
        <label class="radio-inline">
          {{ Form::checkbox($cuisine->cuisine_id, $cuisine->cuisine_id).' '.$cuisine->cuisine_name }}
        </label>
      @endforeach
      </div>
    </div>
  </div>

  <!-- Submit Button -->
  <div class="form-group">
    <div class="col-md-offset-11 col-md-12">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
  <!-- Location Form Close -->
  {{ Form::close() }}


{{ Form::open(array('action'=>'RestaurantController@postPassword', 'method'=>'POST')) }}
  <h2 class="page-header">Change Password</h2>
  <!-- old password row -->
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="res_street" class="col-md-1 control-label">Old Password</label>
        <div class="col-md-11">
        {{ Form::password('old_password')}}   
        </div>
      </div>
    </div>
  </div>
  <!-- new password row -->
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="res_street" class="col-md-1 control-label">New Password</label>
        <div class="col-md-11">
       {{ Form::password('password') }}   
        </div>
      </div>
    </div>
  </div>
  <!-- confirm new password row -->
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="res_street" class="col-md-1 control-label">Confirm New Password</label>
        <div class="col-md-11">
       {{ Form::password('password_confirmation')}}   
        </div>
      </div>
    </div>
  </div>
 <!-- Submit Button -->
  <div class="form-group">
    <div class="col-md-offset-11 col-md-12">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
  <!-- Password Form Close -->
  {{ Form::close() }}
</div>
@stop