<?php
namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Models\Note;
use App\Models\Lead;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Helper\Helper;

class NotesController extends Controller
{
    /**
     * Create a note for leads
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function viewNotes($id){
        $lead = Lead::Find($id);

        return view('layouts.addNotes')->with('lead',$lead);
    }
public function store(Request $request)
    {
        $leadId = $request->all()['lead_id'];
        $lead = Lead::Find($leadId);

        $this->validate($request, [
            'note' => 'required',
            'status' => '',
            'company_id'=>'',
            'client_id' => '',
            'lead_id' => '',
            'user_id' => '']);

        $input = $request = array_merge(
            $request->all(),
            ['user_id' => \Auth::id()]
        );

        Note::create($input);
        //dd(Note::all());
        $note =  Note::all()->sortByDesc('id');

        //Session::flash('flash_message', 'Note successfully added!'); //Snippet in Master.blade.php
        //return redirect('/leads/'.$leadId.'/#Notes');
        return view('leads.notes')->with('notes',$note)->with('lead',$lead);
        //return new JsonResponse(['status'=>'OK','message'=>'Note created Sucessfully']);
    }
}
