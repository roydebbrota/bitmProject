<?php

namespace App\Http\Controllers\Frontend;

use App\InventoryCategory;
use App\InventorySubCategory;
use App\InventoryProduct;
use App\InventoryBrand;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function productSelect(Request $request){
    	if(!Session::has('cartProductList')){
    		Session::put('cartProductList',[]);
    	}
    	$chackProduct =InventoryProduct::where(['id'=>$request->productId,'code'=>$request->productCode,'visibility'=>1])->first();
    	if($chackProduct){
	    	$newProduct =[
	    		'id'=>$chackProduct->id,
	    		'code'=>$chackProduct->code,
	    		'name'=>$chackProduct->name,
	    		'image'=>$chackProduct->image,
	    		'price'=>$chackProduct->sell,
	    		'details'=>$chackProduct->details,
	    		'quantity'=>1,
	    	];
	    	Session::push ('cartProductList',$newProduct);
	    	return back();
    	}
    	return back()->with('alert','<strong>Somethings rong</strong>');
    
    }
    public function productCartDetails(){
    	return  view('frontend.productCartDetails');
    }
    public function productQuantity(Request $request){
    	if(Session::has('cartProductList') && count(session('cartProductList')) > 0){
    		$getCartData = Session::get('cartProductList');
    		$i =0;
    		foreach ($getCartData as $qData) {
    			if ($qData['id'] == $request->pId && $qData['code'] == $request->code ){
    				if ($request->act == 'ptv') {
    					$newProductQuantity =[
				    		'id'=>$qData['id'],
				    		'code'=>$qData['code'],
				    		'name'=>$qData['name'],
				    		'image'=>$qData['image'],
				    		'price'=>$qData['price'],
				    		'details'=>$qData['details'],
				    		'quantity'=>$qData['quantity']+1,
	    				];
    				}else if ($request->act == 'ntv') {
    				$newProductQuantity =[
				    		'id'=>$qData['id'],
				    		'code'=>$qData['code'],
				    		'name'=>$qData['name'],
				    		'image'=>$qData['image'],
				    		'price'=>$qData['price'],
				    		'details'=>$qData['details'],
				    		'quantity'=>$qData['quantity']-1,
	    				];
	    				if ($newProductQuantity['quantity'] == 0) {
	    					$newProductQuantity = [

				    		'id'=>$qData['id'],
				    		'code'=>$qData['code'],
				    		'name'=>$qData['name'],
				    		'image'=>$qData['image'],
				    		'price'=>$qData['price'],
				    		'details'=>$qData['details'],
				    		'quantity'=>1,
	    					];
	    				}
    				}//else{
    					//return back()->with('alert','<strong>Somethings rong</strong>');
    				//}
    				$getCartData[$i] = $newProductQuantity;
    			}
    			$i++;
    		}

    		Session::put('cartProductList',$getCartData);
    		return back();
    	}
    	return back()->with('alert','<strong>Somethings rong</strong>');

    }
    public function deleteCartProduct(Request $request){
    	if(Session::has('cartProductList') && count(session('cartProductList')) > 0){
    		$getCartData = Session::get('cartProductList');
    		$i =0;
    		foreach ($getCartData as $qData) {
    			if ($qData['id'] == $request->dId && $qData['code'] == $request->dCode ){
    				array_splice($getCartData, $i,1);
    			}
    			$i++;
    		}

    		Session::put('cartProductList',$getCartData);
    		return back()->with('success','<strong>Cart Item Deleted</strong>');
    	}
    	return back()->with('alert','<strong>Somethings rong</strong>');
    }
}
