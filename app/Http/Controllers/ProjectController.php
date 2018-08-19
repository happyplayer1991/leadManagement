<?php
namespace App\Http\Controllers;
use Input;
use Mail;
use Session;
use Config;
use Dinero;
use Datatables;
use App\Models\Project;
use App\Models\Source;
use App\Models\FollowUp;
use App\Models\State;
use App\Models\Note;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Client\ClientRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use DB;


class ProjectsController extends Controller

{
    public function index()
    {
        return view('projects.index');

    }
}