<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Role;
use App\Repositories\User\UserRepositoryContract;
use DB;

/**
 * @SWG\Get(
 *     path="/users/{id}",
 *     tags={"Users"},
 *     summary="Fetch User",
 *     @SWG\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          type="integer",
 *          description="UUID",
 * 		),
 *     @SWG\Response(
 *          response=200,
 *         description="Userdata"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Post(
 *     path="/users/{id}/edit",
 *     tags={"Users"},
 *     summary="Edit User",
 *     @SWG\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          type="integer",
 *          description="UUID",
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
}"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */

class UserController extends Controller
{
	protected $users;

	 public function __construct(
        UserRepositoryContract $users
    )
    {
        $this->users = $users;
    }


    public function show($id){
        $user = DB::table('users')
            ->join('role_user','users.id','=','role_user.user_id')
            ->leftjoin('roles','roles.id','=','role_user.role_id')
            ->select('users.*','roles.display_name')
            ->where('users.id','=',$id)
            ->get();
    	if($user == ""){
    		return response()->json(['status'=>'false','error'=>"user not found"]);
    	}else{
    		return response()->json(['status'=>'true','data'=>$user]);
    	}    	

    }

    public function edit($id,Request $request){
    	$user = User::Find($id);
    	if($user == ""){
    		return response()->json(['status'=>'false','error'=>"user not found"]);
    	}else{
    		//$user_data = $this->users->update($id, $request);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->work_number = $request->work_number;
            $user->personal_number = $request->personal_number;
            $user->save();
    		return response()->json(['status'=>'true','data'=>$user]);
    	}
    	
    }
}
