@extends('layouts.main')

@section('title')
  Order Confirm
@stop

@section('main-content')
  <div class="page-order-confirm">
    <div class="container">
    <h3 style="font-weight: bold">
      Confirm Your Order
    </h3>      
    {{ Form::open(array('url'=>'order/confirm-done', 'class'=>'form-horizontal form-order', 
       'id'=>'form-order'))}}    
      <div class="form-group">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>  
      </div>
      <div class="form-group" style="font-weight: bold">
        <div class="col-md-3">
          Dish Name
        </div>
        <div class="col-md-1">
          Price
        </div>
        <div class="col-md-1">
          Quantity
        </div>
      </div>
      @for ($i = 0; $i < $cnt; ++ $i)
        <?php $dish = Dish::find($dish_id[$i]); ?>
        <div class="form-group form-dish" id="{{ $dish->dish_id}}">
          <div class="col-md-3">
            {{ e($dish->dish_name) }}
          </div>
          <div class="col-md-1" name="dish-price" value="{{ $dish->dish_price}}">
            {{ e("$" . $dish->dish_price) }}
          </div>
          <div class="col-md-1" style="padding:0px 10px; text-align:center">
            <button class="btn-plus btn btn-sm" style="float:left" dish-id="{{$dish->dish_id}}" >+</button>
            <label name="dish-quantity"> {{ e($dish_quantity[$i]) }} </label>
            <button class="btn-minus btn btn-sm" style="float:right" dish-id="{{$dish->dish_id}}">-</button>
          </div>
          <input name="dish_id[]" type="hidden" value="{{ $dish->dish_id}}">
          <input name="dish_quantity[]" type="hidden" value="{{ $dish_quantity[$i]}}">
        </div>
      @endfor
      <div class="form-group" style="font-weight: bold">
        <div class="col-md-3">    
          Sum
        </div>
        <div class="col-md-1">
          <label id="lb-total-price"></label>          
        </div>
        <div class="col-md-1">
          <label id="lb-total-cnt">{{ e($cnt)}} Item</label>                
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-3" style="font-weight: bold">
          What kind of serve you want: 
        </div>
        <div class="col-md-1">
          {{ Form::radio('order_service_type', constant('PICKUP'), true) }}
          <div style="display:inline">PickUp</div>
        </div>
        <div class="col-md-2">
          {{ Form::radio('order_service_type', constant('DELIVERY'))}} 
          <div style="display:inline">Delivery</div>
        </div>
      </div>
      <div id="div-address" style="display:none">
        @if( empty($addresses) )
        <div><b>Please add your address in Customer Management</b></div>
        @else
        <div><b>Please select your address:</b></div>
        @endif
        @foreach (CustAddr::where('cust_id', '=', (int)Session::get('role_id'))->get() as $cust_addr)
          <div class="div-cust-addr">
            {{ Form::radio('cust_addr_id', $cust_addr->cust_addr_id)}}
              <span>#:</span><span>{{ e($cust_addr->apt_num) }}</span>
              <span>Street:</span><span>{{ e($cust_addr->street) }}</span>
              <span>City:</span><span>{{ e($cust_addr->city) }}</span>
              <span>Province:</span><span>{{ e($cust_addr->province) }}</span>
              <span>Country:</span><span>{{ e($cust_addr->country) }}</span>
              <span>Postal Code:</span><span>{{ e($cust_addr->postal_code) }}</span>
          </div>
        @endforeach        
      </div>
      {{ Form::submit('Confirm Order')}}
      <input name="res_id" type="hidden" value="{{ $res_id }}">
      <input name="cust_id" type="hidden" value="{{ $cust_id }}">
    {{ Form::close()}}
    </div>
  </div>
  {{ HTML::script('js/orders/confirm.js') }}
@stop