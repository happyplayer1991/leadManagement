<?php
namespace App\Http\Controllers;

use Notifynder;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Log;
use DB;

class NotificationsController extends Controller
{


    public function getNotifications(){
        $user_id = \Auth::id();
        $role_permissions = DB::select(DB::raw("select * from role_user where user_id = $user_id"));
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }
        
        //print_r($role_permissions);exit;
        $company_id = \Auth::user()->company_id;
         
        if($user_role == 1){
            $getAllClients = DB::select(DB::raw("select  f.*,c.name  from follow_up f inner join clients c on f.client_id=c.id where c.drop_status IS NULL AND f.company_id = $company_id"));
        }else{
            $getAllClients = DB::select(DB::raw("select  f.*,c.name  from follow_up f inner join clients c on f.client_id=c.id where c.drop_status IS NULL AND c.user_id = $user_id AND f.company_id = $company_id"));
        }

        return view('notifications.notifications')->with('getAllClients',$getAllClients);
    }
    /**
     * Get all notifications
     * @return mixed
     */
    public function getAll()
    {
        $user = User::find(\Auth::id());
       
        return $user->unreadNotifications;
    }

    /**
     * Mark a notification read
     * @param Request $request
     * @return mixed
     */
    
    public function markRead(Request $request)
    {
        $user = User::find(\Auth::id());
        $user->unreadNotifications()->where('id', $request->id)->first()->markAsRead();
        return redirect($user->notifications->where('id', $request->id)->first()->data['url']);
//       
    }

    

    /**
     * Mark all notifications as read
     * @return mixed
     */
    public function markAll(Request $request)
    {
        $user = User::find(\Auth::id());
            $user->unreadNotifications()->where('id', $request->id)->first()->markAsRead();
        return redirect()->back();
    }
}
