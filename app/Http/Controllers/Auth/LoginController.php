<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
public function showLoginForm(){
$phone = '01914468204';
$phonewithoutZero = explode('0',$phone,2);
return $phonewithoutZero['1'];
}
    // $api_params = $api_element.'?apikey='.$apikey.'&sender='.$sender.'&to='.$mobileno.'&message='.$textmessage;  
    // $smsGatewayUrl = "http://springedge.com";  
    // $smsgatewaydata = $smsGatewayUrl.$api_params;
//     $url = "https://sms.youthfireit.com/api/send?key=4309954320c1f09ff06c151afaaeadb066cbc04f&phone=1914468204&message=hi this is final test&device=197&sim=1&priority=1";

//     $ch = curl_init();                       // initialize CURL
//     curl_setopt($ch, CURLOPT_POST, false);    // Set CURL Post Data
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     $output = curl_exec($ch);
//     curl_close($ch);                         // Close CURL

//     // Use file get contents when CURL is not installed on server.
//     if(!$output){
//        $output =  file_get_contents($smsgatewaydata);  
//     }
// }









    // use AuthenticatesUsers;

    // /**
    //  * Where to redirect users after login.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = '/home';

    // *
    //  * Create a new controller instance.
    //  *
    //  * @return void
     
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
}
