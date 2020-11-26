<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    protected $fillable = [
        'name', 'slug', 'visibility', 'user_id',
    ];

    //table relation
    public function createdBy(){
    	return $this->belongsTo('App\User','user_id');
    }
    public function subCategory(){
        return $this->hasMany('App\InventorySubCategory','category_id');
    }
}
