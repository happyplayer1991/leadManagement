<?php

namespace App\Http\Controllers;

use Session;
use DB;
use App\Models\Location;
use App\Models\Client;
use App\Http\Requests;
use Datatables;
use App\Models\State;
use App\Http\Requests\Location\UpdateLocationRequest;
use App\Http\Requests\Location\StoreLocationRequest;

use App\Repositories\Location\LocationRepositoryContract;

class LocationsController extends Controller
{
    //
    protected $locations;
    protected $clients;

    /**
     * LocationsController constructor.
     * @param LocationRepositoryContract $departments
     */
    public function __construct(LocationRepositoryContract $locations)
    {
        $this->locations = $locations;
        $this->middleware('user.is.admin', ['only' => ['create', 'destroy']]);
    }

    /**
     * @return mixed
     */
    
    public function index()
    {

// $company_id = \Auth::user()->company_id;
//         $test = Client::where('company_id',$company_id)->latest()->first();
//         dd($test);exit;
    	
    	$user_id = \Auth::id();
    	$role_permissions = DB::select(DB::raw("select * from role_user where user_id = $user_id"));
    	
    	foreach($role_permissions as $role){
    		$user_role = $role->role_id;
    	}
    	
        $company_id = \Auth::user()->company_id;
       
    	if($user_role == 1){
    		 $getAllClients = DB::select(DB::raw("select u.name as user_name, c.* from clients c inner join users u on c.user_id=u.id and c.company_id = $company_id"));
    	}else{
    		 $getAllClients = DB::select(DB::raw("select u.name as user_name, c.* from clients c inner join users u on c.user_id=u.id where c.user_id = $user_id and c.company_id = $company_id"));
    	}
       
        
     
         return view('locations.index')->with('getAllClients',$getAllClients);
        
        
       

    }

    public function anyData()
    {
       
        
        $canUpdateUser = auth()->user()->can('update-user');
        $locations = Location::select(['id', 'name', 'description']);
        
        
        return Datatables::of($locations)
            
            ->add_column('edit', '
                <a href="{{ route(\'locations.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->add_column('delete', '
                <form action="{{ route(\'locations.destroy\', $id) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="Delete" class="btn btn-danger" onClick="return confirm(\'Are you sure?\')"">

            {{csrf_field()}}
            </form>')
            ->make(true);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $states = State::all()->pluck('name', 'id');
        return view('locations.create')->with('states', $states);
    }

    /**
     * @param StoreLocationRequest $request
     * @return mixed
     */
    public function store(StoreLocationRequest $request)
    {
        $this->locations->create($request);
        Session::flash('flash_message', 'Successfully created New Location');
        return redirect()->route('locations.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->locations->destroy($id);
        return redirect()->route('locations.index');
    }

    public function edit($id)
    {
        $location = Location::find($id);
        $states = State::all()->pluck('name', 'id');
        return view('locations.edit')
            ->with('states', $states)
            ->with('location', $location);
        
    }

     public function update($id, UpdateLocationRequest $request)
    {
        $this->locations->update($id, $request);
        Session()->flash('flash_message', 'Location successfully updated');
        return redirect()->route('locations.index');
    }

     public function show($id)
    {
        //
        $locations = Location::find($id);
        return view('locations.show')->with('locations',$locations);
    }
    
    public function getLocationsBasedOnState(){
        
        $string = '';
        $state_id = $_GET['state'];
         
        //print_r($state_id);exit;
         
        //$user_details = $this->users->select('*')->where('state_id', '=' , $state_id)->get();
         
        $state_locations = Location::select('*')->where('state_id','=' , $state_id)->get();
         
        foreach($state_locations as $location){
            $locationId = $location->id;
            $locationName = $location->name;
            //print_r($source->name);
            $string .= "<option value='$locationId'>$locationName</option>";
        }
         
        echo $string;
        
    }

}
