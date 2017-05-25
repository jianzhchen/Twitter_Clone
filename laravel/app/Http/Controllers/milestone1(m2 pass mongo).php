<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Cassandra;
use Auth;
use DB;
use MongoDB;

class Error {
		      public $status  = "error";
		      public $error  = "";
}
class Ok {
		      public $status  = "OK";
}
class Ok_id {
		      public $status  = "OK";
		      public $id = "";
}
class Ok_item {
		      public $status  = "OK";
		      public $item;
}
class Ok_items {
		      public $status  = "OK";
		      public $items;
}
class User_data{
			  public $status  = "OK";
		      public $user;
}
class User_follow_data{
			  public $status  = "OK";
		      public $users;
}
class User_data_array{
			  public $email;
		      public $followers;
		      public $following;
}


class milestone1 extends Controller
{
	///done
	public function additem(){
		//check login
		if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}


		$json = file_get_contents('php://input');
		$json = json_decode($json);
		$content = $json->{"content"};

		$username = Auth::user()->username;
		$id = uniqid('',true).uniqid('',true);

		DB::table('search_table')->insert(
		    ['username' => $username, 'content' => $content,'id' => $id,'timestp' => time()]
		);

    	$ok_id = new Ok_id();
    	$ok_id->id=$id;

    	return response(json_encode($ok_id), 200)->header("Content-type","application/json");
	}
	///done
	public function item($id){
		if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

    	$tweet = DB::table('search_table')->where('id', $id)->get()->first();
    	if(isset($tweet)){
			$content=$tweet['content'];
			$timestp=$tweet['timestp'];
			$username=$tweet['username'];

	    	$ok_item = new Ok_item();
	    	$ok_item->item=array(
				'id' => $id,
	    		'username' => $username,
		        'content' => $content,
		        'timestamp' => $timestp
	    	);

	    	return response(json_encode($ok_item), 200)->header("Content-type","application/json");
    	}
    	else{
    		$response=new Error();
			$response->error="not found";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}
	}

	public function search(){
		if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$json = file_get_contents('php://input');
		$json = json_decode($json);

		$timestp; 
		$limit;
		$following;
		$qflag=false;
		$usernameflag=false;
		$querystr;
		$followtolist;
		$username = Auth::user()->username;
		$username_arg;
		$count=0;
		$items;
		if(array_key_exists("limit",$json)==false || ($json->{"limit"})>100){
			$limit=25;
		}
		else{
			$limit = $json->{"limit"};
		}

		if(array_key_exists("timestamp",$json)==false){
			$timestp=time();
		}else{
			$timestp=$json->{"timestamp"};
		}
		if(array_key_exists("following",$json)==false){
			$following=true;
		}else{
			$following=$json->{"following"};
		}
		if(array_key_exists("q",$json)==true){ 
			$qflag=true;
			$querystr=$json->{"q"};
		}
		if(array_key_exists("username",$json)==true){ 
			$usernameflag=true;
			$username_arg=$json->{"username"};
		}

		$follow_table = DB::table('follow_table')->where('username', $username)->get()->first();
		$followtolist=$follow_table["following"];

		$cursor;
		if($qflag==false&&$usernameflag==false&&$following==false){
			$filter = array(
				'timestp'=>['$lte'=>$timestp],
			);
			$options = array(
			    "sort" => array("timestp" => -1),
			    "limit" => $limit
			);

			$manager = new MongoDB\Driver\Manager("mongodb://192.168.1.32/");
			$query = new MongoDB\Driver\Query($filter, $options);

			$cursor = $manager->executeQuery("users_data.search_table", $query);
		}
		else if($qflag==false&&$usernameflag==false&&$following==true){
			$follow_table = DB::table('follow_table')->where('username', $username)->get()->first();
			$followtolist=$follow_table["following"];

			$filter = array(
				'timestp'=>['$lte'=>$timestp],
				"username"=> ['$in'=> $followtolist ],
			);
			$options = array(
			    "sort" => array("timestp" => -1),
			    "limit" => $limit
			);

			$manager = new MongoDB\Driver\Manager("mongodb://192.168.1.32/");
			$query = new MongoDB\Driver\Query($filter, $options);

			$cursor = $manager->executeQuery("users_data.search_table", $query);

		}
		else if($qflag==true&&$usernameflag==false&&$following==false){

			$filter = array(
				'timestp'=>['$lte'=>$timestp],
				'$text' => ['$search' => "\"$querystr\""],
			);
			$options = array(
			    "sort" => array("timestp" => -1),
			    "limit" => $limit
			);

			$manager = new MongoDB\Driver\Manager("mongodb://192.168.1.32/");
			$query = new MongoDB\Driver\Query($filter, $options);

			$cursor = $manager->executeQuery("users_data.search_table", $query);

		}
		else if($qflag==true&&$usernameflag==false&&$following==true){
			$follow_table = DB::table('follow_table')->where('username', $username)->get()->first();
			$followtolist=$follow_table["following"];

			$filter = array(
				'timestp'=>['$lte'=>$timestp],
				'$text' => ['$search' => "\"$querystr\""],
				"username"=> [ '$in'=> $followtolist ],
			);
			$options = array(
			    "sort" => array("timestp" => -1),
			    "limit" => $limit
			);

			$manager = new MongoDB\Driver\Manager("mongodb://192.168.1.32/");
			$query = new MongoDB\Driver\Query($filter, $options);

			$cursor = $manager->executeQuery("users_data.search_table", $query);

		}
		else if($qflag==false&&$usernameflag==true&&$following==true){
			$follow_table = DB::table('follow_table')->where('username', $username)->get()->first();
			$followtolist=$follow_table["following"];

			$filter = array(
				'timestp'=>['$lte'=>$timestp],
				"username"=> ["\"$username_arg\""],
				"username"=> ['$in'=> $followtolist ],
			);
			$options = array(
			    "sort" => array("timestp" => -1),
			    "limit" => $limit
			);

			$manager = new MongoDB\Driver\Manager("mongodb://192.168.1.32/");
			$query = new MongoDB\Driver\Query($filter, $options);

			$cursor = $manager->executeQuery("users_data.search_table", $query);

		}
		else if($qflag==false&&$usernameflag==true&&$following==false){

			$filter = array(
				'timestp'=>['$lte'=>$timestp],
				"username"=> ["\"$username_arg\""],
			);
			$options = array(
			    "sort" => array("timestp" => -1),
			    "limit" => $limit
			);

			$manager = new MongoDB\Driver\Manager("mongodb://192.168.1.32/");
			$query = new MongoDB\Driver\Query($filter, $options);

			$cursor = $manager->executeQuery("users_data.search_table", $query);
		}
		else if($qflag==true&&$usernameflag==true&&$following==true){
			$follow_table = DB::table('follow_table')->where('username', $username)->get()->first();
			$followtolist=$follow_table["following"];

			$filter = array(
				'timestp'=>['$lte'=>$timestp],
				'$text' => ['$search' => "\"$querystr\""],
				"username"=> ["\"$username_arg\""],
				"username"=> [ '$in'=> $followtolist ],
			);
			$options = array(
			    "sort" => array("timestp" => -1),
			    "limit" => $limit
			);

			$manager = new MongoDB\Driver\Manager("mongodb://192.168.1.32/");
			$query = new MongoDB\Driver\Query($filter, $options);

			$cursor = $manager->executeQuery("users_data.search_table", $query);
		}
		else if($qflag==true&&$usernameflag==true&&$following==false){

			$filter = array(
				'timestp'=>['$lte'=>$timestp],
				'$text' => ['$search' => "\"$querystr\""],
				"username"=> ["\"$username_arg\""],
			);
			$options = array(
			    "sort" => array("timestp" => -1),
			    "limit" => $limit
			);

			$manager = new MongoDB\Driver\Manager("mongodb://192.168.1.32/");
			$query = new MongoDB\Driver\Query($filter, $options);

			$cursor = $manager->executeQuery("users_data.search_table", $query);
		}

		foreach ($cursor as $tweet ) {
			$content=$tweet->content;
			$timestp=$tweet->timestp;
			$username=$tweet->username;
			$id=$tweet->id;
			$items[]=array(
				'id' => $id,
	    		'username' => $username,
		        'content' => $content,
		        'timestamp' => $timestp
			);
		}

		$ok_items = new Ok_items();
		if(!isset($items)){
			$ok_items->items=[];
		}
		else{
			$ok_items->items=$items;
		}
    	return response(json_encode($ok_items), 200)->header("Content-type","application/json");

	}
	///done
	public function delete_item($id){
    	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}
		$result = DB::table('search_table')->where('id', $id)->delete();
		if(isset($result)){
			return response("", 200)->header("Content-type","application/json");
		}
		else{
			return response("", 299)->header("Content-type","application/json");
		}
		
    }
    ///done
    public function follow(){
    	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$json = file_get_contents('php://input');
		$json = json_decode($json,true);
		$username_follow_to = $json['username'];
		$follow;
		if(array_key_exists("follow",$json)){
			$follow = $json['follow'];
		}
		else{
			$follow = true;
		}
		$username = Auth::user()->username;

		if($follow){
			$followrow = DB::table('follow_table')->where('username', $username)->get()->first();
			$followbyrow = DB::table('follow_table')->where('username', $username_follow_to)->get()->first();
			$following=$followrow["following"];
			$follow_by=$followrow["follow_by"];
			$following2=$followbyrow["following"];
			$follow_by2=$followbyrow["follow_by"];

			if(count($following)!=0&&in_array($username_follow_to,$following)){
			}
			else{
				$following[]=$username_follow_to;
				DB::table('follow_table')->where('username', $username)->update(['following' => $following]);
			}

			if(count($follow_by2)!=0&&in_array($username,$follow_by2)){
			}
			else{
				$follow_by2[]=$username;
				DB::table('follow_table')->where('username', $username_follow_to)->update(['follow_by' => $follow_by2]);
			}
	    	$ok = new Ok();
	    	return response(json_encode($ok), 200)->header("Content-type","application/json");
		}
		else if(!$follow){
			$followrow = DB::table('follow_table')->where('username', $username)->get()->first();
			$followbyrow = DB::table('follow_table')->where('username', $username_follow_to)->get()->first();
			$following=$followrow["following"];
			$follow_by=$followrow["follow_by"];
			$following2=$followbyrow["following"];
			$follow_by2=$followbyrow["follow_by"];

			$key = array_search($username_follow_to,$following);
			if($key===false){
			}
			else{
				unset($following[$key]);
				$following=array_values($following);
				DB::table('follow_table')->where('username', $username)->update(['following' => $following]);
			}

			$key = array_search($username,$follow_by2);
			if($key===false){
			}
			else{
				unset($follow_by2[$key]);
				$follow_by2=array_values($follow_by2);
				DB::table('follow_table')->where('username', $username_follow_to)->update(['follow_by' => $follow_by2]);
			}
	    	$ok = new Ok();
	    	return response(json_encode($ok), 200)->header("Content-type","application/json");
		}
		else{
			$response=new Error();
			$response->error="follow parameter error";
			$session->close();
			return response(json_encode($response), 200)->header("Content-type","application/json");
		}
    }
	///done
    public function get_user($username){

    	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$email=(DB::table('users_new')->where('username',$username)->first())["email"];
		$follow_table=DB::table('follow_table')->where('username',$username)->first();
    	$following_array=$follow_table["following"];
    	$follow_by_array=$follow_table["follow_by"];

    	$user_data_array= new User_data_array();
    	$user_data_array->email=$email;
		$user_data_array->followers=count($follow_by_array);
		$user_data_array->following=count($following_array);

    	$user_data=new User_data();
    	$user_data->user=$user_data_array;
    	return response(json_encode($user_data), 200)->header("Content-type","application/json");
    }
	///done
    public function get_user_following($username){
    	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$follow_table=DB::table('follow_table')->where('username',$username)->get()->first();
		$following_array=$follow_table["following"];
		$limit = Input::get('limit');
		if($limit==NULL||$limit>200){
			$limit=50;
		}

		if(count($following_array)>$limit){
			$following_array=array_slice($following_array,0,$limit);
		}

    	$user_follow_data= new User_follow_data();
    	$user_follow_data->users=$following_array;
    	return response(json_encode($user_follow_data), 200)->header("Content-type","application/json");
    }
    ///done
    public function get_user_follower($username){
     	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$follow_table=DB::table('follow_table')->where('username',$username)->get()->first();
		$following_array=$follow_table["follow_by"];
		$limit = Input::get('limit');
		if($limit==NULL||$limit>200){
			$limit=50;
		}

		if(count($following_array)>$limit){
			$following_array=array_slice($following_array,0,$limit);
		}

    	$user_follow_data= new User_follow_data();
    	$user_follow_data->users=$following_array;
    	return response(json_encode($user_follow_data), 200)->header("Content-type","application/json");
    }

}


