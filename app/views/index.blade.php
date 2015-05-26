@extends('layouts.main')

@section('title') 
  Home Page 
@stop

<?php
  date_default_timezone_set(date_default_timezone_get());
  $dayOfWeek = date('N', time()); // 1 for monday 7 for sunday
?>

@section('main-content')
<div class="page-rest-gallery">
  <div class="container">
    
    {{ Form::open(array('url'=>'restaurant/search', 'class'=>'undefined'))}}
      <div id="search-bar">
        {{ Form::text('restaurant-name', null, array('class'=>'form-control fm-rest-name', 'placeholder'=>'Restaurant Name'))}}  
        {{ Form::select('cuisine-id', $cuisines, null, array('class'=>'form-control fm-select'))}}
        {{ Form::submit('Search', array('class'=>'btn btn-primary')) }}
      </div>    
    {{ Form::close()}}

    <h1 class="page-header">Restaurants</h1>
    <div class="row">
      @foreach($restaurants as $restaurant)
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail" >	
            <h3 align="center" style="margin-top:0;"> 
  			      {{ HTML::link('restaurant/detail/'.$restaurant->res_id, $restaurant->res_name, array('style'=>'display:block;')) }}
            </h3>
            <div class="gallery_score" data-path="http://localhost/FoodExApp/public/imgs/" score={{$restaurant->score}}>Score</div>
          	
            <div class="caption" value="popup-{{$restaurant->res_id}}"> 
              <div class="rest-gallery-img">
                {{ HTML::image( $restaurant->logo_path, null, array('class' => 'img-responsive')) }}
              </div>
              <div class="popup" id="popup-{{$restaurant->res_id}}">
                <h3> {{e($restaurant->res_name)}} </h3>
                <div class="popup-aboutus">
                  <p>{{e($restaurant->about_us)}}</p>
                </div>
                <div class="cuisine-container">
                  <ul>
                    @foreach($restaurant->cuisines as $cuisine)
                    <li class="rest_cuisine_list">&bull;{{e($cuisine->cuisine_name)}}</li>
                    @endforeach
                  </ul>
                </div>
              </div>

            </div>
            <div class="rest-deliver">
            <?php 
              $deliver = '<p align="center" style="margin:0;background-color:#B1E6C7;">Delivers &#10004</p>';
              $nodeliver = '<p align="center" style="margin:0;background-color:#FFA8B7;">Delivers &#x2717</p>';
              echo(($restaurant->is_deliver)?$deliver:$nodeliver); 
            ?>
            </div>
          </div>       
        </div>
      @endforeach
    </div>
	</div>
</div>
  {{ HTML::script('js/jquery.raty.js') }}
<!--    <input id="public-path" type="hidden" value="{{public_path()}}">  -->
  {{ HTML::script('js/star.js') }}
  {{ HTML::script('js/gallery.js') }}
@stop


