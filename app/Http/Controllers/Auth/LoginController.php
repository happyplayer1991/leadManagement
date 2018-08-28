<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Setting;
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
        $this->validateLogin($request);
        $user = User::where('email', $request->get('email'))->first();
        if(!isset($user))
            return $this->sendFailedLoginResponse();

        $date = strtotime($user->date_expired);
        $cur_date = strtotime(date('Y-m-d'));
        if($date < $cur_date) {
            return array('result' => 'Your account is expired.');
        }

        if ($this->attemptLogin($request)) {
            $resp['result'] = 'success';
            $resp['logo_img'] = '';
            $settings = Setting::where('company_id', $user->company_id)->first();
            if (isset($settings)) {
                Session::put('logo_img', $settings->logo_img);
                if ($settings->notification_allowed == 1 || $settings->notification_allowed == 3)
                    Session::put('notification_allowed', '1');
                else
                    Session::put('notification_allowed', '0');

                $resp['logo_img'] = $settings->logo_img;
                $resp['logo_color'] = $settings->logo_color;
            }

            return $resp;
        }
        return $this->sendFailedLoginResponse();
    }

    protected function sendFailedLoginResponse()
    {/*
        return redirect()->back()->withErrors([
            'failed' => trans('auth.failed'),
        ]);*/
        return array('result' => trans('auth.failed'));
    }

    public function logout() {
        Session::forget('notification_allowed');
        Session::forget('logo_img');
        $this->guard()->logout();

        return redirect('/');
    }
}
