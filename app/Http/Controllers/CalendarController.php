<?php

namespace App\Http\Controllers;

use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use App\Events\MyCalendar;
use Calendar;
use MaddHatter\LaravelFullcalendar\Event;
use DB;
use App\Models\Activities;
use App\Models\Lead;
//use App\Models\EventModel;

use App\Repositories\Lead\LeadRepositoryContract;


class CalendarController extends Controller
{
    //
    public $event;
    protected $leads;

    public function __construct(MyCalendar $event,   LeadRepositoryContract $leads){
        $this->event = $event;
        $this->leads=$leads;

    }
    public function calendarView() {

        $activity_list = [];
        $lead_list = [];

        $user_id = \Auth::id();
        $company_id = \Auth::user()->company_id;
        $role_permissions = DB::table('role_user')
                            ->where('user_id','=', $user_id)
                            ->get();
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }
        if($user_role == 1){
            $activity = Activities::where('company_id',$company_id)->get();
            foreach ($activity as $act) {
                $lead= Lead::find($act->id);
                $activity_list[] = $this->event->event(
                    $act->name,
                    TRUE,
                    $date = $act->date . '' . $act->time,
                    $end_date = $act->end_date,
                    $act->id,
                    ['color' => '#4096ec',
                        'details' => $act->details,
                        'status' => $act->status,
                        'date' => $act->date,
                        'name' => $act->name,
                        'start_date' => $act->date,
                        'end_date' =>$act->end_date
                        ]

                );

            }
            $eloquentEvent = Activities::where('company_id',$company_id)->first();
        } else {
            $activity = Activities::where('company_id',$company_id)->where('user_id',$user_id)->get();
            foreach ($activity as $act) {
                $lead= Lead::find($act->id);
                $activity_list[] = $this->event->event(
                    $act->name,
                    TRUE,
                    $date = $act->date . '' . $act->time,
                    $end_date = $act->end_date,
                    $act->id,
                    ['color' => '#4096ec',
                        'details' => $act->details,
                        'status' => $act->status,
                        'date' => $act->date,
                        'name' => $act->name,
                        'start_date' => $act->date,
                        'end_date' =>$act->end_date
                        ]

                );

            }
            $eloquentEvent = Activities::where('company_id',$company_id)->where('user_id',$user_id)->first();
        }


        //print_r($activity_list);exit;
        // print_r($eloquentEvent);exit;
        $calendar_detais = $this->event->addEvents($activity_list);
                 
        return view('calendar.index', compact('calendar_detais'));
    }

    public function create(Request $request)
    {
        $date = $request->date;
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

        

        
            
        //     $id = '';
        //     $client = '';
        

        return view('calendar.create')->with('clients',$clients)->with('date',$date);
                    // ->with('id',$id)
                    // ->with('client',$client)
                    // ->with('clients',$clients);
    }
}
