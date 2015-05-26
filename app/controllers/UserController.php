<?php

require_once(app_path().'/includes/macro.php');

class UserController extends BaseController 
{
	protected $layout = "layouts.main";
	
	public function __construct()
	{
		$this->beforeFilter('user_get_post_login', ['only' => 
			['getLogin', 'postLogin']]);
	 	$this->beforeFilter('user_post_signup', ['only'=>'postSignup']);
 	}

	public function getCustomerSignup()
	{
		return View::make('users.signup')
			->with('role', constant("CUSTOMER"));
	}

	public function getRestaurantSignup()
	{
		return View::make('users.signup')
			->with('role', constant("RESTAURANT"));
	}

	public function putEditEmail()
	{
		$validator = Validator::make(Input::all(), User::$edit_email_rules);

		if($validator->passes())
		{
			$user = User::find(Session::get('user_id'));
			if (Hash::check(Input::get('password'), $user->password))
			{
				$user->email = Input::get('email');
				$user->save();
				Session::flash('msg', 'Email changed successfully!');
				return Redirect::back();
			}
			Session::flash('edit_email', 'true');
			return Redirect::back()
				->withErrors(['Invalid Password']);
		} else
		{
			Session::flash('edit_email', 'true');
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		}
	}

	public function getForgotPwd()
	{
		return View::make('users.forgot-pwd');
	}

	// try to figure the logic here, stephen
	public function postForgotPwd()
	{
		$validator = Validator::make(Input::all(), User::$forget_pwd_rules);

		if($validator->passes())
		{
			$user = User::where('email', '=', Input::get('email'));
			if($user->count())
			{
				$user = $user->first();

				$tmp_pwd = Str::random(10);
				$code = Str::random(60);

				$user->tmp_password = Hash::make($tmp_pwd);
				$user->code = $code;

				if ($user->save()){
					Mail::queue('emails.forgot-pwd', array('link' => URL::to('user/recover/'.$code),'username' => $user->username,'password' => $tmp_pwd),function($message) use ($user){
						$message->to($user->email, $user->username)->subject("[FoodExApp] Your New Password");
					});

					Session::flash('msg', 'We have sent you a new password by email');
					return Redirect::to('user/login');
				}

			} else {
				return Redirect::back()->withErrors(['The email you entered is not registered!']);
			}
		}
		return Redirect::back()->withErrors($validator)->withInput();
	}


	public function getRecover($code)
	{
		$user = User::where('code', '=', $code)->where('tmp_password', '!=', '');

		if($user->count()){
			$user = $user->first();
			$user->password = $user->tmp_password;
			$user->tmp_password = '';
			$user->code = '';
			if($user->save()){
				Session::flash('msg', 'Your password has being changed! Please use your new password to login!');
				return Redirect::to('user/login');
			}
		}
		Session::flash('error_message', 'The link is invalid or has already been used!');
		return Redirect::to('user/login');
	}

	public function putEditPwd()
	{
		$validator = Validator::make(Input::all(), User::$edit_pwd_rules);
		if($validator->passes())
		{
			$user = User::find(Session::get('user_id'));
			if (Hash::check(Input::get('old_password'), $user->password))
			{
				$user->password = Hash::make(Input::get('password'));
				$user->save();
				Session::flash('msg', 'Password changed successfully!');
				return Redirect::back();
			}
			else{
				return Redirect::back()
					->withErrors('Incorrect Password');
			}
		} else
		{
			Session::flash('edit_pwd', 'true');
			return Redirect::back()
				->withErrors($validator);
		}
	}

	// filter 'role' yet
	public function postSignup()
	{
		$validator = Validator::make(Input::all(), User::$rules);

		if ($validator->passes())
		{
			$user = new User;
			$user->email = Input::get('email');
			$user->username = 'null';
			$user->password = Hash::make(Input::get('password'));
			$user->role = Input::get('role');

			$this->sendEmailConfirm($user);
			$user->save();
			if (Input::get('role') == constant("CUSTOMER")) // string?
			{
				return $this->customer_signup(DB::getPdo()->lastInsertId());
			} else if (Input::get('role') == constant("RESTAURANT"))
			{
				return $this->restaurant_signup(DB::getPdo()->lastInsertId());
			}
		} else
		{
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		}		
//		return Redirect::to('user/login');
	}

	public function getResendEmail()
	{
		$user = User::find(Session::get('user_id'));
		if($user->is_confirmed_email == false){

			$this->sendEmailConfirm($user);
			$user->save();
				
			return "Email sent successfully! Please check your email.";
		}

		return "Your email has already been confirmed";
	}

	public function getConfirmEmail($code)
	{
		$user = User::where('code', '=', $code)->where('is_confirmed_email', '=', False);

		if ($user->count()) {
			$user = $user->first();
			$user->code = '';
			$user->is_confirmed_email = True;
			if($user->save()){
				Session::flash('msg', 'Your email has being confirmed!');
				return Redirect::to('user/login');
			}
		}

		Session::flash('error_message', 'The link is invalid or has already been used! ');
		return Redirect::to('user/login');
	}

	public function sendEmailConfirm($user)
	{
		$code = Str::random(60);
		$user->code = $code;
		//return $user->email."      ".$user->username."      ".URL::to('user/confirm-email/'.$code);
		Mail::queue('emails.confirm-email', array('link' => URL::to('user/confirm-email/'.$code), 'username' => $user->username), function($message) use ($user){
			$message->to($user->email, $user->username)->subject("[FoodExApp] Confirm Your Email");
		});

	}

	/*
	*	When you access /user/login
	*/
	public function getLogin()
	{
		return View::make('users.login');
	}

	/*
	*	the login form will post to here and will login
	*/
	public function postLogin()
	{
//		return Session::get('customer_order');
		// create our user data for the authentication
		$userdata = array(
			'email' 	=> Input::get('email'),
			'password' 	=> Input::get('password')
		);

		// attempt to do the login. the true means remember me
		if (Auth::attempt($userdata)) 
		{
			if (Auth::user()->role==constant("CUSTOMER") && Session::get('customer_is_ordering')==true)
			{
				Session::put('redirect_from_user_login', true);
				$this->session_config(Auth::user()->user_id, constant("CUSTOMER"));
				return Redirect::to('order/confirm');
			} else if(Auth::user()->role == constant("CUSTOMER"))
			{
				$this->session_config(Auth::user()->user_id, constant("CUSTOMER"));
				return Redirect::to('/');
			} else if (Auth::user()->role == constant("RESTAURANT"))
			{
				$this->session_config(Auth::user()->user_id, constant("RESTAURANT"));
				return Redirect::to('restaurant'); // for now, need to be changed
			} else if (Auth::user()->role == constant("ADMIN"))
			{
				$this->session_config(Auth::user()->user_id, constant("ADMIN"));
				return Redirect::to('admin');
			}
		} else 
		{
			return Redirect::to('user/login')
				->with('error_message','Sorry the email and password does not match')
				->withInput();
		}
	}

	public function getLogout() 
	{
    	Auth::logout();
    	Session::flush();
    	return Redirect::to('/');
	}

	/*****************  private function below  ********************/
	private function customer_signup($user_id)
	{
		$customer = new Customer;
		$customer->user_id = $user_id;
		$customer->save();
		$this->session_config($user_id, constant("CUSTOMER"));
		return Redirect::to('/');
	}
	private function restaurant_signup($user_id) 
	{
		$restaurant = new Restaurant;
		$restaurant->user_id = $user_id;
		$restaurant->save();
		$reshours = new RestaurantHours;
		$reshours->res_id = $restaurant->res_id;
		$reshours->save();
		$this->session_config($user_id, constant("RESTAURANT"));
//		return $restaurant;
//		return Session::all();
		return Redirect::to('/restaurant');
	}	
	// Unified API, called by "postSignin, customer_signup and restaurant_signup" func
	private function session_config($user_id, $role)
	{
		if ( $role == constant("CUSTOMER") )
		{
			Session::put('role_id',
				Customer::where('user_id', '=', $user_id)->first()->cust_id);
		} else if ( $role == constant("RESTAURANT") )
		{
			Session::put('role_id',
				Restaurant::where('user_id', '=', $user_id)->first()->res_id);
		} else if ( $role == constant("ADMIN"))
		{
			Session::put('role_id',
				Admin::where('user_id', '=', $user_id)->first()->admin_id);
		}
		Session::put('user_id', $user_id);
		Session::put('role', $role);
	}
}
