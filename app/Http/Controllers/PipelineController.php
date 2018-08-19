<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Quotation;
use App\Models\Activities;
use App\Models\Invoice;
use App\Models\Company;
use DB;
use Carbon;

class PipelineController extends Controller
{
    //
    public function index() {

        $user_id = \Auth::id();
        $role_permissions = DB::select(DB::raw("select * from role_user where user_id = $user_id"));
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }
        
        $user_name = DB::select(DB::raw("select name,id from users where id = $user_id"));

        $company_id = \Auth::user()->company_id;
        
        $today = Carbon\Carbon::now()->toDateString();
        $tomorrow = Carbon\Carbon::now()->addDays(1)->toDateString();
        $yesterday = Carbon\Carbon::now()->addDays(-1)->toDateString();
        $lastweek = Carbon\Carbon::now()->subweek()->toDateString();
        $nextweek = Carbon\Carbon::now()->addDays(7)->toDateString();
        $start_thismonth = Carbon\Carbon::now()->startOfMonth()->toDateString();
        $end_thismonth = Carbon\Carbon::now()->endOfMonth()->toDateString();
        $start_lastmonth = Carbon\Carbon::now()->startOfMonth()->subMonth()->toDateString();
        $end_lastmonth = Carbon\Carbon::now()->endOfMonth()->subMonth()->toDateString();

        $next_month= Carbon\Carbon::now()->addMonths(1);
        $m=$next_month->format('F');
        $date = \Carbon\Carbon::now();

        $month=$date->format('F'); // July
        

        //currency
        $currency=Company::select('value')->where('company_id',$company_id)->first();
        $currency=$currency->value;
        //print_r($currency->value); die();
        // $currency_value=$currency->currency;

if($user_role == 1){


      // $target = DB::table('company as co')
      //                   ->join('quotations as q','co.company_id','=','q.company_id')
      //                   ->select('co.value')
      //                   ->where('q.company_id','=',$company_id)->where('q.status','=','Submitted')->where('co.company_id','=',$company_id)->where('co.type','=','Target')->where('co.sub_type','=',$m)->first();

      $target=Company::select('value')->where('company_id',$company_id)->where('type','Target')->where('sub_type',$m)->first();

      if($target==""){
        $target=0;
      }
      else{
        $target=$target->value;
      }
      $target_approved=3*($target);
      $target_invoice=2*($target);
       //print_r($target); die();
        // $target_value=$target->value;
        // if($target==""){

        // }

      $submit_this= Quotation::where('company_id',$company_id)->where('status','Submitted')->whereBetween('quotation_date',[$start_thismonth,$end_thismonth])->sum('amount');
      // $this_submitted = DB::table('company as co')
      //                   ->join('quotations as q','co.company_id','=','q.company_id')
      // //                   ->where('q.company_id','=',$company_id)->where('q.status','=','Submitted')->where('co.company_id','=',$company_id)->where('type','=','Target')->whereBetween('created_date',[$start_thismonth,$today])->sum('co.value');
      if($submit_this==""){
         $submit_this=0;
       }
       //print_r($this_submitted);die();

       $submit_last = Quotation::where('status','=','Submitted')->where('company_id',$company_id)->whereBetween('quotation_date',[$start_lastmonth,$end_lastmonth])->sum('amount');

      
      if($submit_last==""){
        $submit_last=0;
      }




      $approve_this = Quotation::where('company_id',$company_id)->where('status','Approved')->whereBetween('quotation_date',[$start_thismonth,$end_thismonth])->sum('amount');
      if($approve_this==""){
        $approve_this=0;
      }



       $approve_last =Quotation::where('company_id',$company_id)->where('status','Approved')->whereBetween('quotation_date',[$start_lastmonth,$end_lastmonth])->sum('amount');
      if($approve_last==""){
        $approve_last=0;
      }


      $invoice_this= Invoice::where('company_id',$company_id)->whereBetween('invoice_date',[$start_thismonth,$end_thismonth])->sum('amount');
      if($invoice_this==""){
        $invoice_this=0;
      }


       $invoice_last= Invoice::where('company_id',$company_id)->whereBetween('invoice_date',[$start_lastmonth,$end_lastmonth])->sum('amount');
      if($invoice_last==""){
        $invoice_last=0;
      }








        // $value_approved=Quotation::select('company_id')->where('company_id',$company_id)->where('user_id',$user_id)->where('status','Approved')->first();
        // $idc1=$value_approved->company_id;
        // if($idc1==""){
        //   $this_approved=0;
        //   $last_approved=0;
        // }
       
        // $value_submitted=Quotation::select('company_id')->where('company_id',$company_id)->where('user_id',$user_id)->where('status','Submitted')->first();
        // $idc=$value_submitted->company_id;
        //   if($idc==""){
        //     $this_submitted=0;
        //     $last_submitted=0;
        //     $target_value=0;
        //   }
       // print_r($idc); die();
        //Targets
        //  $value1=Company::select('value')->where('company_id',$idc)->where('sub_type',$m)->first();
        //  if($value==""){
        //   $target_value=0;
        //  }
        //  //print_r($value1); die();
        // $target_value=$value1->value;
        // //print_r($target_value); die();
        //  $target_approved=3*($target_value);
        //  $target_invoice=2*($target_value);
        //this month quotations submitted amount
         //  
         //this month quotations approved amount
         // $this_approved=Company::where('company_id',$idc1)->where('type','Target')->whereBetween('created_date',[$start_thismonth,$today])->sum('value');
         // if($this_approved==""){
         //    $this_approved=0;
         //   }
         //this month invoices amount
         // $value_invoice = Invoice::select('company_id')->where('company_id',$company_id)->where('user_id',$user_id)->first();
         // if($value_invoice ==""){
         //  $this_invoice=0;
         // } else{
         //    $id3=$value_invoice->company_id;
         //    $this_invoice=Company::where('company_id',$id3)->where('type','Target')->whereBetween('created_date',[$start_thismonth,$today])->sum('value');
         // }
      
         // $this_invoice=0;

         // //last month quotations submitted amount

         // $last_submitted= Company::where('company_id',$idc)->where('type','Target')->whereBetween('created_date',[$start_lastmonth,$end_lastmonth])->sum('value');
         // //last month quotations approved amount
         // $last_approved=Company::where('company_id',$idc1)->where('type','Target')->whereBetween('created_date',[$start_lastmonth,$end_lastmonth])->sum('value');
         // //this month invoices amount
         // if($value_invoice ==""){
         //  $last_invoice=0;
         // } else{
         //    $id3=$value_invoice->company_id;
         //    $last_invoice=Company::where('company_id',$id3)->where('type','Target')->whereBetween('created_date',[$start_lastmonth,$end_lastmonth])->sum('value');
         // }
         // $last_invoice=0;

         
         //  $last_submitted= Company::where('company_id',$idc)->where('type','Target')->whereBetween('created_date',[$start_lastmonth,$end_lastmonth])->sum('value');
         //  $this_approved=2*($last_submitted);
         //  $this_inoice=3*($last_submitted);


        //  print_r($target_approved); die();
        //  $target_lastmonth=Company::where('company_id',$company_id)->whereBetween('created_date',($start_thismonth,$today))->(sum('value'));
        //  print_r($target_lastmonth); die();
        // whereBetween('created_date' ($start_lastmonth,$today))->get();
        //    print_r($target_lastmonth);die();
        // print($target_value);
        //  $names = Company::where('company_id',$company_id)->where('sub_type',$m)->get();
        //   foreach($value1 as $value2) {
        //     print($value1);
        //   }
        //print($value1->value);die();
        // $amount = DB::SELECT(DB::raw("SELECT year(invoice_date) as year, month(invoice_date) as month, SUM(amount) as total_amount, count(month(invoice_date)) as no_of_records FROM `invoices` GROUP BY month(invoice_date), year(invoice_date)"));
        
        // foreach($amount as $value) {
        //     $total_amount = $value->total_amount;
        //     $month = $value->month;
        //     $year = $value->year;
        // }

        

            //late
            $callemail_late = Activities::where('company_id',$company_id)->where('name','Call')->orwhere('name','Email')->whereBetween('date',[$yesterday,$lastweek])->count();
            $meet_late = Activities::where('company_id',$company_id)->where('name','Meet')->whereBetween('date',[$yesterday,$lastweek])->count();
            $completed_late = Activities::where('company_id',$company_id)->where('status','Completed')->whereBetween('date',[$yesterday,$lastweek])->count();
            
            
            //now
         $callemail_now = Activities::where('company_id',$company_id)->where('name','Call')->orwhere('name','Email')->where('date',$today)->count();
         $meet_now = Activities::where('company_id',$company_id)->where('name','Meet')->where('date', $today)->count();
         $completed_now = Activities::where('company_id',$company_id)->where('status','Completed')->where('date', $today)->count();

            //ahead
            $callemail_ahead = Activities::where('company_id',$company_id)->where('name','Call')->orwhere('name','Email')->whereBetween('date',[$tomorrow,$nextweek])->count();
            $meet_ahead = Activities::where('company_id',$company_id)->where('name','Meet')->whereBetween('date',[$tomorrow,$nextweek])->count();
         $completed_ahead = Activities::where('company_id',$company_id)->where('status','Completed')->whereBetween('date',[$tomorrow,$nextweek])->count();


           //this month
         // $submit_this = Quotation::where('company_id',$company_id)->where('status','Submitted')->whereBetween('quotation_date',[$start_thismonth,$end_thismonth])->count();
         // $approve_this = Quotation::where('company_id',$company_id)->where('status','Approved')->whereBetween('quotation_date',[$start_thismonth,$end_thismonth])->count();
         // $invoice_this = Invoice::where('company_id',$company_id)->whereBetween('invoice_date',[$start_thismonth,$end_thismonth])->count();
           

           //lastmonth
         // $submit_last = Quotation::where('company_id',$company_id)->where('status','Submitted')->whereBetween('quotation_date',[$start_lastmonth,$end_lastmonth])->count();
         // $approve_last = Quotation::where('company_id',$company_id)->where('status','Approved')->whereBetween('quotation_date',[$start_lastmonth,$end_lastmonth])->count();
         // $invoice_last = Invoice::where('company_id',$company_id)->whereBetween('invoice_date',[$start_lastmonth,$end_lastmonth])->count();

           //total Quotations
           $quote = Quotation::where('status','!=','Rejected')->where('company_id',$company_id)->whereBetween('quotation_date',[$start_thismonth,$end_thismonth])->count();

           //Total invoice
         $invoice = Invoice::where('company_id',$company_id)->whereBetween('invoice_date',[$start_thismonth,$end_thismonth])->count();
        } 
        else {
            //late
            $callemail_late = Activities::where('company_id',$company_id)->where('user_id',$user_id)->where('name','Call')->orwhere('name','Email')->whereBetween('date',[$yesterday,$lastweek])->count();
            $meet_late = Activities::where('company_id',$company_id)->where('user_id',$user_id)->where('name','Meet')->whereBetween('date',[$yesterday,$lastweek])->count();
            $completed_late = Activities::where('company_id',$company_id)->where('user_id',$user_id)->where('status','Completed')->whereBetween('date',[$yesterday,$lastweek])->count();
            
            
            //now
           $callemail_now = Activities::where('company_id',$company_id)->where('user_id',$user_id)->where('name','Call')->orwhere('name','Email')->where('date',$today)->count();
           $meet_now = Activities::where('company_id',$company_id)->where('user_id',$user_id)->where('name','Meet')->where('date', $today)->count();
           $completed_now = Activities::where('company_id',$company_id)->where('user_id',$user_id)->where('status','Completed')->where('date', $today)->count();

            //ahead
            $callemail_ahead = Activities::where('company_id',$company_id)->where('user_id',$user_id)->where('name','Call')->orwhere('name','Email')->whereBetween('date',[$tomorrow,$nextweek])->count();
            $meet_ahead = Activities::where('company_id',$company_id)->where('user_id',$user_id)->where('name','Meet')->whereBetween('date',[$tomorrow,$nextweek])->count();
           $completed_ahead = Activities::where('company_id',$company_id)->where('user_id',$user_id)->where('status','Completed')->whereBetween('date',[$tomorrow,$nextweek])->count();


           //this month
           $submit_this = Quotation::where('company_id',$company_id)->where('user_id',$user_id)->where('status','Submitted')->whereBetween('quotation_date',[$start_thismonth,$end_thismonth])->count();
           //print_r($submit_this);die();
           $approve_this = Quotation::where('company_id',$company_id)->where('user_id',$user_id)->where('status','Approved')->whereBetween('quotation_date',[$start_thismonth,$end_thismonth])->count();
           $invoice_this = Invoice::where('company_id',$company_id)->where('user_id',$user_id)->whereBetween('invoice_date',[$start_thismonth,$end_thismonth])->count();
           

           //lastmonth
           $submit_last = Quotation::where('company_id',$company_id)->where('user_id',$user_id)->where('status','Submitted')->whereBetween('quotation_date',[$start_lastmonth,$end_lastmonth])->count();
           $approve_last = Quotation::where('company_id',$company_id)->where('user_id',$user_id)->where('status','Approved')->whereBetween('quotation_date',[$start_lastmonth,$end_lastmonth])->count();
           $invoice_last = Invoice::where('company_id',$company_id)->where('user_id',$user_id)->whereBetween('invoice_date',[$start_lastmonth,$end_lastmonth])->count();

           //total Quotations
           $quote = Quotation::where('status','!=','Rejected')->where('company_id',$company_id)->where('user_id',$user_id)->whereBetween('quotation_date',[$start_thismonth,$end_thismonth])->count();

           //Total invoice
           $invoice = Invoice::where('company_id',$company_id)->where('user_id',$user_id)->whereBetween('invoice_date',[$start_thismonth,$end_thismonth])->count();
           //targets Quotations submitted

           // $targets=Company::select('value')->where('sub_type',$month)->join('Quotation','Company.company_id','=','Quotation.company_id')->where('status','Submitted')->get();
           // print_r($targets);die();
           //Target
          
          $target=0;
          $target_invoice=0;
          $target_approved=0;
           //next months Quotations submitted
           // $target_thismonth=Company::sum('value')->whereBetween('created_date',($start_thismonth,$today) )join('Quotation','Company.company_id','=','Quotation.company_id')->where('status','Submitted')->get();
           //last months Quotations Approved
           
            // //last months invoices;
            //$target_thismonth_Invoices=3*$target_value;

            //last months Quotations submitted
            //$target_lastmonth=Company::sum('value')->whereBetween('created_date',($start_lastmonth,$today) );
            //print_r($target_lastmonth);die();
              // $target_lastmonth=Company::sum('value')->whereBetween('created_date',($start_lastmonth,$today) )join('Quotation','Company.company_id','=','Quotation.company_id')->where('status','Submitted')->get();

           //$targets=Company::sum('value')->join('Quotation','Company.company_id','=','Quotation.company_id')->where('status','Submitted')->get();
           //$targets=Company::select('value')->where('sub_type',$next_month)->join('Quotation','Company.company_id','=','Quotation.company_id')->where('status','Submitted')->get();
           //$targets=Company::select('value')->where('sub_type',$month)->get();

    //Targets
        //  $value1=Company::select('value')->where('company_id',$idc)->where('sub_type',$m)->first();
        // $target_value=$value1->value;
        // $value2=Company::select('value')->where('company_id',$idc1)->where('sub_type',$m)->first();
        // $target_value1=$value2->value;
        //print_r($vv); die();
            //where('company.type',$m)->where('quotations.company_id','=',$company_id)->where('quotations.status','Submitted')
            
        //print_r($sa); die();
        // $quotations = DB::table('company')
        //     ->join('quotations','quotations.lea_id','=','leads.id')
        //     ->select('quotations.*','leads.name','leads.company_name','leads.lead_number')
        //     ->where('quotations.company_id','=',$company_id)->where('is_deleted','')->orderByDesc('created_at')
        //     ->paginate(10);

       // $target_value=$value1->value;

         // $target_approved=3*($target_value);
         // $target_invoice=2*($target_value);







        }

       return view('layouts.pipeline')->with('callemail_late',$callemail_late)->with('meet_late',$meet_late)->with('completed_late',$completed_late)->with('callemail_now',$callemail_now)->with('meet_now',$meet_now)->with('completed_now',$completed_now)->with('callemail_ahead',$callemail_ahead)->with('meet_ahead',$meet_ahead)->with('completed_ahead',$completed_ahead)->with('submit_last',$submit_last)->with('approve_last',$approve_last)->with('invoice_last',$invoice_last)->with('submit_this',$submit_this)->with('approve_this',$approve_this)->with('invoice_this',$invoice_this)->with('invoice',$invoice)->with('quote',$quote)->with('target',$target)->with('target_approved',$target_approved)->with('target_invoice',$target_invoice)->with('currency',$currency);
      
    }
}
