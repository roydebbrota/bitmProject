<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventorySubCategory extends Model
{
    protected $fillable = 
    [
    	'name','slug','visibility','category_id','user_id','update_user_id',
    ];
    //table relation
    public function createdBy(){
    	return $this->belongsTo('App\User','user_id');
    }
    public function category(){
		return $this->belongsTo('App\InventoryCategory','category_id');
	}

    public function updatedBy(){
        return $this->belongsTo('App\User','update_user_id');
    }


    public function brand(){
        return $this->hasMany('App\InventoryBrand','sub_category_id');
    }
}

