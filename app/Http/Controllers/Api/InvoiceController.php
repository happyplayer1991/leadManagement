<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use DB;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\Quotation;
use App\Models\QuotationProducts;

/**
 * @SWG\Get(
 *     path="/invoices",
 *     tags={"Invoices"},
 *     summary="List all the Invoices",
 *     @SWG\Parameter(
 *          name="user_id",
 *          in="path",
 *          required=true,
 *          type="string",
 *          description="UUID",
 *      ),
 *     @SWG\Parameter(
 *          name="company_id",
 *          in="path",
 *          required=true,
 *          type="string",
 *          description="UUID",
 *      ),
 *     @SWG\Response(
 *          response=200,
 *          description="Invoices Json"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */
/**
 * @SWG\Get(
 *     path="/invoices/{id}",
 *     tags={"Invoices"},
 *     summary="Fetch Invoice",
 *     @SWG\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          type="integer",
 *          description="UUID",
 *      ),
 *     @SWG\Response(
 *          response=200,
 *          description="fetch the invoice data"
 *      ),
 *     @SWG\Response(
 *          response="default",
 *          description="error"
 *   )
 * ),
 */

class InvoiceController extends Controller
{
    public function invoices(Request $request){

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
           // $invoices = Invoice::where('company_id',$company_id)->get();
             $invoices = DB::table('invoices')
                        ->join('leads','invoices.lead_id','=','leads.id')
                        ->select('invoices.*','leads.name','leads.company_name','leads.lead_number')
                        ->where('invoices.company_id','=',$company_id)->orderByDesc('id')
                        ->get();
        }else{
            //$invoices = Invoice::where('company_id',$company_id)->where('user_id',$user_id)->get();
            $invoices = DB::table('invoices')
                        ->join('leads','invoices.lead_id','=','leads.id')
                        ->select('invoices.*','leads.name','leads.company_name','leads.lead_number')
                        ->where('invoices.company_id','=',$company_id)
                        ->where('invoices.user_id','=',$user_id)->orderByDesc('id')
                        ->get();
        }
    	
    	return response()->json(['status'=>'true','data'=>$invoices]);
    }

    public function show($id){
    	$invoices = Invoice::find($id);
        $quotations = Quotation::find($invoices->quote_id);
        $quotation_items = QuotationProducts::where('quote_id',$quotations->id)->get();

        $invoices->quotation_date = $quotations->quotation_date;
        $invoices->discount_amount = ($quotations->total_price * $quotations->discount)/100;
        $invoices->tax_amount = $quotations->tax_amount;
        $invoices->address = $quotations->address;
        // print_r($quotation_items);exit;
        $lead = Lead::where('id',$quotations->lead_id)->get();
        // print_r($invoices);exit;
        return response()->json(['status'=>'true','data'=>$invoices,'invoice_items'=>$quotation_items,'lead'=>$lead]);
    }
}
