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
use App\Models\Quotations;
use App\Models\Lead;
use App\Models\QuotationProducts;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Client\ClientRepositoryContract;
use App\Repositories\Lead\LeadRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use DB;
use App\Helper\Helper;

class ClientsController extends Controller
{

    protected $users;
    protected $clients;
    protected $settings;
    protected $leads;

    public function __construct(
        UserRepositoryContract $users,
        ClientRepositoryContract $clients,
        LeadRepositoryContract $leads,
        SettingRepositoryContract $settings
    )
    {
        $this->users = $users;
        $this->clients = $clients;
        $this->settings = $settings;
        $this->leads = $leads;
        $this->middleware('client.create', ['only' => ['create']]);
        $this->middleware('client.update', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        
    	$user_id = \Auth::id();
    	$role_permissions = DB::select(DB::raw("select * from role_user where user_id = $user_id"));
    	 
    	foreach($role_permissions as $role){
    		$user_role = $role->role_id;
    	}

        $company_id = \Auth::user()->company_id;
    	
    	if($user_role == 1){    		
    		$clientDetails = DB::select(DB::raw("select  c.*,u.name as user_name from clients c inner join users u on c.user_id=u.id where c.lead_status='WON' and c.company_id = $company_id;"));    		
    	}else{
    		$clientDetails = DB::select(DB::raw("select  c.*,u.name as user_name from clients c inner join users u on c.user_id=u.id where c.lead_status='WON' AND c.user_id = $user_id and c.company_id = $company_id;"));
    	}
    	
    	
     
        
        return view('clients.index')->with('clientDetails',$clientDetails);
    }
    

    
   


    public function returnLead($id,Request $request){

        $client_data = Client::find($id);
        $client_data->drop_status = '';
        $client_data->lead_status = 'Opportunity';
        $client_data->returned_user = 1;
        $client_data->user_id = \Auth::id();
        $client_data->save();

        return $client_data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
    	
    	
         $source_type = array('Email Champaigne','chat','Phone','Referral','Blogs','Social Media','Advertisements','Events','Webinare','LinkedIn','Twitter','Instagram');
        $type = 'create';

        $company_id = \Auth::user()->company_id;
        $products = Product::select('*')->where('company_id',$company_id)->get();
       

        return view('clients.create')
            ->withUser($this->users->find(\Auth::id()))          
            ->with('company_id',$company_id)
            ->with('type',$type)
            ->with('source_type', $source_type)
            ->with('products', $products)
            ->withIndustries($this->clients->listAllIndustries());
    }



    public function storeLeadData(Request $request){

        $email = $request->email;
        $mobile = $request->primary_number;
         $name = $request->name;
         $company_id = \Auth::user()->company_id;

         if($name == ''){
            return "emptyName";
         }

         if($mobile != ''){
            $phone = Lead::where('primary_number',$mobile)->where('company_id',$company_id)->get();
           
            if(count($phone)>0){
                return "existPhone";
            }
        }else{
                return "emptyPhone";
        }
        
        if($email != ''){
            $mail = Lead::where('email',$email)->where('company_id',$company_id)->get();
          
            if(count($mail)>0){
            	
                return "existMail";
            }
        }else{
                return "emptyMail";
        }


        $getInsertedID = $this->leads->create($request->all());
        
        //create lead, to store in notes..... Manisha(2nd-Jan,2018)
        // $note = new Note();
        // $note->note = \Auth::user()->name." created the lead";
        // $note->status = "success";
        // $note->user_id = \Auth::id();
        // $note->client_id = $getInsertedID->id;
        // $note->company_id = \Auth::user()->company_id;
        // $note->save();

        return $getInsertedID;

    }
    
      
    

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function show($id)
    {

        $notes = Note::select('*')->where('client_id' , '=' , $id)->get();

        $follow_up_activity = FollowUp::select('*')->where('client_id', '=', $id)->get();
     
       $assign = Client::select('*')->find($id);

         $company_id = \Auth::user()->company_id;
         $products = Product::where('company_id',$company_id)->pluck('product_name','id');

        // $quotations = DB::select(DB::raw("select q.*,qp.product_id,qp.description,qp.price from quotations q inner join quotation_products qp on q.quotation_id = qp.quotation_id where q.client_id = $id"));
        $quotations = Quotations::where('client_id',$id)->get();        
        //$quotation_product = QuotationProducts::where('client_id',$id)->get();
           
         $quotation_product = DB::select(DB::raw("select qp.*, p.product_name from quotation_products qp inner join products p on qp.product_id = p.id where qp.client_id = 1"));

       if(count($notes) > 0){
            $note = $notes;
        }else{
            $note = '';
        }
        

        return view('clients.show')
            ->withClient($this->clients->find($id))
            ->with('follow_up_activity', $follow_up_activity)
            ->with('notes', $note)
            ->with('quotations', $quotations)
            ->with('quotation_product',$quotation_product)
            ->with('products',$products)
            ->withCompanyname($this->settings->getCompanyName())
            ->withInvoices($this->clients->getInvoices($id))
            ->withUsers($this->users->find($assign->user_id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function edit($id)
    {

        $sourceDetails = Source::all()->pluck('name', 'id');
        $source_type = array( 'Web', 'Chat',  'Phone' ,'Referal', 'Blogs',  'Social Media', 'Events' , 'Advertisements');
        $lead_type = array('Product1','Product2');
        $type = 'edit';
        $company_id = \Auth::user()->company_id;
        $products = Product::where('company_id',$company_id)->pluck('product_name','id');
        $users = User::where('company_id',$company_id)->pluck('name','id');
    
        return view('clients.edit')
        	->with('users',$users)
            ->with('type',$type)
            ->withClient($this->clients->find($id))
            ->with('sourceDetails',$sourceDetails)
            ->with('states', $states)
            ->with('lead_type',$lead_type)
            ->with('source_type', $source_type)
            ->with('products',$products)
            ->withIndustries($this->clients->listAllIndustries());
    }

   

    /**
     * @param $id
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update($id, UpdateClientRequest $request)
    {
    	
        $clientData = $this->clients->update($id, $request);
            
        //update lead, to store in notes..... Manisha(3rd-Jan,2018)
        $user_id = $clientData->user_id;  
        if ($user_id == 0) {
        $notes = new Note();
        $notes->note = \Auth::user()->name." updated and changed the lead to Lead Owner";
        $notes->status = "success";
        $notes->user_id = $user_id;
        $notes->client_id = $id;
        $notes->company_id = \Auth::user()->company_id;
        $notes->save();
        } else {
        $notes = new Note();
        $notes->note = \Auth::user()->name." updated the lead";
        $notes->status = "success";
        $notes->user_id = \Auth::id();
        $notes->client_id = $id;
        $notes->company_id = \Auth::user()->company_id;
        $notes->save();
        }
        return $clientData;
    }



    public function drop(Request $request){

        $id = $request['id'];
        $client_name = Client::select ('name')->find($id);

        return view('clients.other')
            ->with('id',$id)->with('client_name',$client_name);
    }

    public function dropLead(Request $request){
    	
    	
        $client_data = Client::find($request['id']);
        $client_data->drop_status = $request['status'];
        $client_data->comment = $request['comment'];
        $client_data->save();

        //drop lead, to store in notes..... Manisha(3rd-Jan,2018)
        $notes = new Note();
        $notes->note = \Auth::user()->name." dropped the lead";
        $notes->status = "success";
        $notes->user_id = \Auth::id();
        $notes->client_id = $request['id'];
        $notes->company_id = \Auth::user()->company_id;
        $notes->save();
        
        return $request['id'];


    }
    public function viewLead(Request $request){
           
   		$id = $request->id;
         $getAllClients =Client::select ('*')->find($id);
         $users=User::select('*')->find($getAllClients->user_id);

 
        return view('clients.view')    
        -> with('users',$users)
        ->  with('getAllClients',$getAllClients);    

    }




    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->clients->destroy($id);

        return redirect()->route('clients.index');
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function updateAssign($id, Request $request)
    {
        $this->clients->updateAssign($id, $request);
        Session()->flash('flash_message', 'New user is assigned');
        return redirect()->back();
    }



    
    
   


    public function clientDetail(Request $request){
    	
    	if($request->details == ""){
    		return "details";
    	}

        $client_follow_up = New FollowUp();
        $client_follow_up->next_follow_up_name = $request->activity;
        $client_follow_up->date = $request->date;
        $client_follow_up->details = $request->details;
        $client_follow_up->client_id = $request->client_id;
        $client_follow_up->status = "Scheduled";
        $client_follow_up->user_id = \Auth::id();
        $client_follow_up->company_id = \Auth::user()->company_id;
        $client_follow_up->save();
    }

    public function oppurtunity(Request $request){

         $id = $request->id;
         $status = $request->status;
         //print_r($id);exit;

         return view('layouts.oppurtunity')->with('id',$id)->with('status',$status);

    }

    public function convertToOppurtunity(Request $request){
        print_r($request->status);
        $client_data = Client::find($request->id);
        $client_data->lead_status = $request->status;
       // $client_data->comment = $request['comment'];
        $client_data->save();

        return $request->id;
    }



    public function quotations($id,Request $request){
        
        $helper = Helper::quotation_code($id);

        $company_id = \Auth::user()->company_id;
        $company_name = \Auth::user()->company_name;

        $quotations = new Quotations();
        $quotations->quotation_id = $helper;
        $quotations->client_id = $id;
        $quotations->company_id = $company_id;
        $quotations->user_id = \Auth::id();
        $quotations->total_amount = $request->quotation_total;
        $quotations->save();

        //print_r($quotations->id);

        if(count($request->products) >0){
                $products = $request->products;
                $description = $request->description;
                $price = $request->price;



                foreach($products as $index => $data){
                   
                    $quotation_product = new QuotationProducts();
                    $quotation_product->product_id = $data;
                    $quotation_product->price = $price[$index];
                    $quotation_product->description = $description[$index];
                    $quotation_product->quotation_id = $helper;
                    $quotation_product->client_id = $id;
                    $quotation_product->company_id = $company_id;
                    $quotation_product->save();
                }
        }else{
            
        }
        
        return redirect()->back();

        //print_r($request->quotation_total);

      // return view('layouts.quote_lead_details');

    }
    
    
    public function stateUsers(){
        
        $string = '';
        $state_id = $_GET['state'];
        
        //$user_details = $this->users->select('*')->where('state_id', '=' , $state_id)->get();
        
        $user_details = User::select('*')->where('state_id','=' , $state_id)->get();
        
        foreach($user_details as $user){
            $userId = $user->id;
            $userName = $user->name;
            //print_r($source->name);
            $string .= "<option value='$userId'>$userName</option>";
        }
        
        echo $string;
        
    }


    public function testuser(){
        $follow_up = FollowUp::select('*')->get();
        return view('clients.index')->with('test',$follow_up);
    }
    
    
   

}
