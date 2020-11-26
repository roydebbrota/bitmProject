<?php

namespace App\Http\Controllers\Inventory;

use App\InventoryCategory;
use App\InventorySubCategory;
use App\InventoryProduct;
use App\InventoryBrand;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(){
    	$category = InventoryCategory::where('visibility',1)->get();
    	$subCategory = InventorySubCategory::where('visibility',1)->get();
    	$brand = InventoryBrand::where('brand_visibility',1)->get();
    	$product = InventoryProduct::get();
    	return view('backend.inventory.product',['category'=>$category,'subCategory'=>$subCategory,'brand'=>$brand,'product'=>$product]);
    }
    public function dynamicProduct(Request $request){
    	if($request->has('targetName') && $request->targetName == 'categoryName'){
    		$chackCategory = InventoryCategory::where('id',$request->targetValue)->first();
    		if($chackCategory == false){
    			return '<option>Category Id is Invalid</option>';
    		}
    		$getSubCategory = InventorySubCategory::where('category_id',$chackCategory->id)->get();
    		if(count($getSubCategory) == 0){
    			return '<option>Please Input some Sub-Category</option>';
    		}
    		$option = '<option>Select Sub-Category</option>';
    		foreach ($getSubCategory as $subData) {
    			$option .= '<option value="'.$subData->id.'">'.$subData->name.'</option>';
    		}
    		return $option;



    	}else if($request->targetName == 'subCategoryName'){
    		$chackSubCategory = InventorySubCategory::where('id',$request->targetValue)->first();
    		if($chackSubCategory == false){
    			return '<option>Sub-Category Id is Invalid</option>';
    		}
    		$getBrand = InventoryBrand::where('sub_category_id',$chackSubCategory->id)->get();
    		if(count($getBrand) == 0){
    			return '<option>Please Input some Brand Name</option>';
    		}
    		$option = '<option>Select Brand Name</option>';
    		foreach ($getBrand as $brandData) {
    			$option .= '<option value="'.$brandData->id.'">'.$brandData->name.'</option>';
    		}
    		return $option;

    	}else if($request->targetName == 'brandName'){
    		$chackBrand = InventoryBrand::where('id',$request->targetValue)->first();
    		if($chackBrand == false){
    			return 'Invalid Brand';
    		}

    		$getBrand =explode('-',$chackBrand->slug);
    		$getSubCategorySlag =explode('-',$chackBrand->subCategory->slug);
    		$getSubCategory =$chackBrand->subCategory;
    		$getCategorySlug =explode('-',$getSubCategory->category->slug);
    		$getCategory =$getSubCategory->category;
    		$getSl =count(InventoryProduct::get())+1;

    		$code ='';
    		foreach ($getCategorySlug as $cData) {
    			$code .= substr($cData,0,1);	
    		}
    		foreach ($getSubCategorySlag as $sData) {
    			$code .= substr($sData,0,1);	
    		}
    		foreach ($getBrand as $bData) {
    			$code .= substr($bData,0,1);	
    		}
    			$code .=str_pad($getSl,3,'0',STR_PAD_LEFT);
    		return strtoupper($code);
    		
    		

    	}
    	else if($request->targetName == 'productImage'){
    		$baseName = basename($request->targetValue);
    		return $baseName;
    	}
    }
    // $chackBrand = InventoryBrand::where('id',$request->targetValue)->first();
    // 		if($chackBrand == false){
    // 			return '<option>Sub-Category Id is Invalid</option>';
    // 		}
    // 		$getBrand =explode('-',$chackBrand->slug);
    // 		$code ='';
    // 		foreach ($getBrand as $bdata) {
    // 			$code .=substr($bdata,0,2);
    // 		}
    // 		$getSubCategory =explode('-',$chackBrand->subCategory->slug);
    // 		foreach ($getSubCategory as $sdata) {
    // 			$code .=substr($sdata,0,1);
    // 		}
    // 		return $code;

    public function createProduct(Request $request){
    	$validator = Validator::make($request->all(), [
    		'categoryName'=>['required','exists:inventory_categories,id'],
    		'subCategoryName'=>['required','exists:inventory_sub_categories,id'],
    		'brandName'=>['required','exists:inventory_brands,id'],
    		'productCode'=>['required','string','between:6,10','unique:inventory_products,code'],
    		'productName'=>['required','string','between:3,100'],
    		'productQuantity'=>['required','numeric','gt:0'],
    		'productBuy'=>['required','numeric','gt:0'],
    		'productSell'=>['required','numeric','gt:0'],
    		'productDetails'=>['required','string','between:5,1000'],

    		'productImage'=>['required','image','mimes:jpg,jpeg,png','max:100'],
    	],[
    		'categoryName.required' => 'Category Name Required',
			'categoryName.exists' => 'Category Id is Invalid',
			'subCategoryName.required' => 'Sub-Category Name Required',
			'subCategoryName.exists' => 'Sub-Category Id is Invalid',
			'brandName.required' => 'Brand Name Required',
			'brandName.exists' => 'Brand Id is Invalid',
			'productCode.required' => 'Product Code Required',
			'productCode.between' => 'Product Code Will be in 4-10 Characters',
			'productCode.unique' => 'Product Code already Exists',
			'productName.required' => 'Product Name Required',
			'productName.between' => 'Product Name Will be in 3-100 Characters',
			'productQuantity.required' => 'Product Quantity Required',
			'productQuantity.numeric' => 'Product Quantity will be a Number',
			'productQuantity.gt' => 'Product Quantity will be at least 1',
			'productBuy.required' => 'Product Buying Price Required',
			'productBuy.numeric' => 'Product Buying Price will be a Number',
			'productBuy.gt' => 'Product Buying Price will be at least .01',
			'productSell.required' => 'Product Selling Price Required',
			'productSell.numeric' => 'Product Selling Price will be a Number',
			'productSell.gt' => 'Product Selling Price will be at least .01',
			'productDetails.required' => 'Product Details Required',
			'productDetails.between' => 'Product Details will be in 5-1000 Characters',
			'productImage.required' => 'Product Image Required',
			'productImage.image' => 'Product Image will be jpg/jpeg/png file',
			'productImage.mimes' => 'Product Image will be jpg/jpeg/png file',
			'productImage.max' => 'Product Image will be in 100kb',
    	]);
    	if($validator->fails()){
    		return back()
    			->withErrors($validator)
    			->withInput()
    			->with('modalError','productModal');
    	}
    	$image = $request->file('productImage');
    	if($image){
    		$newName = explode(' ',$request->productName)[0].time().'.'.$image->getClientOriginalExtension();
    		Storage::disk('public')->putFileAs('productImages', $image, $newName);
    		$imagePath = 'public/productImages/'.$newName;

    	}else{
    		$validator->getMessageBag()->add('productImage','Wrong Image, Pls Upload Good one');
    		return back()->withErrors($validator)
    					->withInput()
    					->with('modalError','productModal');
    	}
    	$addProduct = InventoryProduct::create([
    		'name' => Str::title($request->productName),
			'code' => strtoupper($request->productCode),
			'image' => $imagePath,
			'details' => $request->productDetails,
			'quantity' => $request->productQuantity,
			'buy' => $request->productBuy,
			'sell' => $request->productSell,
			'slug'=> Str::slug($request->productName),
			'category_id' => $request->categoryName ,
			'subCategory_id' => $request->subCategoryName,
			'brand_id'=>$request->brandName,
			'user_id' => Auth::user()->id,
    	]);

		return back()->with('success','<strong>'.$addProduct->name.'</strong> of <strong>'.$addProduct->code.'</strong> Code Product Add Successfully');
	}// createProduct Mothod
    


}
