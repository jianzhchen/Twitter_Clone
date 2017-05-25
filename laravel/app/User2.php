<?php

namespace App;

use Illuminate\Support\Facades\Input;
use Hash;
use Illuminate\Foundation\Auth\User;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent; 
use Illuminate\Contracts\Auth\Authenticatable; 
use Illuminate\Auth\Authenticatable as AuthenticableTrait;


class User2 extends Eloquent implements Authenticatable//implements UserInterface, RemindableInterface
{
  use AuthenticableTrait;

  public $timestamps = false;
    
  public function getRememberToken()
  {
    return null; // not supported
  }

  public function setRememberToken($value)
  {
    // not supported
  }

  public function getRememberTokenName()
  {
    return null; // not supported
  }

  /**
   * Overrides the method to ignore the remember token.
   */
  public function setAttribute($key, $value)
  {
    $isRememberTokenAttribute = $key == $this->getRememberTokenName();
    if (!$isRememberTokenAttribute)
    {
      parent::setAttribute($key, $value);
    }
  }
  
    protected $collection = "users_new";
    //
    public static function formstore($data,$key){

        $username=Input::get('username');
        $password=Hash::make(Input::get('password'));
        $email=Input::get('email');

        $users=new User2();
        $users->username=$username;
        $users->email=$email;
        $users->password=$password;
        $users->key=$key;
        $users->verify=0;

        $users->save();

    }
}
