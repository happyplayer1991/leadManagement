<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\LeadDetails;
use App\Models\Lead;
use App\Models\User;
use App\Models\Activities;
use DB;
use PDF;
use Charts;
use App\Helper\Helper;


class ItemController extends Controller
{

    public function testdata(){
        return "ok";
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function pdfview(Request $request)
    {
        $user_id = \Auth::id();
        $role_permissions = DB::select(DB::raw("select * from role_user where user_id = $user_id"));
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }
        
        $user_name = DB::select(DB::raw("select name,id from users where id = $user_id"));
        // print_r($user_name);exit;
        $company_id = \Auth::user()->company_id;

        if($user_role == 1){
            $leads = Lead::where('company_id',$company_id)->get();
            view()->share('leads',$leads);       
            $pendingLeads = Lead::select('*')->where('company_id',$company_id)->whereIn('lead_stage', ['Quote','Lead','Opportunity'])->where('drop_status' ,'=', '')->get();
            $wonLeads = Lead::select('*')->where('company_id',$company_id)->where('lead_stage', 'Won')->get();
            $lostLeads = Lead::select('*')->where('company_id',$company_id)->where('drop_status' ,'!=', '')->get(); 
            
        }else {
            $leads = Lead::where('company_id',$company_id)->where('user_id',$user_id)->get();
            view()->share('leads',$leads);       
            $pendingLeads = Lead::select('*')->where('company_id',$company_id)->where('user_id',$user_id)->whereIn('lead_stage', ['Quote','Lead','Opportunity'])->where('drop_status' ,'=', '')->get();
            $wonLeads = Lead::select('*')->where('company_id',$company_id)->where('user_id',$user_id)->where('lead_stage', 'Won')->get();
            $lostLeads = Lead::select('*')->where('company_id',$company_id)->where('user_id',$user_id)->where('drop_status' ,'!=', '')->get(); 
        }
        return view('layouts.reportview',compact('pendingLeads','wonLeads','lostLeads'));
    }
    
    public function pdfview_activity(Request $request)
    {
        $user_id = \Auth::id();
        $role_permissions = DB::select(DB::raw("select * from role_user where user_id = $user_id"));
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }
        
        $user_name = DB::select(DB::raw("select name,id from users where id = $user_id"));
        // print_r($user_name);exit;
        $company_id = \Auth::user()->company_id;

        if($user_role == 1){
            $leads = Lead::where('company_id',$company_id)->get();
            view()->share('leads',$leads);
            $activities = Activities::where('company_id',$company_id)->get();
            view()->share('activities',$activities);

            $pending_activities = Activities::select('*')->where('company_id',$company_id)->where('status' ,'Scheduled')->get();
            $closed_activities = Activities::select('*')->where('company_id',$company_id)->where('status' ,'Completed')->get();
        } else {
            $leads = Lead::where('company_id',$company_id)->where('user_id',$user_id)->get();
            view()->share('leads',$leads);
            $activities = Activities::where('company_id',$company_id)->where('user_id',$user_id)->get();
            view()->share('activities',$activities);

            $pending_activities = Activities::select('*')->where('company_id',$company_id)->where('user_id',$user_id)->where('status' ,'Scheduled')->get();
            $closed_activities = Activities::select('*')->where('company_id',$company_id)->where('user_id',$user_id)->where('status' ,'Completed')->get();
        }
        return view('layouts.reportview1',compact('pending_activities','closed_activities'));
    }

    public function leadspdf(Request $request) {
        // print_r('manisha');die();
        $user_id = \Auth::id();
        $role_permissions = DB::select(DB::raw("select * from role_user where user_id = $user_id"));
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }
        
        $user_name = DB::select(DB::raw("select name,id from users where id = $user_id"));
        // print_r($user_name);exit;
        $company_id = \Auth::user()->company_id;

        if($user_role == 1){
            $leads = Lead::where('company_id',$company_id)->get();
            view()->share('leads',$leads);

            if($request->has('download')){
                $pdf = PDF::loadView('layouts.leadspdf');
                return $pdf->download('Leads.pdf');
            }
            return view('layouts.leadspdf');
        } else {
            $leads = Lead::where('company_id',$company_id)->where('user_id',$user_id)->get();
            view()->share('leads',$leads);

            if($request->has('download')){
                $pdf = PDF::loadView('layouts.leadspdf');
                return $pdf->download('Leads.pdf');
            }
            return view('layouts.leadspdf');
        }
  }
     public function activitiespdf(Request $request) {
        $user_id = \Auth::id();
        $role_permissions = DB::select(DB::raw("select * from role_user where user_id = $user_id"));
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }
        
        $user_name = DB::select(DB::raw("select name,id from users where id = $user_id"));
        // print_r($user_name);exit;
        $company_id = \Auth::user()->company_id;

        if($user_role == 1){
            $activities = Activities::where('company_id',$company_id)->get();
            view()->share('activities',$activities);

            if($request->has('download')){
                $pdf = PDF::loadView('layouts.activitiespdf');
                return $pdf->download('Activities.pdf');
            }
            return view('layouts.leadspdf');
        } else {
            $activities = Activities::where('company_id',$company_id)->where('user_id',$user_id)->get();
            view()->share('activities',$activities);

            if($request->has('download')){
                $pdf = PDF::loadView('layouts.activitiespdf');
                return $pdf->download('Activities.pdf');
            }
            return view('layouts.leadspdf');
        }
    }
}

?>
