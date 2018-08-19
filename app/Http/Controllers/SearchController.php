<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activities;
use App\Models\Lead;
use App\Models\Currency;
use DB;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{

	public function index()
    {
    }
    
    public function searchQuery(Request $request){
        // print_r($request->all());die();
    	$user_id = \Auth::id();
        $role_permissions = DB::table('role_user')
                            ->where('user_id','=', $user_id)
                            ->get();
    	
    	foreach($role_permissions as $role){
    		$user_role = $role->role_id;
    	}
    	
    	
    	$company_id = \Auth::user()->company_id;

        if($user_role == 1){
            $leads = Lead::select('id','name')->where('company_id',$company_id)->where('drop_status','=','')->get();
        }else{
            $leads = Lead::select('id','name')->where('drop_status','=','')->where('company_id',$company_id)->where('user_id',$user_id)->get();
        }

    	$requestData = $request->all();
     // print_r($requestData);exit;
    	$ajax = $requestData['ajax'];
//print_r($ajax);exit;

       	if($ajax == 'activity'){
    		$lead_name = $requestData['lead_name'];
    		$created_from = $requestData['created_from'];
            $created_to = $requestData['created_to'];
    		$activity_type = $requestData['activity_type'];
    		$status = $requestData['status'];


    		$query = DB::table('activities as ac')
                            ->join('leads as l','ac.lead_id','=','l.id')
                            ->leftjoin('users as u','ac.user_id','=','u.id')
                            ->where('ac.company_id','=',$company_id);
                            if($lead_name != ''){
                            	 // $query->where('l.name','=', $lead_name);
                                $query->where('l.name', 'like', '%' . $lead_name . '%');
                            }
                           if($created_from != ''){
                            	 $query->whereDate('ac.created_at','>=',$created_from);
                            }
                            if($created_to != ''){
                                $query->whereDate('ac.created_at','<=',$created_to);
                            }
                            if($activity_type != ''){
                            	 $query->where('ac.name','=',$activity_type);
                            }
                            if($status != ''){
                            	 $query->where('ac.status','=',$status);
                            }



            $getAllClients = $query->select('ac.*','l.name as lead_name','l.lead_number','u.name as user_name')->paginate(10);

            return view('activities.datatable')->with('getAllClients',$getAllClients)->with('leads',$leads);
                            
    	}

    	if($ajax == 'contacts'){
            $lead_name = $requestData['lead_name']; //lead_id
            // $email = $requestData['email'];
            $company = $requestData['company'];
            $status = $requestData['status'];

            $query = DB::table('leads as l')
                            ->join('users as u','l.user_id','=','u.id');
                    if($lead_name != '' && $company == '' && $status == ''){
                        $query->where('l.name', 'like', '%' . $lead_name . '%');
                    } elseif($company != '' && $lead_name == '' && $status == ''){
                        // $query->where('l.company_name','=', $company);
                        $query->where('l.company_name', 'like', '%' . $company . '%');
                    } elseif ($status != '' && $lead_name == '' && $company == '') {
                        if($status == 'Pending'){
                            $query->Where([['l.lead_stage','=','Lead'],['l.drop_status','=','']]);
                            $query->orWhere('l.lead_stage','=','Opportunity');
                        } elseif ($status == 'Quote') {
                            $query->Where([['l.lead_stage','=','Quote'],['l.drop_status','=','']]);
                        } elseif ($status == 'Won') {
                            $query->Where('l.lead_stage','=','Won');
                        } elseif ($status == 'Lost') {
                            $query->where([['l.drop_status','!=',''],['l.drop_status','!=','Not-Qualifield']]);
                        } elseif ($status == 'NotQualified') {
                            $query->where('l.drop_status','=','Not-Qualifield');
                        } elseif ($status == 'all') {
                            // $query->where('l.company_id','=',$company_id);
                        }
                    } elseif ($lead_name != '' && $company != '' && $status == '') {
                        // $query->where('l.id','=', $lead_name)->where('l.company_name','=', $company);
                        $query->where('l.name', 'like', '%' . $lead_name . '%')->where('l.company_name', 'like', '%' . $company . '%');
                    } elseif ($lead_name != '' && $status != '' && $company == '') {
                        if($status == 'Pending'){
                            $query->Where([['l.lead_stage','=','Lead'],['l.drop_status','=',''],['l.name', 'like', '%' . $lead_name . '%']]);
                            $query->orWhere([['l.lead_stage','=','Opportunity'],['l.name', 'like', '%' . $lead_name . '%']]);
                        } elseif ($status == 'Quote') {
                           $query->Where([['l.lead_stage','=','Quote'],['l.drop_status','=',''],['l.name', 'like', '%' . $lead_name . '%']]);
                        } elseif ($status == 'Won') {
                            $query->Where([['l.lead_stage','=','Won'],['l.name', 'like', '%' . $lead_name . '%']]);
                        } elseif ($status == 'Lost') {
                            $query->where([['l.drop_status','!=',''],['l.drop_status','!=','Not-Qualifield'],['l.name', 'like', '%' . $lead_name . '%'
                        ]]);
                        } elseif ($status == 'NotQualified') {
                            $query->where([['l.drop_status','=','Not-Qualifield'],['l.name', 'like', '%' . $lead_name . '%']]);
                        } elseif ($status == 'all') {
                            $query->where('l.name', 'like', '%' . $lead_name . '%');
                        }
                    } elseif ($company != '' && $status != '' && $lead_name == '') {
                        if($status == 'Pending'){
                            $query->Where([['l.lead_stage','=','Lead'],['l.drop_status','=',''],['l.company_name', 'like', '%' . $company . '%']]);
                            $query->orWhere([['l.lead_stage','=','Opportunity'],['l.company_name', 'like', '%' . $company . '%']]);
                        } elseif ($status == 'Quote') {
                            $query->where([['l.company_name', 'like', '%' . $company . '%'],['l.lead_stage','=','Quote'],['l.drop_status','=','']]);
                        } elseif ($status == 'Won') {
                            $query->where([['l.company_name', 'like', '%' . $company . '%'],['l.lead_stage','=','Won']]);
                        } elseif ($status == 'Lost') {
                            $query->where([['l.company_name', 'like', '%' . $company . '%'],['l.drop_status','!=',''],['l.drop_status','!=','Not-Qualifield']]);
                        } elseif ($status == 'NotQualified') {
                            $query->where([['l.company_name', 'like', '%' . $company . '%'],['l.drop_status','=','Not-Qualifield']]);
                        } elseif ($status == 'all') {
                            $query->where('l.company_name', 'like', '%' . $company . '%');
                        }
                    } elseif ($company != '' && $status != '' && $lead_name != '') {
                        if($status == 'Pending'){
                            $query->Where([['l.lead_stage','=','Lead'],['l.drop_status','=',''],['l.company_name', 'like', '%' . $company . '%'],['l.id','=', $lead_name]]);
                            $query->orWhere([['l.lead_stage','=','Opportunity'],['l.company_name', 'like', '%' . $company . '%'],['l.name', 'like', '%' . $lead_name . '%']]);
                        } elseif ($status == 'Quote') {
                            $query->where([['l.name', 'like', '%' . $lead_name . '%'],['l.company_name', 'like', '%' . $company . '%'],['l.lead_stage','=','Quote'],['l.drop_status','=','']]);
                        } elseif ($status == 'Won') {
                            $query->where([['l.name', 'like', '%' . $lead_name . '%'],['l.company_name', 'like', '%' . $company . '%'],['l.lead_stage','=','Won']]);
                        } elseif ($status == 'Lost') {
                            $query->where([['l.name', 'like', '%' . $lead_name . '%'],['l.company_name', 'like', '%' . $company . '%'],['l.drop_status','!=',''],['l.drop_status','!=','Not-Qualifield']]);
                        } elseif ($status == 'NotQualified') {
                            $query->where([['l.name', 'like', '%' . $lead_name . '%'],['l.company_name', 'like', '%' . $company . '%'],['l.drop_status','=','Not-Qualifield']]);
                        } elseif ($status == 'all') {
                            $query->where([['l.name', 'like', '%' . $lead_name . '%'],['l.company_name', 'like', '%' . $company . '%']]);
                        }
                    }
                    
         $getAllClients = $query->select('u.name as user_name','l.*')->paginate(10);
         // var_dump($getAllClients);die();
         return view('leads.contacts')->with('getAllClients',$getAllClients);
    	}

//        print_r($ajax);exit;
    	if($ajax == 'allleads'){

    		$lead_name = $requestData['lead_name']; //lead_id
    		// $email = $requestData['email'];
    		$company = $requestData['company'];
    		$status = $requestData['status'];
            $query = DB::table('leads as l')
                            ->join('users as u','l.user_id','=','u.id')
                            ->where('l.company_id','=', $company_id);
                    if($lead_name != '' && $company == '' && $status == ''){
                        $query->where('l.name', 'like', '%' . $lead_name . '%');
                    } elseif($company != '' && $lead_name == '' && $status == ''){
                        $query->where('l.company_name', 'like', '%' . $company . '%');
                    } elseif ($status != '' && $lead_name == '' && $company == '') {
                        if($status == 'Pending'){
                            $query->Where([['l.lead_stage','=','Lead'],['l.drop_status','=','']]);
                            $query->orWhere('l.lead_stage','=','Opportunity');
                        } elseif ($status == 'Quote') {
                            $query->Where([['l.lead_stage','=','Quote'],['l.drop_status','=','']]);
                        } elseif ($status == 'Won') {
                            $query->Where('l.lead_stage','=','Won');
                        } elseif ($status == 'Lost') {
                            $query->where([['l.drop_status','!=',''],['l.drop_status','!=','Not-Qualifield']]);
                        } elseif ($status == 'NotQualified') {
                            $query->where('l.drop_status','=','Not-Qualifield');
                        } elseif ($status == 'all') {
                            $query->where('l.company_id','=',$company_id);
                        }
                    } elseif ($lead_name != '' && $company != '' && $status == '') {
                        $query->where('l.name', 'like', '%' . $lead_name . '%')->where('l.company_name', 'like', '%' . $company . '%');
                    } elseif ($lead_name != '' && $status != '' && $company == '') {
                        if($status == 'Pending'){
                            $query->Where([['l.lead_stage','=','Lead'],['l.drop_status','=',''],['l.name', 'like', '%' . $lead_name . '%']]);
                            $query->orWhere([['l.lead_stage','=','Opportunity'],['l.name', 'like', '%' . $lead_name . '%']]);
                        } elseif ($status == 'Quote') {
                           $query->Where([['l.lead_stage','=','Quote'],['l.drop_status','=',''],['l.name', 'like', '%' . $lead_name . '%']]);
                        } elseif ($status == 'Won') {
                            $query->Where([['l.lead_stage','=','Won'],['l.name', 'like', '%' . $lead_name . '%']]);
                        } elseif ($status == 'Lost') {
                            $query->where([['l.drop_status','!=',''],['l.drop_status','!=','Not-Qualifield'],['l.id','=', $lead_name]]);
                        } elseif ($status == 'NotQualified') {
                            $query->where([['l.drop_status','=','Not-Qualifield'],['l.name', 'like', '%' . $lead_name . '%']]);
                        } elseif ($status == 'all') {
                            $query->where('l.name', 'like', '%' . $lead_name . '%');
                        }
                    } elseif ($company != '' && $status != '' && $lead_name == '') {
                        if($status == 'Pending'){
                            $query->Where([['l.lead_stage','=','Lead'],['l.drop_status','=',''],['l.company_name', 'like', '%' . $company . '%']]);
                            $query->orWhere([['l.lead_stage','=','Opportunity'],['l.company_name', 'like', '%' . $company . '%']]);
                        } elseif ($status == 'Quote') {
                            $query->where([['l.company_name', 'like', '%' . $company . '%'],['l.lead_stage','=','Quote'],['l.drop_status','=','']]);
                        } elseif ($status == 'Won') {
                            $query->where([['l.company_name', 'like', '%' . $company . '%'],['l.lead_stage','=','Won']]);
                        } elseif ($status == 'Lost') {
                            $query->where([['l.company_name', 'like', '%' . $company . '%'],['l.drop_status','!=',''],['l.drop_status','!=','Not-Qualifield']]);
                        } elseif ($status == 'NotQualified') {
                            $query->where([['l.company_name', 'like', '%' . $company . '%'],['l.drop_status','=','Not-Qualifield']]);
                        } elseif ($status == 'all') {
                            $query->where('l.company_name', 'like', '%' . $company . '%');
                        }
                    } elseif ($company != '' && $status != '' && $lead_name != '') {
                        if($status == 'Pending'){
                            $query->Where([['l.lead_stage','=','Lead'],['l.drop_status','=',''],['l.company_name','=', $company],['l.name', 'like', '%' . $lead_name . '%']]);
                            $query->orWhere([['l.lead_stage','=','Opportunity'],['l.company_name', 'like', '%' . $company . '%'],['l.id','=', $lead_name]]);
                        } elseif ($status == 'Quote') {
                            $query->where([['l.name', 'like', '%' . $lead_name . '%'],['l.company_name', 'like', '%' . $company . '%'],['l.lead_stage','=','Quote'],['l.drop_status','=','']]);
                        } elseif ($status == 'Won') {
                            $query->where([['l.name', 'like', '%' . $lead_name . '%'],['l.company_name', 'like', '%' . $company . '%'],['l.lead_stage','=','Won']]);
                        } elseif ($status == 'Lost') {
                            $query->where([['l.name', 'like', '%' . $lead_name . '%'],['l.company_name', 'like', '%' . $company . '%'],['l.drop_status','!=',''],['l.drop_status','!=','Not-Qualifield']]);
                        } elseif ($status == 'NotQualified') {
                            $query->where([['l.name', 'like', '%' . $lead_name . '%'],['l.company_name', 'like', '%' . $company . '%'],['l.drop_status','=','Not-Qualifield']]);
                        } elseif ($status == 'all') {
                            $query->where([['l.name', 'like', '%' . $lead_name . '%'],['l.company_name', 'like', '%' . $company . '%']]);
                        }
                    }

         $getAllLeads = $query->select('u.name as user_name','l.*')->paginate(10);
         return view('leads.allleads')->with('getAllLeads',$getAllLeads);
//            print_r("pra");exit;
    	}

        if($ajax == 'mycustomers'){
            $lead_name = $requestData['lead_name'];
            // $email = $requestData['email'];
            $company = $requestData['company'];
            // $status = $requestData['status'];
            // print_r($status);die();
            $query = DB::table('leads as l')
                            ->join('users as u','l.user_id','=','u.id')
                            ->where('l.company_id','=', $company_id)
                            ->where('l.lead_stage','=','Won');
                            if($lead_name != ''){
                                 $query->where('l.name', 'like', '%' . $lead_name . '%');
                            }
                            // if($email != ''){
                            //      $query->where('l.email','=', $email);
                            // }
                            if($company != ''){
                                 $query->where('l.company_name', 'like', '%' . $company . '%');
                            }
         $getAllClients = $query->select('u.name as user_name','l.*')->paginate(10);
         // var_dump($getAllClients);die();
         return view('leads.mycustomers')->with('getAllClients',$getAllClients);
        }


    	if($ajax == 'quote'){
    		$lead_name = $requestData['lead_name'];
            // print_r($lead_name);die();
    		// $quote_id = $requestData['quotation_id'];
    		$company = $requestData['company'];
    		$status = $requestData['status'];

    		$query =  DB::table('quotations')
			            ->join('leads','quotations.lead_id','=','leads.id')
			            ->where('quotations.company_id','=',$company_id);
			            if($lead_name != ''){
			            	$query->where('leads.name', 'like', '%' . $lead_name . '%');
			            }
			            // if($quote_id != ''){
			            // 	$query->where('quotations.id','=',$quote_id);
			            // }
			            if($company != ''){
			            	$query->where('leads.company_name', 'like', '%' . $company . '%');
			            }
			            if($status != ''){
			            	$query->where('quotations.status','=',$status);
			            }
		 $quotations = $query->select('quotations.*','leads.name','leads.company_name','leads.lead_number')
			            ->paginate(10);
         $currency = Currency::all();

		return view('layouts.quotedatatable')->with('quotations',$quotations)->with('currency',$currency);
    	}

    	if($ajax == 'invoice'){
    		$lead_name = $requestData['lead_name'];
    		// $invoice_id = $requestData['invoice_id'];
    		$company = $requestData['company'];

    		$query = DB::table('invoices')
                        ->join('leads','invoices.lead_id','=','leads.id')
                        ->where('leads.company_name', 'like', '%' . $company . '%');
                        if($lead_name != ''){
                        	$query->where('leads.name', 'like', '%' . $lead_name . '%');
                        }
                        // if($invoice_id != ''){
                        // 	$query->where('invoices.id','=',$invoice_id);
                        // }
                        if($company != ''){
                        	$query->where('leads.company_name','=',$company);
                        }
        $invoices  =  $query->select('invoices.*','leads.name','leads.company_name','leads.lead_number')
                        ->paginate(10);

            $currency = Currency::all();
            return view('layouts.invoicedatatable')->with('invoices',$invoices)->with('currency',$currency);
    	}
    	
    }
}
