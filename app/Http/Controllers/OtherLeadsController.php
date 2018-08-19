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
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Client\ClientRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use DB;

class OtherLeadsController extends Controller
{

    protected $users;
    protected $clients;
    protected $settings;

    public function __construct(
        UserRepositoryContract $users,
        ClientRepositoryContract $clients,
        SettingRepositoryContract $settings
    )
    {
        $this->users = $users;
        $this->clients = $clients;
        $this->settings = $settings;
        $this->middleware('client.create', ['only' => ['create']]);
        $this->middleware('client.update', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientDetails = Client::all();
       // $clientDetails = DB::select(DB::raw("SELECT t1.id,t1.client_name,t1.company_name,t1.email,t1.primary_number,t1.user_name,t1.source_name,t1.next_follow_up_name  FROM (select c.id, c.name as Client_name,c.company_name,c.email,c.primary_number,u.name as user_name,s.name as Source_name,fu.updated_at,fu.next_follow_up_name  from  clients c inner join users u on c.user_id=u.id inner join sources s on c.source_id=s.id inner join follow_up fu on fu.client_id=c.id) AS t1 LEFT JOIN (select c.id, c.name as Client_name,c.company_name,c.email,c.primary_number,u.name as user_name,s.name as Source_name,fu.updated_at,fu.next_follow_up_name  from  clients c inner join users u on c.user_id=u.id inner join sources s on c.source_id=s.id inner join follow_up fu on fu.client_id=c.id) AS t2 ON t1.id = t2.id AND t1.updated_at < t2.updated_at WHERE t2.id IS NULL;"));
        
       // print_r($clientDetails);exit;
        
        return view('clients.other')->with('clientDetails',$clientDetails);
    }
    

}
