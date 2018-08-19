<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function show(Request $request){
    	$company_id = $request->company_id;
        $user_id = $request->user_id;
        if($company_id == ""){
            return response()->json(['status'=>'false','error'=>"company id is empty"]);
        }else if($user_id == ""){
            return response()->json(['status'=>'false','error'=>"user id is empty"]);
        }
    	$products = Product::where('company_id',$company_id)->get();
    	return response()->json(['status'=>'true','data'=>$products]);
    }
}
