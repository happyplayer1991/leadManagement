<?php

namespace App\Http\Controllers;


use Input;
use Mail;
use Session;
use Config;
use Dinero;
use Datatables;
use App\Models\Client;
use App\Models\Source;
use App\Models\Lead;
use App\Models\FollowUp;
use App\Models\Activities;
use App\Models\Note;
use App\Models\User;
use App\Models\Product;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Lead\LeadRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use DB;
use App\Repositories\Activities\ActivitiesRepositoryContract;


class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response     */
    
    protected $activities;
    protected $users;
    protected $settings;
    protected $leads;

    public function __construct(
        ActivitiesRepositoryContract $activities,
        UserRepositoryContract $users,
        LeadRepositoryContract $leads,
        SettingRepositoryContract $settings
    )
    {
        $this->activities = $activities;
        $this->users = $users;
        $this->leads = $leads;
        $this->settings = $settings;
//        $this->middleware('client.create', ['only' => ['create']]);
//        $this->middleware('client.update', ['only' => ['edit']]);

    }


    /**
    *       Activities index page 
    *       Display the list of Open and closed Activities

    */
   
    
   
    public function index()
    {

        $user_id = \Auth::id();
        $role_permissions = DB::table('role_user')
                            ->where('user_id','=', $user_id)
                            ->get();
//       print_r($role_permissions);exit;
    	foreach($role_permissions as $role){
    		$user_role = $role->role_id;
    	}


    	$company_id = \Auth::user()->company_id;

        if($user_role == 1){
            $leads = Lead::select('id','name')->where('company_id',$company_id)->where('drop_status','=','')->limit(10);
        }else{
            $leads = Lead::select('id','name')->where('drop_status','=','')->where('company_id',$company_id)->where('user_id',$user_id)->limit(10);
        }
    	 
    	$getAllClients = $this->activities->allActivitiesData();
        $activities = Activities::where('company_id',$company_id)->orderByDesc('date')->get();
        //print_r($activities);exit;
    	
        
        return view('activities.index')->with('getAllClients',$getAllClients)->with('leads',$leads)->with('activities',$activities);

    }

    /**
     * Show the form for creating a new Activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $user_id = \Auth::id();
        $role_permissions = DB::table('role_user')
                            ->where('user_id','=', $user_id)
                            ->get();
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }
        
        
        $company_id = \Auth::user()->company_id;

        if($user_role == 1){
            $clients = DB::select(DB::raw("select id,name,lead_number from leads where drop_status IS NULL OR drop_status = '' and company_id = $company_id and session_id = ''" ));
        }else{
            $clients = DB::select(DB::raw("select id,name,lead_number from leads where drop_status IS NULL OR drop_status = '' and company_id = $company_id and user_id = $user_id and session_id = ''"));
        }

        

        
            
            $id = '';
            $client = '';
        

        return view('activities.create')
                    ->with('id',$id)
                    ->with('client',$client)
                    ->with('clients',$clients);
    }


    public function createActivity($id){

              $user_id = \Auth::id();
        $role_permissions = DB::table('role_user')
                            ->where('user_id','=', $user_id)
                            ->get();
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }
        
        
        $company_id = \Auth::user()->company_id;
        $client_id = $id;

        if($user_role == 1){
            $clients = DB::select(DB::raw("select id,name,lead_number from leads where drop_status IS NULL OR drop_status = '' and company_id = $company_id"));
        }else{
            $clients = DB::select(DB::raw("select id,name,lead_number from leads where drop_status IS NULL OR drop_status = '' and company_id = $company_id and user_id = $user_id"));
        }

        

        if($client_id == ''){
            
            $id = '';
            $client = '';
        }else{
            $id = $client_id;
            $client = $this->leads->find($id);
        }

        return view('activities.create')
                    ->with('id',$id)
                    ->with('client',$client)
                    ->with('clients',$clients);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        $data['error'] = '';
        if($request->details == ""){
            $data['error'] = 'Please Enter the details.';

            return $data;

        }
        

        $this->activities->create($request);
        

         $notes = new Note();
         $notes->note = \Auth::user()->name." added the activity";
         $notes->status = "scheduled";
         $notes->user_id = \Auth::id();
         $notes->lead_id =  $request->lead_id;
         $notes->company_id = \Auth::user()->company_id;
         $notes->save();

         if($request->lead_track == "lead_track"){
             $data['message'] = "Activity successfully Added";
            return "";
         }else{
            $getAllClients = $this->activities->allActivitiesData();

            $data['html'] = view('activities.datatable')->with('getAllClients',$getAllClients)->render();
            $data['message'] = "Activity successfully Added";
            return $data;

         }

    }


    public function clientFollowup($id, Request $request){
       
        $this->activities->updateFollowup($id, $request);
        
        
//         $notes = new Note();
//         $notes->note = \Auth::user()->name." completed the activity";
//         $notes->status = "completed";
//         $notes->user_id = \Auth::id();
//         $notes->lead_id =  $request->lead_id;
//         $notes->company_id = \Auth::user()->company_id;
//         $notes->save();
        
         return "success";

    }

  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        
    }

    /**
     * Show the form for showing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateSampleCodeRequest $request)
    {
        //
        $this->samples->update($id, $request);
        Session()->flash('flash_message', 'sample code successfully updated');
        return redirect()->route('samples.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->samples->destroy($id);
        return redirect()->route('samples.index');
    }

}
