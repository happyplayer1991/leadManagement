<?php
namespace App\Repositories\Lead;

use App\Models\Lead;
use App\Models\Currency;
use App\Models\RoleUser;
use App\Models\Task;
use App\Models\Industry;
use App\Models\Product;
use App\Models\User;
use App\Helper\Helper;
use Notifynder;
use Carbon;
use DB;
use Datetime;
/**
 * Class LeadRepository
 * @package App\Repositories\Lead
 */
class LeadRepository implements LeadRepositoryContract
{

    const CREATED = 'created';
    const UPDATED = 'updated';
    const DROPPED = 'dropped';
    
    const UPDATED_STATUS = 'updated_status';
    const UPDATED_DEADLINE = 'updated_deadline';
    

    public function find($id)
    {
        return Lead::findOrFail($id);
    }

    public function listAllIndustries()
    {
        return Industry::pluck('name', 'id');
    }

    public function listAllProducts(){
        $company_id = \Auth::user()->company_id;
        return Product::where('company_id',$company_id)->pluck('product_name','id');
    }

    public function leadStatus(){
        $helper = Helper::leadStatus();
        return $helper;
    }

    public function leadSource(){
        $helper = Helper::leadSource();
        return $helper;
    }

    public function leadType(){
        $lead_type =array('Hot' =>'Hot','Warm'=>'Warm','Cold' =>'Cold');
        return $lead_type;
    }

    public function dropStatus(){
        $reason= array('Lost - Cost High' => 'Lost - Cost High','Lost - Dislike' => 'Lost - Dislike','Lost- Late' => 'Lost- Late','Not the right product' => 'Not the right product','Looking for offers' => 'Looking for offers','Not-Qualifield' => 'Not-Qualifield');
        return $reason;
    }

    public function users(){
        $company_id = \Auth::user()->company_id;
        $users = User::where('company_id',$company_id)->pluck('name','id');

        return $users;

    }

    /**
     * @param $requestData
     * @return mixed
     */
    public function create($requestData)
    {
        $email = $requestData['email'];
        $mobile = $requestData['primary_number'];
        $name = $requestData['name'];
        $company_id = array_key_exists('company_id', $requestData) ? $requestData['company_id'] : \Auth::user()->company_id;

        $data['error'] = '';
        if($name == ''){
            $data['error'] = "Invalid Lead Name.";
            return $data;
        }

        if($mobile != ''){
            $phone = Lead::where('primary_number',$mobile)->where('company_id',$company_id)->get();
           
            if(count($phone)>0){
                $data['error'] = "Lead already exists with this phone Number.";
                return $data;
            }
        }

        if($email != ''){
            $mail = Lead::where('email',$email)->where('company_id',$company_id)->get();
          
            if(count($mail)>0){
                $data['error'] = "Lead already exists with this e-mail address.";
                return $data;
            }
        }
        if (\Auth::check()) {
            $user_id = \Auth::id();
        } else
            $user_id = 1;

        $lead = new Lead();
        $lead->email = $email;
        $lead->primary_number = $mobile;
        $lead->name = $name;
        $lead->company_id = $company_id;
        $lead->lead_type = $requestData['lead_type'];
        $lead->user_id = $user_id;
        $lead->industry_id = $user_id;
        $lead->lead_number = Helper::leadNumberWithCompany($company_id);
        $lead->save();
        event(new \App\Events\LeadAction($lead, self::CREATED));

        $data['message'] = "Lead Added successfully";
        return $data;
    }

    /**
     * @param $id
     * @param $requestData
     */
    public function updateStatus($id, $requestData)
    {
        $lead = Lead::findOrFail($id);

        $input = $requestData->get('status');
        $input = array_replace($requestData->all(), ['status' => 2]);
        $lead->fill($input)->save();
    }

    /**
     * @param $id
     * @param $requestData
     */
    public function updateFollowup($id, $requestData)
    {
        $lead = Lead::findOrFail($id);
        $input = $requestData->all();
        $input = $requestData =
            ['contact_date' => $requestData->contact_date . " " . $requestData->contact_time . ":00"];
        $lead->fill($input)->save();
        event(new \App\Events\LeadAction($lead, self::UPDATED_DEADLINE));
    }

    /**
     * @param $id
     * @param $requestData
     */
    public function updateAssign($id, $requestData)
    {
        $lead = Lead::with('user')->findOrFail($id);
        $lead->user_id = $requestData->get('user_assigned_id');
        $lead->save();
        event(new \App\Events\ClientAction($client, self::UPDATED_ASSIGN));

    }

    /**
     * @return int
     */
    public function leads()
    {
        return Lead::all()->count();
    }

    /**
     * @return mixed
     */
    public function allCompletedLeads()
    {
        return Lead::where('status', 2)->count();
    }

    /**
     * @return float|int
     */
    public function percantageCompleted()
    {
        if (!$this->leads() || !$this->allCompletedLeads()) {
            $totalPercentageLeads = 0;
        } else {
            $totalPercentageLeads = $this->allCompletedLeads() / $this->leads() * 100;
        }

        return $totalPercentageLeads;
    }

    /**
     * @return mixed
     */
    public function completedLeadsToday()
    {
        return Lead::whereRaw(
            'date(updated_at) = ?',
            [Carbon::now()->format('Y-m-d')]
        )->where('status', 2)->count();
    }

    /**
     * @return mixed
     */
    public function createdLeadsToday()
    {
        return Lead::whereRaw(
            'date(created_at) = ?',
            [Carbon::now()->format('Y-m-d')]
        )->count();
    }

    /**
     * @return mixed
     */
    public function completedLeadsThisMonth()
    {
        return DB::table('leads')
            ->select(DB::raw('count(*) as total, updated_at'))
            ->where('status', 2)
            ->whereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()])->get();
    }

    /**
     * @return mixed
     */
    public function createdLeadsMonthly()
    {
        return DB::table('leads')
            ->select(DB::raw('count(*) as month, updated_at'))
            ->where('status', 2)
            ->groupBy(DB::raw('YEAR(updated_at), MONTH(updated_at)'))
            ->get();
    }

    /**
     * @return mixed
     */
    public function completedLeadsMonthly()
    {
        return DB::table('leads')
            ->select(DB::raw('count(*) as month, created_at'))
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function totalOpenAndClosedLeads($id)
    {
        $open_leads = Lead::where('status', 1)
        ->where('user_assigned_id', $id)
        ->count();

        $closed_leads = Lead::where('status', 2)
        ->where('user_assigned_id', $id)->count();

        return collect([$closed_leads, $open_leads]);
    }


    /**
     *  @return leads based on company id
     *
     */

   

    public function leadsBaseOnCompany(){
        // $currency = Currency::all();
        $user_id = \Auth::id();

         $role_permissions = DB::table('role_user')
                            ->where('user_id','=', $user_id)
                            ->get();
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }  

        
      
        $company_id = \Auth::user()->company_id;

         if($user_role == 1){
            $getAllLeads = DB::table('leads as l')  
                            ->leftjoin('notes as n1', 'l.id', '=', 'n1.lead_id')                         
                            ->leftjoin('notes as n2',function($join){
                                $join->on('n1.lead_id', '=', 'n2.lead_id');
                                $join->on('n1.created_at', '<', 'n2.created_at');
                            })
                            ->whereNull('n2.created_at')
                            ->where('l.company_id','=',$company_id)
                            ->select('l.*','n1.note')
                            ->get();

            $getQuotationLeads = DB::table('leads as l')
                                    ->join('quotations as q','l.id','=','q.lead_id')
                                    ->where('l.company_id','=',$company_id)
                                    ->select('q.id as quotation_id','q.quotation_number','q.currency','amount','status','l.*')
                                    ->groupBy('l.id')
                                    ->get();

            $getInvoiceLeads = DB::table('leads as l')
                                   ->join('invoices as i','l.id','=','i.lead_id')
                                   ->where('l.company_id','=',$company_id)
                                   ->select('i.id as invoice_id','i.invoice_number','i.currency','i.public_notes','amount','l.*')
                                   ->get();

         }else{
            $getAllLeads = DB::table('leads as l')  
                            ->leftjoin('notes as n1', 'l.id', '=', 'n1.lead_id')                         
                            ->leftjoin('notes as n2',function($join){
                                $join->on('n1.lead_id', '=', 'n2.lead_id');
                                $join->on('n1.created_at', '<', 'n2.created_at');
                            })
                            ->whereNull('n2.created_at')
                            ->where('l.company_id','=',$company_id)
                            ->where('l.user_id','=',$user_id)
                            ->select('l.*','n1.note')
                            ->get();

            $getQuotationLeads = DB::table('leads as l')
                                    ->join('quotations as q','l.id','=','q.lead_id')
                                    ->where('l.company_id','=',$company_id)
                                    ->where('l.user_id','=',$user_id)
                                    ->select('q.id as quotation_id','q.quotation_number','q.currency','amount','status','l.*')
                                    ->groupBy('l.id')
                                    ->get();

            $getInvoiceLeads = DB::table('leads as l')
                                   ->join('invoices as i','l.id','=','i.lead_id')
                                   ->where('l.company_id','=',$company_id)
                                   ->where('l.user_id','=',$user_id)
                                   ->select('i.id as invoice_id','i.invoice_number','i.currency','i.public_notes','amount','l.*')
                                   ->get();
        
         }
        // print_r($getQuotationLeads);exit;
        // print_r($symbol);exit;
         $leads = array('getAllLeads'=>$getAllLeads,'getQuotationLeads'=>$getQuotationLeads,'getInvoiceLeads'=>$getInvoiceLeads);

        return $leads;
    }


    public function dropLead($request){
        $client_data = Lead::find($request['id']);
        $client_data->drop_status = $request['status'];
        $client_data->comment = $request['comment'];
        $client_data->save();
        event(new \App\Events\LeadAction($client_data, self::DROPPED));
        return $client_data;
    }
    
    public function update($id, $requestData)
    {
       $client = Lead::findOrFail($id);
       
        if($requestData->lead_status == "Drop"){
            if($requestData->comment == ""){
                return "comment";
            }
            $client->name = $requestData->name;
            $client->email = $requestData->email;
            $client->company_name = $requestData->company_name;
            $client->primary_number = $requestData->primary_number;
            $client->secondary_number = $requestData->secondary_number;
            $client->address = $requestData->address;
            $client->pin = $requestData->pin;
            $client->fax = $requestData->fax;
            $client->country = $requestData->country;
            $client->source_id = $requestData->source_id;
            $client->lead_type = $requestData->lead_type;
            $client->company_website = $requestData->company_website;
            $client->annual_revenue = $requestData->annual_revenue;
            $client->number_employee = $requestData->number_employee;
            $client->industry_id = $requestData->industry_type;
            $client->drop_status = $requestData->drop_status;
            $client->comment = $requestData->comment;
            $client->user_id = $requestData->user_id;
            $client->interested_product = $requestData->interested_product;
            $client->save();
        }else{
            $client->name = $requestData->name;
            $client->email = $requestData->email;
            $client->company_name = $requestData->company_name;
            $client->primary_number = $requestData->primary_number;
            $client->secondary_number = $requestData->secondary_number;
            $client->address = $requestData->address;
            $client->pin = $requestData->pin;
            $client->fax = $requestData->fax;
            $client->country = $requestData->country;
            $client->source_id = $requestData->source_id;
            $client->lead_type = $requestData->lead_type;
            $client->company_website = $requestData->company_website;
            $client->annual_revenue = $requestData->annual_revenue;
            $client->number_employee = $requestData->number_employee;
            $client->industry_id = $requestData->industry_type;
            $client->lead_stage = $requestData->lead_stage;
            $client->comment = $requestData->comment;
            $client->user_id = $requestData->user_id;
            $client->interested_product = $requestData->interested_product;
            $client->save();
        }
        event(new \App\Events\LeadAction($client, self::UPDATED));
         $data['error'] = '';
        $getAllLeads = $this->leadsBaseOnCompany();
        
        $data['html'] = view('pages.cardview')->with('getAllLeads',$getAllLeads)->render();
        $data['message'] = "Lead Updated successfully";
        return $data;
    }


    public function returnLead($id,$request){
        $client_data = Lead::find($id);
        $client_data->drop_status = '';
        $client_data->lead_stage = 'Opportunity';
        $client_data->returned_user = 1;
        $client_data->user_id = \Auth::id();
        $client_data->save();
        return $client_data;
    }
}
