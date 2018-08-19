<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\Lead;
use App\Models\Activities;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\Invoice;
use App\Models\Note;
use App\Models\Industry;
use App\Helper\Helper;
use App\Models\User;
use DB;

/**
 * @SWG\Post(
 *     path="/leads",
 *     tags={"Leads"},
 *     summary="Create new Lead",
 *     @SWG\Parameter(
 * 			name="id",
 * 			in="body",
 *          schema={"$ref": "#/definitions/NewLead"},
 * 			required=true,
 * 			type="integer",
 * 			description="UUID",
 * 		),
 *     @SWG\Response(
 *          response=200,
 *          description="A newly-created lead"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */

/**
 * @SWG\Get(
 *     path="/leads/{id}",
 *     tags={"Leads"},
 *     summary="Fetch lead",
 *     @SWG\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          type="integer",
 *          description="UUID",
 * 		),
 *     @SWG\Response(
 *          response=200,
 *          description="lead data"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */

/**
 * @SWG\Post(
 *     path="/leads/{id}/edit",
 *     tags={"Leads"},
 *     summary="Edit lead",
 *     @SWG\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          schema={"$ref": "#/definitions/EditLead"},
 *          type="integer",
 *          description="UUID",
 * 		),
 *     @SWG\Response(
 *          response=200,
 *          description="An lead"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */

/**
 * @SWG\Post(
 *     path="/leads/drop/{id}",
 *     tags={"Leads"},
 *     summary="Drop lead",
 *     @SWG\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          schema={"$ref": "#/definitions/DropLead"},
 *          type="integer",
 *          description="UUID",
 * 		),
 *     @SWG\Response(
 *          response=204,
 *          description="Delete an employee"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/leads",
 *     tags={"Leads"},
 *     summary="List all the lead in Lead Stage",
  *     @SWG\Parameter(
 *          name="company_id",
 *          in="path",
 *          required=true,
 *          type="string",
 *          description="pass company_id as parameter",
 *      ),
 *     @SWG\Parameter(
 *          name="user_id",
 *          in="path",
 *          required=true,
 *          type="integer",
 *          description="pass user_id as parameter",
 *      ),
 *     @SWG\Response(
 *          response=200,
 *          description="{
    'status': 'true',
    'data': [
                {
                    'id': 6,
                    'name': 'test',
                    'lead_number': '0003'
                }
            ]
        }"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/opportunities",
 *     tags={"Opportunities"},
 *     summary="List all the lead in opportunity Stage",
  *     @SWG\Parameter(
 *          name="company_id",
 *          in="path",
 *          required=true,
 *          type="string",
 *          description="pass company_id as parameter",
 *      ),
 *     @SWG\Parameter(
 *          name="user_id",
 *          in="path",
 *          required=true,
 *          type="integer",
 *          description="pass user_id as parameter",
 *      ),
 *     @SWG\Response(
 *          response=200,
 *          description="{
                'status': 'true',
                'data': [
                    {
                        'id': 4,
                        'name': 'sowjitha kokkarapalle',
                        'lead_number': '0001'
                    }
                ]
            }"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */

/**
 * @SWG\Get(
 *     path="/quote",
 *     tags={"Quotations"},
 *     summary="List all the lead in quotation Stage",
  *     @SWG\Parameter(
 *          name="company_id",
 *          in="path",
 *          required=true,
 *          type="string",
 *          description="pass company_id as parameter",
 *      ),
 *     @SWG\Parameter(
 *          name="user_id",
 *          in="path",
 *          required=true,
 *          type="integer",
 *          description="pass user_id as parameter",
 *      ),
 *     @SWG\Response(
 *          response=200,
 *          description="{
                    'status': 'true',
                    'data': [
                        {
                            'quotation_id': 2,
                            'quotation_number': '0002',
                            'status': 'submitted',
                            'lead_id': 3,
                            'lead_name': '',
                            'lead_number': ''
                        }
                    ]
                }"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/won",
 *     tags={"won"},
 *     summary="List all the lead in won Stage",
  *     @SWG\Parameter(
 *          name="company_id",
 *          in="path",
 *          required=true,
 *          type="string",
 *          description="pass company_id as parameter",
 *      ),
 *     @SWG\Parameter(
 *          name="user_id",
 *          in="path",
 *          required=true,
 *          type="integer",
 *          description="pass user_id as parameter",
 *      ),
 *     @SWG\Response(
 *          response=200,
 *          description="{
                    'status': 'true',
                    'data': [
                        {
                            'invoice_id': 1,
                            'invoice_number': '0001',
                            'currency': 'AUD($)',
                            'public_notes': 'Pending',
                            'amount': '33',
                            'lead_id': 7,
                            'lead_name': 'testleaddata',
                            'lead_number': '0004'
                        }
                    ]
                }"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Post(
 *     path="/movelead/{id}",
 *     tags={"Leads"},
 *     summary="Move lead to Quote and Opportunity",
 *     @SWG\Parameter(
 *          name="id",
 *          in="path",
 *          schema={"$ref": "#/definitions/MoveLead"},
 *          required=true,
 *          type="integer",
 *          description="UUID",
 *      ),
   *     @SWG\Parameter(
 *          name="company_id",
 *          in="body",
 *          schema={"$ref": "#/definitions/MoveLead"},
 *          required=true,
 *          type="string",
 *          description="pass company_id as parameter",
 *      ),
 *     @SWG\Parameter(
 *          name="user_id",
 *          in="body",
 *          schema={"$ref": "#/definitions/MoveLead"},
 *          required=true,
 *          type="integer",
 *          description="pass user_id as parameter",
 *      ),
  *     @SWG\Parameter(
 *          name="stage",
 *          in="body",
 *          schema={"$ref": "#/definitions/MoveLead"},
 *          required=true,
 *          type="integer",
 *          description="pass user_id as parameter",
 *      ),
 *     @SWG\Response(
 *          response=200,
 *          description="Moved Successfully"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */

/**
 * @SWG\Get(
 *     path="/mobileleads",
 *     tags={"Leads"},
 *     summary="List all the lead in won Stage",
  *     @SWG\Parameter(
 *          name="company_id",
 *          in="path",
 *          required=true,
 *          type="string",
 *          description="pass company_id as parameter",
 *      ),
 *     @SWG\Parameter(
 *          name="user_id",
 *          in="path",
 *          required=true,
 *          type="integer",
 *          description="pass user_id as parameter",
 *      ),
 *     @SWG\Response(
 *          response=200,
 *          description="{
                    'status': 'true',
                    'data': [
                        {
                            'invoice_id': 1,
                            'invoice_number': '0001',
                            'currency': 'AUD($)',
                            'public_notes': 'Pending',
                            'amount': '33',
                            'lead_id': 7,
                            'lead_name': 'testleaddata',
                            'lead_number': '0004'
                        }
                    ]
                }"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/interestProducts",
 *     tags={"Leads"},
 *     summary="List all the interestProducts.",
  *     @SWG\Parameter(
 *          name="company_id",
 *          in="path",
 *          required=true,
 *          type="string",
 *          description="pass company_id as parameter",
 *      ),
 *     @SWG\Response(
 *          response=200,
 *          description="Lists all the interested_products"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/industries",
 *     tags={"Leads"},
 *     summary="List all the industries.",
 *     @SWG\Response(
 *          response=200,
 *          description="Lists all the interested_products"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/leadtype",
 *     tags={"Leads"},
 *     summary="List all the leadTypes.",
 *     @SWG\Response(
 *          response=200,
 *          description="Lists all the types of leads"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/leadstatus",
 *     tags={"Leads"},
 *     summary="Lead Status List.",
 *     @SWG\Response(
 *          response=200,
 *          description="Lists all the status"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/users",
 *     tags={"Leads"},
 *     summary="List all the users based on Company.",
  *     @SWG\Parameter(
 *          name="company_id",
 *          in="path",
 *          required=true,
 *          type="string",
 *          description="pass company_id as parameter",
 *      ),
 *     @SWG\Response(
 *          response=200,
 *          description="Lists all the Users"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/leadsource",
 *     tags={"Leads"},
 *     summary="Lead Source List.",
 *     @SWG\Response(
 *          response=200,
 *          description="Lists all the Sources"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/dropstatus",
 *     tags={"Leads"},
 *     summary="Lead Drop List.",
 *     @SWG\Response(
 *          response=200,
 *          description="Lists all the Drop reasons"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */

class LeadController extends Controller
{

	public function create(Request $request){

       // print_r($request->all());exit;
        $email = $request['email'];
        $mobile = $request['primary_number'];
         $company_id = $request['company_id'];
         $lead_number = $request['lead_number'];
        if($mobile != ''){
            $phone = Lead::where('primary_number',$mobile)->where('company_id',$company_id)->get();
           
            if(count($phone)>0){
                $data['error'] = "Lead already exists with this phone Number.";
                return response()->json(['status'=>'false','error'=>"Lead already exists with this phone Number."]);
            }
        }else{
            return response()->json(['status'=>'false','error'=>"Mobile number is empty"]);
        }
        
        if($email != ''){
            $mail = Lead::where('email',$email)->where('company_id',$company_id)->get();
          
            if(count($mail)>0){
              
              $data = "Lead already exists with this e-mail address.";
                return response()->json(['status'=>'false','error'=>"Lead already exists with this e-mail address."]);
            }
        }else{
            return response()->json(['status'=>'false','error'=>"email is empty"]);
        }
        if($lead_number == '') {
            $request['lead_number'] = Helper::leadNumberWithCompany($company_id);
        }
        //print_r($request->all());exit;
		$lead = Lead::create($request->all());
        return new JsonResponse(['status'=>'true','data'=>'Lead created Sucessfully'], Response::HTTP_CREATED);
	}

     public function show($id){
     	$lead = Lead::find($id);
        // print_r($lead);exit;
        $activity = Activities::where('lead_id',$lead->id)->get();
        // print_r($activity);exit;
         $industries = Industry::where('id',$lead->industry_id)->get(['id','name']);
        // print_r($industries);exit;
        $quotation = Quotation::where('lead_id',$lead->id)->get();
        $invoices = Invoice::where('lead_id',$lead->id)->get();
        $notes = Note::where('lead_id',$lead->id)->get();
     	return response()->json(['status'=>'true','data'=>$lead,'industries'=>$industries,'activities'=>$activity,'quotations'=>$quotation,'invoices'=>$invoices,'notes'=>$notes]);
    }

    public function edit($id, Request $request){

        //print_r($id);exit;

//print_r($request->all());exit;

    	$client = Lead::findOrFail($id);

    	$requestData = $request->all();       
        
            $client->name = $requestData['name'];
            $client->email = $requestData['email'];
            $client->company_name = $requestData['company_name'];
            $client->primary_number = $requestData['primary_number'];
            $client->secondary_number = $requestData['secondary_number'];
            $client->address = $requestData['address'];
            $client->pin = $requestData['pin'];
            $client->fax = $requestData['fax'];
            $client->country = $requestData['country'];
            $client->source_id = $requestData['source_id'];
            $client->lead_type = $requestData['lead_type'];
            $client->company_website = $requestData['company_website'];
            $client->annual_revenue = $requestData['annual_revenue'];
            $client->number_employee = $requestData['number_employee'];
            $client->industry_id = $requestData['industry_id'];
            $client->lead_stage = $requestData['lead_stage'];
            $client->comment = $requestData['comment'];
            $client->user_id = $requestData['user_id'];
            $client->interested_product = $requestData['interested_product'];
            $client->save();
       
        return response()->json(['status'=>'true','data'=>$client]);
    }

    public function miniedit($id, Request $request) {
        $requestData = $request->all();       
        $updateParams = array();
        foreach ($requestData as $key => $value) {
            $updateParams[$key] =  $value;
        }
        $lead = Lead::where('id',$id)->update($updateParams);
        $client = Lead::find($id);
        return response()->json(['status'=>'true','data'=>$client]);
    }

    public function drop($id, Request $request){
    	$lead = Lead::find($id);
        $lead->drop_status = $request['status'];
        $lead->comment = $request['comment'];
        $lead->save();

        return response()->json(['status'=>'true','data'=>$lead]);
    }


    public function leads(Request $request){

    	$company_id = $request->company_id;
    	$user_id = $request->user_id;

    	if($company_id == ""){
    		return response()->json(['status'=>'false','error'=>"company id is empty"]);
    	}else if($user_id == ""){

    		return response()->json(['status'=>'false','error'=>"user id is empty"]);
    	}

        if($user_id != ""){
             $user = User::Find($user_id);
            if($user == ""){
                return response()->json(['status'=>'false','error'=>"User not found"]);
            }
        }

         $role_permissions = DB::table('role_user')
                            ->where('user_id','=', $user_id)
                            ->get();
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }

        if($user_role == 1){
            $leads = Lead::select('*')->where('company_id',$company_id)->where('lead_stage','=','Lead')->where('drop_status','=','')->orderByDesc('created_at')->get();
        }else{
            $leads = Lead::select('*')->where('company_id',$company_id)->where('user_id',$user_id)->where('lead_stage','=','Lead')->where('drop_status','=','')->orderByDesc('created_at')->get();
        }

    	

    	return response()->json(['status'=>'true','data'=>$leads]);
    }

    public function opportunities(Request $request){

    	$company_id = $request->company_id;
    	$user_id = $request->user_id;

    	if($company_id == ""){
    		return response()->json(['status'=>'false','error'=>"company id is empty"]);
    	}else if($user_id == ""){
    		return response()->json(['status'=>'false','error'=>"user id is empty"]);
    	}

         $role_permissions = DB::table('role_user')
                            ->where('user_id','=', $user_id)
                            ->get();
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }

        if($user_role == 1){
            $leads = Lead::select('*')->where('company_id',$company_id)->where('lead_stage','=','Opportunity')->where('drop_status','=','')->orderByDesc('created_at')->get();
        }else{
          $leads = Lead::select('*')->where('company_id',$company_id)->where('user_id',$user_id)->where('lead_stage','=','Opportunity')->where('drop_status','=','')->orderByDesc('created_at')->get();
        }

    	

    	return response()->json(['status'=>'true','data'=>$leads]);
    }


    public function quotations(Request $request){
    	$company_id = $request->company_id;
    	$user_id = $request->user_id;

    	if($company_id == ""){
    		return response()->json(['status'=>'false','error'=>"company id is empty"]);
    	}else if($user_id == ""){
    		return response()->json(['status'=>'false','error'=>"user id is empty"]);
    	}

         $role_permissions = DB::table('role_user')
                            ->where('user_id','=', $user_id)
                            ->get();

       if($role_permissions == ""){
            $user_role = 2;
       }
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }

        if($user_role == 1){
            $quotations = DB::table('leads as l')
                                    ->join('quotations as q','l.id','=','q.lead_id')
                                    ->where('l.company_id','=',$company_id)
                                    ->select('q.id as quotation_id','q.quotation_number','status','l.id as lead_id','l.name as lead_name','l.lead_number as lead_number','l.email as email','l.primary_number as primary_number','q.created_at as created','l.company_name as company_name')
                                    ->groupBy('l.id')
                                    ->orderBy('quotation_id','DESC')
                                    ->get();

        }else{
            $quotations = DB::table('leads as l')
                                    ->join('quotations as q','l.id','=','q.lead_id')
                                    ->where('l.company_id','=',$company_id)
                                    ->where('l.user_id','=',$user_id)
                                    ->select('q.id as quotation_id','q.quotation_number','status','l.id as lead_id','l.name as lead_name','l.lead_number as lead_number','l.email as email','l.primary_number as primary_number','q.created_at as created','l.company_name as company_name')
                                    ->groupBy('l.id')
                                    ->orderBy('quotation_id','DESC')
                                    ->get();

        }
    	     
         return response()->json(['status'=>'true','data'=>$quotations]);
    }

    public function won(Request $request){
    	$company_id = $request->company_id;
    	$user_id = $request->user_id;

    	if($company_id == ""){
    		return response()->json(['status'=>'false','error'=>"company id is empty"]);
    	}else if($user_id == ""){
    		return response()->json(['status'=>'false','error'=>"user id is empty"]);
    	}

         $role_permissions = DB::table('role_user')
                            ->where('user_id','=', $user_id)
                            ->get();
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }

        if($user_role == 1){
            $won = DB::table('leads as l')
                                   ->join('invoices as i','l.id','=','i.lead_id')
                                   ->where('l.company_id','=',$company_id)
                                   ->select('i.id as invoice_id','i.invoice_number','i.currency','i.public_notes','i.amount','i.created_at','l.id as lead_id','l.name as lead_name','l.lead_number as lead_number','l.email','l.primary_number','l.company_name')
                                   ->get();
        }else{
            $won = DB::table('leads as l')
                                   ->join('invoices as i','l.id','=','i.lead_id')
                                   ->where('l.company_id','=',$company_id)
                                   ->where('l.user_id','=',$user_id)
                                   ->select('i.id as invoice_id','i.invoice_number','i.currency','i.public_notes','i.amount','i.created_at','l.id as lead_id','l.name as lead_name','l.lead_number as lead_number','l.email','l.primary_number','l.company_name')
                                   ->get();
        }
    	    

         return response()->json(['status'=>'true','data'=>$won]);
    }

    public function moveLead($id,Request $request){
        $lead_stage = $request->stage;
        $company_id = $request->company_id;
        $user_id = $request->user_id;

        $number = $this->quotationNumber($company_id);

        $lead = Lead::Find($id);
        if($lead_stage == "Quote"){
            $lead->lead_stage = "Quote";
            $lead->save();
            $quotation = new Quotation();
            $quotation->quotation_number = $number;
            $quotation->lead_id = $id;
            $quotation->user_id = $user_id;
            $quotation->company_id = $company_id;
            $quotation->status = 'pending';
            $quotation->save();
        }else{
            $lead->lead_stage = "Opportunity";
            $lead->save();
        }

        return response()->json(['status'=>'true','data'=>"Moved Sucessfully"]);
    }

    public function interested_product(Request $request){
            $company_id = $request->company_id;
            if($company_id == ""){
                return response()->json(['status'=>'false','error'=>"company id is empty"]);

            }else{
                $products = Product::where('company_id',$company_id)->get();

                return response()->json(['status'=>'true','data'=>$products]);
            }
            
    }

    public function listAllIndustries()
    {
        $industry =  Industry::select('id','name')->get();

        return response()->json(['status'=>'true','data'=>$industry]);
    }

    public function leadType(){
        $lead_type =array('Hot' =>'Hot','Warm'=>'Warm','Cold' =>'Cold');
        return response()->json(['status'=>'true','data'=>$lead_type]);
    }

      public function leadStatus(){
        $helper = Helper::leadStatus();
        return response()->json(['status'=>'true','data'=>$helper]);
    }

    public function users(Request $request){
        $company_id = $request->company_id;
        if($company_id == ""){
            return response()->json(['status'=>'false','error'=>"company id is empty"]);

        }else{
           $users = User::select('id','name')->where('company_id',$company_id)->get();

            return response()->json(['status'=>'true','data'=>$users]);
        }
        

    }

    public function leadSource(){
        $helper = Helper::leadSource();
        return response()->json(['status'=>'true','data'=>$helper]);
    }

    public function dropStatus(){
        $reason= array('Lost - Cost High' => 'Lost - Cost High','Lost - Dislike' => 'Lost - Dislike','Lost- Late' => 'Lost- Late','Not the right product' => 'Not the right product','Looking for offers' => 'Looking for offers','Not-Qualifield' => 'Not-Qualifield');
        return response()->json(['status'=>'true','data'=>$reason]);
    }

    public function quotationNumber($company_id){
        $quote_details = Quotation::where('company_id',$company_id)->latest()->first();


            if($quote_details == ''){
                $quotation_code = "0001";
            }else{
                $quote = $quote_details->quotation_number;
                $number = $quote;
                $number++;
                $quotation_code = str_pad($number, 4, '0', STR_PAD_LEFT);
            }

            return $quotation_code;
    }

    public function contactLeads(Request $request){
        $company_id = $request->company_id;
        $user_id = $request->user_id;

        if($company_id == ""){
            return response()->json(['status'=>'false','error'=>"company id is empty"]);
        }else if($user_id == ""){
            return response()->json(['status'=>'false','error'=>"user id is empty"]);
        }

         $role_permissions = DB::table('role_user')
                            ->where('user_id','=', $user_id)
                            ->get();
                            
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }

        

        if($user_role == 1){
            $leads = Lead::select('primary_number','secondary_number','name')->where('company_id',$company_id)->where('primary_number','!=','')->where('drop_status','=','')->get();
        }else{
            $leads = Lead::select('primary_number','secondary_number','name')->where('company_id',$company_id)->where('user_id',$user_id)->where('primary_number','!=','')->where('drop_status','=','')->get();
        }

        

        return response()->json(['status'=>'true','data'=>$leads]);
    }

    public function leadDetails(Request $request) {
        $company_id = $request->company_id;
        $user_id = $request->user_id;
        
        if($company_id == ""){
            return response()->json(['status'=>'false','error'=>"company id is empty"]);
        }else if($user_id == ""){
            return response()->json(['status'=>'false','error'=>"user id is empty"]);
        }

        $lead = Lead::where('company_id',$company_id)->where('user_id',$user_id)->where('drop_status','=','')->get(['id','name','address']);

        return response()->json(['status'=>'true','data'=>$lead]);
    }

}
