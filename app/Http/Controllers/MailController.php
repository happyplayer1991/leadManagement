<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\LeadDetails;
use App\Models\Lead;
use App\Models\Client;
use App\Models\User;
use App\Helper\Helper;
use DB;
use PDF;


class MailController extends Controller
{
    
	
	public function basicEmail($id){
		
		
		//$voucher_code = LeadDetails::find($id);

		 

		$leadDetails = LeadDetails::select('*')->where('lead_id', '=', $id)->get();
		
		
		foreach($leadDetails as $lead){
			$lead_details_id = $lead->id;
		}
		 
		$voucher_code = LeadDetails::find($lead_details_id);
		
		if($voucher_code->voucher_code == ''){
			Helper::voucher_number_quote($id);
		}else{
		
		}
		
		$lead = Lead::select('*')->find($id);
		$clientData = Client::select('*')->find($lead->client_id);
        $userData = User::select('*')->find($clientData->user_id);
		$users = $clientData->email;
		$username = $clientData->name;
		$cityname = $clientData->city;
	
		//view()->share('items',$leadDetails);
		$data = array('name'=>$username , 'address' => $lead , 'user' => $userData);
		$items = $leadDetails;
		Mail::send('attachmail', $data, function ($message) use ($users , $username , $items , $clientData , $userData , $voucher_code , $cityname){
			
			$message->to($users, $username)->subject
						('Quotation for '.$username.'  at  '.$cityname);
						$message->cc('sowjitha@kloudportal.com', 'Prashanthi');
						$message->from('sowji.reddy09@gmail.com','Super Surfaces');
						$attach = time();
						PDF::loadView('layouts.pdfview' , compact('items','voucher_code','clientData','userData'))->save('/var/www/html/superSurfaces/pdf/'.$username.$attach.'.pdf')->stream('download.pdf');
						$message->attach('/var/www/html/superSurfaces/pdf/'.$username.$attach.'.pdf');
		});
			//echo "Basic Email Sent. Check your inbox.";
			Session::flash('flash_message', 'Email Sent Successfully. Check your inbox.'); //Snippet in Master.blade.php
			return redirect()->back();
			
		 
// 		Mail::send(['mail'], $data, function($message) {
// 			$message->to('sowjitha@kloudportal.com', 'Tutorials Point')->subject
// 			('Laravel Basic Testing Mail');
// 			$message->from('sowji.reddy09@gmail.com','Sowjitha');
// 		});
// 		echo "Basic Email Sent. Check your inbox.";
// 		$msg = "First line of text\nSecond line of text";
		
// 		// use wordwrap() if lines are longer than 70 characters
// 		$msg = wordwrap($msg,70);
		
// 		// send email
// 		mail("sowji.reddy09@gmail.com","My subject",$msg);
	}
	
}
