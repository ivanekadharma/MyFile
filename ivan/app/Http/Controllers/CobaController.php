<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as Controller;
use Illuminate\Support\facades\DB;
use Request;
use App\User;
use App\Article;


class CobaController extends Controller
{
	public function get_data(){

/*
		$arr_tojson=array('encrypt');
		$arr_tojson = json_encode($arr);
		users::create(['encrypt' => $arr_tojson]);
*/
		$data = DB::table('users')->get();
		$data1 = User::all();
		for ($i=0; $i < count($data1); $i++) { 
			$data1[$i]["encrypt"] = bcrypt($data1[$i]->password);
		}
		return $data1;


	}    
 
	public function insert_user(Request $name, $email, $password){
		
		try{
			
			$users = new User;
			$users->name = $name;
			$users->email = $email;	
			$users->password = $password;

			
			if($users->save()){
				$data[] = array();
				$data[0]["success"] = "1";
				$data[0]["message"] = "Berhasil";
				return response()->json($data);	
			}

			} catch (Exception $e){
				$data[] = "";
				$data["success"] = "0";
				$data["message"] = "Gagal";


				return response()->json($data);
			}
			 //ini backup
		

			//$insert= User::make($request->all());
			//json ada 3 baris, status+message sukses nilai nol atau satu, message->tampilan yang muncul pada user
			/*$user= User::create([
				'name'=>$request->name,
				'email'=>$request->email,
				'password'=>bcrypt($request->password)]);
			*/

			//$users = new User;
			//DB::table('User')->insert([
/*
			$user= DB::table('User')->post;
			'name'=>$user->name;
			'password'=>$user->password;
			'email'=>$user->email;
			//]);
*/

			return "success";

			//return Response()->json($users->all());
			}

	public function update_data($id, $name, $email, $password){


			$users= User::find($id);

			$users->name= $name;
			$users->email= $email;
			$users->password= $password;
			
			if($users->save()){
				return "success";
			}else{
				return "fail";
			}

			 
	}
		public function delete_data($id){
			$users= User::find($id);

			$users->delete();

			return "success delete!!";
		}

		public function get_data_article(){
			$data=Article::all(); // ini buat import semua table db kedalam function ini

			return response()->json($data);
		}

		public function get_insert_article($title, $body, $images){
			
			try {
				$artikel= new Article;

				$artikel->title=$title;
				$artikel->body=$body;
				$artikel->images='http://localhost/ivan/resources/assets/images/'.$images;

				if($artikel->save()){
				$message[0]["message"]="Berhasil!";
				$message[1]["success!!"]="1";

				return response()->json($message);
			}

			} catch (Exception $e) {
				$message[0]="";
				$message["message"]="gagal!";
				$message["success?"] = "0";
				return response()->json($message);
			}
			
		}

		public function get_update_article($id, $title, $body, $images){

			$artikel= Article::find($id);

			$artikel->title=$title;
			$artikel->body=$body;
			$artikel->images="http://localhost/ivan/resources/assets/images/".$images;

			if($artikel->save()){
				return "Update Success";
			}else{
				return "Update Fail :( , please try again later";
			}
		}

		public function get_delete_article($id){
			$artikel = Article::find($id);
			if($artikel->delete()){
				return "delete success!!";
			} else{
				return "delete fail :(" ;
			}
		}

}

 ?>