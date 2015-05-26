@extends('layouts.main')

@section('title') 
  Restaurant Edit Dish
@stop

@section('main-content')
<div class="container">
  {{ Form::open(array('action'=>'RestaurantController@postEditDish', 'method'=>'POST', 'files'=>true)) }}
    <h2 class="page-header">Edit Dish</h2>
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>



  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="dish_name" class='col-md-1 control-label'>Dish Name</label>
        <div class="col-md-11">
          {{ Form::text('dish_name',$dish->dish_name,
          array('placeholder'=>'Dish Name', 'class' => 'form-control')) }}
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="dish_name" class='col-md-1 control-label'>Dish Price</label>
        <div class="col-md-11">
          {{ Form::text('dish_price',format_money($dish->dish_price),
          array('placeholder'=>'Dish Price', 'class' => 'form-control')) }}
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="dish_description" class='col-md-1 control-label'>Dish Description</label>
        <div class="col-md-11">
          {{ Form::textarea('dish_description',$dish->dish_description,
          array('placeholder'=>'100 characters max', 'class' => 'form-control', 'rows' => '2')) }}
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="dish_name" class='col-md-1 control-label'>New Dish Image</label>
        <div class="col-md-11">
          {{ Form::file('img') }}
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

  {{ Form::hidden('dish_id', $dish->dish_id) }}
  {{ Form::close()}}
</div>
@stop

<?php
  function format_money($price){
      $result = $price;
      $dec_pos;
      if(!($dec_pos = strrpos($price, '.') == false)){
        $result = substr($price, 0, $dec_pos + 4);
      }
      return ($result);
    }
?>