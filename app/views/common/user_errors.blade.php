<div class="error-msg">
	<ul>
		@if($errors->has())
			{{ $errors->first('email', '<li>:message</li>') }}
			{{ $errors->first('username', '<li>:message</li>') }}
			{{ $errors->first('password', '<li>:message</li>') }}
		@endif

		@if (Session::has('error_message'))
			<li> {{ Session::get('error_message') }} </li>
		@endif

		@if (Session::has('msg'))
			<li> {{ Session::get('msg') }} </li>
		@endif
	</ul>
</div>