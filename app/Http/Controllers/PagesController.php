<?php
namespace App\Http\Controllers;

use DB;
use Carbon;
use App\Http\Requests;
use App\Repositories\Lead\LeadRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Announcement;



class PagesController extends Controller
{

    protected $users;
    protected $settings;
    protected $leads;

    public function __construct(
        UserRepositoryContract $users,
        SettingRepositoryContract $settings,
        LeadRepositoryContract $leads
    ) {
        $this->users = $users;
        $this->settings = $settings;
        $this->leads = $leads;
    }

    /**
     * Dashobard view
     * @return mixed
     */
    public function dashboard()
    {

      /**
         * Other Statistics
         *
         */
        $companyname = $this->settings->getCompanyName();
        $users = $this->users->getAllUsers();
       
        $login_user_name = $this->users->find(\Auth::id());

        $getAllLeads = $this->leads->leadsBaseOnCompany();
        $user_id = \Auth::user()->id;
        $scrollText = Announcement::where('user_id',$user_id)->where('misclaneous1','Publish')->orderByDesc('created_at')->limit(1)->get();


        //dd($getAllLeads);exit;
        


       // $user_id = \Auth::id();
       //  $role_permissions = DB::select(DB::raw("select * from role_user where user_id = $user_id"));
        
       //  foreach($role_permissions as $role){
       //  	$user_role = $role->role_id;
       //  }
        
      
       //   $company_id = \Auth::user()->company_id;
        
     
       //  if($user_role == 1){
        
       //    $getAllLeads = DB::select(DB::raw("select l.*,n1.note from leads l left join notes n1 on l.id=n1.lead_id left join notes n2 on (n1.lead_id=n2.lead_id and n1.created_at<n2.created_at) where n2.created_at is null and l.company_id = $company_id "));
       

       //    $wonLeads =DB::select(DB::raw("select l.*,n1.note from leads l left join notes n1 on l.id=n1.lead_id left join notes n2 on (n1.lead_id=n2.lead_id and n1.created_at<n2.created_at) where n2.created_at is null and l.lead_stage='WON' and Date_Format(l.updated_at,'%M %D %Y') = Date_Format(CURDATE(),'%M %D %Y') and l.company_id = $company_id "));


       //  }else{
        	
        
       //     $getAllLeads = DB::select(DB::raw("select l.*,n1.note from leads l left join notes n1 on l.id=n1.lead_id left join notes n2 on (n1.lead_id=n2.lead_id and n1.created_at<n2.created_at) where n2.created_at is null and l.company_id = $company_id and l.user_id =  $user_id"));


       //     $wonLeads =DB::select(DB::raw("select l.*,n1.note from leads l left join notes n1 on l.id=n1.lead_id left join notes n2 on (n1.lead_id=n2.lead_id and n1.created_at<n2.created_at) where n2.created_at is null and l.lead_stage='WON' and Date_Format(l.updated_at,'%M %D %Y') = Date_Format(CURDATE(),'%M %D %Y') and l.company_id = $company_id and l.user_id = $user_id;"));
       //  }


        //print_r($getAllLeads);exit;
        
              
        return view('pages.dashboard', compact(
            'getAllLeads','scrollText'
            //'wonLeads'
        ));
    }
}
