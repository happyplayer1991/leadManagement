<?php
namespace App\Repositories\Activities;

use App\Models\Activities;
use Notifynder;
use Carbon;
use DB;

class ActivitiesRepository implements ActivitiesRepositoryContract
{

    const SCHEDULED = 'scheduled';
    
    const COMPLETED = 'completed';
    
    public function find($id)
    {
        return Activities::findOrFail($id);
    }


    public function create($requestData)
    {
        $client_follow_up = New Activities();
        $client_follow_up->name = $requestData->activity;
        $client_follow_up->date = $requestData->date;
        $client_follow_up->time = $requestData->time;
        $client_follow_up->details = $requestData->details;
        $client_follow_up->lead_id = $requestData->lead_id;
        $client_follow_up->status = $requestData->status;
        $client_follow_up->user_id = \Auth::id();
        $client_follow_up->company_id = \Auth::user()->company_id;
        $client_follow_up->save();
        
         event(new \App\Events\ActivitiesAction($client_follow_up, self::SCHEDULED));
        return $client_follow_up;
    }
    
    public function updateFollowup($id, $requestData) {
        
        $client_follow_up = Activities::find($id);
        $client_follow_up->status = $requestData->status;
        $client_follow_up->end_date = Carbon::now();
        $client_follow_up->save();
        
        event(new \App\Events\ActivitiesAction($client_follow_up, self::COMPLETED));
        return $client_follow_up;
    }    


    public function allActivitiesData(){
        $user_id = \Auth::id();
        $role_permissions = DB::table('role_user')
                            ->where('user_id','=', $user_id)
                            ->get();
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }
        
        
        $company_id = \Auth::user()->company_id;

        if($user_role == 1){
            $getAllClients = DB::table('activities as ac')
                            ->join('leads as l','ac.lead_id','=','l.id')
                            ->leftjoin('users as u','ac.user_id','=','u.id')
                            ->where('l.drop_status','=','')
                            ->where('ac.company_id','=',$company_id)
                            ->select('ac.*','l.name as lead_name','l.lead_number','u.name as user_name')
                            ->orderByDesc('date')
                            ->paginate(10);
        }else{

            $getAllClients = DB::table('activities as ac')
                            ->join('leads as l','ac.lead_id','=','l.id')
                            ->leftjoin('users as u','ac.user_id','=','u.id')
                            ->where('l.drop_status','=','')
                            ->where('ac.company_id','=',$company_id)
                            ->where('l.user_id','=',$user_id)
                            ->select('ac.*','l.name as lead_name','l.lead_number','u.name as user_name')
                            ->orderByDesc('date')
                            ->paginate(10);
        }    

        return $getAllClients;  
    }
   
}
