@extends('layouts.main')

@section('title')
	Restaurant Management
@stop

@section('main-content')
<div class="page-admin-restaurant-management">
  <div class="container">
    <h1 class="page-header">Restaurants</h1>  
    <div class="row">
      @foreach($restaurants as $restaurant)
        <div class="col-sm-6 col-md-3">
          <div class="thumbnail">
            <h3 align="left" style="margin-top:0;">
  			      {{ HTML::link('restaurant/detail/'.$restaurant->res_id, $restaurant->res_name, array('style'=>'display:inline;')) }}
              <!-- @if ($restaurant->legitimate)
                Active
              @else
                Not Active
              @endif -->
            </h3>
          	{{ HTML::image( $restaurant->logo_path, null, array('style'=> 'width:100px;height:100px;float:left;padding-right:10px', 'class'=>"img-responsive")) }}
          	<div class="caption" style="padding-top:0;height:100px;overflow:scroll;">
              @if ($restaurant->legitimate)
                {{ HTML::link('admin/deactive-restaurant/'.$restaurant->res_id, 'Deactivate', array('class'=>'btn btn-deactive'))}}
              @else
                {{ HTML::link('admin/active-restaurant/'.$restaurant->res_id, 'Activate', array('class'=>'btn btn-active btn-success'))}}
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

@stop