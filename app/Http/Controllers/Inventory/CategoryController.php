<?php

namespace App\Http\Controllers\Inventory;

use App\InventoryCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
    	$category = InventoryCategory::get();
    	return view('backend.inventory.category',['category'=>$category] );
    }

    public function createCategory(Request $request){
    	  $validator = Validator::make($request->all(),[
            'categoryName'=>['required','string','between:3,50','unique:inventory_categories,name'],
        ],[
            'categoryName.required'=>'Category Name Required',
            'categoryName.string'=>'Category Name is Invalid',
            'categoryName.between'=>'Category Name will be 3-50 Characters',
            'categoryName.unique'=>'Category Name Already exists',


        ]);
        if($validator->fails()){
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }
    	$chackCategory = InventoryCategory::where('slug',Str::slug($request->categoryName))->first();

    	if($chackCategory == true){
    		$validator
    			->getMessageBag()
    			->add('categoryName','This Name Already Exists');
    		return back()->withInput()->withErrors($validator);
    	}

    	$newCategory = InventoryCategory::create([
    					'name'=>Str::title($request->categoryName),
    					'slug'=>Str::slug($request->categoryName),
    					'user_id'=>Auth::user()->id,
    	]);

    	return back()->with('success','<strong>'.$newCategory->name.'</strong>Category Name Add Successfuly');
    }
    public function categoryVisibility(Request $request){
        $chackCategory = InventoryCategory::where('id',$request->categoryVisilibityId)->first();
        if($chackCategory == true){
            if($chackCategory->visibility == 1){
                $visibility = 0;
                $action = 'Inactive';
                $color = 'text-danger';

            }else{
               $visibility = 1;
                $action = 'Active';
                $color = '';  
            }
            $chackCategory->update([
                'visibility'=>$visibility,

            ]);
            return back()->with('success','<strong class="'.$color.'">'.$chackCategory->name.'</strong> Category <strong class="'.$color.'">'.$action.'</strong> Successfuly');
            }else{
                return back()->with('alert','<strong>Something wrong,Please Refress</strong>');
            }
        }



        public function updateCategory(Request $request){

            $dataId = collect($request->updateCategoryId)->keys()->first();
            $validator = Validator::make($request->all(),[
            'updateCategoryId.*'=>['required','exists:inventory_categories,id'],
            'u_categoryName.*'=>['required','string','between:3,50'],
        ],[
            'updateCategoryId.*.required'=>'Category Id is Invalid',
            'updateCategoryId.*.exists'=>'Category Id is Invalid',
            'u_categoryName.*.required'=>'Category Name Required',
            'u_categoryName.*.string'=>'Category Name will be a string',
            'u_categoryName.*.between'=>'Invalid Category Name',


        ]);
        if($validator->fails()){
            return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('modalError','categoryUpdate'.$request->$dataId);
        }
 
            $chackCategory = InventoryCategory::where('slug',Str::slug($request->u_categoryName[$dataId]))->first();
            if($chackCategory == true && $chackCategory->id !=$dataId){
                $validator->getMessageBag()
                ->add('u_categoryName.'.$dataId,'This Name Already Exists');
                return back()->withErrors($validator)
                ->withInput()
                ->with('modalError','categoryUpdate'.$dataId);

            }
            InventoryCategory::where(['id'=>$dataId])
                                ->update([
                                    'name'=>Str::title($request->u_categoryName[$dataId]),
                                    'slug'=>Str::slug($request->u_categoryName[$dataId]),
                                    'user_id'=>Auth::user()->id,
                                ]);
            return back()->with('success','<strong>'.Str::title($request->u_categoryName[$dataId]).'<strong> Update Successfuly');

        }
}
