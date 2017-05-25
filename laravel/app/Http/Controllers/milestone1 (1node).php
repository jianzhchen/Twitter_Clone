<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Cassandra;
use Auth;
use DB;

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
	//k
	public function additem(){
		//check login
		if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$cluster = Cassandra::cluster()->withContactPoints('192.168.1.48')->build();
		$keyspace  = 'twitter_clone';
		$session   = $cluster->connect($keyspace);

		$json = file_get_contents('php://input');
		$json = json_decode($json);

		if(property_exists($json,"parent")==false && property_exists($json,"media")==false){

			$content = $json->{"content"};

			$username = Auth::user()->username;
			$id = uniqid('',true).uniqid('',true);

			$statement2 = $session->prepare(
			"INSERT INTO search_table (username,content,id,timestp,parent,media) " .
				"VALUES (?,?,?,?,?,?)"
	           );

			$args = array(
		        'username' => $username,
		        'content' => $content,
				'id' => $id,
		        'timestp' => new Cassandra\Bigint((String)time()),
		        'parent'=>'',
		        'media'=> new Cassandra\Set(Cassandra\Type::text())
		  	);
			$options = array('arguments' => $args);
	    	$result=$session->executeAsync($statement2, $options);
	    	$result=$result->get();
	    	$ok_id = new Ok_id();
	    	$ok_id->id=$id;

	    	$session->close();
	    	return response(json_encode($ok_id), 200)->header("Content-type","application/json");
		}
		else if(property_exists($json,"parent")==true && property_exists($json,"media")==false){

			$content = $json->{"content"};
			$parent = $json->{"parent"};

			$username = Auth::user()->username;
			$id = uniqid('',true).uniqid('',true);

			$statement2 = $session->prepare(
			"INSERT INTO search_table (username,content,id,timestp,parent,media) " .
				"VALUES (?,?,?,?,?,?)"
	           );

			$args = array(
		        'username' => $username,
		        'content' => $content,
				'id' => $id,
		        'timestp' => new Cassandra\Bigint((String)time()),
		        'parent'=>$parent,
		        'media'=> new Cassandra\Set(Cassandra\Type::text())
		  	);
			$options = array('arguments' => $args);
	    	$result=$session->executeAsync($statement2, $options);
	    	$result=$result->get();
	    	$ok_id = new Ok_id();
	    	$ok_id->id=$id;

	    	$session->close();
	    	return response(json_encode($ok_id), 200)->header("Content-type","application/json");
		}
		else if(property_exists($json,"parent")==false && property_exists($json,"media")==true){

			$content = $json->{"content"};
			$media = $json->{"media"};

			$username = Auth::user()->username;
			$id = uniqid('',true).uniqid('',true);

			$mediaset=new Cassandra\Set(Cassandra\Type::text());
			foreach ($media as $key) {
				$mediaset->add($key);
			}

			$statement2 = $session->prepare(
			"INSERT INTO search_table (username,content,id,timestp,parent,media) " .
				"VALUES (?,?,?,?,?,?)"
	           );

			$args = array(
		        'username' => $username,
		        'content' => $content,
				'id' => $id,
		        'timestp' => new Cassandra\Bigint((String)time()),
		        'parent'=>"",
		        'media'=> $mediaset
		  	);
			$options = array('arguments' => $args);
	    	$result=$session->executeAsync($statement2, $options);
	    	$result=$result->get();

	    	$ok_id = new Ok_id();
	    	$ok_id->id=$id;

	    	$session->close();
	    	return response(json_encode($ok_id), 200)->header("Content-type","application/json");
		}
		else if(property_exists($json,"parent")==true && property_exists($json,"media")==true){

			$content = $json->{"content"};
			$parent = $json->{"parent"};
			$media = $json->{"media"};

			$username = Auth::user()->username;
			$id = uniqid('',true).uniqid('',true);

			$mediaset=new Cassandra\Set(Cassandra\Type::text());
			foreach ($media as $key) {
				$mediaset->add($key);
			}

			$statement2 = $session->prepare(
			"INSERT INTO search_table (username,content,id,timestp,parent,media) " .
				"VALUES (?,?,?,?,?,?)"
	           );

			$args = array(
		        'username' => $username,
		        'content' => $content,
				'id' => $id,
		        'timestp' => new Cassandra\Bigint((String)time()),
		        'parent'=>$parent,
		        'media'=> $mediaset
		  	);
			$options = array('arguments' => $args);
	    	$result=$session->executeAsync($statement2, $options);
	    	$result=$result->get();

	    	$ok_id = new Ok_id();
	    	$ok_id->id=$id;

	    	$session->close();
	    	return response(json_encode($ok_id), 200)->header("Content-type","application/json");
		}
		else{
			return;
		}
	}
	//k
	public function item($id){
		if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$cluster = Cassandra::cluster()->withContactPoints('192.168.1.48')->build();
		$keyspace  = 'twitter_clone';
		$session   = $cluster->connect($keyspace);

		$statement = $session->prepare(
		"SELECT * FROM search_table WHERE id='$id';"
           );

		$content;
		$timestp;
		$username;
		$media;
		$parent;

		$result = $session->executeAsync($statement);
		$result=$result->get();

		if(($result->count())<=0){
			$response=new Error();
			$response->error="";
			$session->close();
			return response(json_encode($response), 200)->header("Content-type","application/json");
		}

		foreach ($result as $Tweet ) {
			$content=$Tweet['content'];
			$timestp=$Tweet['timestp'];
			$username=$Tweet['username'];
			$media=$Tweet['media'];
			$parent=$Tweet['parent'];
			break;
		}


    	$ok_item = new Ok_item();
    	if(isset($media)){
	    	$ok_item->item=array(
				'id' => $id,
	    		'username' => $username,
		        'content' => $content,
		        'timestamp' => $timestp->value(),
		        'parent'=>$parent,
		        'media'=>$media->values()
	    	);
    	}
    	else{
	    	$ok_item->item=array(
				'id' => $id,
	    		'username' => $username,
		        'content' => $content,
		        'timestamp' => $timestp->value(),
		        'parent'=>$parent,
		        'media'=>array()
	    	);
    	}


    	$session->close();
    	return response(json_encode($ok_item), 200)->header("Content-type","application/json");
	}

	public function search(){
		if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$cluster = Cassandra::cluster()->withContactPoints('192.168.1.48')->build();
		$keyspace  = 'twitter_clone';
		$session   = $cluster->connect($keyspace);

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
		if(property_exists($json,"limit")==false || ($json->{"limit"})>100){
			$limit=25;
		}
		else{
			$limit = $json->{"limit"};
		}
		if(property_exists($json,"timestamp")==false){
			$timestp=time();
		}else{
			$timestp = $json->{"timestamp"};
		}
		if(property_exists($json,"following")==false){
			$following=true;
		}else{
			$following=$json->{"following"};
		}
		if(property_exists($json,"q")==true){ 
			$qflag=true;
			$querystr=$json->{"q"};
		}
		if(property_exists($json,"username")==true){ 
			$usernameflag=true;
			$username_arg=$json->{"username"};
		}

		$timestp = new Cassandra\Bigint((String)$timestp);

		$statement11 = $session->prepare(
		"SELECT * FROM follow_table WHERE username='$username';"
        );
		$result11 = $session->executeAsync($statement11);
		$result11=$result11->get();
		foreach ($result11 as $followto ) {
			$followtolist=$followto['following'];
			break;
		}
		if(isset($followtolist)){
			$followtolist=$followtolist->values();
		}
		else{
			$followtolist=[];
		}


		$statement;
		if($qflag==false&&$usernameflag==false){
			if($following){
				if(count($followtolist)==0){
					$ok_items = new Ok_items();
					$ok_items->items=[];
					$session->close();
		    		return response(json_encode($ok_items), 200)->header("Content-type","application/json");
				}

				$usernameliststr="[\"".implode("\",\"", $followtolist)."\"]";

				$statement = $session->prepare(
				"SELECT * FROM search_table WHERE expr(
					search_index, '{
						filter: [{
						    type: \"contains\",
						    field: \"username\",
						    values: $usernameliststr
				    	},
						{
							type: \"range\", field: \"timestp\", upper: $timestp , include_upper: true
						}],
						sort: {field: \"timestp\", reverse: true}
					}'
				)LIMIT $limit;");
			}
			else{
				$statement = $session->prepare(
				"SELECT * FROM search_table WHERE expr(
					search_index, '{
						filter:{
							type: \"range\", field: \"timestp\", upper: $timestp , include_upper: true
						},
						sort: {field: \"timestp\", reverse: true}
					}'
				)LIMIT $limit;"
		        );
			}
	    }
	    else if($qflag==true&&$usernameflag==false){
	    	if($following){
	    		if(count($followtolist)==0){
					$ok_items = new Ok_items();
					$ok_items->items=[];
					$session->close();
		    		return response(json_encode($ok_items), 200)->header("Content-type","application/json");
				}

				$usernameliststr="[\"".implode("\",\"", $followtolist)."\"]";

				$statement = $session->prepare(
				"SELECT * FROM search_table WHERE expr(
					search_index, '{
						sort: {field: \"timestp\", reverse: true},
						filter: [
						{
							type: \"range\", field: \"timestp\", upper: $timestp , include_upper: true
						},
						{
						    type: \"phrase\",
						    field: \"content\",
						    value: \"$querystr\"
					    },
					    {
						    type: \"contains\",
						    field: \"username\",
						    values: $usernameliststr
				    	}]
					}'
				)LIMIT $limit;"
		        );

	    	}
	    	else{
				$statement = $session->prepare(
				"SELECT * FROM search_table WHERE expr(
					search_index, '{
						sort: {field: \"timestp\", reverse: true},
						filter: [{
						    type: \"phrase\",
						    field: \"content\",
						    value: \"$querystr\"
					    },{
							type: \"range\", field: \"timestp\", upper: $timestp , include_upper: true
						}
					    ]
					}'
				)LIMIT $limit;"
		        );
			}
		}
		else if($qflag==false&&$usernameflag==true){

			$statement = $session->prepare(
			"SELECT * FROM search_table WHERE expr(
				search_index, '{
					filter: [{
					    type: \"match\",
					    field: \"username\",
					    value: \"$username_arg\"
				    },{
						type: \"range\", field: \"timestp\", upper: $timestp , include_upper: true
					}],
					sort: {field: \"timestp\", reverse: true}

				}'
			)LIMIT $limit;"
	        );
	    }
	    else if($qflag==true&&$usernameflag==true){

			if(count($followtolist)==0){
				$ok_items = new Ok_items();
				$ok_items->items=[];
				$session->close();
	    		return response(json_encode($ok_items), 200)->header("Content-type","application/json");
			}

			$usernameliststr="[\"".implode("\",\"", $followtolist)."\"]";

			$statement = $session->prepare(
			"SELECT * FROM search_table WHERE expr(
				search_index, '{
					filter: [
					{
					    type: \"match\",
					    field: \"username\",
					    value: \"$username_arg\"
				    },
					{
					    type: \"phrase\",
					    field: \"content\",
					    value: \"$querystr\",
				    },
				    {
						type: \"range\", field: \"timestp\", upper: $timestp , include_upper: true
					}
				    ],
				    sort: {field: \"timestp\", reverse: true}
				}'
			)LIMIT $limit;"
	        );
		}

		$result = $session->executeAsync($statement);
		$result=$result->get();
		foreach ($result as $tweet ) {
			$content=$tweet['content'];
			$timestp=$tweet['timestp'];
			$username=$tweet['username'];
			$id=$tweet['id'];
			$items[]=array(
				'id' => $id,
	    		'username' => $username,
		        'content' => $content,
		        'timestamp' => $timestp-> toInt()
			);
		}

		$ok_items = new Ok_items();
		if(!isset($items)){
			$ok_items->items=[];
		}
		else{
			$ok_items->items=$items;
		}
		$session->close();
    	return response(json_encode($ok_items), 200)->header("Content-type","application/json");
	}
	//k
	public function delete_item($id){
    	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$cluster = Cassandra::cluster()->withContactPoints('192.168.1.48')->build();
		$keyspace  = 'twitter_clone';
		$session   = $cluster->connect($keyspace);

		$statement = $session->prepare(
		"SELECT * FROM search_table WHERE id='$id';"
           );

		$result = $session->executeAsync($statement);
		$result=$result->get();

		if(($result->count())<=0){
			$response=new Error();
			$response->error="";
			$session->close();
			return response(json_encode($response), 200)->header("Content-type","application/json");
		}

		$media;
		foreach ($result as $mediaset ) {
			$media=$mediaset['media'];
			break;
		}

		if(isset($media)==true){
			$media = $media->values();
			foreach($media as $mdid){
				$statement1 = $session->prepare(
				"DELETE FROM media_table WHERE id='$mdid';"
		         );
				$result = ($session->executeAsync($statement1));
				$result=$result->get();
			}
		}

		$statement2 = $session->prepare(
		"DELETE FROM search_table WHERE id='$id';"
         );
		$result4 = ($session->executeAsync($statement2));
		$result4=$result4->get();


		$session->close();
		return response("", 200)->header("Content-type","application/json");
    }

    public function follow(){
    	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$cluster = Cassandra::cluster()->withContactPoints('192.168.1.48')->build();
		$keyspace  = 'twitter_clone';
		$session   = $cluster->connect($keyspace);

		$json = file_get_contents('php://input');
		$json = json_decode($json,true);
		$username_follow_to = $json['username'];
		$follow = $json['follow'];
		$username = Auth::user()->username;

		if(isset($follow)==false){
			$follow=true;
		}

		if($follow==true){
			$statement1 = $session->prepare(
			"UPDATE follow_table SET following = following + {'$username_follow_to'} WHERE username = '$username';"
	        );
	        $statement2 = $session->prepare(
			"UPDATE follow_table SET follow_by = follow_by + {'$username'} WHERE username = '$username_follow_to';"
	        );
		    $result=$session->executeAsync($statement1);
		    $result=$result->get();
	    	$result=$session->executeAsync($statement2);
	    	$result=$result->get();
	    	$session->close();


	    	$ok = new Ok();
	    	return response(json_encode($ok), 200)->header("Content-type","application/json");

		}
		else if($follow==false){
			$statement1 = $session->prepare(
			"UPDATE follow_table SET following = following - {'$username_follow_to'} WHERE username = '$username';"
	        );
	        $statement2 = $session->prepare(
			"UPDATE follow_table SET follow_by = follow_by - {'$username'} WHERE username = '$username_follow_to';"
	        );
		    $result=$session->executeAsync($statement1);
		    $result=$result->get();
	    	$result=$session->executeAsync($statement2);
	    	$result=$result->get();
	    	$session->close();

	    	
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

    public function get_user($username){

    	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$cluster = Cassandra::cluster()->withContactPoints('192.168.1.48')->build();
		$keyspace  = 'twitter_clone';
		$session   = $cluster->connect($keyspace);

		$email=(DB::table('users_new')->where('username',$username)->first())["email"];

		$statement1 = $session->prepare(
		"SELECT following FROM follow_table WHERE username = '$username';"
        );
        $statement2 = $session->prepare(
		"SELECT follow_by FROM follow_table WHERE username = '$username';"
        );
	    $result1=$session->executeAsync($statement1);
	    $result1=$result1->get();
    	$result2=$session->executeAsync($statement2);
    	$result2=$result2->get();
    	$session->close();

    	$following_array;
    	$follow_by_array;
    	if($result1->count()==0 || $result2->count()==0){
			$response=new Error();
			$response->error="user not exist";
			$session->close();
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

    	foreach ($result1 as $node1) {
    		$following_array=$node1;
    		break;
    	}
    	foreach ($result2 as $node2) {
    		$follow_by_array=$node2;
    		break;
    	}
    	$following_array=$following_array["following"];
    	$follow_by_array=$follow_by_array["follow_by"];

    	$user_data_array= new User_data_array();
    	$user_data_array->email=$email;
		$user_data_array->followers=count($follow_by_array);
		$user_data_array->following=count($following_array);

    	$user_data=new User_data();
    	$user_data->user=$user_data_array;
    	return response(json_encode($user_data), 200)->header("Content-type","application/json");
    }

    public function get_user_following($username){
    	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$cluster = Cassandra::cluster()->withContactPoints('192.168.1.48')->build();
		$keyspace  = 'twitter_clone';
		$session   = $cluster->connect($keyspace);

		$limit = Input::get('limit');
		if($limit=NULL||$limit>200){
			$limit=50;
		}

        $statement = $session->prepare(
		"SELECT following FROM follow_table WHERE username = '$username';"
        );

    	$result=$session->executeAsync($statement);
    	$result=$result->get();
    	$session->close();

    	$follow_array;
    	if(count($result)==0){
			$response=new Error();
			$response->error="user not exist";
			$session->close();
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}
    	foreach ($result as $node1) {
    		$follow_array=$node1;
    		break;
    	}
    	if($follow_array["following"]==NULL){
    		$user_follow_data= new User_follow_data();
	    	$user_follow_data->users=[];
	    	return response(json_encode($user_follow_data), 200)->header("Content-type","application/json");
    	}
    	else{
	    	$follow_array=$follow_array["following"]->values();
	    	$user_follow_data= new User_follow_data();
	    	$user_follow_data->users=$follow_array;
	    	return response(json_encode($user_follow_data), 200)->header("Content-type","application/json");
	    }
    }

    public function get_user_follower($username){
    	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$cluster = Cassandra::cluster()->withContactPoints('192.168.1.48')->build();
		$keyspace  = 'twitter_clone';
		$session   = $cluster->connect($keyspace);

		$limit = Input::get('limit');
		if($limit=NULL||$limit>200){
			$limit=50;
		}

        $statement = $session->prepare(
		"SELECT follow_by FROM follow_table WHERE username = '$username';"
        );

    	$result=$session->executeAsync($statement);
    	$result=$result->get();
    	$session->close();

    	$follow_array;
    	if(count($result)==0){
			$response=new Error();
			$response->error="user not exist";
			$session->close();
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}
    	foreach ($result as $node1) {
    		$follow_array=$node1;
    		break;
    	}
    	if($follow_array["follow_by"]==NULL){
    		$user_follow_data= new User_follow_data();
	    	$user_follow_data->users=[];
	    	return response(json_encode($user_follow_data), 200)->header("Content-type","application/json");
    	}
    	else{
	    	$follow_array=$follow_array["follow_by"]->values();
	    	$user_follow_data= new User_follow_data();
	    	$user_follow_data->users=$follow_array;
	    	return response(json_encode($user_follow_data), 200)->header("Content-type","application/json");
    	}
    }

    //k
    public function like($id){
    	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$cluster = Cassandra::cluster()->withContactPoints('192.168.1.48')->build();
		$keyspace  = 'twitter_clone';
		$session   = $cluster->connect($keyspace);

		$json = file_get_contents('php://input');
		$json = json_decode($json);

		$username = Auth::user()->username;

		if(property_exists($json,"like")==false||((bool)$json->{"like"})==true ){
			$statement1 = $session->prepare(
			"UPDATE search_table SET likeslist = likeslist + {'$username'} WHERE id = '$id';"
	        );
		    $result=$session->executeAsync($statement1);
		    $result=$result->get();
		}
		else{
			$statement1 = $session->prepare(
			"UPDATE search_table SET likeslist = likeslist - {'$username'} WHERE id = '$id';"
	        );
		    $result=$session->executeAsync($statement1);
		    $result=$result->get();
		}

		// $result22;
		// while(isset($result22)==false){
		// 	$statement1 = $session->prepare(
		// 	"SELECT * FROM search_table WHERE id='$id';"
	 //        );
		//     $result22=$session->executeAsync($statement1);
		//     $result22=$result22->get();
		// }

		// $likesList;
		// foreach ($result22 as $row ) {
		// 	$likesList=$row['likeslist'];
		// 	break;
		// }
		// if(isset($likesList)==false){
		// 	$response=new Error();
		// 	$response->error=var_dump($result22);
		// 	return response(json_encode($response), 200)->header("Content-type","application/json");
		// }

		// $size = $likesList->count();

		// $statement1 = $session->prepare(
		// "UPDATE search_table SET likes=$size WHERE id = '$id';"
  //       );
	 //    $result=$session->executeAsync($statement1);
	 //    $result=$result->get();
    	$session->close();

		$ok = new Ok();
    	return response(json_encode($ok), 200)->header("Content-type","application/json");
		
    }

    //k
    public function addmedia(Request $request){

		if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$cluster = Cassandra::cluster()->withContactPoints('192.168.1.48')->build();
		$keyspace  = 'twitter_clone';
		$session   = $cluster->connect($keyspace);


		$file = file_get_contents($_FILES["content"]["tmp_name"]);;
		$type=$request->file('content')->getMimeType();

		$id = "MD".uniqid('',true).uniqid('',true);

		$statement2 = $session->prepare(
		"INSERT INTO media_table (id,content,type) " .
			"VALUES (?,?,?)"
           );

		$args = array(
			'id' => $id,
			'content'=> new Cassandra\Blob($file),
			'type'=>$type
	  	);
		$options = array('arguments' => $args);
    	$result=$session->executeAsync($statement2, $options);
    	$result=$result->get();
    	$ok_id = new Ok_id();
    	$ok_id->id=$id;
    	return response(json_encode($ok_id), 200)->header("Content-type","application/json");
    }

    //k
    public function media($id){

    	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$cluster = Cassandra::cluster()->withContactPoints('192.168.1.48')->build();
		$keyspace  = 'twitter_clone';
		$session   = $cluster->connect($keyspace);

		$statement = $session->prepare(
		"SELECT * FROM media_table WHERE id='$id';"
           );

		$content;
		$type;

		$result = $session->executeAsync($statement);
		$result=$result->get();

		if(($result->count())<=0){
			$response=new Error();
			$response->error="";
			$session->close();
			return response(json_encode($response), 200)->header("Content-type","application/json");
		}

		foreach ($result as $media ) {
			$content=$media['content'];
			$type=$media['type'];
			break;
		}

		return response($content->toBinaryString())->header('Content-Type', $type);
    }


}


