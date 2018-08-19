<?php
namespace App\Repositories\Quotation;

use App\Models\Quotation;
use Notifynder;
use Carbon;
use DB;

class QuotationRepository implements QuotationRepositoryContract
{

    const SUBMIT = 'submit';
    
    public function find($id)
    {
        return Quotation::findOrFail($id);
    }


    public function create($requestData)
    {
        //print_r('manisha');exit;
        $quotation = Quotation::create($requestData);
        event(new \App\Events\QuotationAction($quotation, self::SUBMIT));
        return $quotation;
    }
   
}
