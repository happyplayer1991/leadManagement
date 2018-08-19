<?php
namespace App\Repositories\Taxs;

use App\Models\Taxs;
use Notifynder;
use Carbon;
use DB;

class TaxsRepository implements TaxsRepositoryContract
{
    const CREATED = 'created';
    public function find($id)
    {
        return Taxs::findOrFail($id);
    }


    public function create($requestData)
    {
        if($requestData->tax_name != "" && $requestData->rate != ""){
            $taxs = Taxs::select('*')->where('name','=',$requestData->tax_name)->where('rate','=',$requestData->rate)->get();
            
           
            if(count($taxs) == 0){
                $tax = New Taxs();
                $tax->name = $requestData->tax_name;
                $tax->rate = $requestData->rate;
                $tax->description = $requestData->description;
                $tax->user_id = \Auth::id();
                $tax->company_id = \Auth::user()->company_id;
                $tax->save();
                event(new \App\Events\TaxsAction($tax, self::CREATED));
            }else{
                $tax = "";
            }
        }
       
//        print_r($tax);exit;
        
        return $tax;
    }
    
}
