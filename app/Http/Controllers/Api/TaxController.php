<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\Taxs;
use DB;

class TaxController extends Controller
{
	public function tax(Request $request) {
		$company_id = $request->company_id;
        $user_id = $request->user_id;
        if($company_id == ""){
            return response()->json(['status'=>'false','error'=>"company id is empty"]);
        }else if($user_id == ""){
            return response()->json(['status'=>'false','error'=>"user id is empty"]);
        }
		$currency = Taxs::where('company_id',$company_id)->get();
		return response()->json(['status'=>'true','data'=>$currency]);
	}
}