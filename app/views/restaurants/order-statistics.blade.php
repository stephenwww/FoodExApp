@extends('layouts.main')

@section('title') 
  Restaurant Statistics
@stop

@section('main-content')
<div class="container page-order-statistics">
  <div id="hiden-res-id" value={{ $restaurant->res_id }}></div>
  
  <div id="past-order-num">
    {{ Form::select('size', array('day' => 'By Day', 'week' => 'By Week', 'month' => 'By Month'), 'd', array('id' => 'order-num-chart-type')) }}
    <div class="chartdiv" id="orderchartdiv"></div>
  </div>

  <div id="past-income">
    {{ Form::select('size', array('day' => 'By Day', 'week' => 'By Week', 'month' => 'By Month'), 'd', array('id' => 'income-chart-type')) }}
    <div class="chartdiv" id="incomechartdiv"></div>
  </div>
</div>

{{ HTML::script('js/restaurants/order-statistics.js') }}
@stop