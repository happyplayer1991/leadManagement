<?php

namespace App\Http\Controllers;

use App\Models\Taxs;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Repositories\Taxs\TaxsRepositoryContract;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $tax;

    public function __construct(
        
        TaxsRepositoryContract $tax
    )
    {
        $this->tax = $tax;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('taxs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $tax = $this->tax->create($request);

        $company_id =  \Auth::user()->company_id;
        $taxs = Taxs::where('company_id',$company_id)->get();

        if($tax == ""){
            $data['error'] = 'Tax already exists';
            $data['message'] = "";
        }else{
            $data['error'] = '';
             $data['message'] = "Tax Added successfully.";
        }
    
        
        $data['html'] = view('taxs.datatable')->with('taxs',$taxs)->render();
       
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Taxs  $taxs
     * @return \Illuminate\Http\Response
     */
    public function show(Taxs $taxs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Taxs  $taxs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tax = Taxs::findOrFail($id);
        return view('taxs.edit')
            ->with('tax',$tax);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Taxs  $taxs
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $tax = Taxs::find($id);
        $tax->name = $request->tax_name;
        $tax->rate = $request->rate;
        $tax->description = $request->description;
        $tax->save();

        $company_id =  \Auth::user()->company_id;
        $taxs = Taxs::where('company_id',$company_id)->get();
    
        $data['error'] = '';
        $data['html'] = view('taxs.datatable')->with('taxs',$taxs)->render();
        $data['message'] = "Tax Updated successfully.";
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Taxs  $taxs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tax = Taxs::findOrFail($id);
        $tax->delete();
    	Session()->flash('flash_message', 'Tax Successfully deleted');
    	return back();
    }
}

