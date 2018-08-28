<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Models\RoleUser;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;
use Gate;
use Datatables;
use Carbon;
use Auth;
use DB;


class UserRepository implements UserRepositoryContract
{
    const MANAGER = 'manager';
    const EMPLOYEE = 'employee';

    public function find($id)
    {
        return User::findOrFail($id);
    }


    public function getAllUsers()
    {
        return User::all();
    }

    /**
     * @return mixed
     */
    public function getAllUsersWithDepartments()
    {
        return User::all()
        ->pluck('nameAndDepartment', 'id');
    }


 

    /**
     * @param $requestData
     * @return static
     */
    public function create($requestData)
    {

       
        $companyname = Setting::first()->company;
        $filename = null;
        // if ($requestData->hasFile('image_path')) {
        //     if (!is_dir(base_path(). '/resources/assets/images/'. $companyname)) {
        //         mkdir(base_path(). '/resources/assets/images/'. $companyname, 0777, true);
        //     }
        //     $file =  $requestData->file('image_path');

        //     $destinationPath = base_path(). '/resources/assets/images/'. $companyname;
        //     $filename = str_random(8) . '_' . $file->getClientOriginalName() ;
        //     $file->move($destinationPath, $filename);
        // }


        $user = New User();
        $user->name = $requestData->name;
        $user->email = $requestData->email;
        $user->address = $requestData->address;
        $user->work_number = $requestData->work_number;
        $user->personal_number = $requestData->personal_number;
        $user->password = bcrypt($requestData->password);
        $user->image_path = $filename;
        $user->company_id = \Auth::user()->company_id;
        $user->date_expired = \Auth::user()->date_expired;
        $user->company_name = \Auth::user()->company_name;


    //     if ($requestData->hasFile('image_path')) {
    //     //print_r("hello"); die();
    //     $image = $requestData->file('image_path');
    //     //print_r($image);
    //     $name = time().'.'.$image->getClientOriginalExtension();
    //     //print_r($name); die();
    //     $destinationPath = public_path('/resources/assets/images');
    //     print_r($destinationPath); die();
    //     $image->move($destinationPath, $name);
    //     $user->image_path=$name;
    //     //$this->save();

    //     return back()->with('success','Image Upload successfully');
    // }

        if($file = $requestData->hasFile('image_path')) {
            $file = $requestData->file('image_path');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/';
            $file->move($destinationPath,$fileName);
            $user->image_path = $fileName;
        }




        $user->save();
       // $user->roles()->attach($requestData->roles);
       // $user->roles()->attach(\Auth::user()->company_id);
        $user_role = New RoleUser();
        $user_role->user_id = $user->id;
        
        $user_role->role_id = $requestData->roles;
        $user_role->company_id  = \Auth::user()->company_id;
        $user_role->save();   
      
        

        Session::flash('flash_message', 'User successfully added!'); //Snippet in Master.blade.php
        return $user;
    }

    /**
     * @param $id
     * @param $requestData
     * @return mixed
     */
    public function update($id, $requestData)
    {

// print_r($id);die();

        $settings = Setting::first();
        
        //$companyname = $settings->company;
        $user = User::find($id);
        // print_r($user);die();
        //$password = bcrypt($requestData->password);
        $user->name = $requestData->name;
        $user->personal_number= $requestData->personal_number;
        $user->work_number=$requestData->work_number;
        $user->email = $requestData->email;
        $user->company_name=$requestData->company_name;
        $user->address=$requestData->address;
        if($file = $requestData->hasFile('image_path')) {
            $file = $requestData->file('image_path');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/avatar/';
            $file->move($destinationPath,$fileName);
            $user->image_path = $fileName;
        }
        $role = $requestData->roles;
        $user->save();
        //$Data=$requestData->all();
        //print_r($Data)or die();
         //print_r($role);exit;
       // $department = $requestData->departments;
       // $user->location = $requestData->location;
        //$user->state_id = $requestData->state_id;
        //$Data=array_replace($requestData->except('address'));
        //$Data=$requestData->all();
        //$Data=array_replace($requestData->all(),['personal_number'=>"$personal_number"],['work_number'=>"$work_number"],['role'=>"$role"],['address'=>"$address"]);

        // if ($requestData->hasFile('image_path')) {
        //     $settings = Setting::findOrFail(1);
        //     $companyname = $settings->company;
        //     $file =  $requestData->file('image_path');

        //     $destinationPath =  base_path(). '/resources/assets/images/'. $companyname;
        //     $filename = str_random(8) . '_' . $file->getClientOriginalName() ;

        //     $file->move($destinationPath, $filename);
        //     if ($requestData->password == "") {
        //         $input =  array_replace($requestData->except('password'), ['image_path'=>"$filename"]);
        //     } else {
        //         $input =  array_replace($requestData->all(), ['image_path'=>"$filename", 'password'=>"$password"]);
        //     }
        // } else {
        //     if ($requestData->password == "") {
        //         $input =  array_replace($requestData->except('password'));
        //     } else {
        //         $input =  array_replace($requestData->all(), ['password'=>"$password"]);
        //     }
        // }

        // print_r($user);exit;
        //$user->fill($input)->save();
        //$user->fill($Data)->save();
        

        // if($role == '2') {
            
        //     event(new \App\Events\UserAction($user, self::MANAGER));
        // }
        // elseif($role == '3') {
            
        //     event(new \App\Events\UserAction($user, self::EMPLOYEE));
        // }
        //$user->department()->sync([$department]);
        $user->roles()->sync([$role]);
        Session::flash('flash_message', 'User successfully updated!');

        return $user;
    }
     //public function updatePassword($id,$request){
       //$data = Input::all();
         //$data=$request->all();
         //print_r($data); 
         //$user = User::findorFail($id);
         //print_r($id) or die();
         // $user->fill($data)->save();
         // return $user;

     //}
 /**
     * @param $id
     * @return mixed
     */
    public function destroy($request, $id)
    {
        $user = User::findorFail($id);
        if ($user->hasRole('super_administrator')) {
            return Session()->flash('flash_message_warning', 'Not allowed to delete super admin');
        }

        if ($request->tasks == "move_all_tasks" && $request->task_user != "" ) {
            $user->moveTasks($request->task_user);
        }
        if($request->leads == "move_all_leads" && $request->lead_user != "") {
            $user->moveLeads($request->lead_user);
        }
        if($request->clients == "move_all_clients" && $request->client_user != "") {
            $user->moveClients($request->client_user);
        }

        try {
            $user->delete();
            Session()->flash('flash_message', 'User successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            Session()->flash('flash_message_warning', 'User can NOT have, leads, clients, or tasks assigned when deleted');
        }
    }
}
