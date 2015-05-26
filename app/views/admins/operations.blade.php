@extends('layouts.main')

@section('title')
	Operations
@stop

@section('header')
	{{ HTML::style('css/admin_operation.css') }}

@section('main-content')
<div class="container">
  <ul>
    @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
	<h1 class="page-header">Cuisines</h1>

	<h2>Remove Cuisines</h2>
	<div class="rm-cuisines">
		{{ Form::open(array('action'=>'AdminController@postRemoveCuisines', 'method'=>'POST')) }}
		@foreach($cuisines as $cuisine)
		  <label class="radio-inline">
        {{ Form::checkbox($cuisine->cuisine_id, $cuisine->cuisine_id).' '.$cuisine->cuisine_name }}
      </label>
		@endforeach
		<br/>
		<button type="submit"  id="rm-cuisine-submit" class="btn btn-default">Submit</button>
		{{ Form::close() }}
	</div>

	<h2>Add Cuisine</h2>
	<div class="add-cuisines">
		{{ Form::open(array('action'=>'AdminController@postAddCuisine', 'method'=>'POST')) }}
		{{ Form::text('cuisine_name', null) }}

		<button type="submit" class="btn btn-default">Submit</button>
		{{ Form::close() }}
	</div>

	<h1>Tax</h1>
	<div class="edit-tax">
	<dl>
		<dt>Current Tax:</dt>
		  <dd>{{$current_tax}}%</dd>
	</dl>
		{{ Form::open(array('action'=>'AdminController@postEditTax', 'method'=>'POST')) }}
		{{ Form::text('tax', null, array('placeholder'=>'update tax')) }}

		<button type="submit" class="btn btn-default">Submit</button>
		{{ Form::close() }}
	</div>	
</div> <!-- container div -->
@stop