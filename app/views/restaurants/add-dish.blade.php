@extends('layouts.main')

@section('title') 
  Restaurant Add Dish
@stop

@section('main-content')
<div class="container">
  {{ Form::open(array('url'=>'restaurant/dishes', 'method'=>'POST', 'files'=>true)) }}
    <h2 class="page-header">Add New Dish</h2>
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
          {{ Form::text('dish_name',null,
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
          {{ Form::text('dish_price',null,
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
          {{ Form::textarea('dish_description',null,
          array('placeholder'=>'100 characters max', 'class' => 'form-control', 'rows' => '2')) }}
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="dish_name" class='col-md-1 control-label'>Dish Image</label>
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

  {{ Form::hidden('res_id', $restaurant->res_id) }}
  {{ Form::close()}}
</div>
@stop