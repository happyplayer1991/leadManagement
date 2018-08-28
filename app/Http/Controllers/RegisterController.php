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

    public function saveData(Request $request)
    {
        $email = $request->get('email');
        if($email != '') {
            $mobile = $request->get('work_number');

            if(User::where('email',$email)->count() > 0){
                return "Email Address is duplicated.";
            } else if(User::where('work_number',$mobile)->count() > 0){
                return "Phone Number is duplicated.";
            } else{
                $date_expiry = env('USER_DATE_EXPIRY', 120);
                $user = New User();
                $user->company_name = $request->get('company_name');
                $user->name = $request->get('name');
                $user->email = $email;
                $user->work_number = $mobile;
                $user->password = bcrypt($request->get('password'));
                $user->company_id = time();
                $user->date_expired = date('Y-m-d', strtotime( "+".$date_expiry."days"));
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

                return 'success';
            }
        } else{
            return 'Email Address is required.';
        }
    }
}




























?>