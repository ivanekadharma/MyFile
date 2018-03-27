<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as Controller;
use Illuminate\Support\facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Article;
Use App\pulsa_dummy;
use App\Wallet;
use Closure;
use Hash;
use JWTAuth;
//use App\wallet as test;

class CobaController extends Controller
{
	//operation mathematicss
	public function get_minus($a, $b){
		$total = $a-$b;
		return $total;
	}
	public function get_plus($a, $b){
		$total= $a+$b;
		return $total;
	}
	public function get_multiple($a, $b){
		$total= $a*$b;
		return $total;
	}
	public function get_devide($a, $b){
		$total= $a/$b;
		return $total;
	}
	//ini selalu ada di setiap page, untuk validasi token nya
	public function validasiToken($token){
		try {
            $user = JWTAuth::toUser($token);
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['error'=>'Token is Invalid']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['error'=>'Token is Expired']);
            }else{
                return response()->json(['error'=>'Something is wrong']);
            }
        }
	}
	//end

	//public function wallet_new(Request )
	public function register(Request $request){
		
		$user= User::where('email', $request->email)->first();

		/*
		 * $user =User::firstOrNew([ 'email' => $request-> email]);
		 * if ($user->exist) {
		 * // asd
		 * } 
		 */

		$wallet= new Wallet();
		//$data= User::find($request->email);

		if(!$user){
			$input= $request->all();

			$input['password'] = Hash::make($input['password']);
			$input['email'] = $input['email'];
			$input['name'] = $input['name'];
			$input['phoneNumb'] = $input['phoneNumb'];
			$send_id = User::create($input);

			//create wallet id
			//$temp= DB::table('users')->where('email', $request->email)->get();

			$wallet->saldo = 0;
			$wallet->id_user = $send_id->id;
			$wallet->save();
			//end
			
			// $message[0]['success'] = '1';
			// $message[0]['message'] = "Registration Success!";
			return response()->json(['result'=>'Registration success']);
			

			//return response()->json(['result' => 'sukses register']);
		}else{
		
		// $message['0']['success'] = '0';
		// $message['0']['message'] = "Registration Failed!";
		return response()->json(['result'=>'Registration Fail!']);
		//return response()->json(['result' => 'gagal register']);
		
		}
	}


	
/*$message['0']['success'] = '1';
		$message['0']['message'] = "Registration Success!";
		return response()->json($message);
$message['0']['success'] = '0';
		$message['0']['message'] = "Registration Failed!";
		return response()->json($message);*/
		
	public function login(Request $request)
    {	
    	$input = $request->all();
    	if (!$token = JWTAuth::attempt($input)) {
            return response()->json(['result' => 'wrong email or password.']);
    	}
    	else{
    		//delete this if error (down)
    		// $user = DB::table('users')->first();
	        $user = DB::table('users')->Where("email", $request->email)->first();
	        $temp = $user->id_device;
	        //$message[0]["token"] = $token;
	     	if(empty($temp)){
	     		$temp=$request->id_device;
	     		//$message[0]["success"]='1';
				//$message[0]["message"]= $token;
	    	 	return response()->json(['result'=>($token)]);
	    	 	//return response()->json( ['result' => $token]);
		    }else if(!empty($temp)){
		    	
	   //  		$message[0]["success"]='0';
				// $message[0]["message"]= 'Your account is still active in another device!';
				return response()->json(['result'=>'fail!']);
				
				//return 'error';
	    	}
    	}
    }

	public function get_user_details(Request $request)
    {
	    $input = $request->all();
	    $user = JWTAuth::toUser($input['token']);

	    $wallet_user= Wallet::find($user->id);

	    if($wallet_user){
	    	
	    	$user['wallet']= $wallet_user->saldo;

	   	}else if(!$wallet_user){
	   		$user['wallet']= 0;
	   	}

	   	$user;
        return response()->json(['result'=>$user]);
    }

	public function wallet_minus (Request $request){
		$this->validasiToken($request->input('token'));
		$data = Wallet::find($request->id);
		
		$update = Wallet::find($request->id);
		//return $data;
		$update->saldo = $this->get_minus($data->saldo, $request->nominal);
		
		try {
			if($update->save()){
				// $message[0]["success"]='1';
				// $message[0]["message"]='Transaction Success!';
				return response()->json(['result'=>(('transaction success'))]);
			}
		} catch (Exception $e) {
			// $message[0]["success"]='0';
			// $message[0]["message"]= 'Transaction Failed!';
			return response()->json(['result'=>'Transaction Failed!']);
		}
	}

	public function wallet_plus (Request $request){
		$this->validasiToken($request->input('token'));
		$data = Wallet::find($request->id);
		
		$update = Wallet::find($request->id);
		$update->saldo = $this->get_plus($data->saldo, $request->nominal);
		
		try {
			if($update->save()){
				// $message[0]["success"]='1';
				// $message[0]["message"]='Transaction Success!';
				return response()->json(['result'=>('transaction success')]);
			}
		} catch (Exception $e) {
			$message[0]["success"]='0';
			$message[0]["message"]= 'Transaction Failed!';
			return response()->json(['result'=>('Transaction Failed!')]);
		}
	}



	public function wallet_multiple (Request $request){
		$this->validasiToken($request->input('token'));
		$data = Wallet::find($request->id);
		
		$update = Wallet::find($request->id);
		$update->saldo = $this->get_minus($data->saldo, $request->nominal);
		
		try {
			if($update->save()){
				// $message[0]["success"]="1";
				// $message[0]["message"]='Transaction Success!';
				return response()->json(['result'=>('transaction success')]);
			}
		} catch (Exception $e) {
			$message[0]["success"]="0";
			$message[0]["message"]= 'Transaction Failed!';
			return response()->json(['result'=>('Transaction Failed!')]);
		}
	}

	public function pulsa_operators(Request $request){
		$this->validasiToken($request->input('token'));
		$data= DB::table('pulsa_operators')->get();

		return response()->json(['result' => $data]);
	}


	public function pulsa(Request $request){
		$this->validasiToken($request->input('token'));
//tambah pulsa_operators
		$data= DB::table('pulsa_providers')
		->join('providers', 'pulsa_providers.providers_id','=','providers.id')
		->join('pulsa_operators', 'pulsa_operators.id_provider', '=', 'providers.id')
		->select('pulsa_operators.kode_provider','providers.name','pulsa_providers.*')
		->get();
		if(count($data)==0){
			return 'data kosong';
		}else{
			return response()->json(['result'=>($data)]);
		}
	}

	public function getOperator(){//providers pulsa_operator
		$this->validasiToken($request->input('token'));
		$data= DB::table('providers')
		->join('pulsa_operators', 'providers.id', '=', 'pulsa_operators.id_provider')
		->select('pulsa_operators.*', 'pulsa_operators.kode_provider', 'providers.*')
		->get();

		return response()->json(['result'=>($data)]);

	}

	public function wallet(Request $request){
		$this->validasiToken($request->input('token'));
		$data= DB::table('wallets')->get();

		return response()->json(['result'=>($data)]);
	}

	public function get_data(){

		$this->validasiToken($request->input('token'));
		$data= new User();
		$data1 = User::all();
		for ($i=0; $i < count($data1); $i++) { 
			$data1[$i]["encrypt"] = bcrypt($data1[$i]->password);
		}
		// array_push($data1, $data);
		return response()->json($data1);


	}    
 
	public function insert_user(Request $request){

		$this->validasiToken($request->input('token'));
		$users  = new User();
		$users->email = $request->email;
		$users->password= bcrypt($request->password);
		$users->name= $request->name;
		try {

			if($users->save()){
			$message[0]["success"]='1';
			$message[0]["message"]='Data anda berhasil kami simpan!'; 
			return response()->json($message);

			}
		} catch (Exception $e) {
			$message[0]["success"]="0";
			$message[0]["message"]='Failed!';
			return response()->json($message);
		}
		
			
		
		
		//return $email;
	}

	public function update_data(Request $request){
			$this->validasiToken($request->input('token'));
		/*
			$users= User::find($id);

			$users->name= $name;
			$users->email= $email;
			$users->password= $password;
			
			if($users->save()){
				return "success";
			}else{
				return "fail";
			}
		*/

			$users = User::find($request->id);

			$users->name=$request->name;
			$users->email=$request->email;
			$users->password=$request->password;
			try {

			if($users->save()){
			$message[0]["success"]='1';
			$message[0]["message"]='Data anda berhasil kami update!'; 
			return response()->json($message);

			}
		} catch (Exception $e) {
			$message[0]["success"]='0';
			$message[0]["message"]='Failed!';
			return response()->json($message);
		}

	}


		public function delete_data(Request $request){

			$this->validasiToken($request->input('token'));

			$users= User::find($request->id);
			$users->delete($request);

		try {

			if($users->save()){
			$message[0]["success"]='1';
			$message[0]["message"]='Data anda berhasil kami simpan!'; 
			return response()->json($message);

			}
		} catch (Exception $e) {
			$message[0]["success"]='0';
			$message[0]["message"]='Failed!';
			return response()->json($message);
		}	
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

		public function test() {
			// $test= str_random(10);
			$test= (string)rand(10000000,99999999); // 8 digit
			return $test;
        }

		public function test2() {
			$users = User::where('id', '!=', 1)
						->orderBy('created_at', 'desc')
						->first();

			echo $users;
		}


}

 ?>