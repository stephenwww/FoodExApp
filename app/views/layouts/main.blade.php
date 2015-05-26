<!DOCTYPE html>
<html>
  <head>
	{{ HTML::style('css/bootstrap.min.css') }}
	<!-- {{ HTML::style('css/style.css') }} -->
	{{ HTML::script('js/jquery-2.1.1.min.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}
	{{ HTML::script('js/main.js') }}
	{{ HTML::script('js/amcharts/amcharts.js') }}
	{{ HTML::script('js/amcharts/serial.js') }}
	{{ HTML::style('css/font-awesome.min.css') }}
	{{ HTML::style('css/font-awesome.css') }}
	{{ HTML::style('css/main.css') }}
	{{ HTML::script('js/jquery.raty.js') }}
    {{ HTML::script('js/star.js') }}
    <!-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

	 <!-- <link href="css/font-awesome.min.css" rel="stylesheet"> -->
	@yield('header')
	<title>@yield('title')</title>
  </head>
  <body>

  	 <div class="navbar navbar-inverse navbar-fixed-top">

      <div class="container">
	        <div class="navbar-header">
	          {{ HTML::link('/', 'FoodEX', array('id' => 'home', 'class' => "navbar-brand") )}}
	           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
          	   </button>
	        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right" id="nav-top-btns">
			@if( Session::has('role') )
			  @if (Session::get('role') == constant('CUSTOMER'))
			  <li id="g">{{ HTML::link('/', 'Gallery') }}</li>
			  <li id="cm">{{ HTML::link('customer/management', 'Customer Management')}}</li>
			  <li id="co">{{ HTML::link('customer/orders', 'Orders')}}</li>
			  @elseif (Session::get('role') == constant('RESTAURANT'))
			  <li id="g">{{ HTML::link('/', 'Gallery') }}</li>
			  <li id="rest">{{ HTML::link('/restaurant', 'My Restaurant')}}</li>
			  <li id="ro">{{ HTML::link('/restaurant/orders', 'Orders')}}</li>
			  <li id="rmp">{{ HTML::link('/restaurant/manage-profile', 'Manage Profile')}}</li>
			  <li id="rmd">{{ HTML::link('/restaurant/manage-dishes', 'Manage Dishes')}}</li>
			  <li id="ros">{{ HTML::link('/restaurant/order-statistics', 'Order Statistics')}}</li>
			  @elseif (Session::get('role') == constant('ADMIN'))
			  <li id="g">{{ HTML::link('/', 'Gallery') }}</li>
			  <li id='arm'>{{ HTML::link('/admin/restaurant-management', 'Restaurant Management') }}</li>
			  <li id='aop'>{{ HTML::link('/admin/operations', 'Operations')}}</li>
			  <li id='apo'>{{ HTML::link('/admin/past-operation', 'Past Operations') }}</li>
			  @endif
			  <li id="ulo">{{ HTML::link('user/logout', 'Logout') }}</li>
			@else
			<li id="g">{{ HTML::link('/', 'Gallery') }}</li>
			<li id="uli">{{ HTML::link('user/login', 'Login') }}</li>
			<li id="ucs">{{ HTML::link('user/customer-signup', 'Customer Signup', array('class' => 'navbar-item')) }}</li>
			<li id="urs">{{ HTML::link('user/restaurant-signup', 'Restaurant Signup', array('class' => 'navbar-item')) }} </li>
			@endif

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

<!--     <?php require_once(app_path().'/includes/macro.php'); ?> -->
	
	<div class="main-content">

		@yield('main-content')
		<br/>
	  <div class="footer" style="text-align: right;">
		<small>@Developed by CMPT 470 (Group 16): Jeremy Ni, Brandon Tang, Stephen Wang, Ella Huang</small>
	  </div>
	</div>
  </body>
</html>

