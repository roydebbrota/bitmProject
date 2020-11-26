<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InventoryCategory;
use App\InventorySubCategory;
use App\User;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    //
    public function index(){
    	$category = InventoryCategory::where('visibility',1)->get();
    	$subCategory = InventorySubCategory::get();
    	return view('backend.inventory.subCategory',['category'=>$category,'subCategory'=>$subCategory]);
    	 
    }
    public function createSubCategory(Request $request){
    	$validator = Validator::make($request->all(),[
    			'categoryName'=>['required','exists:inventory_categories,id'],
            	'subCategoryName'=>['required','string','between:3,50'],
	        ],[
	        	'categoryName.requried'=>'Category Name Required',
	        	'categoryName.exixts'=>'Invalid Category Name',
	            'subCategoryName.required'=>'Sub-Category Name Required',
	            'subCategoryName.string'=>'Invalid Sub-Category Name',
	            'subCategoryName.between'=>'Category Name will be 3-50 Characters',

	        ]);
    	if($validator->fails()){
    		return back()
    				->withErrors($validator)
    				->withInput();
    	}
    	$chackCategory = InventoryCategory::where(['id'=>$request->categoryName,'visibility'=>1])->first();
        
    	$newSubCategory = InventorySubCategory::create([
    		'name'=>Str::title($request->subCategoryName),
    		'slug'=>Str::slug($request->subCategoryName),
    		'category_id'=>$chackCategory->id,
    		'user_id'=>Auth::user()->id,

    	]);

    		return back()->with('success','<strong>'.$newSubCategory->name.'</strong> Sub-Category Name Add Successfuly');



    }


    public function updateSubCategory(Request $request){
        $getId = collect($request->updateSubCategoryId)->keys()->first();
         $validator = Validator::make($request->all(),[
            'updateSubCategoryId.*'=>['exists:inventory_sub_categories,id'],
            'u_subCategoryName.*'=>['required','string','between:3,50'],
        ],[
            'updateSubCategoryId.*.exists'=>'Sub-Category Id is Invalid',
            'u_subCategoryName.*.required'=>'Sub-Category Name Required',
            'u_subCategoryName.*.string'=>'Sub-Category Name will be a string',
            'u_subCategoryName.*.between'=>'Sub-Category Category Name',


        ]);
        if($validator->fails()){
            return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('modalError','subCategoryUpdate'.$request->$getId);
        }
 
            $chackSubCategory = InventoryCategory::where('slug',Str::slug($request->u_subCategoryName[$getId]))->first();
            if($chackSubCategory == true && $chackSubCategory->id !=$getId){
                $validator->getMessageBag()
                ->add('u_subCategoryName.'.$getId,'This Name Already Exists');
                return back()->withErrors($validator)
                ->withInput()
                ->with('modalError','subCategoryUpdate'.$getId);

            }
            InventorySubCategory::where(['id'=>$getId])
                                ->update([
                                    'name'=>Str::title($request->u_subCategoryName[$getId]),
                                    'slug'=>Str::slug($request->u_subCategoryName[$getId]),
                                    'update_user_id'=>Auth::user()->id,
                                ]);
            return back()->with('success','<strong>'.Str::title($request->u_subCategoryName[$getId]).'<strong> Update Successfuly');

    }






    public function subCategoryVisibility(Request $request){
    	$sql = InventorySubCategory::where('id',$request->subCategoryVisilibityId)->first();
    	if($sql == true && $sql->visibility == 1){
    		$visibility = 0;
    		$action = 'Inactive';
    		$color = 'text-danger';
    	}else{
	    		$visibility = 1;
	    		$action = 'Active';
	    		$color = '';
    		}
    		$sql->update([
    			'visibility'=>$visibility,
    		]);
    		return back()->with('success','<strong class="'.$color.'">'.$sql->name.'</strong> Category <strong class="'.$color.'">'.$action.'</strong> Successfuly');
    }
}






