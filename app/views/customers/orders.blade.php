@extends('layouts.main')

@section('title') 
  Customer Orders
@stop

@section('main-content')
  <div class="container">


  <div class="display">
    <br><br>
    <h3 class="oheader">Current Orders</h3>
    <div class="current-orders">
        @foreach($orders as $order)
          @if( $order->is_fulfilled == 0 )

          {{ Form::open(array('url' => 'customer/complete', )) }}
             {{ Form::hidden('id', $order->order_id) }}
             {{ Form::submit('Received Order') }}
          {{ Form::close() }}
          <div class="current-order-table">
          <table class="order-header" style="width:100%" >
            <tr>
              <th>Order ID</th>
              <th>Restaurant Name</th> 
              <th>Order Time</th>
              <th>Restaurant Phone</th>
            </tr>
            <tr>
              <td>{{ e($order->order_id) }}</td>
              <td>{{ e($order->restaurant->res_name) }}</td>
              <td> {{ e($order->order_time) }} </td>
              <td>{{ e($order->restaurant->res_tel) }}</td>
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
              <td>Tax{{'@'.$tax}}%:</td>
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
          </div>
            <br>
          @endif
          
        @endforeach
    </div>


    <h3 class="oheader">Past Orders</h3>
    <div class="past-orders">
      
        @foreach($orders as $order)
          @if( $order->is_fulfilled == 1 )
         
          {{ Form::open(array('url' => 'order/review', 'method'=>'GET')) }}
             {{ Form::hidden('id', $order->order_id) }}
             {{ Form::hidden('cust_id', Session::get('role_id')) }}
             {{ Form::submit('Review Order') }}
          {{ Form::close() }}
          <div class="past-order-table">
          <table class="porder-header" style="width:100%" >
            <tr>
              <th>Order ID</th>
              <th>Restaurant Name</th> 
              <th>Order Time</th>
              <!-- <th>Order Price</th> -->
              <th>Review</th>
            </tr>
            <tr>
              <td>{{ e($order->order_id) }}</td>
              <td>{{ e($order->restaurant->res_name) }}</td>
              <td > {{ e($order->order_time) }} </td>
              @if( $order->review )
              <td> Comment: {{ e($order->review->review_content) }}<div class = "order_score" score={{$order->review->review_score}} }} >Score:</div>  </td>
              @else
              <td>Not reviewed yet</td>
              @endif
            </tr>
            </table>

            <table class="porder-table" style="width:100%">
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
                <td> {{ e($order_dish->dish_amount * $order_dish->dish->dish_price) }} </td>
              </tr>
              @endforeach
            <tr>
              <td>Before Tax:</td>
              <td></td>
              <td></td>
              <td>{{ e($order->order_price) }}</td>
            </tr>
            <tr>
              <td>Tax{{'@'.$tax}}%:</td>
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
          </div>
          @endif
          <br>
        @endforeach
    </div>

  </div>

  </div>

  {{ HTML::script('js/jquery.raty.js') }}
  {{ HTML::script('js/star.js') }}
@stop

