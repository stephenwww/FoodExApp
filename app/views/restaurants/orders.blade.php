@extends('layouts.main')

@section('title') 
  Restaurant Orders
@stop

{{ HTML::style('css/order-table.css') }}

@section('main-content')

<meta http-equiv="refresh" content="30" >
  <div class="container">

  <dt class="display">
    
    <h3 class="oheader">Current Orders</h3>
    <div class="current-orders">
        @foreach($orders as $order)
          @if( $order->is_fulfilled == 0 )
          @if( $order->is_sent == 0 )

          {{ Form::open(array('url' => 'restaurant/complete', )) }}
             {{ Form::hidden('id', $order->order_id) }}
             {{ Form::submit('Sent Order') }}
          {{ Form::close() }}
          <div class="current-order-table">
          <table class="order-header" style="width:100%" >
            <tr>
              <th>Order ID</th>
              <th>Customer Name</th> 
              <th>Order Time</th>
              <!-- <th>Order Price</th> -->
              <th>Customer Phone</th>
              <th>Customer Address</th>
            </tr>
            <tr>
              <td>{{ e($order->order_id) }}</td>
              <td>{{ e($order->customer->first_name)}}  {{e($order->customer->last_name)}}</td>
              <td> {{ e($order->order_time) }} </td>
              <!-- <td> {{ $order->order_price }} </td> -->
              <td>{{ e($order->customer->cust_tel)}}</td>
              <td> 
                   <span>#</span><span>{{ e($order->custaddr->apt_num) }}</span>
                   <span>{{ e($order->custaddr->street) }}</span>
                   <span>{{ e($order->custaddr->city) }}</span>
                   <span>{{ e($order->custaddr->province) }}</span>
                   <span>{{ e($order->custaddr->country)}},</span>
                   <span>Postal Code:</span><span>{{ e($order->custaddr->postal_code) }}</span> 
              </td>
              
            </tr>
            </table>

            <table class="order-table" style="width:100%">
              <tr>
                <th>Items</th>
                <th>Price</th> 
                <th>Quantity</th>
                <th>Total</th>
              </tr>
              @foreach($order->orderDishes as $order_dish)
              <tr>
                <td> {{ e($order_dish->dish->dish_name) }}</td>
                <td> {{ e($order_dish->dish->dish_price) }} </td>
                <td> {{ e($order_dish->dish_amount) }} </td>
                <td> {{  e($order_dish->dish_amount * $order_dish->dish->dish_price) }} </td>
              </tr>
              @endforeach
            <tr>
              <td>Before Tax:</td>
              <td></td>
              <td></td>
              <td>{{ e($order->order_price) }}</td>
            </tr>
            <tr>
              <td>Tax{{e('@'.$tax)}}%:</td>
              <td></td>
              <td></td>
              <td>{{ e($order->order_price * $tax/100)}}</td>
            </tr>
            <tr>
              <td>Total Price</td>
              <td></td>
              <td></td>
              <td>{{ e($order->order_price * (1+$tax/100))}}</td>
            </tr>
            </table>

        <table class="order-table" style="width:100%">
              
        </table>

          </div>
             <br>
          @endif
          @endif
         
        @endforeach

    </div>

    <h3 class="oheader">Waiting For Customer Confirmation</h3>
    
    <div class="sent-orders">
        @foreach($orders as $order)
          @if( $order->is_fulfilled == 0)
          @if( $order->is_sent == 1)
          <div class="wait-order-table">
          <table class="worder-header" style="width:100%" >
            <tr>
              <th>Order ID</th>
              <th>Customer Name</th> 
              <th>Order Time</th>
              <th>Order Price</th>
              <th>Customer Address</th>
            </tr>
            <tr>
              <td>{{ e($order->order_id) }}</td>
              <td>{{ e($order->customer->first_name)}}  {{e($order->customer->last_name)}}</td>
              <td> {{ e($order->order_time )}} </td>
              <td> {{ e($order->order_price )}} </td>
              <td> 
                   <span>#</span><span>{{ e($order->custaddr->apt_num) }}</span>
                   <span>{{ e($order->custaddr->street) }}</span>
                   <span>{{ e($order->custaddr->city) }}</span>
                   <span>{{ e($order->custaddr->province) }}</span>
                   <span>{{ e($order->custaddr->country) }},</span>
                   <span>Postal Code:</span><span>{{ e($order->custaddr->postal_code) }}</span> 
              </td>
            </tr>
            </table>
<!--  
            <table style="width:600px">
              <tr>
                <th>items</th>
                <th>price</th> 
                <th>quantity</th>
                <th>sum</th>
              </tr>
              @foreach($order->orderDishes as $order_dish)
              <tr>
                <td> {{ $order_dish->dish->dish_name }}</td>
                <td> {{ $order_dish->dish->dish_price }} </td>
                <td> {{ $order_dish->dish_amount }} </td>
                <td> {{  $order_dish->dish_amount * $order_dish->dish->dish_price }} </td>
              </tr>
              @endforeach
              <td>Total Price:</td>
              <td></td>
              <td></td>
              <td>{{ $order->order_price }}</td>
            </table>
-->
        </div>
         <br>
          @endif
          @endif
         
        @endforeach
    </div>

    <h3 class="oheader">Past Orders</h3>
    <div class="past-orders">
        @foreach($orders as $order)
          @if( $order->is_fulfilled == 1 )
          <div class="past-order-table">
          <table class="porder-header" style="width:100%" >
            <tr>
              <th>Order ID</th>
              <th>Customer Name</th> 
              <th>Order Time</th>
              <th>Order Price</th>
              <th>Customer Address</th>
            </tr>
            <tr>
              <td>{{ e($order->order_id) }}</td>
              <td>{{ e($order->customer->first_name)}}  {{e($order->customer->last_name)}}</td>
              <td> {{ e($order->order_time) }} </td>
              <td> {{ e($order->order_price) }} </td>
              <td> 
                   <span>#</span><span>{{ e($order->custaddr->apt_num) }}</span>
                   <span>{{ e($order->custaddr->street) }}</span>
                   <span>{{ e($order->custaddr->city) }}</span>
                   <span>{{ e($order->custaddr->province) }}</span>
                   <span>{{ e($order->custaddr->country) }},</span>
                   <span>Postal Code:</span><span>{{ e($order->custaddr->postal_code) }}</span> 
              </td>
            </tr>
            </table>
          </div>
              <br>
<!--  
            <table style="width:600px">
              <tr>
                <th>items</th>
                <th>price</th> 
                <th>quantity</th>
                <th>sum</th>
              </tr>
              @foreach($order->orderDishes as $order_dish)
              <tr>
                <td> {{ $order_dish->dish->dish_name }}</td>
                <td> {{ $order_dish->dish->dish_price }} </td>
                <td> {{ $order_dish->dish_amount }} </td>
                <td> {{  $order_dish->dish_amount * $order_dish->dish->dish_price }} </td>
              </tr>
              @endforeach
              <tr>
              <td>Total Price:</td>
              <td></td>
              <td></td>
              <td>{{ $order->order_price }}</td>
              </tr>
            </table>
-->    
          @endif
        
        @endforeach
    </div>

  </dt>
</div>

@stop

