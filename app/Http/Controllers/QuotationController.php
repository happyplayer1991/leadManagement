<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\QuotationProducts;
use App\Models\Lead;
use App\Models\Taxs;
use App\Models\Note;
 use App\Models\Invoice;
use App\Models\Product;
use App\Models\Currency;
use App\Models\Company;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon;
use Session;
use Datatables;
use App\Helper\Helper;
use App\Repositories\Lead\LeadRepositoryContract;

use App\Repositories\Quotation\QuotationRepositoryContract;

class QuotationController extends Controller
{

    const SUBMIT = 'submit';
    protected $quotation;
    protected $leads;

    public function __construct(
        LeadRepositoryContract $leads,
        QuotationRepositoryContract $quotation
    )
    {
        $this->quotation = $quotation;
        $this->leads = $leads;
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
            $quotations = DB::table('quotations')
            ->join('leads','quotations.lead_id','=','leads.id')
            ->select('quotations.*','leads.name','leads.company_name','leads.lead_number')
            ->where('quotations.company_id','=',$company_id)->where('is_deleted','')->orderByDesc('created_at')
            ->paginate(10);
        }else{
            $leads = Lead::select('id','name')->where('drop_status','=','')->where('company_id',$company_id)->where('user_id',$user_id)->get();
             $quotations = DB::table('quotations')
            ->join('leads','quotations.lead_id','=','leads.id')
            ->select('quotations.*','leads.name','leads.company_name','leads.lead_number')
            ->where('quotations.company_id','=',$company_id)->where('is_deleted','')
            ->where('quotations.user_id','=',$user_id)->orderByDesc('created_at')
            ->paginate(10);
        }

        //$quotations = Quotation::where('company_id',$company_id)->get();

        // $currency = Company::where('company_id',$company_id)->limit(1)->get();//Currency::all();
        return view('layouts.quotations')->with('quotations',$quotations)->with('leads',$leads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company_id = \Auth::user()->company_id;
        $leads = Lead::where('company_id',$company_id)->where('drop_status','')->where('session_id','')->get(['id', 'name', 'address']);


        $currency = Company::where('company_id',$company_id)->limit(1)->get();
        $quotation_number =Helper::quotation_code("quote");

        $products = Product::get(['id','product_name','price','description']);
        // $currency = Currency::all();
        $taxs = Taxs::where('company_id',$company_id)->get();
        $id = '';

        return view('layouts.addquotations')->with('leads',$leads)->with('quotation_number',$quotation_number)->with('products',$products)->with('currency',$currency)->with('taxs',$taxs)->with('id',$id);
    }

    public function createQuotation($id)
    {
        $company_id = \Auth::user()->company_id;
        $leads = Lead::where('id',$id)->where('company_id',$company_id)->get(['id', 'name', 'address']);



        $quotation_number =Helper::quotation_code("quote");

        $products = Product::get(['id','product_name','price','description']);
        $currency = Company::where('company_id',$company_id)->limit(1)->get();//Currency::all();
        $taxs = Taxs::where('company_id',$company_id)->get();

        $lead = $id;
        if($lead == '') {
            $id = '';
        } else {
            $id = $lead;
        }
        return view('layouts.addquotations')->with('leads',$leads)->with('quotation_number',$quotation_number)->with('products',$products)->with('currency',$currency)->with('taxs',$taxs)->with('id',$id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // print_r($request->all());exit;

        
        if($request->save == "save"){
            $company_id = \Auth::user()->company_id;

            $quotation = New Quotation();
            $quotation->quotation_number = $request->quote_number;
            $quotation->lead_id = $request->leads;
            $quotation->user_id = \Auth::id();
            $quotation->company_id = $company_id;
            $quotation->discount = $request->quote_discount;
            $quotation->currency = $request->currency;
            $quotation->quotation_date = $request->quote_date;
            $quotation->amount = $request->gross_price;
            $quotation->due_amount = $request->gross_price;
            $quotation->total_price = $request->total_price;
            $quotation->address = $request->quote_address;
            $quotation->status = 'Pending';
            $quotation->tax_amount = $request->quote_tax;
            $quotation->save();


            if(count($request->products) >0){
                $products = $request->products;
                $description = $request->description;
                $price = $request->price;
                $quantity = $request->quantity;
                $line_total = $request->line_total;
                $product_name = $request->product_name;

                foreach($products as $index => $data){
                    if($data != ""){
                        $quotation_product = New QuotationProducts();
                        $quotation_product->product_id = $data;
                        $quotation_product->price = $price[$index];
                        $quotation_product->description = $description[$index];
                        $quotation_product->qty = $quantity[$index];
                        $quotation_product->total = $line_total[$index];
                        $quotation_product->product_key = $product_name[$index];
                        $quotation_product->quotation_number = $request->quote_number;
                        $quotation_product->quote_id = $quotation->id;
                        $quotation_product->lead_id = $request->leads;
                        $quotation_product->company_id = $company_id;
                        $quotation_product->save();
                    }

                }
            }else{

            }

            $lead_data = Lead::findOrFail($request->leads);
            $lead_data->lead_stage = "Quote";
            $lead_data->address = $request->quote_address;
            $lead_data->save();
            
        }

        if($request->submit == "submit"){
            $company_id = \Auth::user()->company_id;

            $quotation = New Quotation();
            $quotation->quotation_number = $request->quote_number;
            $quotation->lead_id = $request->leads;
            $quotation->user_id = \Auth::id();
            $quotation->company_id = $company_id;
            $quotation->discount = $request->quote_discount;
            $quotation->currency = $request->currency;
            $quotation->quotation_date = $request->quote_date;
            $quotation->amount = $request->gross_price;
            $quotation->due_amount = $request->gross_price;
            $quotation->total_price = $request->total_price;
            $quotation->address = $request->quote_address;
            $quotation->status = 'Submitted';
            $quotation->tax_amount = $request->quote_tax;
            $quotation->save();


            if(count($request->products) >0){
                $products = $request->products;
                $description = $request->description;
                $price = $request->price;
                $quantity = $request->quantity;
                $line_total = $request->line_total;
                $product_name = $request->product_name;

                foreach($products as $index => $data){
                    if($data != ""){
                        $quotation_product = New QuotationProducts();
                        $quotation_product->product_id = $data;
                        $quotation_product->price = $price[$index];
                        $quotation_product->description = $description[$index];
                        $quotation_product->qty = $quantity[$index];
                        $quotation_product->total = $line_total[$index];
                        $quotation_product->product_key = $product_name[$index];
                        $quotation_product->quotation_number = $request->quote_number;
                        $quotation_product->quote_id = $quotation->id;
                        $quotation_product->lead_id = $request->leads;
                        $quotation_product->company_id = $company_id;
                        $quotation_product->save();
                    }

                }
            }else{

            }

            $lead_data = Lead::findOrFail($request->leads);
            $lead_data->lead_stage = "Quote";
            $lead_data->address = $request->quote_address;
            $lead_data->save();

            event(new \App\Events\QuotationAction($quotation, self::SUBMIT));
            
            $notes = new Note();
            $notes->note = \Auth::user()->name." added the Quotation";
            $notes->status = "added";
            $notes->user_id = \Auth::id();
            $notes->lead_id = $request->leads;
            $notes->company_id = \Auth::user()->company_id;
            $notes->save();
        }





        return redirect()->route('quotations.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company_id = \Auth::user()->company_id;
        $quotation = Quotation::find($id);
        $quotation_items = QuotationProducts::where('quote_id',$id)->where('company_id',$company_id)->get();
        $lead_name = Lead::find($quotation->lead_id);
        $inv = DB::select(DB::raw("select i.id from invoices as i left join quotations as q on i.quote_id=q.id where i.company_id=$company_id and q.id=$id"));

        $symbol = substr($quotation->currency, 0, 3);
        // $currency = Company::where('company_id',$company_id)->limit(1)->get();//Currency::where('currency_code',$symbol)->get();
        $invoices = Invoice::select('quote_id')->where('quote_id',$id)->count();
        // print_r($currency);exit;
        //print_r($quotation->quotation_number);exit;

        return View('layouts.viewquotation')->with('quotation',$quotation)->with('quotation_items',$quotation_items)->with('lead_name',$lead_name)->with('invoices',$invoices)->with('inv',$inv);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $quotation = Quotation::find($id);
        $quotation->is_deleted = "void";
        $quotation->save();
        // print_r($quotation->is_deleted);exit;        
        $company_id = \Auth::user()->company_id;
        $leads = Lead::where('company_id',$company_id)->where('drop_status','')->where('id',$quotation->lead_id)->where('session_id','')->get(['id', 'name', 'address']);

        $quotation_number =Helper::quotation_code("quote");

        $products = Product::get(['id','product_name','price','description']);
        // $currency = Currency::all();
        $currency = Company::where('company_id',$company_id)->limit(1)->get();
        $taxs = Taxs::where('company_id',$company_id)->get();
        
        
        return view('layouts.modify_quotation')->with('leads',$leads)->with('quotation',$quotation)->with('quotation_number',$quotation_number)->with('products',$products)->with('currency',$currency)->with('taxs',$taxs);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {

// print_r($request->submit);exit;
        if($request->save == "save"){
            $company_id = \Auth::user()->company_id;

            $quotation = New Quotation();
            $quotation->quotation_number = $request->quote_number;
            $quotation->lead_id = $request->leads;
            $quotation->user_id = \Auth::id();
            $quotation->company_id = $company_id;
            $quotation->discount = $request->quote_discount;
            $quotation->currency = $request->currency;
            $quotation->quotation_date = $request->quote_date;
            $quotation->amount = $request->gross_price;
            $quotation->due_amount = $request->gross_price;
            $quotation->total_price = $request->total_price;
            $quotation->address = $request->quote_address;
            $quotation->status = 'Pending';
            $quotation->tax_amount = $request->quote_tax;

            $quotation->save();


            if(count($request->products) >0){
                $products = $request->products;
                $description = $request->description;
                $price = $request->price;
                $quantity = $request->quantity;
                $line_total = $request->line_total;
                $product_name = $request->product_name;

                foreach($products as $index => $data){
                    if($data != ""){
                        $quotation_product = New QuotationProducts();
                        $quotation_product->product_id = $data;
                        $quotation_product->price = $price[$index];
                        $quotation_product->description = $description[$index];
                        $quotation_product->qty = $quantity[$index];
                        $quotation_product->total = $line_total[$index];
                        $quotation_product->product_key = $product_name[$index];
                        $quotation_product->quotation_number = $request->quote_number;
                        $quotation_product->quote_id = $quotation->id;
                        $quotation_product->lead_id = $request->leads;
                        $quotation_product->company_id = $company_id;
                        $quotation_product->save();
                    }

                }
            }else{

            }

            $lead_data = Lead::findOrFail($request->leads);
            $lead_data->lead_stage = "Quote";
            $lead_data->address = $request->quote_address;
            $lead_data->save();
            
        }


        if($request->submit == "submit"){
            $company_id = \Auth::user()->company_id;

            $quotation = New Quotation();
            $quotation->quotation_number = $request->quote_number;
            $quotation->lead_id = $request->leads;
            $quotation->user_id = \Auth::id();
            $quotation->company_id = $company_id;
            $quotation->discount = $request->quote_discount;
            $quotation->currency = $request->currency;
            $quotation->quotation_date = $request->quote_date;
            $quotation->amount = $request->gross_price;
            $quotation->due_amount = $request->gross_price;
            $quotation->total_price = $request->total_price;
            $quotation->address = $request->quote_address;
            $quotation->status = 'Submitted';
            $quotation->tax_amount = $request->quote_tax;

            $quotation->save();


            if(count($request->products) >0){
                $products = $request->products;
                $description = $request->description;
                $price = $request->price;
                $quantity = $request->quantity;
                $line_total = $request->line_total;
                $product_name = $request->product_name;

                foreach($products as $index => $data){
                    if($data != ""){
                        $quotation_product = New QuotationProducts();
                        $quotation_product->product_id = $data;
                        $quotation_product->price = $price[$index];
                        $quotation_product->description = $description[$index];
                        $quotation_product->qty = $quantity[$index];
                        $quotation_product->total = $line_total[$index];
                        $quotation_product->product_key = $product_name[$index];
                        $quotation_product->quotation_number = $request->quote_number;
                        $quotation_product->quote_id = $quotation->id;
                        $quotation_product->lead_id = $request->leads;
                        $quotation_product->company_id = $company_id;
                        $quotation_product->save();
                    }

                }
            }else{

            }

            $lead_data = Lead::findOrFail($request->leads);
            $lead_data->lead_stage = "Quote";
            $lead_data->address = $request->quote_address;
            $lead_data->save();

            event(new \App\Events\QuotationAction($quotation, self::SUBMIT));
            
            $notes = new Note();
            $notes->note = \Auth::user()->name." added the Quotation";
            $notes->status = "added";
            $notes->user_id = \Auth::id();
            $notes->lead_id = $request->leads;
            $notes->company_id = \Auth::user()->company_id;
            $notes->save();
        }

        return redirect()->route('quotations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        //
    }

    public function updateStatus($id,Request $request){

        if($request->status == "Approved") {
            $quotation = Quotation::find($id);
            $quotation->status = $request->status;
            $quotation->save();
        }

        if($request->status == "Rejected") {
            $quotation = Quotation::find($id);
            $quotation->status = $request->status;
            $quotation->reason = $request->reason;
            $quotation->save();
        }
        if($request->status == "submit"){
            $quotation = Quotation::findOrFail($id);
            $quotation->status = 'Submitted';
            $quotation->save();
        }
        return redirect()->route('quotations.index');
        
    }


    public function quotationPopover(Request $request){ 

            $company_id = \Auth::user()->company_id;

            $quotation = New Quotation();
            $quotation->quotation_number = $request->quote_number;
            $quotation->lead_id = $request->leads;
            $quotation->user_id = \Auth::id();
            $quotation->company_id = $company_id;
            $quotation->discount = $request->quote_discount;
            $quotation->currency = $request->currency;
            $quotation->quotation_date = $request->quote_date;
            $quotation->amount = $request->gross_price;
            $quotation->due_amount = $request->gross_price;
            $quotation->total_price = $request->total_price;
            $quotation->address = $request->quote_address;
            $quotation->status = 'Submitted';
            $quotation->tax_amount = $request->quote_tax;
            $quotation->save();


            if(count($request->products) >0){
                $products = $request->products;
                $description = $request->description;
                $price = $request->price;
                $quantity = $request->quantity;
                $line_total = $request->line_total;
                $product_name = $request->product_name;

                foreach($products as $index => $data){
                    if($data != ""){
                        $quotation_product = New QuotationProducts();
                        $quotation_product->product_id = $data;
                        $quotation_product->price = $price[$index];
                        $quotation_product->description = $description[$index];
                        $quotation_product->qty = $quantity[$index];
                        $quotation_product->total = $line_total[$index];
                        $quotation_product->product_key = $product_name[$index];
                        $quotation_product->quotation_number = $request->quote_number;
                        $quotation_product->quote_id = $quotation->id;
                        $quotation_product->lead_id = $request->leads;
                        $quotation_product->company_id = $company_id;
                        $quotation_product->save();
                    }

                }
            }else{

            }
           
            $lead_data = Lead::findOrFail($request->leads);
            $lead_data->lead_stage = "Quote";
            $lead_data->save();
        



        $getAllLeads = $this->leads->leadsBaseOnCompany();
        
        $error = "";
        $html = view('pages.cardview')->with('getAllLeads',$getAllLeads)->render();
        $message = "Quotation Created successfully";

        $data = array('error'=>$error,'html'=>$html,'message'=>$message);
        return $data;

    }
}
