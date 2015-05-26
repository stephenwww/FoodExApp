@extends('layouts.main')

@section('title')
	Past Operation
@stop

<?php
  require_once(app_path().'/includes/macro.php');
?>

@section('main-content')
<div class="page-admin-past-operation">
  <div class="container">
  	<h1 class="page-header">Past Operations</h1>
  	<table class="table table-striped table-past-op">
  	  <tr>
	  	<th>Adminstrator name</th>
	  	<th>Restaurant name</th>
	  	<th>Operation Descrition</th>
	  	<th>Operation Time</th>
	  </tr>
	  @foreach($operations as $operation)
	    <tr>
	      <td> {{ Admin::find($operation->admin_id)->admin_name}}</td>
	      <td> {{ Restaurant::find($operation->res_id)->res_name}}</td>
	      <td> {{ constant("ACTIVE")==$operation->op_type? "ACTIVE": "DEACTIVE"}}</td>
	      <td> {{ $operation->op_time}}</td>
	    </tr>
	  @endforeach
  	</table>

  	<?php echo $operations->links() ?>	
  </div>
</div>
@stop