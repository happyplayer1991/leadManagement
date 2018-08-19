<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Auth;
use Session;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
   // protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);

    }

    public function login(Request $request){

        $email = $request->email;
        $password = $request->password;


       
       $this->validateLogin($request);
        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $date = strtotime($user->date_expired);
            $cur_date = strtotime(date('Y-m-d'));
            //dd($user);
            if($date >= $cur_date){
               
                return redirect('/'); 

            }else{

              // print_r(\Auth::user()->company_id); exit;
                Auth::logout();
                //print_r($user->company_id);exit;
                //return redirect('/login');
               // Session::flash('message', 'You have been logged out!');
                $type="test";
                return view('layouts.subscription')->with('type', $type)->with('user',$user);
            }
                  
        }
        return $this->sendFailedLoginResponse($request);

    }

     protected function sendFailedLoginResponse(Request $request)
    {
       
        return Redirect::to('logout')->withErrors([
                    'failed' => trans('auth.failed'),
                ]);

      
    }


}
