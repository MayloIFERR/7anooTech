<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\ConfirmationMessage;
class ConfirmationMessageController extends Controller
{

	// // Your Account SID and Auth Token from twilio.com/console
	// $sid = 'AC6c14e69865219cc9d4b252ff333b3689';
	// $token = '277ee6b5bdcd3b819466266bd358fb2f';
	// $client = new Client($sid, $token);

    public function index(){
    		$user = \Auth::user();
    		// send the code to current user
    		ConfirmationMessage::where('user_id',$user->id)->delete();
    		ConfirmationMessage::sendCode($user);
    		return view('auth.confirm');
    }

    public function check(Request $req){
    	$user = \Auth::user();
    	// check the code 
    	if ($req->code == $user->confirmationmessage->code) {
    		$user->confirmationmessage->state = 1;
    		return redirect()->route('home');
    		//show him confirmed float message and redirect him to home page
    	} else {
    		//error message
    	}

    }
}