@extends('layouts.main')

@section('title') 
  Make Order Review
@stop


@section('main-content')
<div class="container">
 @if( $order->review )


  {{ Form::open(array('url'=>'order/review', 'method'=>'PUT')) }}
  {{ Form::hidden('id', $order->review->review_id) }}
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>

    <div class="form-group">
      {{ Form::textarea('comment', $order->review->review_content, array('placeholder'=>'Comment')) }}
    </div>
    
    <div id="review" score = {{$order->review->review_score}}>Please choose score: </div>
    <textarea id="hint"></textarea>
    <div class="form-group">
    {{ Form::submit('Submit', array('class'=>'btn btn-primary'))}}
    </div>
  {{ Form::close()}}


  @else

  {{ Form::open(array('url'=>'order/review', 'method'=>'POST')) }}
  {{ Form::hidden('order_id', $order->order_id) }}
  {{ Form::hidden('cust_id', $order->cust_id) }}
  {{ Form::hidden('res_id', $order->res_id) }}
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>

    <div class="form-group">
      {{ Form::textarea('comment', '' ,array('placeholder'=>'Comment')) }}
    </div>
    
    <div id="review" >Please choose score: </div>
    <textarea id="hint"></textarea>
    <div class="form-group">
    {{ Form::submit('Submit', array('class'=>'btn btn-primary'))}}
    </div>
  {{ Form::close()}}

  @endif

  {{ HTML::script('js/jquery.raty.js') }}
  {{ HTML::script('js/star.js') }}
</div>
@stop


