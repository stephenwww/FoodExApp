@extends('layouts.main')

@section('title') 
  Customer Profile
@stop

@section('header')
  {{ HTML::style('css/customer-management.css') }}
@stop

@section('main-content')
  <div class="page-customer-manament">

    <div class="container">
      <div class="message-area" id="msg-email">
        <ul>
        @if( $user->is_confirmed_email == false)
          <li>Please confirm your email <span><button class="btn btn-primary" id="btn-resend-email">Resend Email</button></span></li>    
        @endif
        </ul>
      </div>
      
      <span class="cust-edit-group">
        <h1 class="page-header">Contact Profile
        {{ HTML::link('customer/edit-profile', 'Edit Profile')}}
        {{ HTML::link('customer/manage-security', 'Manage Security')}}
        </h1> 
      </span>

      <div class="row">
        <label class="col-md-2">First Name</label>
        <div class="col-md-10"> {{ e($customer->first_name) }}</div>
      </div>
      <div class="row">
        <label class="col-md-2">Last Name</label>
        <div class="col-md-10"> {{ e($customer->last_name) }}</div>
      </div>
      <div class="row">
        <label for="cust_tel" class="col-md-2">Telephone Number</label>
        <div class="col-md-10"> {{ e($customer->cust_tel) }} </div>
      </div>

      <span class="cust-edit-group">
        <h1 class="page-header">Contact Addresses
        {{ HTML::link('customer/add-address', 'Add Address')}}
        </h1>
      </span>
      @foreach( $customer->custAddrs as $custAddr)
      @if($custAddr->hidden == 0)
      <div class="cust-addr">
        <address>
          @if($custAddr->apt_num != "null")
          {{ e($custAddr->apt_num).' '}}
          @endif
          {{ e($custAddr->street)}}<br/>
          {{ e($custAddr->city) }},
          {{ e($custAddr->province) }},
          {{ e($custAddr->country) }},
          {{ e($custAddr->postal_code) }}<br/>

          {{ HTML::link('customer/edit-address/'.$custAddr->cust_addr_id, 'Edit Address',  array('class'=>'edit-addr'))}}

          {{ Form::open(array('action'=>'CustomerController@deleteCustomerAddress', 'method'=>'DELETE', 'style'=>"display: inline;")) }}
          {{ Form::hidden('cust_addr_id',$custAddr->cust_addr_id) }}
          <button type="submit" class="cust-btn-submit">Remove Address</button>
          {{ Form::close()}}      
        </address>  
      </div>
      @endif
      @endforeach
    
  </div>
</div>

  <script type="text/javascript">
  
  $(document).ready(function(){   
    $(".uuedit-addr").click(function(){
      var $url_edit = $( this ).attr('url');
      alert($url_edit);
    });     

    $("#btn-resend-email").click(function(){
      $.get( "../user/resend-email", function( data ) {
        $("#msg-email ul").append("<li>"+data+"</li>");
      });
    });
  });
  </script>   
@stop

