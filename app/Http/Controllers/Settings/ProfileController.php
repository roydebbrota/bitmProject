<?php

namespace App\Http\Controllers\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{


   public function index(){
   return view('backend.settings.profile');
   }

   public function resetPassword(){
   return view('backend.settings.profile');
   }




   public function imageUpload(Request $request){

   	$request->validate([
   		'profileImage'=>['required','image','mimes:jpg,png,jpeg','max:100'],
   	],[
   		'profileImage.required'=>'image Required',
   		'profileImage.image'=>'Invalid Image',
   		'profileImage.mimes'=>'Invalid Image Format',
   		'profileImage.max'=>'You Cross The Size Limit',
   	]);
   	$image = $request->file('profileImage');
   	if($image == true){

   	$newName =$request->user()->id.time().$image->getClientOriginalName();
   	if(Auth::user()->image !=null){
   			Storage::delete(Auth::user()->image);
   		}
   		Storage::disk('public')->putFileAs(
    	'profileImage', $image, $newName );
		$imagePath = 'public/profileImage/'.$newName;

   	}else{
   		$imagePath = null;
   	}

   	User::where('id',Auth::user()->id)
   		->update([
   			'image'=>$imagePath,
   		]);
   	return back()->with('success','<strong>Profile Image Update Successfuly</strong>');
   }
}
