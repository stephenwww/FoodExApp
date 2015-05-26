<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected $primaryKey = 'user_id';
	public $timestamps = false;
	public static $rules = array(
	    'email'=>'required|email|unique:users',
	    'password'=>'required|alpha_num|between:6,12|confirmed', 
	    'password_confirmation'=>'required|alpha_num|between:6,12'
    );	

    public static $edit_email_rules = array(
    	'email'=>'required|email',
    	'password'=>'required|alpha_num|between:6,12', 
    );

    public static $edit_pwd_rules = array(
    	'old_password' => 'required|alpha_num|between:6,12',
    	'password'=>'required|alpha_num|between:6,12|confirmed', 
	    'password_confirmation'=>'required|alpha_num|between:6,12'
    );

    public static $forget_pwd_rules = array(
    	'email'=>'required|email'
    );
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

/*	public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}*/	
}

