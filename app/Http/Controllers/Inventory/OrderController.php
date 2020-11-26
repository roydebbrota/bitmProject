<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use smasif\ShurjopayLaravelPackage\ShurjopayService;

class OrderController extends Controller 
{
    public function productPaymentMethod(Request $request){
    	$shurjopay_service = new ShurjopayService();
        $shurjopay_service->generateTxId(uniqid());
        $success_route =  url('/shurjoPayCallback');

       // dd($shurjopay_service);

        $shurjopay_service->sendPayment($request->surjaPay, $success_route);
    	
    	}
}
