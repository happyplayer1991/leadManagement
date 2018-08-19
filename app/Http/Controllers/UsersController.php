<?php
namespace App\Http\Controllers;

use Gate;
use Carbon;
use Datatables;
use App\Models\User;
use App\Models\Task;
use App\Http\Requests;
use App\Models\Client;
use App\Models\Lead;
use App\Models\Announcement;
use App\Models\Location;
use App\Models\State;
use App\Models\Department;
use App\Models\Quotation;
use App\Models\QuotationProducts;
use App\Models\Invoice;
use App\Models\Company;
use DB;

use Illuminate\Http\Request;

use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Role\RoleRepositoryContract;
use App\Repositories\Department\DepartmentRepositoryContract;
use App\Repositories\Location\LocationRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\Task\TaskRepositoryContract;
use App\Repositories\Lead\LeadRepositoryContract;
use App\Repositories\Quotation\QuotationRepositoryContract;
use App\Repositories\Invoice\InvoiceRepositoryContract;


class UsersController extends Controller
{
    protected $users;
    protected $roles;
    protected $departments;
    protected $settings;
    protected $locations;
    protected $invoices;
    protected $quotations;

    public function __construct(
        UserRepositoryContract $users,
        RoleRepositoryContract $roles,
        DepartmentRepositoryContract $departments,
        LocationRepositoryContract $locations,
        SettingRepositoryContract $settings,
        TaskRepositoryContract $tasks,
        LeadRepositoryContract $leads

    )
    {
        $this->users = $users;
        $this->roles = $roles;
        $this->departments = $departments;
        $this->locations = $locations;
        $this->settings = $settings;
        $this->tasks = $tasks;
        $this->leads = $leads;
        $this->middleware('user.create', ['only' => ['create']]);
    }

    /**
     * @return mixed
     */
    public function index()
    {
         
        $company_id = \Auth::user()->company_id;
        $user_id = \Auth::user()->id;
        $usersDetails = User::select('*')->where('company_id',$company_id)->get();
        $departmentsDetails = Department::all();
        $role = DB::select(DB::raw("SELECT r.display_name,u.id FROM roles as r LEFT JOIN role_user as ru on r.id = ru.role_id LEFT JOIN users as u on u.id = ru.user_id"));
        $scrollText = Announcement::where('user_id',$user_id)->where('misclaneous1','Publish')->orderByDesc('created_at')->limit(1)->get();
       $publish=Announcement::all()->sortByDesc("created_at");
        
        return view('layouts.controlpanel')->withUsers($this->users)->with('usersDetails',$usersDetails) 
        ->with('departmentsDetails',$departmentsDetails)->with('role',$role)->with('scrollText',$scrollText)->with('publish',$publish);
    }

    public function anyData()
    {
        $canUpdateUser = auth()->user()->can('update-user');
        $users = User::select(['id', 'name', 'email', 'work_number']);
        return Datatables::of($users)
            ->addColumn('namelink', function ($users) {
                return '<a href="users/' . $users->id . '" ">' . $users->name . '</a>';
            })
            ->addColumn('edit', function ($user) {
                return '<a href="' . route("users.edit", $user->id) . '" class="btn btn-success"> Edit</a>';
            })
            ->add_column('delete', function ($user) { 
                return '<button type="button" class="btn btn-danger delete_client" data-client_id="' . $user->id . '" onClick="openModal(' . $user->id. ')" id="myBtn">Delete</button>';
            })->make(true);
    }

    /**
     * Json for Data tables
     * @param $id
     * @return mixed
     */
    public function taskData($id)
    {
        $tasks = Task::select(
            ['id', 'title', 'created_at', 'deadline', 'user_assigned_id', 'client_id', 'status']
        )
            ->where('user_assigned_id', $id);
        return Datatables::of($tasks)
            ->addColumn('titlelink', function ($tasks) {
                return '<a href="' . route('tasks.show', $tasks->id) . '">' . $tasks->title . '</a>';
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('deadline', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('status', function ($tasks) {
                return $tasks->status == 1 ? '<span class="label label-success">Open</span>' : '<span class="label label-danger">Closed</span>';
            })
            ->editColumn('client_id', function ($tasks) {
                return $tasks->client->name;
            })
            ->make(true);
    }

        /**
     * Json for Data tables
     * @param $id
     * @return mixed
     */
    public function leadData($id)
    {
        $leads = Lead::select(
            ['id', 'title', 'created_at', 'contact_date', 'user_assigned_id', 'client_id', 'status']
        )
            ->where('user_assigned_id', $id);
        return Datatables::of($leads)
            ->addColumn('titlelink', function ($leads) {
                return '<a href="' . route('leads.show', $leads->id) . '">' . $leads->title . '</a>';
            })
            // ->editColumn('created_at', function ($leads) {
            //     return $leads->created_at ? with(new Carbon($leads->created_at))
            //         ->format('d/m/Y') : '';
            // })
            // ->editColumn('contact_date', function ($leads) {
            //     return $leads->created_at ? with(new Carbon($leads->created_at))
            //         ->format('d/m/Y') : '';
            // })
            // ->editColumn('status', function ($leads) {
            //     return $leads->status == 1 ? '<span class="label label-success">Open</span>' : '<span class="label label-danger">Closed</span>';
            // })
            ->editColumn('client_id', function ($tasks) {
                return $tasks->client->name;
            })
            ->make(true);
    }

    /**
     * Json for Data tables
     * @param $id
     * @return mixed
     */
    public function clientData($id)
    {
        $clients = Client::select(['id', 'name', 'company_name', 'primary_number', 'email'])->where('user_id', $id);
        return Datatables::of($clients)
            ->addColumn('clientlink', function ($clients) {
                return '<a href="' . route('clients.show', $clients->id) . '">' . $clients->name . '</a>';
            })
            ->editColumn('created_at', function ($clients) {
                return $clients->created_at ? with(new Carbon($clients->created_at))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('deadline', function ($clients) {
                return $clients->created_at ? with(new Carbon($clients->created_at))
                    ->format('d/m/Y') : '';
            })
            ->make(true);
    }


    /**
     * @return mixed
     */
    public function create()
    {

    	//$states = State::all()->pluck('name', 'id');
        $user = User::all();
        return view('users.create')
            ->with('user',$user)
            ->withRoles($this->roles->listAllRoles())
            ->with('type','create')
            //->with('states', $states)
            //->withLocations($this->locations->listAllLocations())
            ->withDepartments($this->departments->listAllDepartments());
    }

    /**
     * @param StoreUserRequest $userRequest
     * @return mixed
     */
    public function store(StoreUserRequest $userRequest)
    {
        $getInsertedId = $this->users->create($userRequest);

        return redirect()->route('users.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $userDetails = User::all();

        $role = DB::select(DB::raw("SELECT r.display_name,u.id FROM roles as r LEFT JOIN role_user as ru on r.id = ru.role_id LEFT JOIN users as u on u.id = ru.user_id"));
        return view('users.show')
            ->withUser($this->users->find($id))
            ->withCompanyname($this->settings->getCompanyName())
            ->with('role',$role)
            ->with('userDetails',$userDetails);
            //->withTaskStatistics($this->tasks->totalOpenAndClosedTasks($id))
            //->withLeadStatistics($this->leads->totalOpenAndClosedLeads($id));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
    	
    	
        return view('users.edit')
            ->withUser($this->users->find($id))
            ->withRoles($this->roles->listAllRoles())
            ->with('type','edit')
            ->withDepartments($this->departments->listAllDepartments());
    }

    /**
     * @param $id
     * @param UpdateUserRequest $request
     * @return mixed
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user_data = $this->users->update($id, $request);
        //print_r($user_data->id);exit;
        Session()->flash('flash_message', 'User successfully updated');
        return redirect()->route('users.show', $user_data->id);
    }
 /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function UpdatePassword($id, Request $request){
            //print_r($request->all());die();
            //$user->password = bcrypt($request->password);
            //$user->password = bcrypt($request->password);
            //$Data=$request->all();
            $password=$request->password;
            $confirm_password=$request->password_confirmation;  
            if($password !='' && $confirm_password != '') {
                if($password==$confirm_password ){
            //        print_r($id);die();
                    $password = bcrypt($request->password);
                    $user = User::where('id', $id)->update(['password' => $password]);
                    Session()->flash('flash_message','Password successfully updated');
                    return redirect()->back();

                }
            }
        
            else{
            Session()->flash('flash_message','Password does not match');
            return redirect()->back();
            }
            //return redirect()->route('users.show', $user_data->id);

        // $user_data=$this->users->updatePassword($id,$request);
        // Session()->flash('flash_message','Password successfully updated');
    }

    

    /**
     * @param $id
     * @return mixed
     */

    public function dropUser($id) {
        $user = User::findOrFail($id);
        $company_id = \Auth::user()->company_id;
        $r = DB::table('role_user')->where('company_id',$company_id)->pluck('user_id');
        // print_r($r[0]);exit;
        $leads = DB::table('leads')->where('user_id',$id)->update(['user_id'=>$r[0]]);
        $activities = DB::table('activities')->where('user_id',$id)->update(['user_id'=>$r[0]]);
        $quotations = DB::table('quotations')->where('user_id',$id)->update(['user_id'=>$r[0]]);
        $invoices = DB::table('invoices')->where('user_id',$id)->update(['user_id'=>$r[0]]);
        $user->delete();
    	Session()->flash('flash_message', 'User Successfully deleted');
    	return back();
    }


    public function weekQoutes()
    {

    }

    public function currency(Request $request){
        // print_r($request->currency);exit;
         $company_id =  \Auth::user()->company_id;
        $user_id = \Auth::user()->id;
        $date = Carbon\Carbon::now()->toDateString();
        // $currency = $request->currency;
        $curr = Company::where('company_id',$company_id)->count();
        // print_r($curr);die();
        if($curr == 0) {
            $company = new Company();
            $company->company_id = $company_id;
            $company->type = "Currency";
            $company->sub_type = "currency";
            $company->value = $request->currency;
            $company->created_date = $date;
            $company->save();
            Session()->flash('flash_message', 'Currency created Successfully');
            return back();
             // echo '<script type="text/javascript">;alert("Currency once Selected cannot be Changable");window.location.href="/settings";</script>';
        }else {
            $currency_update = Company::where('company_id',$company_id)->update(['value'=>$request->currency,'updated_date'=>$date]);
            Session()->flash('flash_message', 'Currency updated Successfully');
            return back();
        }
    }
}
