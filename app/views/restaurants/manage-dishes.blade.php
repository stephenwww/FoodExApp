@extends('layouts.main')

@section('title') 
  Dishes
@stop

@section('header')
  {{ HTML::style('css/_restaurant.css')}}
@stop

@section('main-content')
  
  <div class="container">

	
	<h2 class="page-header">Dishes <a href="{{URL::to('restaurant/add-dish')}}" class="btn btn-default" role="button">Add Dish</a></h2>
    <div class="row">
    @foreach($dishes as $dish)
    @if($dish->serving == true)

        <div class="col-sm-6 col-md-4">
          <div class="thumbnail menu-item">

            {{ HTML::image( $dish->dish_pic_path, null, array('class' => 'menu-item-img')) }}
            <div class="menu-item-name">
              <h3>{{e($dish->dish_name)}}</h3>
              <h4>{{format_money($dish->dish_price)}}</h4>
            </div>
              <div class="menu-item-descr">
                {{$dish->dish_description}}
              </div>
              <p>
                {{ Form::open(array('action'=>'RestaurantController@getEditDish', 'method'=>'GET', 'style'=>"display: inline;")) }}
                {{ Form::hidden('dish_id', $dish->dish_id) }}
                <button type="submit" class="btn btn-primary">Edit</button>
                {{ Form::close()}}
                {{ Form::open(array('action'=>'RestaurantController@postDeleteDish', 'method'=>'POST', 'style'=>"display: inline;")) }}
                {{ Form::hidden('dish_id', $dish->dish_id) }}
                {{ Form::hidden('archive', true)}}
                <button type="submit" class="btn btn-default">Archive</button>
                {{ Form::close()}}
              </p>
            
          </div>
        </div>
    @endif
    @endforeach
  </div>
   <h2 class="page-header">Archived Dishes</h2>
    <div class="row">
    @foreach($dishes as $dish)
    @if($dish->serving == false)
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail menu-item">

            {{ HTML::image( $dish->dish_pic_path, null, array('class'=>'menu-item-img')) }}
            <div class="menu-item-name">
              <h3>{{e($dish->dish_name)}}</h3>
              <h4>{{format_money($dish->dish_price)}}</h4>
              <div class="menu-item-descr">
                {{e($dish->dish_description)}}
              </div>
              <p>
                {{ Form::open(array('action'=>'RestaurantController@getEditDish', 'method'=>'GET', 'style'=>"display: inline;")) }}
                {{ Form::hidden('dish_id', $dish->dish_id) }}
                <button type="submit" class="btn btn-primary">Edit</button>
                {{ Form::close()}}
                {{ Form::open(array('action'=>'RestaurantController@postDeleteDish', 'method'=>'POST', 'style'=>"display: inline;")) }}
                {{ Form::hidden('dish_id', $dish->dish_id) }}
                {{ Form::hidden('archive', false)}}
                <button type="submit" class="btn btn-default">Unarchive</button>
                {{ Form::close()}}
              </p>
            </div>
          </div>
        </div>
      @endif
    @endforeach
    </div>
  </div>  <!-- Container div -->

@stop

<?php
  function format_money($price){
      $result = $price;
      $dec_pos;
      if(!($dec_pos = strrpos($price, '.') == false)){
        $result = substr($price, 0, $dec_pos + 4);
      }
      return ('$'.$result);
    }
?>
  