<?php
namespace App\Http\Controllers;

use DB;
use Carbon;
use App\Http\Requests;
use App\Models\Task;
use App\Repositories\Task\TaskRepositoryContract;
use App\Repositories\Lead\LeadRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Client\ClientRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Models\FollowUp;
use App\Models\Client;
use App\Models\Lead;
use App\Models\Activities;
use Illuminate\Http\Request;
use Charts;
//use config\Entrust;
use App\Models\Role;
use App\Models\RoleUser;
//use Zizaco\Entrust\Traits\EntrustUserTrait;



class DashboardController extends Controller
{

    protected $users;
    protected $clients;
    protected $settings;
    protected $tasks;
    protected $leads;

    public function __construct(
        UserRepositoryContract $users,
        ClientRepositoryContract $clients,
        SettingRepositoryContract $settings,
        TaskRepositoryContract $tasks,
        LeadRepositoryContract $leads
    ) {
        $this->users = $users;
        $this->clients = $clients;
        $this->settings = $settings;
        $this->tasks = $tasks;
        $this->leads = $leads;
    }

    /**
     * Dashobard view
     * @return mixed
     */
    public function dashboard(Request $request)
    {
    	$user_id = \Auth::id();
    	$role_permissions = DB::select(DB::raw("select * from role_user where user_id = $user_id"));
    	
    	foreach($role_permissions as $role){
    		$user_role = $role->role_id;
    	}
    	
        $user_name = DB::select(DB::raw("select name,id from users where id = $user_id"));
        // print_r($user_name);exit;
    	$company_id = \Auth::user()->company_id;
    	$requestData = $request->all();
    	
    	
    	if(count($requestData) == "0"){
    		$start_date = date("Y-m-01");
    		$end_date = date("Y-m-t");
    		
    	}else{
    		$start_date = $requestData['start_date'];
    		$end_date = $requestData['end_date'];
    	}
    	
    	if($user_role == 1){
    		$pendingLeads = Lead::select('*')->where('company_id',$company_id)->whereIn('lead_stage', ['Quote','Lead','Opportunity'])->where('drop_status' ,'=', '')->whereBetween('created_at', [$start_date, $end_date])->get();    		
    		$wonLeads = Lead::select('*')->where('company_id',$company_id)->where('lead_stage', 'Won')->whereBetween('created_at', [$start_date, $end_date])->get();
    		
    		$lostLeads = Lead::select('*')->where('company_id',$company_id)->where('drop_status' ,'!=', '')->whereBetween('created_at', [$start_date, $end_date])->get();
    		
    		
    		$pending_activities = Activities::select('*')->where('company_id',$company_id)->where('status' ,'Scheduled')->whereBetween('created_at', [$start_date, $end_date])->get();
    		$closed_activities = Activities::select('*')->where('company_id',$company_id)->where('status' ,'Completed')->whereBetween('created_at', [$start_date, $end_date])->get();
    		
            $lead_names = DB::select(DB::raw("SELECT l.name as lead_name,l.id as lead_id,a.id as activity_id FROM leads as l LEFT JOIN activities as a on a.lead_id=l.id WHERE a.company_id=$company_id"));
    		
    	}else{
    		
    		$pendingLeads = Lead::select('*')->where('company_id',$company_id)->where('user_id',$user_id)->whereIn('lead_stage', ['Quote','Lead','Opportunity'])->where('drop_status' ,'=', '')->whereBetween('created_at', [$start_date, $end_date])->get();
                		
    		$wonLeads = Lead::select('*')->where('company_id',$company_id)->where('user_id',$user_id)->where('lead_stage', 'Won')->whereBetween('created_at', [$start_date, $end_date])->get();
    		
    		$lostLeads = Lead::select('*')->where('company_id',$company_id)->where('user_id',$user_id)->where('drop_status' ,'!=', '')->whereBetween('created_at', [$start_date, $end_date])->get();
    		
    		
    		$pending_activities = Activities::select('*')->where('company_id',$company_id)->where('user_id',$user_id)->where('status' ,'Scheduled')->whereBetween('created_at', [$start_date, $end_date])->get();
    		$closed_activities = Activities::select('*')->where('company_id',$company_id)->where('user_id',$user_id)->where('status' ,'Completed')->whereBetween('created_at', [$start_date, $end_date])->get();
    		
    		$lead_names = DB::select(DB::raw("SELECT l.name as lead_name,l.id as lead_id,a.id as activity_id FROM leads as l LEFT JOIN activities as a on a.lead_id=l.id WHERE a.company_id=$company_id WHERE a.user_id=$user_id"));
    	}
    	
//		print_r($closed_activities);exit;
//    	print_r($lead_names);exit;
    	
    	
    	$chart = Charts::create('pie', 'highcharts')
						    	->title('Leads chart')
						    	->labels(['WonLeads', 'LostLeads', 'PendingLeads'])
						    	->values([count($wonLeads),count($lostLeads),count($pendingLeads)])
						    	->dimensions(500,500)
						    	->responsive(true);
    	$chart1 = Charts::create('pie', 'highcharts')
						    	->title('Activity chart')
						    	->labels(['Scheduled', 'Completed'])
						    	->values([count($pending_activities),count($closed_activities)])
						    	->dimensions(500,500)
						    	->responsive(true);
    	return view('dashboard.dashboard', compact('chart','chart1','start_date','end_date','pendingLeads','wonLeads','lostLeads','pending_activities','closed_activities','lead_names','user_name'));

     

    }
}
