<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use DB;
use Illuminate\Support\Facades\Redirect;

class AnnouncementController extends Controller
{


    public function store($id, Request $request)
    {
        // print_r($request->all());exit;
        $requestData = $request->all();
        $user_id = \Auth::user()->id;
        $all_unpub = Announcement::where('user_id', $user_id)->where('misclaneous1','Publish')->update(['misclaneous1' => 'Unpublish']);
        //print_r($requestData['company_id']);exit;
        $scrollText = New Announcement();
        $scrollText->announcement = $requestData['announcement'];
        $scrollText->user_id = $requestData['user_id'];
        $scrollText->company_id = $requestData['company_id'];
        $scrollText->misclaneous1 = "Publish";
    	$scrollText->save();
    	return back();
    }

    public function unpublish($id){
        $unpub=Announcement::find($id);
        $unpub->misclaneous1="Unpublish";
        $unpub->save();
        echo '<script type="text/javascript">window.location.href="/controlpanel";</script>';
    }

    public function publish($id){

        $user_id = \Auth::user()->id;
       $all_unpub = Announcement::where('user_id', $user_id)->where('misclaneous1','Publish')->update(['misclaneous1' => 'Unpublish']);
      //print_r($all_unpub);exit;
        $pub=Announcement::find($id);
        $pub->misclaneous1="Publish";
        $pub->save();

        echo '<script type="text/javascript">window.location.href="/controlpanel";</script>';

    }
}