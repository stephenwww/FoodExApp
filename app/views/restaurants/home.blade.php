@extends('layouts.main')

@section('header')
  {{ HTML::style('css/_restaurant.css')}}
@stop

@section('title') 
  Home
@stop

@section('main-content')
  <div class="page-rest-detail container">

    <div class="message-area" id="msg-email">
      <ul>
      @if( $user->is_confirmed_email )
        @if($restaurant->legitimate == false)
          <li>We are manually reviewing your profile.</li>
        @endif
      @else
        <li>Please confirm your email <span><button class="btn btn-primary" id="btn-resend-email">Resend Email</button></span></li>    
      @endif
      </ul>
    </div>

    <div class="row">
     
      <!-- {{ $restaurant->open_time.' - '. $restaurant->close_time }} --> 
      <!-- <table id="contact-table"> -->
        
        <div class="col-md-6 col-sm-6 my_res_home_center" >
           <h2 class="page-header">
            {{ HTML::image( $restaurant->logo_path, null, array('style'=> 'width: 75px; height: 75px;')) }}
            {{ $restaurant->res_name }}
            </h2>
            <!-- <td id="aboutus"> -->
              <h3>About us</h3>
            {{ $restaurant->about_us }} <br>
            
            <?php 
              $deliver = '<h3>Delivery</h3><p align="center" style="background-color:#B1E6C7;">&#10004</p>';
              $nodeliver = '<h3>Delivery</h3><p align="center" style="background-color:#FFA8B7;">&#x2717</p>';
              echo(($restaurant->is_deliver)?$deliver:$nodeliver); 
            ?>

            <h3> Score:</h3>
            <div class="rest_detail_score" score={{$restaurant->score}} ></div>

            <h3>Cuisines:</h3>
            <div class="cuisine-container">
            <ul>
              @foreach($restaurant->cuisines as $cuisine)
              <li class="rest_cuisine_list">&bull;{{$cuisine->cuisine_name}}</li>
              @endforeach
            </ul>
            </div>
          <!-- </td> -->
        </div>

        <div class="col-md-6" id="map">
        <!-- <td id="contact-info"> -->

      <!-- {{ $restaurant->open_time.' - '. $restaurant->close_time }} --> 
      

          <iframe style="display: inline-block; margin-right:10px;"

            width="300"
            height="300"
            frameborder="0" style="border:0"
            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB0VBlkHxOVIQm33CybkivJ3FmvwQVQmSk&q={{ $restaurant->res_street }},+{{ $restaurant->res_city }},+{{ $restaurant->res_province }},+{{ $restaurant->res_country }}">
          </iframe>
          <div class="res-info">
            {{ e($restaurant->res_street) }} <br>
            {{ e($restaurant->res_city) }}, {{ e($restaurant->res_province)}} <br>
            {{ e($restaurant->res_country) }}  <br>
            Call: <a href="tel:{{$restaurant->res_tel}}">{{e($restaurant->res_tel)}}</a><br>
            Email: <a href="mailto:{{$restaurant->res_email}}">{{e($restaurant->res_email)}}</a>
          </div>
        <!-- </td> -->
      <!-- </table> -->
      </div>
    </div> <!-- first row -->

    <?php function getAMPM($time){ return date('h:i A', strtotime($time));}?>
    <div class="row"> <!-- open/close hours -->
      <h2 class="res-header">Hours of Operation</h2>
      <div class="table-responsive">
        <table class="table">
            <tr>
            <th></th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
            <th>Saturday</th>
            <th>Sunday</th>
          </tr>
          <tr>
            <th>Open</th>
            <td>
              @if($reshours->mon_isClosed == 0)
                {{ getAMPM($reshours->open_mon)}}
                @else
                {{ 'Closed' }}
                @endif
            </td>
            <td>
              @if($reshours->tues_isClosed == 0)
                {{ getAMPM($reshours->open_tues)}}
                @else
                {{ 'Closed' }}
                @endif
            </td>
            <td>
              @if($reshours->weds_isClosed == 0)
                {{ getAMPM($reshours->open_weds)}}
                @else
                {{ 'Closed' }}
                @endif
            </td>
            <td>
              @if($reshours->thurs_isClosed == 0)
                {{ getAMPM($reshours->open_thurs)}}
                @else
                {{ 'Closed' }}
                @endif
            </td>
            <td>
              @if($reshours->fri_isClosed == 0)
                {{ getAMPM($reshours->open_fri)}}
                @else
                {{ 'Closed' }}
                @endif
            </td>
            <td>
              @if($reshours->sat_isClosed == 0)
                {{ getAMPM($reshours->open_sat)}}
                @else
                {{ 'Closed' }}
                @endif
            </td>
            <td>
              @if($reshours->sun_isClosed == 0)
                {{ getAMPM($reshours->open_sun)}}
                @else
                {{ 'Closed' }}
                @endif
            </td>
          </tr>
          <tr>
            <th>Close</th>
            <td>
              @if($reshours->mon_isClosed == 0)
                {{ getAMPM($reshours->close_mon)}}
                @else
                {{ 'Closed' }}
                @endif
            </td>
            <td>
              @if($reshours->tues_isClosed == 0)
                {{ getAMPM($reshours->close_tues)}}
                @else
                {{ 'Closed' }}
                @endif
            </td>
            <td>
              @if($reshours->weds_isClosed == 0)
                {{ getAMPM($reshours->close_weds)}}
                @else
                {{ 'Closed' }}
                @endif
            </td>
            <td>
              @if($reshours->thurs_isClosed == 0)
                {{ getAMPM($reshours->close_thurs)}}
                @else
                {{ 'Closed' }}
                @endif
            </td>
            <td>
              @if($reshours->fri_isClosed == 0)
                {{ getAMPM($reshours->close_fri)}}
                @else
                {{ 'Closed' }}
                @endif
            </td>
            <td>
              @if($reshours->sat_isClosed == 0)
                {{ getAMPM($reshours->close_sat)}}
                @else
                {{ 'Closed' }}
                @endif
            </td> 
            <td>
              @if($reshours->sun_isClosed == 0)
                {{ getAMPM($reshours->close_sun)}}
                @else
                {{ 'Closed' }}
                @endif
            </td>
          </tr>
        </table>
      </div>
    </div>  <!-- Container div -->
    <div class="dish-section main-section">
    <h2 class="page-header">Dishes</h2>
    <div class="row">
    @foreach($dishes as $dish)
    @if($dish->serving == 1)
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail menu-item">
            {{ HTML::image( $dish->dish_pic_path, null, array('class'=>'menu-item-img')) }}
            <div class="menu-item-name">
              <h3>{{e($dish->dish_name)}}</h3>
              <button class="btn-order" name="{{ $dish->dish_name }}" price="{{ $dish->dish_price }}" id="{{ $dish->dish_id}}">
                {{ format_money($dish->dish_price)}}
              </button>
            </div>
            <div class="menu-item-descr">
              {{e($dish->dish_description)}}
            </div>
          </div>
        </div>
      @endif
    @endforeach
    </div>
  </div> <!-- container div -->



{{ HTML::script('js/restaurants/restaurant.js') }}
  

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