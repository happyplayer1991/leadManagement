<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\Invoice;
use App\Models\Currency;
use App\Models\QuotationProducts;
use App\Models\Lead;
use App\Helper\Helper;
use DB;
use App\Models\Note;
use Mail;
use Session;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\Invoice\InvoiceRepositoryContract;
use App\Repositories\Client\ClientRepositoryContract;

class InvoicesController extends Controller
{

    protected $clients;
    protected $invoices;

    public function __construct(
        InvoiceRepositoryContract $invoices,
        ClientRepositoryContract $clients
    )
    {
        $this->invoices = $invoices;
        $this->clients = $clients;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = \Auth::id();
        $role_permissions = DB::table('role_user')
                            ->where('user_id','=', $user_id)
                            ->get();
        
        foreach($role_permissions as $role){
            $user_role = $role->role_id;
        }
        
        
        $company_id = \Auth::user()->company_id;

        if($user_role == 1){
            $leads = Lead::select('id','name')->where('company_id',$company_id)->where('drop_status','=','')->get();
            $invoices = DB::table('invoices')
                        ->join('leads','invoices.lead_id','=','leads.id')
                        ->select('invoices.*','leads.name','leads.company_name','leads.lead_number')
                        ->where('invoices.company_id','=',$company_id)->orderByDesc('id')
                        ->paginate(10);
        }else{
            $leads = Lead::select('id','name')->where('drop_status','=','')->where('company_id',$company_id)->where('user_id',$user_id)->get();
            $invoices = DB::table('invoices')
                        ->join('leads','invoices.lead_id','=','leads.id')
                        ->select('invoices.*','leads.name','leads.company_name','leads.lead_number')
                        ->where('invoices.company_id','=',$company_id)
                        ->where('invoices.user_id','=',$user_id)->orderByDesc('id')
                        ->paginate(10);
        }
        //$quotations = Quotation::where('company_id',$company_id)->get();

        // $currency = Company::where('company_id',$company_id)->limit(1)->get();//Currency::all();


       
        return view('layouts.invoice')->with('invoices',$invoices)->with('leads',$leads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //$this->invoices->create('test');
        $company_id = \Auth::user()->company_id;
        $quotation = Quotation::find($id);
        $invoice_code =Helper::quotation_code("invoice");
        $quotation_items = QuotationProducts::where('quote_id',$quotation->id)->where('company_id',$company_id)->get();
        $lead_name = Lead::find($quotation->lead_id);
        $symbol = substr($quotation->currency, -2, 1);
        // $currency = Company::where('company_id',$company_id)->limit(1)->get();//Currency::all();

        return view('layouts.addinvoice')->with('invoice_number',$invoice_code)->with('quotation',$quotation)->with('quotation_items',$quotation_items)->with('lead_name',$lead_name)->with('symbol',$symbol);
    }


    public function store(Request $request){
        //print_r($request->all());exit;
        $quotation = Quotation::find($request->quotation_id);
        $quotation->paid_amount = $request->payed;
        $quotation->due_amount = $request->due;
        $quotation->save();
        
        if($quotation->due_amount == 0) {
        $invoice = New Invoice();
        $invoice->invoice_number = $request->invoice_number;
        $invoice->lead_id = $request->lead_id;
        $invoice->user_id = \Auth::id();
        $invoice->company_id = \Auth::user()->company_id;
        $invoice->amount = $request->amount;
        $invoice->quote_id = $request->quotation_id;
        $invoice->quotation_number = $request->quotation_number;
        $invoice->currency = $quotation->currency;
        $invoice->paid_amount = $quotation->paid_amount;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->due_amount = $quotation->due_amount;
        $invoice->public_notes = "Paid";
        $invoice->discount = $quotation->discount;
        $invoice->tax_amount = $quotation->tax_amount;
        $invoice->save();
        $lead_data = Lead::findOrFail($request->lead_id); 
        $lead_data->lead_stage = "Won";
        $lead_data->save();
        }else {
        $invoice = New Invoice();
        $invoice->invoice_number = $request->invoice_number;
        $invoice->lead_id = $request->lead_id;
        $invoice->user_id = \Auth::id();
        $invoice->company_id = \Auth::user()->company_id;
        $invoice->amount = $request->amount;
        $invoice->quote_id = $request->quotation_id;
        $invoice->quotation_number = $request->quotation_number;
        $invoice->currency = $quotation->currency;
        $invoice->paid_amount = $quotation->paid_amount;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->due_amount = $quotation->due_amount;
        $invoice->public_notes = "Pending";
        $invoice->discount = $quotation->discount;
        $invoice->tax_amount = $quotation->tax_amount;
        $invoice->save();
        $lead_data = Lead::findOrFail($request->lead_id); 
        $lead_data->lead_stage = "Won";
        $lead_data->save();
        }
 
        $notes = new Note();
        $notes->note = \Auth::user()->name." added the Invoice";
        $notes->status = "added";
        $notes->user_id = \Auth::id();
        $notes->lead_id = $invoice->lead_id;
        $notes->company_id = \Auth::user()->company_id;
        $notes->save();
        return redirect()->route('invoices.index'); 

    }

    public function update($id, Request $request) {

        $inv = Invoice::find($id);
        // $quotation = Quotation::find($request->quotation_id);
        // $total_price=$quotation->total_price;
        // print_r($quotation->total_price); die();

        $invtamount=$inv->amount-$inv->due_amount;
        ///print_r($invtamount);
        //print_r($request->payed);
        //print_r($inv->due_amount);
        //print_r($inv->amount); 
        //$inv->amount=$inv->amount-$inv->paid_amount;
        //print_r($inv->amount); die(); 
        $inv->paid_amount=$inv->paid_amount+$request->payed;
        //print_r($inv->paid_amount); die();
        //$inv->paid_amount = $inv->paid_amount ? (int)$inv->paid_amout : 0 +  (int)$request->payed;
       // $inv->due_amount =  $request->due;

        //$$inv->amount = $inv->amount - $request->payed;
         $inv->due_amount = $inv->amount-$inv->paid_amount;
         //print_r($inv->due_amount); die();
        //$inv->amount=$invtamount;
       // $total=0;
        //$total=$total+$request->payed;
        //print_r($total); die();
        //print_r($inv->paid_amount); die();
        //print_r($inv->amount); die();
        if($inv->due_amount==0) {
            //$inv->paid_amount = $inv->amount;
            //$inv->amount=$invtamount;
            //print_r($inv->amount); die();
            $inv->public_notes = "Paid";
        }
       
        $inv->save();

        return redirect()->route('invoices.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company_id = \Auth::user()->company_id;
        $invoices = Invoice::find($id);
        // print_r($invoices);exit;
        $quotations = Quotation::find($invoices->quote_id);
        // print_r($quotations);exit;
        $quotation_items = QuotationProducts::where('quote_id',$quotations->id)->where('company_id',$company_id)->get();
        $lead_name = Lead::find($quotations->lead_id);
        // $currency = Company::where('company_id',$company_id)->limit(1)->get();//Currency::all();

        return view('layouts.viewinvoice')->with('invoices',$invoices)->with('quotations',$quotations)->with('quotation_items',$quotation_items)->with('lead_name',$lead_name);
    }

    public function viewEmail($id,Request $request) {
        $invoices = Invoice::find($id);
        // print_r($invoices);exit;
        return view('layouts.emailAddress')->with('invoices',$invoices);
    }

    public function emailAddress($id,Request $request) {
        // print_r($id);exit;
        // print_r($request->emailInvoice);
        $inv = Invoice::findOrFail($id);
        $lead = Lead::findOrFail($inv->lead_id);
        // print_r($lead);exit;
        $data = array('name' => $lead->name,'primary_number' => $lead->primary_number, 'email' => $lead->email );

        $mail = explode(',', $request->emailInvoice);
        Mail::send('invoicemail', $data, function($message) use ($data,$mail)
            {
                $message->from('sowji.reddy09@gmail.com', "Sowjitha");
                $message->subject("Welcome to Opal CRM");
                $message->to($mail);
            });

            // Session::flash('flash_message', 'Email Sent Successfully. Check your inbox.');
        
        return redirect()->back();
        

    }
    /**
     * Closed open payment
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function updatePayment(Request $request, $id)
    {
        $this->invoices->updatePayment($id, $request);
        return redirect()->back();
    }

    /**
     * Reopen closed payment
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function reopenPayment(Request $request, $id)
    {
        $this->invoices->reopenPayment($id, $request);
        return redirect()->back();
    }

    /**
     * Update the sent status
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function updateSentStatus(Request $request, $id)
    {
        $this->invoices->updateSentStatus($id, $request);
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function updateSentReopen(Request $request, $id)
    {
        $this->invoices->updateSentReopen($id, $request);
        return redirect()->back();
    }

    /**
     * Add new invoice line
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function newItem($id, Request $request)
    {
        $this->invoices->newItem($id, $request);
        return redirect()->back();
    }

}
