<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\Facades\Input;
use MongoDB;
use App\User2;
use DB;

class Error {
    public $status  = "error";
    public $error  = "";
}

class Ok {
	public $status  = "OK";
}

class authcontroller extends Controller
{
    //
    public function adduser(){
		//echo "test";

		$data=Input::except(array("_token"));

		$rule=array(
			'username'=>'required|unique:users_new',
			'password'=>'required',
			'email'=>'required|email|unique:users_new'
			);

		$message=array(
			'username.required'=>'Username is required',
			'password.required'=>'password is required',
			'email.required'=>'email is required'
			);

		$validator=Validator::make($data,$rule,$message);

		if($validator->fails()){
			$response=new Error();
			$response->error="validation failed";
			return response(json_encode($response), 200)->header("Content-type","application/json");
			//return Redirect::to('register')->withErrors($validator);
		}else{
			User2::formstore(Input::except(array("_token")),uniqid());

			$json = file_get_contents('php://input');
			$json = json_decode($json);
			$username = $json->{"username"};



			$collection = (new MongoDB\Client('mongodb://192.168.1.112:27017'))->tc->follow_table;
			$insertOneResult = $collection->insertOne([
			    'username' => $username,
			  	'following' => [],
			    'follow_by' => [],
			]);

			$ok = new Ok();
    		return response(json_encode($ok), 200)->header("Content-type","application/json");
		}
    }

    public function verify(){

    	$data=Input::except(array("_token"));
    	$email = Input::get('email'); 
    	$key = Input::get('key'); 

    	//backdoor
    	if(strcmp($key,"abracadabra")==0){
    		DB::table('users_new')
            ->where('email', $email)
            ->update(['verify' => 1]);

            $ok = new Ok();
    		return response(json_encode($ok), 200)->header("Content-type","application/json");
    	}

    	//get key 
    	$key_db=(DB::table('users_new')->where('email',$email)->first())["key"];

    	if(strcmp($key,$key_db)==0){
    		DB::table('users_new')
            ->where('email', $email)
            ->update(['verify' => 1]);

            $ok = new Ok();
    		return response(json_encode($ok), 200)->header("Content-type","application/json");           
    	}

		$response=new Error();
		$response->error="verification failed";
		return response(json_encode($response), 200)->header("Content-type","application/json");
    }

    public function login(){

    	$data=Input::except(array("_token"));

		$rule=array(
			'username'=>'required',
			'password'=>'required',
			);

		$validator=Validator::make($data,$rule);

		if($validator->fails()){
			$response=new Error();
			$response->error="validation failed";
			return response(json_encode($response), 200)->header("Content-type","application/json");
		}
		else{
			$userdata=array(
				'username'=>Input::get('username'),
				'password'=>Input::get('password'),
				'verify'=>1
				);
			if(Auth::attempt($userdata)){
	            $ok = new Ok();
	    		return response(json_encode($ok), 200)->header("Content-type","application/json");
			}
			else{
				$response=new Error();
				$response->error="login failed";
				return response(json_encode($response), 200)->header("Content-type","application/json");				
			}
		}
    }

    public function logout(){
    	Auth::logout();

	    $ok = new Ok();
		return response(json_encode($ok), 200)->header("Content-type","application/json");
    }
}

