<?php
namespace App\Http\Controllers;

use Input;
use Mail;
use Session;
use Config;
use Dinero;
use Datatables;
use App\Models\Client;
use App\Models\Source;
use App\Models\FollowUp;
use App\Models\State;
use App\Models\Note;
use App\Models\User;
use App\Models\Product;
use App\Models\Company;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Client\ClientRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;

use DB;
use App\Repositories\Product\ProductRepositoryContract;
use Carbon;

class   TargetController extends Controller
{
    public function index() {
        return view('targets.index');
    }

    public function store(Request $request){

    $company_id =  \Auth::user()->company_id;
      $user_id = \Auth::user()->id;
        //$Data=Input::all();
    //$Data=$request->all()->except('csrf_field()');
    $Data=$request->except('_token');
    print_r($user_id);
      print_r($company_id);
     print_r($Data);
    //print_r($Data['January']);


    // $targets = Company::select('company_id')->where('company_id',$company_id)->whereNotin('type','currency')->get();
    // print_r($targets);
      $target1 = Company::select('company_id')->where('company_id',$company_id)->where('type','Target')->get();
      //print_r($target1);die();

  // $data=$request->all();
      $today = Carbon\Carbon::now()->toDateString();
      //print_r($today);
      if($Data['January']!=""){
     $january=$Data['January'];} else{
        $january=0;
     }
     if($Data['February']!=""){
     $february=$Data['February'];} else{
        $february=0;
     }
     if($Data['March']!=""){
     $march=$Data['March'];} else{
        $march=0;
     }
     if($Data['April']!=""){
     $april=$Data['April'];} else{
        $april=0;
     }
     if($Data['May']!=""){
     $may=$Data['May'];} else{
        $may=0;
     }
     if($Data['June']!=""){
     $june=$Data['June'];} else{
    $june=0;
    }
    if($Data['July']!=""){
    $july=$Data['July'];} else{
        $july=0;
    }
    if($Data['August']!=""){
    $august=$Data['August'];} else{
        $august=0;
    }
    if($Data['September']!=""){
     $september=$Data['September'];} else{
        $september=0;
     }
    if($Data['October']!=""){
    $october=$Data['October'];} else{
        $october=0;
    }
    if($Data['November']!=""){
    $november=$Data['November'];} else{
        $november=0;
    }   
    if($Data['December']!="") {
        $december=$Data['December'];} else{
            $december=0;
        }

//print_r($Data['December']); die();









    if(count($target1) == 0){
    Company::insert([
        ['company_id'=>$company_id, 'type' => 'Target','sub_type'=>'January', 'value'=>$january,'created_date'=> $today],
        ['company_id'=>$company_id, 'type' => 'Target','sub_type'=>'February', 'value'=>$february,'created_date'=> $today],
        ['company_id'=>$company_id, 'type' => 'Target','sub_type'=>'March', 'value'=>$march,'created_date'=> $today],
        ['company_id'=>$company_id, 'type' => 'Target','sub_type'=>'April', 'value'=>$april,'created_date'=> $today],
        ['company_id'=>$company_id, 'type' => 'Target','sub_type'=>'May', 'value'=>$january,'created_date'=> $today],
        ['company_id'=>$company_id, 'type' => 'Target','sub_type'=>'June', 'value'=>$june,'created_date'=> $today],
        ['company_id'=>$company_id, 'type' => 'Target','sub_type'=>'July', 'value'=>$july,'created_date'=> $today],
        ['company_id'=>$company_id, 'type' => 'Target','sub_type'=>'August', 'value'=>$august,'created_date'=> $today],
        ['company_id'=>$company_id, 'type' => 'Target','sub_type'=>'September', 'value'=>$september,'created_date'=> $today],
        ['company_id'=>$company_id, 'type' => 'Target','sub_type'=>'October', 'value'=>$october,'created_date'=> $today],
        ['company_id'=>$company_id, 'type' => 'Target','sub_type'=>'November', 'value'=>$november,'created_date'=> $today],
        ['company_id'=>$company_id, 'type' => 'Target','sub_type'=>'December', 'value'=>$december,'created_date'=> $today]

    ]);
}

    else{

        $requestData = $request->all();       
        $updateParams = array();
        $months = array("January", "February", "March","April","May","June","July","August","September","October","November","December");
        $var=0;



         foreach ($Data as $key => $value1) {
                if($value1==""){
                $updateParams[$key]=0;
                }
                else{
               $updateParams[$key] =  $value1;
           }
             //print_r($updateParams[$key]) ; 

$updateDetails=array(
    'value' => $updateParams[$key],
    'updated_date' => $today
);

            
        //  print_r($updateParams[]);
        $lead = Company::where('company_id',$company_id)->where('type','Target')->where('sub_type',$months[$var])->update($updateDetails);
         $var=$var+1;
        //['updated_date' => $today]     
    }

        //['updated_date' => $today]     
}

Session()->flash('flash_message','Amount successfully updated');
                    return redirect()->back();













  
      }  

 } 


