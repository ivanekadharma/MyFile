<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as Controller;
use Illuminate\Support\facades\DB;

use App\User;

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
 
	public function insert_user($name, $email, $password){

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

			//json ada 3 baris, status+message sukses nilai nol atau satu, message->tampilan yang muncul pada user
			return "success";
			//return Response()->json($users-->all());
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


}

 ?>