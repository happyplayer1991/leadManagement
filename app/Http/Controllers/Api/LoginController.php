<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleUser;

/**
 * @SWG\Post(
 *     path="/login",
 *     tags={"Users"},
 *     summary="Login User",
 * @SWG\Parameter(
 * 			name="email",
 * 			in="body",
 *			schema={"$ref": "#/definitions/Login"},
 * 			required=true,
 * 			type="String",
 * 			description="UUID",
 * 		),
 *     @SWG\Response(
 *          response=200,
 *          description="{
    'status': 'true',
    'data': {
        'id': 1,
        'name': 'Admin',
        'email': 'admin@admin.com',
        'address': '',
        'work_number': '0',
        'personal_number': '0',
        'image_path': '',
        'state_id': null,
        'company_id': '1515483847',
        'date_expired': null,
        'company_name': 'admin',
        'random_unique_number': '1515483850',
        'created_at': '2016-06-04 13:42:19',
        'updated_at': '2016-06-04 13:42:19',
        'company_code': '',
        'user_number': ''
    }
}  "
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/logout",
 *     tags={"Users"},
 *     summary="Logs out current logged in user session",
 *     @SWG\Response(
 *          response=200,
 *          description="user logged out."
 *      )
 * ),
 */

class LoginController extends Controller
{

	 use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = '/home';
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user_id = $user->id;
            $roleuser = RoleUser::select('role_id')->where('user_id',$user_id)->get();
            return response()->json(['status' => 'true',
                'data' => $user->toArray(),'role_id' => $roleuser
            ]);
        }
        return $this->sendFailedLoginResponse($request);
    }
    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            $user->api_token = null;
            $user->save();
        }
        return response()->json([ 'status'=>'true','data' => 'User logged out.' ], 200);
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = ['status' => 'false', 'error' => 'Invalid Credentials' ];
        return response()->json($errors, 422);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

}
