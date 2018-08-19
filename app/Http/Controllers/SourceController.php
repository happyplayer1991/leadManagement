<?php

namespace App\Http\Controllers;

use Input;

use Session;
use App\Models\Source;
use App\Models\Client;
use App\Models\User;
use App\Models\Lead;
use App\Http\Requests;

use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Source\UpdateSourceRequest;
use App\Http\Requests\Source\StoreSourceRequest;
use App\Repositories\Source\SourceRepositoryContract;

class SourceController extends Controller
{
    //
    protected $sources;

    /**
     * SourceController constructor.
     * @param SourceRepositoryContract $sources
     */
    public function __construct(SourceRepositoryContract $sources)
    {
        $this->sources = $sources;
        $this->middleware('user.is.admin', ['only' => ['create', 'destroy']]);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        
    	$user_id = \Auth::id();
    	$company_id = \Auth::user()->company_id;
        $leads = Lead::select('*')->where('company_id',$company_id)->get();
        $users = User::select('*')->where('company_id',$company_id)->get();
        return view('sources.index')->with('leads',$leads)->with('users',$users);
    }

    public function anyData()
    {
       
        
        $canUpdateUser = auth()->user()->can('update-user');
        $sources = Source::select(['id', 'name', 'email','phone_number']);
        return Datatables::of($sources)
            
            ->add_column('edit', '
                <a href="{{ route(\'sources.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->add_column('delete', '
                <form action="{{ route(\'sources.destroy\', $id) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="Delete" class="btn btn-danger" onClick="return confirm(\'Are you sure?\')"">

            {{csrf_field()}}
            </form>')
            ->make(true);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $type = 'create';
        return view('sources.create')
         ->with('type',$type);
    }

    /**
     * @param StoreSourceRequest $request
     * @return mixed
     */
    public function store(StoreSourceRequest $request)
    {
        $phno = Source::where('phone_number',Input::get('phone_number'))->first();

        if (!is_null($phno)) {

        return Redirect::back()->withErrors(['msg', 'Source is already exist']);
      
        }
        
        $this->sources->create($request);
        Session::flash('flash_message', 'Created New Source');
        return redirect()->route('sources.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->sources->destroy($id);
        Session::flash('flash_message', 'Source Deleted');
        return redirect()->route('sources.index');
    }

    public function edit($id)
    {
        $type = 'edit';
        $source = Source::find($id);
        return view('sources.edit')
        ->with('type',$type)
        ->with('source',$source);
        
    }

     /**
     * Show the form for showing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $sources = Source::find($id);
        return view('sources.show')->with('sources',$sources);
    }

     public function update($id, UpdateSourceRequest $request)
    {
        $phone = Source::where('id', $id)->value('phone_number');
        $phno = $request->phone_number;
 
        $num = Source::where('phone_number',Input::get('phone_number'))->first();

        if($phno==$phone){   
            $this->sources->update($id, $request);
        }
        elseif (!is_null($num)) {
            return Redirect::back()->withErrors(['msg', 'Source is already exist']);
        }
        else{
            $this->sources->update($id, $request);
        }

        // $this->sources->update($id, $request);
        Session()->flash('flash_message', 'Source Updated');
        return redirect()->route('sources.index');
    }



    public function sourceDetails(){

        $string = '';
        $source_type = $_GET['source'];

        $source_details = Source::select('*')->where('types','=' , $source_type)->get();

        foreach($source_details as $source){
            $sourceId = $source->id;
            $sourceName = $source->name;
            //print_r($source->name);
            $string .= "<option value='$sourceId'>$sourceName</option>";
        }

        echo $string;
       // print_r($source_details);

       // echo $source_details;
    }
    
   


}
