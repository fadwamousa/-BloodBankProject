<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Validator;
use App\Client;
class AuthController extends Controller
{
	private function apiResponse($status,$message,$data=null){
		$responses = ['status'=>  $status ,
		              'message'=> $message,
		              'data'=> $data];

		return response()->json($responses);              
	}
    public function register(Request $request){

    	//validate the data
    	$validate = validator()->make($request->all(),
    		['name'=>'required|max:150',
    		'email'=>'required|max:200|unique:clients|email',
    		'phone'=>'required|max:11',
    		'password'=>'required|confirmed',
    		'type_id'=>'required',
    		'city_id'=>'required',
    		'last_date_request'=>'required',
    		'date_birth'=>'required']
    	);

    	if($validate->fails()){

    		return $this->apiResponse(0,'faild to send data',$validate->errors());
    	}else{
            $request->merge(['password'=>bcrypt($request->password)]);
            //
    		$clients = Client::create($request->all());
    		//that is mean all fillable variable will send to DB
    		$clients->api_token = str_random(60);

            $clients->save();

    		return $this->apiResponse(1,'data inserted',[
    			'api_token' => $clients->api_token,
    			'clients'    => $clients
    		]);

    		//api_token not appear in data 

    	}

    }

    public function login(Request $request){

    	//validate the data
    	$validater = validator()->make($request->all(),
    		['phone'=>'required',
    		'password'=>'required']
    	);

    	if($validater->fails()){

    		return $this->apiResponse(0,'faild to send data',$validater->errors());
    	}
        //$auth = auth()->guard('api')->validate($request->all())
    	$client = Client::where('phone',$request->phone)->first();
    	if($client){

    		if(Hash::check($request->password,$client->password))

    		{
                   return $this->apiResponse(1,'good',[
                   	'api_token'=> $client->api_token
                   	,'client'=>$client]);
    		}

    	}else{
    		return $this->apiResponse(0,'fail data');
    	}
    }


    public function profile(Request $request){

	//$data_client = Client::where('id',$request->id)->get();
	$data_client = Client::where(function($query) use($request){

		if($request->has('id')){
			$query->where('id',$request->id);
		}
	})->get();

	return $this->apiResponse(1,'تم عرض الداتا',$data_client); 
	

    }



}
/*


The password contains characters from at least three of the following five categories:

English uppercase characters (A – Z)
English lowercase characters (a – z)
Base 10 digits (0 – 9)
Non-alphanumeric (For example: !, $, #, or %)
Unicode characters

|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/
not work

|regex:/(02)[0-9]{11}/ in phone
*/
