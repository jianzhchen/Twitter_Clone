<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use MongoDB;
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

		$json = file_get_contents('php://input');
		$json = json_decode($json);

		if(property_exists($json,"parent")==false && property_exists($json,"media")==false){

			$content = $json->{"content"};

			$username = Auth::user()->username;
			$id = uniqid('',true).uniqid('',true);

			// $statement2 = $session->prepare(
			// "INSERT INTO search_table (username,content,id,timestp,parent,media) " .
			// 	"VALUES (?,?,?,?,?,?)"
	  //          );

			// $args = array(
		 //        'username' => $username,
		 //        'content' => $content,
			// 	'id' => $id,
		 //        'timestp' => new Cassandra\Bigint((String)time()),
		 //        'parent'=>'',
		 //        'media'=> new Cassandra\Set(Cassandra\Type::text())
		 //  	);
			// $options = array('arguments' => $args);
	  //   	$session->execute($statement2, $options);
			$collection = (new MongoDB\Client('mongodb://192.168.1.112:27017'))->tc->search_table;
			$insertOneResult = $collection->insertOne([
			    'username' => $username,
			    'content' => $content,
			    'id' => $id,
			    'timestp' => time(),
			  	'parent' => "",
			    'media' => [],
			]);

	    	$ok_id = new Ok_id();
	    	$ok_id->id=$id;

	    	return response(json_encode($ok_id), 200)->header("Content-type","application/json");
		}
		else if(property_exists($json,"parent")==true && property_exists($json,"media")==false){

			$content = $json->{"content"};
			$parent = $json->{"parent"};

			$username = Auth::user()->username;
			$id = uniqid('',true).uniqid('',true);

			// $statement2 = $session->prepare(
			// "INSERT INTO search_table (username,content,id,timestp,parent,media) " .
			// 	"VALUES (?,?,?,?,?,?)"
	  //          );

			// $args = array(
		 //        'username' => $username,
		 //        'content' => $content,
			// 	'id' => $id,
		 //        'timestp' => new Cassandra\Bigint((String)time()),
		 //        'parent'=>$parent,
		 //        'media'=> new Cassandra\Set(Cassandra\Type::text())
		 //  	);

			$collection = (new MongoDB\Client('mongodb://192.168.1.112:27017'))->tc->search_table;
			$insertOneResult = $collection->insertOne([
			    'username' => $username,
			    'content' => $content,
			    'id' => $id,
			    'timestp' => time(),
			  	'parent' => $parent,
			    'media' => [],
			]);


	    	$ok_id = new Ok_id();
	    	$ok_id->id=$id;

	    	return response(json_encode($ok_id), 200)->header("Content-type","application/json");
		}
		else if(property_exists($json,"parent")==false && property_exists($json,"media")==true){

			$content = $json->{"content"};
			$media = $json->{"media"};

			$username = Auth::user()->username;
			$id = uniqid('',true).uniqid('',true);

			$mediaset=array();
			foreach ($media as $key) {
				$mediaset[]=$key;
			}

			// $statement2 = $session->prepare(
			// "INSERT INTO search_table (username,content,id,timestp,parent,media) " .
			// 	"VALUES (?,?,?,?,?,?)"
	  //          );

			// $args = array(
		 //        'username' => $username,
		 //        'content' => $content,
			// 	'id' => $id,
		 //        'timestp' => new Cassandra\Bigint((String)time()),
		 //        'parent'=>"",
		 //        'media'=> $mediaset
		 //  	);

			$collection = (new MongoDB\Client('mongodb://192.168.1.112:27017'))->tc->search_table;
			$insertOneResult = $collection->insertOne([
			    'username' => $username,
			    'content' => $content,
			    'id' => $id,
			    'timestp' => time(),
			  	'parent' => '',
			    'media' => $mediaset,
			]);

	    	$ok_id = new Ok_id();
	    	$ok_id->id=$id;

	    	return response(json_encode($ok_id), 200)->header("Content-type","application/json");
		}
		else if(property_exists($json,"parent")==true && property_exists($json,"media")==true){

			$content = $json->{"content"};
			$parent = $json->{"parent"};
			$media = $json->{"media"};

			$username = Auth::user()->username;
			$id = uniqid('',true).uniqid('',true);

			$mediaset=array();
			foreach ($media as $key) {
				$mediaset[]=$key;
			}

			// $statement2 = $session->prepare(
			// "INSERT INTO search_table (username,content,id,timestp,parent,media) " .
			// 	"VALUES (?,?,?,?,?,?)"
	  //          );

			// $args = array(
		 //        'username' => $username,
		 //        'content' => $content,
			// 	'id' => $id,
		 //        'timestp' => new Cassandra\Bigint((String)time()),
		 //        'parent'=>$parent,
		 //        'media'=> $mediaset
		 //  	);

			$collection = (new MongoDB\Client('mongodb://192.168.1.112:27017'))->tc->search_table;
			$insertOneResult = $collection->insertOne([
			    'username' => $username,
			    'content' => $content,
			    'id' => $id,
			    'timestp' => time(),
			  	'parent' => $parent,
			    'media' => $mediaset,
			]);

	    	$ok_id = new Ok_id();
	    	$ok_id->id=$id;

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

		$collection = (new MongoDB\Client('mongodb://192.168.1.112:27017'))->tc->search_table;
		$document = $collection->findOne(['id' => $id]);

		if(isset($document)==false || $document==null){
			$response=new Error();
			$response->error="";
			return response(json_encode($response), 200)->header("Content-type","application/json");
		}


		$content=$document["content"];
		$timestp=$document["timestp"];
		$username=$document["username"];
		$media=$document["media"];
		$parent=$document["parent"];

		$ok_item=new Ok_item();
    	$ok_item->item=array(
			'id' => $id,
    		'username' => $username,
	        'content' => $content,
	        'timestamp' => $timestp,
	        'parent'=>$parent,
	        'media'=>$media
    	);

    	return response(json_encode($ok_item), 200)->header("Content-type","application/json");
	}
	//k
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
		$username=Auth::user()->name;
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

		$collection = (new MongoDB\Client('mongodb://192.168.1.112:27017'))->tc->follow_table;
		$document = $collection->findOne(['username' => $username]);
		$followtolist=$document['following'];

		$statement;
		if($qflag==false&&$usernameflag==false){
			if($following){
				if(count($followtolist)==0){
					$ok_items = new Ok_items();
					$ok_items->items=[];
		    		return response(json_encode($ok_items), 200)->header("Content-type","application/json");
				}
				//no query, no username, yes following

				$cursor = $collection->find(
					['username' => [
						'$in'=>$followtolist],
					'timestp'=>[
						'$lte'=>$timestp]],

					['limit' => $limit,
					'sort' => ['timestp' => -1],
					]
				);
			}
			else{

				//no query, no username, no following
				$cursor = $collection->find(
					['timestp'=>[
						'$lte'=>$timestp]],

					['limit' => $limit,
					'sort' => ['timestp' => -1],
					]
				);
			}
	    }
	    else if($qflag==true&&$usernameflag==false){
	    	if($following){
	    		if(count($followtolist)==0){
					$ok_items = new Ok_items();
					$ok_items->items=[];
		    		return response(json_encode($ok_items), 200)->header("Content-type","application/json");
				}
				//yes query, no username, yes following

				$cursor = $collection->find(
					['username' => [
						'$in'=>$followtolist],
					'timestp'=>[
						'$lte'=>$timestp],
					'content'=>[
						'$text'=>$querystr]],
					['limit' => $limit,
					'sort' => ['timestp' => -1],
					]
				);


	    	}
	    	else{
				//yes query, no username, no following

				$cursor = $collection->find(
					['timestp'=>[
						'$lte'=>$timestp],
					'content'=>[
						'$text'=>$querystr]],
					['limit' => $limit,
					'sort' => ['timestp' => -1],
					]
				);
			}
		}
		else if($qflag==false&&$usernameflag==true){

			//no query, yea username, no following

			$cursor = $collection->find(
				['timestp'=>[
					'$lte'=>$timestp],
				'username'=>$username_arg],
				['limit' => $limit,
				'sort' => ['timestp' => -1],
				]
			);

	    }
	    else if($qflag==true&&$usernameflag==true){

			//yes query, yes username, yes following

			$cursor = $collection->find(
				['username' => $username_arg,
				'timestp'=>[
					'$lte'=>$timestp],
				'content'=>[
					'$text'=>$querystr]],
				['limit' => $limit,
				'sort' => ['timestp' => -1],
				]
			);

		}

		foreach ($cursor as $tweet ) {
			$content=$tweet['content'];
			$timestp=$tweet['timestp'];
			$username=$tweet['username'];
			$id=$tweet['id'];
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
	//k
	public function delete_item($id){
    	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$collection = (new MongoDB\Client('mongodb://192.168.1.112:27017'))->tc->search_table;
		$document = $collection->findOne(['id' => $id]);

		if(isset($document)==false||$document==null){
			$response=new Error();
			$response->error="";
			return response(json_encode($response), 200)->header("Content-type","application/json");
		}

		$media=$document['media'];

		if(isset($media)==true){
			foreach($media as $mdid){
				$collection2= (new MongoDB\Client('mongodb://192.168.1.112:27017'))->tc->media_table;
				$deleteResult = $collection2->deleteOne(['id' => $mdid]);
			}
		}
		$deleteResult = $collection->deleteOne(['id' => $id]);
		return response("", 200)->header("Content-type","application/json");
    }
    //k
    public function follow(){
    	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$json = file_get_contents('php://input');
		$json = json_decode($json,true);
		$username_follow_to = $json['username'];
		$follow = $json['follow'];
		$username = Auth::user()->username;

		if(isset($follow)==false){
			$follow=true;
		}

		$collection = (new MongoDB\Client('mongodb://192.168.1.112:27017'))->tc->follow_table;
			

		if($follow==true){

			$document = $collection->updateOne(['username' => $username],['$addToSet'=>	['following'=>$username_follow_to]]);
			$document = $collection->updateOne(['username' => $username_follow_to],['$addToSet'=>	['follow_by'=>$username]]);
	    	$ok = new Ok();
	    	return response(json_encode($ok), 200)->header("Content-type","application/json");

		}
		else if($follow==false){
			$document = $collection->updateOne(['username' => $username],['$pull'=>	['following'=>$username_follow_to]]);
			$document = $collection->updateOne(['username' => $username_follow_to],['$pull'=>	['follow_by'=>$username]]);
	    	$ok = new Ok();
	    	return response(json_encode($ok), 200)->header("Content-type","application/json");
		}
		else{
			$response=new Error();
			$response->error="follow parameter error";
			return response(json_encode($response), 200)->header("Content-type","application/json");
		}
    }
    //k
    public function get_user($username){

    	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$email=(DB::table('users_new')->where('username',$username)->first())["email"];

		$collection = (new MongoDB\Client('mongodb://192.168.1.112:27017'))->tc->follow_table;
		$document = $collection->findOne(['username' => $username]);

    	$following_array=$document['following'];
    	$follow_by_array=$document['follow_by'];
    	if(isset($document)==false|| $document ==null){
			$response=new Error();
			$response->error="user not exist";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

    	$user_data_array= new User_data_array();
    	$user_data_array->email=$email;
		$user_data_array->followers=count($follow_by_array);
		$user_data_array->following=count($following_array);

    	$user_data=new User_data();
    	$user_data->user=$user_data_array;
    	 
    	return response(json_encode($user_data), 200)->header("Content-type","application/json");
    }
    //k
    public function get_user_following($username){
    	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}


		$limit = Input::get('limit');
		if($limit=NULL||$limit>200){
			$limit=50;
		}

		$collection = (new MongoDB\Client('mongodb://192.168.1.112:27017'))->tc->follow_table;
		$document = $collection->findOne(['username' => $username]);

    	if(isset($document)==false||$document==null){
			$response=new Error();
			$response->error="user not exist";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

    	$follow_array=$document['following'];

    	$user_follow_data= new User_follow_data();
    	$user_follow_data->users=$follow_array;
    	 
    	return response(json_encode($user_follow_data), 200)->header("Content-type","application/json"); 
    }
    //k
    public function get_user_follower($username){
    	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		$limit = Input::get('limit');
		if($limit=NULL||$limit>200){
			$limit=50;
		}

        $collection = (new MongoDB\Client('mongodb://192.168.1.112:27017'))->tc->follow_table;
		$document = $collection->findOne(['username' => $username]);

    	if(isset($document)==false||$document==null){
			$response=new Error();
			$response->error="user not exist";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

    	$follow_array=$document['follow_by'];

    	$user_follow_data= new User_follow_data();
    	$user_follow_data->users=$follow_array;
    	 
    	return response(json_encode($user_follow_data), 200)->header("Content-type","application/json");
    }
    //k
    public function like($id){
    	if(!Auth::check()){
			$response=new Error();
			$response->error="not login in";
			return response(json_encode($response), 200)->header("Content-type","application/json");
    	}

		// $json = file_get_contents('php://input');
		// $json = json_decode($json);

		// $username = Auth::user()->username;

		// if(property_exists($json,"like")==false||((bool)$json->{"like"})==true ){
		// 	$statement1 = $session->prepare(
		// 	"UPDATE search_table SET likeslist = likeslist + {'$username'} WHERE id = '$id';"
	 //        );
		//     $result=$session->execute($statement1);
		// }
		// else{
		// 	$statement1 = $session->prepare(
		// 	"UPDATE search_table SET likeslist = likeslist - {'$username'} WHERE id = '$id';"
	 //        );
		//     $result=$session->execute($statement1);
		// }

		// // $result22;
		// // while(isset($result22)==false){
		// // 	$statement1 = $session->prepare(
		// // 	"SELECT * FROM search_table WHERE id='$id';"
	 // //        );
		// //     $result22=$session->executeAsync($statement1);
		// //     $result22=$result22->get();
		// // }

		// // $likesList;
		// // foreach ($result22 as $row ) {
		// // 	$likesList=$row['likeslist'];
		// // 	break;
		// // }
		// // if(isset($likesList)==false){
		// // 	$response=new Error();
		// // 	$response->error=var_dump($result22);
		// // 	return response(json_encode($response), 200)->header("Content-type","application/json");
		// // }

		// // $size = $likesList->count();

		// // $statement1 = $session->prepare(
		// // "UPDATE search_table SET likes=$size WHERE id = '$id';"
  		// 		//       );
	 // //    $result=$session->executeAsync($statement1);
	 // //    $result=$result->get();
    	
		 
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

		$file = file_get_contents($_FILES["content"]["tmp_name"]);
		
		$type=$request->file('content')->getMimeType();

		$id = "MD".uniqid('',true).uniqid('',true);

		$collection = (new MongoDB\Client('mongodb://192.168.1.112:27017'))->tc->media_table;
		$document = $collection->insertOne(['id' => $id,'content' => bin2hex($file),'type' => $type]);

    	$ok_id = new Ok_id();
    	$ok_id->id=$id;
    	 
    	return response(json_encode($ok_id), 200)->header("Content-type","application/json");
    }
    //k
    public function media($id){

   //  	if(!Auth::check()){
			// $response=new Error();
			// $response->error="not login in";
			// return response(json_encode($response), 200)->header("Content-type","application/json");
   //  	}

		$collection = (new MongoDB\Client('mongodb://192.168.1.112:27017'))->tc->media_table;
		$document = $collection->findOne(['id' => $id]);
		$content=$document['content'];
		$type=$document['type'];

		if(isset($document)==false||$document==null){
			$response=new Error();
			$response->error="";
			return response(json_encode($response), 200)->header("Content-type","application/json");
		}
		 
		return response(hex2bin($content),200)->header('Content-Type', $type);
    }


}


