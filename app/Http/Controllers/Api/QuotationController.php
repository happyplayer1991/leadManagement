<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\Quotation;
use App\Models\Lead;
use App\Models\User;
use App\Models\Currency;
use App\Models\QuotationProducts;
use DB;

/**
 * @SWG\Get(
 *     path="/quotations",
 *     tags={"Quotations"},
 *     summary="List all the Quotations",
 *     @SWG\Parameter(
 *          name="user_id",
 *          in="path",
 *          required=true,
 *          type="string",
 *          description="UUID",
 * 		),
 *     @SWG\Parameter(
 *          name="company_id",
 *          in="path",
 *          required=true,
 *          type="string",
 *          description="UUID",
 * 		),
 *     @SWG\Response(
 *          response=200,
 *          description="Quotations Json"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/quotation/{id}",
 *     tags={"Quotations"},
 *     summary="Fetch Quotation",
 *     @SWG\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          type="integer",
 *          description="UUID",
 * 		),
 *     @SWG\Response(
 *          response=200,
 *          description="fetch the quotation data"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Post(
 *     path="quotation/approved/{id}",
 *     tags={"Quotations"},
 *     summary="approve quotation",
 *     @SWG\Parameter(
 *          name="id",
 *          in="path",
 *          schema={"$ref": "#/definitions/Quotation"},
 *          required=true,
 *          type="integer",
 *          description="UUID",
 * 		),
 *     @SWG\Response(
 *          response=200,
 *          description="Quotation Approved Sucessfully"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */

/**
 * @SWG\Post(
 *     path="quotation/rejected/{id}",
 *     tags={"Quotations"},
 *     summary="reject quotation",
 *     @SWG\Parameter(
 *          name="id",
 *          in="path",
 *          schema={"$ref": "#/definitions/Quotation"},
 *          required=true,
 *          type="integer",
 *          description="UUID",
 * 		),
  *     @SWG\Parameter(
 *          name="reason",
 *          in="body",
 *          schema={"$ref": "#/definitions/Quotation"},
 *          required=true,
 *          type="string",
 *          description="reason for quotation reject",
 * 		),
 *     @SWG\Response(
 *          response=200,
 *          description="Quotation Rejected"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */

class QuotationController extends Controller
{

	public function Quotations(Request $request){
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
        	//$quotations = Quotation::where('company_id',$company_id)->get();
        	 $quotations = DB::table('quotations')
            ->join('leads','quotations.lead_id','=','leads.id')
            ->select('quotations.*','leads.name','leads.company_name','leads.lead_number','leads.email','leads.primary_number')
            ->where('quotations.company_id','=',$company_id)->orderByDesc('created_at')
            ->get();
        }else{
        	//$quotations = Quotation::where('company_id',$company_id)->where('user_id',$user_id)->get();
        	 $quotations = DB::table('quotations')
            ->join('leads','quotations.lead_id','=','leads.id')
            ->select('quotations.*','leads.name','leads.company_name','leads.lead_number','leads.email','leads.primary_number')
            ->where('quotations.company_id','=',$company_id)
            ->where('quotations.user_id','=',$user_id)->orderByDesc('created_at')
            ->get();
        }
		

		return response()->json(['status'=>'true','data'=>$quotations]);
	}

	public function show($id){
		//$quotation = New Quotation();
		$quotation = Quotation::Find($id);

		$quotation_items = QuotationProducts::where('quote_id',$id)->get();
		// print_r($quotation);exit;
		$quotation->discountvalue = ($quotation->total_price * $quotation->discount)/100;

		$lead = Lead::where('id',$quotation->lead_id)->get();
		//print_r($lead);exit;
		return response()->json(['status'=>'true','data'=>$quotation,'quotation_items'=>$quotation_items,'lead'=>$lead]);
	}

	public function approved($id){
		$quotation = Quotation::Find($id);
		$quotation->status = 'approved';
		$quotation->save();
		return response()->json(['status'=>'true','data'=>'Quotation approved successfully']);
	}

	public function rejected($id,Request $request){
		$quotation = Quotation::Find($id);
		$quotation->status = 'rejected';
		$quotation->reason = $request->reason;
		$quotation->save();
		return response()->json(['status'=>'true','data'=>'Quotation rejected']);
	}

	public function currency() {
		$currency = Currency::all();
		return response()->json(['status'=>'true','data'=>$currency]);
	}

	public function newQuotation(Request $request) {
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

		// $requestData = $request->all();
		// var_dump($request->address);die();
		// var_dump($request->address);die()
		$quotation = new Quotation();
		$quotation->quotation_number = $request->quotation_number;
		$quotation->lead_id = $request->lead_id;
		$quotation->user_id = $request->user_id;
		$quotation->company_id = $request->company_id;
		$quotation->discount = $request->discount;
		$quotation->quotation_date = $request->quotation_date;
		$quotation->tax_amount = $request->tax_amount;
		$quotation->currency = $request->currency;
		$quotation->address = $request->address;
		$quotation->amount = $request->amount;  //gross price including tax 
		$quotation->total_price = $request->total_price; //line total
		$quotation->due_amount = $request->amount;
		$quotation->save();

		$lead_data = Lead::findOrFail($request->lead_id);
        $lead_data->lead_stage = "Quote";
        $lead_data->address = $request->address;    	
        $lead_data->save();

		return response()->json(['status'=>'true','data'=>'Quotation added successfully']);
	}

	public function quoteNumber(Request $request){
		
		$company_id = $request->company_id;
    	if($company_id == ""){
    		return response()->json(['status'=>'false','error'=>"company id is empty"]);
    	}

		$quote_details = Quotation::where('company_id',$company_id)->latest()->first();

		if($quote_details == ''){
			$quote_number = "0001";
		}else{
			$quote = $quote_details->quotation_number;
        	$number = $quote;
        	$number++;
        	$quote_number = str_pad($number, 4, '0', STR_PAD_LEFT);
		}

		return response()->json(['status'=>'true','data'=>$quote_number]);
	}
    
}
