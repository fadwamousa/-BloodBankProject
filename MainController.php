<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Governorate;
use App\City;
use App\Category;
use App\Setting;
use App\Contactus;
use App\Post;
use Validator;
class MainController extends Controller
{



	private function apiResponse($status,$message,$data=null){

		$responces = [
			'status' => $status,
			'message'=> $message,
			'data'   => $data
		];

		return response()->json($responces);

	}

    public function posts(){
        $posts = Post::all();
        return $this->apiResponse(1,'goog',$posts);  
    }

    public function governorates(){

    	$governorate = Governorate::all();
    	return $this->apiResponse(1,'The Governorate is showed',$governorate);              

    }

    public function cities(Request $request){

    	//$cities = City::where('governorate_id',$request->governorate_id)->get();

    	$cities = City::where(function($query) use($request){

    		if($request->has('governorate_id')){
    			$query->where('governorate_id',$request->governorate_id);
    		}
    	}
    	)->get();
    	return $this->apiResponse(1,'Good',$cities);
    }

    public function categories(Request $request){

    	$cats = Category::all();
    	return $this->apiResponse(1,'تم عرض الداتا بنجاح',$cats);
    }

    public function showSetting(){
    	$settings = Setting::all();
    	return $this->apiResponse(1,'تم عرض الاعدادت بشكل صحيح',$settings);
    }

    public function storeContact(Request $request){

        //validate the data
        $validate = validator()->make($request->all(),
            ['name'=>'required|max:20',
             'email'=>'required|unique:contactus|email',
            'phone'=>'required|regex:/(01)[0-9]{9}/',
            'title'=>'required|min:10|max:250',
            'message'=>'required|min:20|max:250']);

        
        if($validate->fails()){
            return $this->apiResponse(0,'error',$validate->errors());
        }
    //response json containing all the validation errors.

        $contactus_create = Contactus::create([
            'name'=>request('name'),
            'email'=>request('email'),
            'phone'=>request('phone'),
            'title'=>request('title'),
            'message'=>request('message')]);

        $contactus_create->save();

        return $this->apiResponse(1,'تم ادخال الداتا بشكل صحيح',$contactus_create);


    }
}
