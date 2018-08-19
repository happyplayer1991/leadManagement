<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Carbon;
use DB;

/**
 * @SWG\Post(
 *     path="/activities",
 *     tags={"Activities"},
 *     summary="Create new Activity",
 *     @SWG\Parameter(
 * 			name="id",
 * 			in="body",
 *          schema={"$ref": "#/definitions/NewActivity"},
 * 			required=true,
 * 			type="integer",
 * 			description="UUID",
 * 		),
 *     @SWG\Response(
 *          response=200,
 *          description="A newly-created Activity"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */

/**
 * @SWG\Post(
 *     path="/activityComplete/{id}",
 *     tags={"Activities"},
 *     summary="Complete Activity",
 *     @SWG\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          type="integer",
 *          description="UUID",
 * 		),
 *     @SWG\Response(
 *          response=200,
 *          description="Completed the Activity"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/activities",
 *     tags={"Activities"},
 *     summary="List all the Activities",
 *     @SWG\Parameter(
 *          name="company_id",
 *          in="path",
 *          required=true,
 *          type="string",
 *          description="pass company_id as parameter",
 *      ),
 *     @SWG\Parameter(
 *          name="user_id",
 *          in="path",
 *          required=true,
 *          type="integer",
 *          description="pass user_id as parameter",
 *      ),
 *     @SWG\Response(
 *          response=200,
 *          description="Get the list of all activities."
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/activities/{id}",
 *     tags={"Activities"},
 *     summary="Fetch Activity",
 *     @SWG\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          type="integer",
 *          description="activity id",
 *      ),
 *     @SWG\Response(
 *          response=200,
 *          description="Get the list of all activities."
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/todaysTask",
 *     tags={"Activities"},
 *     summary="Fetch week activities.",
  *     @SWG\Parameter(
 *          name="company_id",
 *          in="path",
 *          required=true,
 *          type="string",
 *          description="pass company_id as parameter",
 *      ),
 *     @SWG\Parameter(
 *          name="user_id",
 *          in="path",
 *          required=true,
 *          type="integer",
 *          description="pass user_id as parameter",
 *      ),
 *     @SWG\Response(
 *          response=200,
 *          description="Get the list of all week activities."
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/activityleads",
 *     tags={"Activities"},
 *     summary="Fetch all the Active leads for Activities.",
  *     @SWG\Parameter(
 *          name="company_id",
 *          in="path",
 *          required=true,
 *          type="string",
 *          description="pass company_id as parameter",
 *      ),
 *     @SWG\Parameter(
 *          name="user_id",
 *          in="path",
 *          required=true,
 *          type="integer",
 *          description="pass user_id as parameter",
 *      ),
 *     @SWG\Response(
 *          response=200,
 *          description="Get the list of all Active Leads."
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/activitytype",
 *     tags={"Activities"},
 *     summary="Activity Types.",
 *     @SWG\Response(
 *          response=200,
 *          description="Get the list of all Activity Types."
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */

class ActivityController extends Controller
{
    public function create(Request $request)
    {
        $activity = New Activities();
        $activity->name = $request->name;
        $activity->date = $request->date;
        $activity->details = $request->details;
        $activity->lead_id = $request->lead_id;
        $activity->status = $request->status;
        $activity->user_id = $request->user_id;
        $activity->company_id = $request->company_id;
        $activity->save();        
         return new JsonResponse(['status'=>'true','data'=>$activity], Response::HTTP_CREATED);
    }

    public function completeActivity($id) {       
        $activity = Activities::find($id);
        $activity->status = "Completed";
        $activity->end_date = Carbon::now();
        $activity->save();
        return response()->json(['status'=>'true','data'=>$activity]);
    }  

    public function activities(Request $request){
        $company_id = $request->company_id;
        $user_id = $request->user_id;

        if($company_id == ""){
            return response()->json(['status'=>'false','error'=>"company id is empty"]);
        }else if($user_id == ""){
            return response()->json(['status'=>'false','error'=>"user id is empty"]);
        }

        $role_permissions = DB::table('role_user')
                            ->where('user_id','=', $user_id)
                            ->get();
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }


        if($user_role == 1){
            $activities = DB::table('activities as ac')
                            ->join('leads as l','ac.lead_id','=','l.id')
                            ->where('l.drop_status','=','')
                            ->where('ac.company_id','=',$company_id)
                            ->select('ac.*','l.name as lead_name','l.lead_number')
                            ->orderByDesc('created_at')
                            ->get();
        }else{
            $activities = DB::table('activities as ac')
                            ->join('leads as l','ac.lead_id','=','l.id')
                            ->where('l.drop_status','=','')
                            ->where('ac.company_id','=',$company_id)
                            ->where('ac.user_id','=',$user_id)
                            ->select('ac.*','l.name as lead_name','l.lead_number')
                            ->orderByDesc('created_at')
                            ->get();
        }

        
        return response()->json(['status'=>'true','data'=>$activities]);
    }

    public function weekActivities(Request $request) {
        $company_id = $request->company_id;
        $user_id = $request->user_id;

        if($company_id == ""){
            return response()->json(['status'=>'false','error'=>"company id is empty"]);
        }else if($user_id == ""){
            return response()->json(['status'=>'false','error'=>"user id is empty"]);
        }

        $role_permissions = DB::table('role_user')
                            ->where('user_id','=', $user_id)
                            ->get();
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }

         $date = new Carbon\Carbon;
        $dateto = new Carbon\Carbon;
//print_r(array($date->subWeek(),$date->addWeek()));exit;

        if($user_role == 1){
            $activities = DB::table('activities as ac')
                            ->join('leads as l','ac.lead_id','=','l.id')
                            ->where('l.drop_status','=','')
                            ->where('ac.company_id','=',$company_id)
                            ->where('ac.status','!=','Completed')
                            ->select('ac.*','l.name as lead_name','l.lead_number')
                            ->where('ac.date', '>=', $date->subWeek())
                            ->where('ac.date', '<=', $dateto->addWeek())
                           // ->whereRaw('ac.date  >= ? AND ac.date <= ? ',  array($date->subWeek(),$dateto->addWeek()))
                            ->orderByDesc('created_at')
                            ->get();
        }else{
            $activities = DB::table('activities as ac')
                            ->join('leads as l','ac.lead_id','=','l.id')
                            ->where('l.drop_status','=','')
                            ->where('ac.company_id','=',$company_id)
                            ->where('ac.status','!=','Completed')
                            ->where('ac.user_id','=',$user_id)
                            ->select('ac.*','l.name as lead_name','l.lead_number')
                            ->where('ac.date', '>=', $date->subWeek())
                            ->where('ac.date', '<=', $dateto->addWeek())
                            ->orderByDesc('created_at')
                            ->get();
        }

        
        return response()->json(['status'=>'true','data'=>$activities]);
    }

    public function show($id){
        $activity = DB::table('activities as ac')
                        ->join('leads as l','ac.lead_id','=','l.id')
                        ->select('ac.*','l.name as lead_name','l.lead_number')
                        ->where('ac.id','=',$id)
                        ->get();
        return response()->json(['status'=>'true','data'=>$activity]);
    }


    public function leads(Request $request){
        $company_id = $request->company_id;
        $user_id = $request->user_id;

        if($company_id == ""){
            return response()->json(['status'=>'false','error'=>"company id is empty"]);
        }else if($user_id == ""){
            return response()->json(['status'=>'false','error'=>"user id is empty"]);
        }

       $leads = Lead::select('id','name','lead_number')->where('company_id',$company_id)->where('drop_status','=','')->where('user_id',$user_id)->get();

        return response()->json(['status'=>'true','data'=>$leads]);
    }


    public function activity_type(){
        $activity_type =array('Call' =>'Call','Email'=>'Email','Meet' =>'Meet');
        return response()->json(['status'=>'true','data'=>$activity_type]);
    }
}
