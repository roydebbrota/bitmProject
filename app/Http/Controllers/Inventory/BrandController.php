<?php

namespace App\Http\Controllers\Inventory;
use App\InventoryCategory;
use App\InventorySubCategory;
use App\InventoryBrand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function index(){
    	$subcategory = InventorySubCategory::where('visibility',1)->get();
    	$brand = InventoryBrand::get();
    	return view('backend.inventory.brand',[
    		'subCategory'=>$subcategory,
    		'brand'=>$brand
    	]);
    }
    public function createBrand(Request $request){
    	$validator = Validator::make($request->all(),[
    		'subCategoryName'=>['required','exists:inventory_sub_categories,id'],
    		'brandName'=>['required','string','between:3,50'],
    	],[
    		'subCategoryName.required'=>'Select A Sub-Category',
    		'subCategoryName.exists'=>'Select A Sub-Category',
    		'brandName.required'=>'Brand Name Required',
    		'brandName.string'=>'Brand Name will be String',
    		'brandName.between'=>'Brand Name will be 3-50 Characters',

    	]);
    	if($validator->fails()){
    		return back()->withErrors($validator)
    					->withInput();
    	}
    		$getSubCategoryId = InventorySubCategory::where('id',$request->subCategoryName)->first()->id;
    		// $chackBrandName = InventoryBrand::where('slug',Str::slug($request->brandName))->first();

    		// if($chackBrandName){
    		// $validator	->getMessageBag()
    		// 			->add('brandName','This Name Already Exists');
    		// return back()->withInput()->withErrors($validator);
    		// }
    		$newBrandName = InventoryBrand::create([
    			'name'=>Str::title($request->brandName),
    			'slug'=>Str::slug($request->brandName),
    			'sub_category_id'=>$getSubCategoryId,
    			'user_id'=>Auth::user()->id,
    		]);
    		return back()->with('success','<strong>'.$newBrandName->name.'</strong> Brand Name Add Successfuly');
    }
    public function brandVisibility(Request $request){
    	$chackBrandDetails = InventoryBrand::where('id',$request->subCategoryVisilibityId)->first();
    	if($chackBrandDetails == true){
    		if($chackBrandDetails->brand_visibility == 1){
    			$visibility = 0;
    			$action = 'Inactive';
    			$color = 'text-danger';
    		}else{
    			$visibility = 1;
    			$action = 'Active';
    			$color = '';
    		}
    		$chackBrandDetails->update([
    			'brand_visibility'=>$visibility,
    		]);
    		return back()->with('success','<strong class="'.$color.'">'.$chackBrandDetails->name.'</strong> Brand <strong class="'.$color.'">'.$action.'</strong> Successfuly');

    	}
    }
}
