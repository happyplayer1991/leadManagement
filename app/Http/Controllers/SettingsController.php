<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use Auth;
use Session;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Taxs;
use App\Models\Company;
use App\Models\Currency;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\Role\RoleRepositoryContract;
use App\Http\Requests\Setting\UpdateSettingOverallRequest;
use App\Models\Announcement;

class SettingsController extends Controller
{
    protected $settings;
    protected $roles;

    /**
     * SettingsController constructor.
     * @param SettingRepositoryContract $settings
     * @param RoleRepositoryContract $roles
     */
    public function __construct(
        SettingRepositoryContract $settings,
        RoleRepositoryContract $roles
    )
    {
        $this->settings = $settings;
        $this->roles = $roles;
        $this->middleware('user.is.admin', ['only' => ['index']]);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $company_id =  \Auth::user()->company_id;

        $products = Product::select('*')->where('company_id',$company_id)->get();

        $taxs = Taxs::where('company_id',$company_id)->get();
        $user_id = \Auth::user()->id;
        $scrollText = Announcement::where('user_id',$user_id)->where('misclaneous1','Publish')->orderByDesc('created_at')->limit(1)->get();
        $currency = Currency::all();
        $c = Company::where('company_id',$company_id)->limit(1)->get();

        return view('layouts.settings')
                ->with('products',$products)
                ->with('taxs',$taxs)
                ->withSettings($this->settings->getSetting())
                ->withPermission($this->roles->allPermissions())
                ->withRoles($this->roles->allRoles())
                ->with('scrollText',$scrollText)
                ->with('currency',$currency)
                ->with('c',$c);
    }

    /**
     * @param UpdateSettingOverallRequest $request
     * @return mixed
     */
    public function updateOverall(UpdateSettingOverallRequest $request)
    {
        $this->settings->updateOverall($request);

        Session::flash('flash_message', 'Overall settings successfully updated');
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function permissionsUpdate(Request $request)
    {
        $this->roles->permissionsUpdate($request);

        Session::flash('flash_message', 'Role is updated');
        return redirect()->back();
    }

    public function updateCustomSettings(Request $request) {
        Session::put('logo_img', $this->settings->updateCustom($request));

        Session::flash('flash_message', 'Logo is updated.');
        return redirect()->back();
    }
}
