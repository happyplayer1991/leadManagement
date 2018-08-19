<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Notifynder;
use App\Models\User;
use App\Models\Notification;
use App\Http\Requests;
use Log;
use DB;
use Carbon;

class NotificationController extends Controller
{
    //
    public function getAll()
    {
        $notification = Notification::whereNull('read_at')->get();
       // Add space at the start of id value.
        // for ($i=0; $i < sizeof($notification) ; $i++) { 
        //    $notification[$i]['notification'] = 'Key: '.$notification[$i]['id'];
        // }
        
     //  print_r($notification);exit;
        return response()->json(['status'=>'true','data'=>$notification]);
    }

    public function markRead($id) {
        $notif = Notification::find($id);
        // print_r($notif);exit;
        $notif->read_at = Carbon::now();
        $notif->save();
        return response()->json(['status'=>'true','data'=>$notif]);
    }
}
