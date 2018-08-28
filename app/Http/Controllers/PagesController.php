<?php
namespace App\Http\Controllers;

use DB;

use App\Repositories\Lead\LeadRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Models\Announcement;
use Auth;
use Session;

class PagesController extends Controller
{

    protected $users;
    protected $settings;
    protected $leads;

    public function __construct(
        UserRepositoryContract $users,
        SettingRepositoryContract $settings,
        LeadRepositoryContract $leads
    ) {
        $this->users = $users;
        $this->settings = $settings;
        $this->leads = $leads;
    }

    /**
     * Dashobard view
     * @return mixed
     */
    public function dashboard()
    {
        $getAllLeads = $this->leads->leadsBaseOnCompany();
        $user_id = \Auth::user()->id;
        $scrollText = Announcement::where('user_id',$user_id)->where('misclaneous1','Publish')->orderByDesc('created_at')->limit(1)->get();
              
        return view('pages.dashboard', compact('getAllLeads','scrollText'));
    }

    public function index()
    {
        if(Auth::check())
            return redirect('/dashboard');

        return view('pages.index');
    }
}
