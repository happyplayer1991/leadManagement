<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Carbon;
use Gr8Shivam\SmsApi\SmsApi;
use Illuminate\Mail\Message;
use Session;
use Datatables;
use App\Helper\Helper;
use App\Models\Lead;
use App\Models\User;
use App\Models\Industry;
use App\Models\LeadDetails;
use App\Models\Source;
use App\Models\Quotation;
use App\Models\Activities;
use App\Models\Invoice;
use App\Models\Note;
use App\Models\SampleCode;
use App\Models\Setting;
use App\Models\FollowUp;
use App\Models\ColorCode;
use App\Models\Client;
use App\Models\Currency;
use App\Models\Taxs;
use App\Models\Product;
use App\Http\Requests;
use App\Models\Subscriptions;
use Illuminate\Http\Request;
use App\Http\Requests\Lead\StoreLeadRequest;
use App\Repositories\Lead\LeadRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use App\Http\Requests\Lead\UpdateLeadFollowUpRequest;
use App\Repositories\Client\ClientRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use Mail;

class LeadsController extends Controller
{
    protected $leads;
    protected $clients;
    protected $settings;
    protected $users;

    public function __construct(
        LeadRepositoryContract $leads,
        UserRepositoryContract $users,
        ClientRepositoryContract $clients,
        SettingRepositoryContract $settings
    )
    {
        $this->users = $users;
        $this->settings = $settings;
        $this->clients = $clients;
        $this->leads = $leads;
        $this->middleware('lead.create', ['only' => ['create']]);
        $this->middleware('lead.assigned', ['only' => ['updateAssign']]);
        $this->middleware('lead.update.status', ['only' => ['updateStatus']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = \Auth::id();
        $company_id = \Auth::user()->company_id;
        $allleads = Lead::select('id','name')->where('company_id',$company_id)->where('drop_status','=','')->paginate(10);
        $leads = Lead::select('id','name')->where('drop_status','=','')->where('company_id',$company_id)->where('user_id',$user_id)->paginate(10);
        $wonLeads = Lead::select('id','name')->where('lead_stage','=','Won')->where('company_id',$company_id)->where('user_id',$user_id)->paginate(10);
        $users = User::select('*')->where('company_id',$company_id)->get();

        return view('leads.index')->with('leads',$leads)->with('allleads',$allleads)->with('wonLeads',$wonLeads)->with('users',$users);
    }

    /**
     * Data for Data tables
     * @return mixed
     */
    public function anyData()
    {
        $leads = Lead::select(
            ['id', 'address']//, 'user_created_id', 'client_id', 'user_assigned_id', 'contact_date']
        )->get();


        return Datatables::of($leads)
            ->addColumn('titlelink', function ($leads) {
                return '<a href="leads/' . $leads->id . '" ">' . $leads->address . '</a>';
            })->add_column('edit', '
                <a href="{{ route(\'leads.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leads.create')
            ->withUser($this->users->find(\Auth::id()))
            ->withLeadtype($this->leads->leadType())
            ->with('company_id',\Auth::user()->company_id)
            ->withLeadnumber(Helper::leadNumber())
            ->with('type','create')
            ->withIndustries($this->leads->listAllIndustries());
    }

    public function newLeadForUnknownUser($company) {
        $user = User::where('company_name', $company)->first();
        if (!isset($user))
            return redirect('/');

        $data['company_id'] = $user->company_id;
        $settings = Setting::where('company_id', $user->company_id)->first();
        if (!isset($settings)) {
            $data['logo_color'] = '';
            $data['logo_img'] = '';
        } else {
            $data['logo_color'] = $settings->logo_color;
            $data['logo_img'] = $settings->logo_img;
        }

        return view('leads.unauthorized', $data);
    }

    public function edit($id)
    {
        return view('leads.edit')
            ->withLeads($this->leads->find($id))
            ->withLeadstatus($this->leads->leadStatus())
            ->withLeadsource($this->leads->leadSource())
            ->withLeadtype($this->leads->leadType())
            ->withDropstatus($this->leads->dropStatus())
            ->withLeadnumber(Helper::leadNumber())
            ->with('type','edit')
            ->withUsers($this->leads->users())
            ->withProducts($this->leads->listAllProducts())
            ->withIndustries($this->leads->listAllIndustries());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLeadRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLeadRequest $request)
    {
        $msg = $this->leads->create($request->all());
        if ($msg['error'] != '')
            return array('result'=>'error', 'msg'=>$msg['error']);

        $notes = new Note();
        $notes->note = \Auth::check() ? \Auth::user()->name : 'Unauthorized User'." Created the Lead.";
        $notes->status = "created";
        $notes->user_id = \Auth::check() ? \Auth::id() : 0;
        $notes->lead_id = $request->id;
        $notes->company_id = $request->has('company_id') ? $request->get('company_id') : \Auth::user()->company_id;
        $notes->save();

        $settings = Setting::where('company_id', $notes->company_id)->first();
        if (isset($settings)) {
            if ($settings->notification_allowed == 1 || $settings->notification_allowed == 2) {
                $mail = User::where('company_id', $notes->company_id)->pluck('email')->toArray();
                $lead = Lead::where('name', $request->get('name'))->firstOrFail();
                $data = array('type' => 'create', 'creator' => \Auth::check() ? \Auth::user()->name : 'Unauthorized User',
                    'lead' => $lead);

                Mail::send('mail.lead', $data, function($message) use ($data,$mail)
                {
                    $message->from('sowji.reddy09@gmail.com', "Sowjitha");
                    $message->subject("New Lead is created.");
                    $message->to($mail);
                });
            }
        }

        return array('result'=>'success', 'msg'=>$msg['message']);
    }

    public function updateAssign($id, Request $request)
    {
        $this->leads->updateAssign($id, $request);
        return redirect()->back();
    }

    /**
     * Update the follow up date (Deadline)
     * @param UpdateLeadFollowUpRequest $request
     * @param $id
     * @return mixed
     */
    public function updateFollowup(UpdateLeadFollowUpRequest $request, $id)
    {
        $this->leads->updateFollowup($id, $request);
        Session()->flash('flash_message', 'New follow up date is set');
        return redirect()->back();
    }


    public function update($id, Request $request){
        $leadData = $this->leads->update($id, $request);
        Session()->flash('flash_message', 'Lead successfully updated');

        $notes = new Note();
        $notes->note = \Auth::user()->name." Updated the Lead";
        $notes->status = "update";
        $notes->user_id = \Auth::id();
        $notes->lead_id = $id;
        $notes->company_id = \Auth::user()->company_id;
        $notes->save();

        return $leadData;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $company_id = \Auth::user()->company_id;
        $assign = Lead::select('*')->find($id);
        $activities = Activities::where('lead_id',$id)->groupBy('date')->get();
        $act = Activities::where('lead_id',$id)->get();
        $quotations = Quotation::all();
        $invoices = Invoice::all();
//        $note = Note::all()->groupBy(function($date){
//            return \Carbon::parse($date->created_at)->format('d-M-y');
//            });
//        $note = DB::table('notes as n')
//            ->select(DB::Raw('DATE(n.created_at) as day'))
//            ->groupBy('day')
//            ->orderBy('n.created_at')
//            ->get();
        $note = Note::where('lead_id',$id)->where('company_id',$company_id)->groupBy('created_at')->get();
        //$note = DB::select(DB::raw("select EXTRACT(day from 'created_at') as date from notes where lead_id =$id"));
        $notes = Note::all()->sortByDesc("id");

        $products = Product::where('company_id',$company_id)->pluck('product_name','id');
        $industry = DB::select(DB::raw("select i.name from industries i left join leads l on l.industry_id=i.id where l.id=$id"));
        $product = DB::select(DB::raw("select p.product_name from products p left join leads l on l.interested_product=p.id where l.id=$id"));
        if(count($notes) > 0){
            $note = $notes;
        }else{
            $note = '';
        }

        $currency = Currency::all();
//print_r($note);exit;

        return view('leads.show')
            ->withLead($this->leads->find($id))
            ->with('quotations',$quotations)
            ->with('industry',$industry)
            ->with('product',$product)
            ->with('activities', $activities)
            ->with('invoices',$invoices)
            ->with('notes', $notes)
            ->with('act',$act)
            ->with('note',$note)
            ->withUsers($this->users->find($assign->user_id))
            ->with('currency',$currency)
            ->withCompanyname($this->settings->getCompanyName());
    }


    public function oppurtunity(Request $request){
        $lead = Lead::find($request->id);
        $lead->lead_stage = $request->status;
        $lead->save();

        $getAllLeads = $this->leads->leadsBaseOnCompany();

        return view('pages.cardview')->with('getAllLeads',$getAllLeads);

        // $id = $request->id;
        // $status = $request->status;
        // //print_r($id);exit;

        // return view('layouts.oppurtunity')->with('id',$id)->with('status',$status);

    }


    public function quote(Request $request){
         $company_id = \Auth::user()->company_id;
        $leads = Lead::find($request->id);

        $quotation_number =Helper::quotation_code("quote");

        $products = Product::get(['id','product_name','price','description']);
        $currency = Currency::all();
        $taxs = Taxs::where('company_id',$company_id)->get();


        return view('quotations.quotation_popover')->with('leads',$leads)->with('quotation_number',$quotation_number)->with('products',$products)->with('currency',$currency)->with('taxs',$taxs);
    }

    public function convertToOppurtunity(Request $request){
        //print_r($request->status);
        $client_data = Lead::find($request->id);
        $client_data->lead_stage = $request->status;
        // $client_data->comment = $request['comment'];
        $client_data->save();

        return $request->id;
    }


    public function drop($id,Request $request){

        return view('leads.drop')
            ->withLead($this->leads->find($id))
            ->withDropstatus($this->leads->dropStatus())
            ->with('id',$id);
    }

    public function dropLead(Request $request){

        $lead_drop = $this->leads->dropLead($request->all());
        return $lead_drop;


    }

    public function returnLead($id,Request $request){
        $return_lead = Lead::findOrFail($id);
        $return_lead = $this->leads->returnLead($id,$request);
        $notes = new Note();
        $notes->note = \Auth::user()->name." Convert ".$return_lead->name." to Oppurtunity";
        $notes->status = "convert";
        $notes->user_id = \Auth::id();
        $notes->lead_id = $id;
        $notes->company_id = \Auth::user()->company_id;
        $notes->save();
        return $return_lead;
    }


     public function userAssign($id, Request $request){
        //print_r($id);exit;

        $lead_data = Lead::find($id);
        $lead_data->user_id = $request['user_id'];
        $lead_data->session_id = '';
        $lead_data->save();

        $notes = new Note();
        $notes->note = "Admin Assign the Lead";
        $notes->status = "assignUser";
        $notes->user_id = $lead_data->user_id;
        $notes->lead_id = $id;
        $notes->company_id = $lead_data->company_id;
        $notes->save();

        return $id;
    }


    /**
     * Complete lead
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function updateStatus($id, Request $request)
    {
        $this->leads->updateStatus($id, $request);
        Session()->flash('flash_message', 'Lead is completed');
        return redirect()->back();
    }

    public function test(){
        return Lead::all();
        return "hello";
    }


    public function productInterest(){

        $company_id = \Auth::user()->company_id;

        $view = Product::where('company_id',$company_id)->get();
        $product = Product::all();
        $ld = DB::select(DB::raw("SELECT p.product_name,count(l.id) as ltotal,p.id FROM leads as l LEFT JOIN products as p on l.interested_product = p.id GROUP BY p.id"));
       //print_r($view);exit;

        $qt = DB::select(DB::raw("SELECT p.product_name,count(q.id) as qtotal,p.id FROM leads as l LEFT JOIN quotations as q on l.id = q.lead_id LEFT JOIN products as p on l.interested_product = p.id GROUP BY l.interested_product"));

        $in = DB::select(DB::raw("SELECT p.product_name,count(i.id) as itotal,p.id FROM leads as l LEFT JOIN invoices as i on l.id = i.lead_id LEFT JOIN products as p on l.interested_product = p.id GROUP BY l.interested_product"));

        $leads = DB::select(DB::raw("select a.*,l.name from (
SELECT  DISTINCT q1.lead_id,q1.product_id,q1.quote_id,q1.quotation_number FROM quotation_items q1 left JOIN quotation_items q2 on  q1.lead_id=q2.lead_id AND q1.product_id=q2.product_id  and q1.quote_id<q2.quote_id where  q2.quote_id is null
) a inner join leads l on l.id=a.lead_id"));

        // dd($leads);
        //for loop for $ld lead details
        //prepare model object with products and zero count if no data is been available
        foreach($product as $productview){
             $prod_name = $productview->product_name;
            $skip = false;
            //lead 
           foreach ($ld as $key ) {
                if( $key->product_name == $prod_name){
                    $skip = true; //no need to add. product is already available
                }
             }
             if($skip == false){
                $newRecord  = (object) array("product_name"=>$prod_name, "ltotal"=>0,"id"=>$productview->id);
                 $ld[sizeof($ld)] =  $newRecord;
                  //print_r($ld);exit;
             }

             //quote
             $skip = false;
           foreach ($qt as $key ) {
                if( $key->product_name == $prod_name){
                    $skip = true; //no need to add. product is already available
                }
             }
             if($skip == false){
                $newRecord  = (object) array("product_name"=>$prod_name, "qtotal"=>0,"id"=>$productview->id);
                 $qt[sizeof($qt)] =  $newRecord;
                  //print_r($ld);exit;
             }

             //invoice

             $skip = false;
           foreach ($in as $key ) {
                if( $key->product_name == $prod_name){
                    $skip = true; //no need to add. product is already available
                }
             }
             if($skip == false){
                $newRecord  = (object) array("product_name"=>$prod_name, "itotal"=>0,"id"=>$productview->id);
                 $in[sizeof($in)] =  $newRecord;
                  //print_r($ld);exit;
             }
        }


            //for loop for product list

           // if ld product is not available in product list , add it.


        // $leads = DB::table('leads')
        //         ->join('quotation_items as qt','leads.id','=','qt.lead_id')
        //         ->select('*')
        //         ->get();

        return view('layouts.interestview')->with('view',$view)->with('leads',$leads)->with('ld',$ld)->with('qt',$qt)->with('in',$in);
    }

    public function leadCount($id) {

        $leadDetails = DB::select(DB::raw("SELECT l.id,l.lead_number,l.name,l.created_at,l.company_name,p.product_name FROM leads as l LEFT JOIN products as p on l.interested_product = p.id where p.id=$id"));
        return view('layouts.intrestedlead')->with('leadDetails',$leadDetails);
    }

    public function quoteCount($id) {

        $quotations = Quotation::all();
        $currency = Currency::all();
        $leads = Lead::all();
        $quotationDetails = DB::select(DB::raw("SELECT l.id as lid,l.lead_number,l.name,l.company_name,q.quotation_number,q.created_at,q.amount,q.status,q.id as qid FROM leads as l LEFT JOIN quotations as q on l.id = q.lead_id LEFT JOIN products as p on l.interested_product = p.id where p.id=$id"));
        return view('layouts.intrestedquote')->with('quotationDetails',$quotationDetails)->with('quotations',$quotations)->with('currency',$currency)->with('leads',$leads);
    }

    public function invoiceCount($id) {

        $invoices = Invoice::all();
        $currency = Currency::all();
        $leads = Lead::all();
        $invoiceDetails = DB::select(DB::raw("SELECT l.id as lid,l.lead_number,l.name,l.company_name,i.quotation_number,i.created_at,i.public_notes,i.invoice_number,i.amount,i.id as iid FROM leads as l LEFT JOIN invoices as i on l.id = i.lead_id LEFT JOIN products as p on l.interested_product = p.id where p.id=$id"));
        return view('layouts.intrestedinvoice')->with('invoiceDetails',$invoiceDetails)->with('invoices',$invoices)->with('currency',$currency)->with('leads',$leads);
    }
    public function viewSms($id,Request $request) {
       // print_r('prathi');exit;
        $lead = Lead::find($request->id);
        // print_r($lead);exit;
        return view('layouts.sms')->with('lead',$lead);
    }

    public function sms(Request $request) {
        // print_r($id);exit;
        // print_r($request->sms);
//        $ld = Lead::findOrFail($id);
//        $lead = Lead::findOrFail($ld->lead_id);
        // print_r($lead);exit;
        //$lead=Lead::all();
        //$data = array('name' => $lead->name,'primary_number' => $lead->primary_number, 'email' => $lead->email );

        smsapi()->sendMessage($request->sendSms,$request->smsText);


//        $sms = explode(',', $request->smsLead);
//        Msg::send('sendsms', $data, function($message) use ($data,$sms)
//        {
//            $message->from('9493878715', "Sms");
//            $message->subject("Welcome to Opal CRM");
//            $message->to($sms);
//        });

        return redirect()->back();


    }
    public function sendEmail($id,Request $request) {
        // print_r('prathi');exit;
        $lead = Lead::find($request->id);
        // print_r($lead);exit;
        return view('layouts.email')->with('lead',$lead);
    }

    public function email(Request $request) {


        return redirect()->back();


    }
     public function ajax_data(){

       // print_r("sowjitha");exit;

        $session_id = $_GET['session_id'];
        $company_id = $_GET['company_id'];
        $user_id = $_GET['user_id'];
        // $lead_number = $_GET['lead_number'];
        $users = User::where('random_unique_number',$user_id)->pluck('id');



        //print_r($users[0]);exit;




        $leads = Lead::select('*')->where('session_id','=',$session_id)->get();

        if(count($leads)>0){
            foreach($leads as $lead){
                $lead_id = $lead->id;
            }

            $lead_data = Lead::find($lead_id);

            if(!empty($_GET['name'])){

                $lead_name = Lead::select('*')->where('name','=',$_GET['name'])->where('company_id',$company_id)->get();

                if(count($lead_name)>0){

                }else{

                    //$client_id_email = Client::select('email')->find($client_id);

                    if($lead_data->name == ''){ // change existing lead to Lead stage if he is interesed
                        $lead_data->name = $_GET['name'];
                        $lead_data->company_id = $_GET['company_id'];
                        $lead_data->lead_stage = 'Lead';
                       // $lead_data->source_type = 'Web';
                       // $lead_data->user_id = $users[0];
                        $lead_data->save();
                    }else{ //Add new lead.

                        if($lead_data->session_id == $session_id && $lead_data->name != $_GET['name']){
                            $session_id = uniqid();
                            $leads = new Lead();
                            $leads->session_id = $session_id;
                            $leads->name = $_GET['name'];
                            $leads->company_id = $_GET['company_id'];
                            $leads->lead_stage = 'Lead';
                            $leads->user_id = $users[0];

                                $leads->lead_number = Helper::leadNumberWithCompany($_GET['company_id']);

                            $leads->save();
                        }

                    }
                }
            }

            if(!empty($_GET['email'])){

                $lead_email = Lead::select('*')->where('email','=',$_GET['email'])->where('company_id',$company_id)->get();

                if(count($lead_email)>0){

                }else{

                    //$client_id_email = Client::select('email')->find($client_id);

                    if($lead_data->email == ''){
                        $lead_data->email = $_GET['email'];
                        $lead_data->company_id = $_GET['company_id'];
                        $lead_data->lead_stage = 'Lead';

                       // $lead_data->source_type = 'Web';
                       // $lead_data->user_id = $users[0];
                        $lead_data->save();
                    }else{

                        if($lead_data->session_id == $session_id && $lead_data->email != $_GET['email']){
                            $session_id = uniqid();
                            $leads = new Lead();
                            $leads->session_id = $session_id;
                            $leads->email = $_GET['email'];
                            $leads->company_id = $_GET['company_id'];
                            $leads->lead_stage = 'Lead';
                            //$leads->source_type = 'Web';
                            $leads->user_id = $users[0];

                                $leads->lead_number = Helper::leadNumberWithCompany($_GET['company_id']);

                            $leads->save();
                        }

                    }
//                  if(!empty($_GET['email'])){
//                      $client_data->email = $_GET['email'];
//                      $client_data->save();
//                  }
                }
            }


            if(!empty($_GET['message'])){
                $lead_message = Lead::select('*')->where('messages', '=',$_GET['message'])->where('company_id',$company_id)->get();

                if(count($lead_message)>0){

                }else{

                    if($lead_data->messages == ''){
                        $lead_data->messages = $_GET['message'];
                        $lead_data->company_id = $_GET['company_id'];
                        $lead_data->lead_stage = 'Lead';
                        //$lead_data->source_type = 'Web';
                        //$lead_data->user_id = $users[0];
                        $lead_data->save();
                    }else{

                        if($lead_data->session_id == $session_id && $lead_data->messages != $_GET['message']){
                            $session_id = uniqid();
                            $leads = new Lead();
                            $leads->session_id = $session_id;
                            $leads->messages = $_GET['message'];
                            $leads->company_id = $_GET['company_id'];
                            $leads->lead_stage = 'Lead';
                           // $leads->source_type = 'Web';
                            $leads->user_id = $users[0];

                                $leads->lead_number = Helper::leadNumberWithCompany($_GET['company_id']);

                            $leads->save();
                        }

                    }

                }

            }




        }else{

            $leads = new Lead();
            $leads->session_id = $session_id;
            $leads->user_id = $users[0];
            $leads->save();
        }

    }


    public function subscription(Request $request){
            //print_r($request->all());exit;
            $plan = $request['os0'];
          if($plan == "5 Users - 20%"){
            $amount = 480;
          }else if($plan == "3 Users - 12%"){
            $amount = 300;
          }else if($plan == "3 Users Monthly"){
            $amount = 30;
          }
         $company_id = $request['company_id'];
         $user_id = $request['user_id'];
        $subscription = new Subscriptions();
        $subscription->user_id =$user_id;
        $subscription->company_id = $company_id;
        $subscription->stripe_plan = $plan;
        $subscription->amount = $amount;
        $subscription->status = "pending";
        $subscription->save();
        return $subscription->id;
    }

    public function paypalSucess(Request $request){
        $user_id = Auth::id();


        $subscription = Subscriptions::where('user_id',$user_id)->latest()->first();
        $payment = Subscriptions::find($subscription->id);
        $payment->paypal_auth = $request['auth'];
        $payment->status = "Completed";
        $payment->save();

        if($payment->amount == 30){
             $date = date('Y-m-d', strtotime("+30 days"));
             $users = 3;
        }else if($payment->amount == 480){
             $date = date('Y-m-d', strtotime("+365 days"));
             $users = 5;
        }else if($payment->amount == 300){
             $date = date('Y-m-d', strtotime("+365 days"));
             $users = 3;
        }

        $settings = Setting::where('company_id',$payment->company_id)->update(array('date_expired' => $date,'number_of_users'=> $users));

        $users = User::where('company_id',$payment->company_id)->update(array('date_expired' => $date));

        return redirect('/');

    }

    public function paypalCancel(Request $request){
        $string = "Please connect to the admin ";
        return $string.env('PAYPAL_EMAIL');
    }

    public function paypalForm(Request $request){
        $type= $request['type'];
        //print_r($type);exit;
         return view('layouts.paypalbutton')->with('type',$type);
    }

    public function getCustomers(Request $request) {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $search_item = explode(',', $request->get('search'));
        $lead_name = $search_item[0];
        $company = $search_item[1];

        $total = DB::table('leads')
            ->where('company_id', '=', \Auth::user()->company_id)
            ->where('lead_stage', 'Won')
            ->count();

        $customers = DB::table('leads')
            ->where('company_id','=', \Auth::user()->company_id)
            ->where('lead_stage', 'Won');
        if ($lead_name != '')
            $customers = $customers->where('name', 'like', '%' . $lead_name . '%');
        if ($company != '')
            $customers = $customers->where('company_name', 'like', '%' . $company . '%');

        $customers = $customers->get();
        $total_filtered = sizeof($customers);

        $data = array();
        for ($i = $start; $i < min($start + $length, $total_filtered); $i ++) {
            $temp = array('<div class="btn btn-success btn-just-icon btn-round"><a href="'.\URL::to('leads/'.$customers[$i]->id).'" style="color: white">W</a></div>',
                '<a href="'.\URL::to('leads/'.$customers[$i]->id).'">'.$customers[$i]->name.'('.$customers[$i]->lead_number.')</a>',
                $customers[$i]->company_name);
            array_push($data, $temp);
        }

        $res = array(
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total_filtered,
            'data' => $data
        );

        echo json_encode($res);
    }

    public function getContacts(Request $request) {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $search_item = explode(',', $request->get('search'));
        $lead_name = $search_item[0];
        $company = $search_item[1];
        $status = $search_item[2];

        $total = DB::table('leads')
            ->where('company_id', '=', \Auth::user()->company_id)
            ->count();

        $customers = DB::table('leads')
            ->where('company_id','=', \Auth::user()->company_id);

        if ($lead_name != '')
            $customers = $customers->where('name', 'like', '%' . $lead_name . '%');
        if ($company != '')
            $customers = $customers->where('company_name', 'like', '%' . $company . '%');
        switch ($status) {
            case 'Pending':
                $customers = $customers->where([['lead_stage', 'Lead'], ['drop_status', '']])
                    ->orWhere('l.lead_stage', 'Opportunity');
                break;
            case 'Quote':
                $customers = $customers->Where([['lead_stage', 'Quote'], ['drop_status', '']]);
                break;
            case 'Won':
                $customers = $customers->Where('lead_stage', 'Won');
                break;
            case 'Lost':
                $customers = $customers->where([['drop_status', '!=', ''], ['drop_status', '!=', 'Not-Qualifield']]);
                break;
            case 'NotQualified':
                $customers = $customers->where('drop_status', 'Not-Qualifield');
                break;
            default:
                break;
        }

        $customers = $customers->get();
        $total_filtered = sizeof($customers);

        $data = array();
        for ($i = $start; $i < min($start + $length, $total_filtered); $i ++) {
            if($customers[$i]->drop_status == '') {
                if ($customers[$i]->lead_stage == 'Won'){
                    $class_name = 'btn-warning';
                    $title = 'P';
                } else {
                    $class_name = 'btn-success';
                    $title = 'W';
                }
            } else if($customers[$i]->drop_status == 'Not-Qualifield') {
                $class_name = 'btn-danger';
                $title = 'NQ';
            } else {
                $class_name = 'btn-danger';
                $title = 'L';
            }

            $temp = array(
                '<div class="btn '.$class_name.' btn-just-icon btn-round" style="font-size: 14px;font-weight: bold;"><a href="'.\URL::to('leads/'.$customers[$i]->id).'" style="color: white">'.$title.'</a></div>',
                '<a href="'.\URL::to('leads/'.$customers[$i]->id).'">'.$customers[$i]->name.'('.$customers[$i]->lead_number.')</a>',
                $customers[$i]->company_name, $customers[$i]->lead_stage);

            if($customers[$i]->drop_status == '')
                array_push($temp, '');
            else
                array_push($temp, '<a><i class="material-icons" style="font-size:16px;cursor: pointer;" onclick="returnLead('.$customers[$i]->id.')" >refresh</i></a>');
            array_push($data, $temp);
        }

        $res = array(
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total_filtered,
            'data' => $data
        );

        echo json_encode($res);
    }

    public function getAllLeads(Request $request) {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $search_item = explode(',', $request->get('search'));
        $lead_name = $search_item[0];
        $company = $search_item[1];
        $status = $search_item[2];

        $total = DB::table('leads')
            ->where('company_id',\Auth::user()->company_id)
            ->where('user_id', \Auth::user()->id)
            ->count();

        $customers = DB::table('leads')
            ->where('company_id', \Auth::user()->company_id)
            ->where('user_id', \Auth::user()->id);

        if ($lead_name != '')
            $customers = $customers->where('name', 'like', '%' . $lead_name . '%');
        if ($company != '')
            $customers = $customers->where('company_name', 'like', '%' . $company . '%');
        switch ($status) {
            case 'Pending':
                $customers = $customers->where([['lead_stage', 'Lead'], ['drop_status', '']])
                    ->orWhere('l.lead_stage', 'Opportunity');
                break;
            case 'Quote':
                $customers = $customers->Where([['lead_stage', 'Quote'], ['drop_status', '']]);
                break;
            case 'Won':
                $customers = $customers->Where('lead_stage', 'Won');
                break;
            case 'Lost':
                $customers = $customers->where([['drop_status', '!=', ''], ['drop_status', '!=', 'Not-Qualifield']]);
                break;
            case 'NotQualified':
                $customers = $customers->where('drop_status', 'Not-Qualifield');
                break;
            default:
                break;
        }

        $customers = $customers->get();
        $total_filtered = sizeof($customers);

        $data = array();
        for ($i = $start; $i < min($start + $length, $total_filtered); $i ++) {
            if($customers[$i]->drop_status == '') {
                if ($customers[$i]->lead_stage == 'Won'){
                    $class_name = 'btn-warning';
                    $title = 'P';
                } else {
                    $class_name = 'btn-success';
                    $title = 'W';
                }
            } else if($customers[$i]->drop_status == 'Not-Qualifield') {
                $class_name = 'btn-danger';
                $title = 'NQ';
            } else {
                $class_name = 'btn-danger';
                $title = 'L';
            }

            $temp = array(
                '<div class="btn '.$class_name.' btn-just-icon btn-round" style="font-size: 14px;font-weight: bold;"><a href="'.\URL::to('leads/'.$customers[$i]->id).'" style="color: white">'.$title.'</a></div>',
                '<a href="'.\URL::to('leads/'.$customers[$i]->id).'">'.$customers[$i]->name.'('.$customers[$i]->lead_number.')</a>',
                $customers[$i]->company_name, $customers[$i]->lead_stage,
                '<a action="'.url('leads/'.$customers[$i]->id.'/edit').'" class="btn-icon aicon" id="modal_fade" style="cursor: pointer"><i class="material-icons ">create</i></a>');

            if(\Entrust::hasRole('administrator')) {
                $str = '<select name="user_id" class="form-control activity_status" onchange="assign_users('.$customers[$i]->id.',this)">';
                $str .= '<option hidden="true">Select Users...</option>';

                $users = User::select('*')->where('company_id', \Auth::user()->company_id)->get();
                foreach($users as $user)
                    $str .= '<option value="'.$user->id.'">'.$user->name.'</option>';

                $str .= '</select>';
                array_push($temp , $str);
            }

            array_push($data, $temp);
        }

        $res = array(
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total_filtered,
            'data' => $data
        );

        echo json_encode($res);
    }
}