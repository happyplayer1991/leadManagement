<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Setting;
use Illuminate\Support\Facades\Redirect;


class RegisterController extends Controller
{


	public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(){
    	
    	return view('auth.register');
    }

public function saveData(Request $request){

    	//print_r($request->all());
    	$requestData = $request->all();

      //  print_r($requestData);

    	//print_r($requestData['name']);
        $email = $requestData['email'];
        if($email != ''){
            $mobile=$requestData['work_number'];
           // print_r("test");
             $mail = User::where('email',$email)->get();
             $phone = User::where('work_number',$mobile)->get();


             if(count($mail)>0){
                //print_r($mail);
                //echo "<script>toastr.error('', 'Email already exists');</script>";
                return "email";

            }else if(count($phone)>0){
                 return "mobile";
             }

            else{
                $date_expiry = env('USER_DATE_EXPIRY');
                $user = New User();
                $user->company_name = $requestData['company_name'];
                $user->name = $requestData['name'];
                $user->email = $requestData['email'];
                $user->work_number = $requestData['work_number'];
                $user->password = bcrypt($requestData['password']);
                $user->company_id = time();
                $user->date_expired =  date('Y-m-d', strtotime( "+".$date_expiry."days"));
                $user->random_unique_number = time();
                $user->save();
                $newrole = new RoleUser();
                $newrole->role_id = '1';
                $newrole->user_id = $user->id;
                $newrole->company_id = $user->company_id;
                $newrole->timestamps = false;
                $newrole->save();

                $settings = new Setting();
                $settings->company = $user->company_name;
                $settings->company_id = $user->company_id;
                $settings->number_of_users = 2;
                $settings->date_expired = date('Y-m-d', strtotime("+120 days"));
                $settings->save();

            }
        }else{
            
        }

    	//print_r("sowjitha");

       return redirect('/login');
    }

    
}




























?>