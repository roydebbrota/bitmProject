<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InventoryProduct;

class HomeController extends Controller
{
    public function index(){
    	$product = InventoryProduct::where('visibility',1)->get();
    	return view('frontend.home',['product'=>$product]);
    }
}
