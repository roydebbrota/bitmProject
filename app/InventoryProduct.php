<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryProduct extends Model
{
   protected $fillable = ['name','image','code','details','quantity','buy','sell','slug','visibility','category_id','subCategory_id','brand_id','user_id','update_user_id'];



   /// Table Relation ///
	public function createdBy(){
		return $this->belongsTo('App\User','user_id');
	}
	/// Category Relation ///
	public function category(){
		return $this->belongsTo('App\InventoryCategory','category_id');
	}
	/// Sub-Category Relation ///
	public function subCategory(){
		return $this->belongsTo('App\InventorySubCategory','subCategory_id');
	}
	public function brand(){
		return $this->belongsTo('App\InventoryBrand','brand_id');
	}
}
