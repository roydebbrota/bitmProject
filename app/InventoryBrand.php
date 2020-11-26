<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryBrand extends Model
{
    protected $fillable = [
    	'name','slug','brand_visibility','sub_category_id','user_id',
    ];

    public function createdBy(){
        return $this->belongsTo('App\User','user_id');
    }

    public function subCategory(){
        return $this->belongsTo('App\InventorySubCategory','sub_category_id');
    }
    public function product(){
        return $this->hasMany('App\InventoryProduct','brand_id');
    }
    
}

