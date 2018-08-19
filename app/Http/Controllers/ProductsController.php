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
use App\Models\Company;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Client\ClientRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;

use DB;
use App\Repositories\Product\ProductRepositoryContract;

class ProductsController extends Controller
{


    protected $product;
    protected $users;
    protected $clients;
    protected $settings;

    public function __construct(
        ProductRepositoryContract $product,
        UserRepositoryContract $users,
        ClientRepositoryContract $clients,
        SettingRepositoryContract $settings
    )
    {
        $this->product = $product;
        $this->users = $users;
        $this->clients = $clients;
        $this->settings = $settings;
//        $this->middleware('client.create', ['only' => ['create']]);
//        $this->middleware('client.update', ['only' => ['edit']]);
    }


    
    public function index(){

        $company_id =  \Auth::user()->company_id;

        $products = Product::select('*')->where('company_id',$company_id)->get();

       // return view('product.index')->with('products',$products);

        return view('product.index')->with('products',$products);
       
    }

    public function create(){
        return View('product.create');
    }

    public function store(Request $request){
        
 /*   $company_id =  \Auth::user()->company_id;

    $product_exist = Product::select('*')->where('company_id',$company_id)->where('product_name',$request->product_name)->where('description',$request->description)->get();

    $product_exist = $product_exist->toArray();

    $products = Product::select('*')->where('company_id',$company_id)->get();
    if(empty($product_exist)) {
        print_r('new');die();
        $value = $this->product->create($request);
        $data['error'] = '';
        $data['html'] = view('product.datatable')->with('products',$products)->render();
        $data['message'] = "Products Added successfully.";
        return $data;
    } else {
        print_r('existed');die();
        $data['error'] = 'Product Already Existed';
        // $data['html'] = view('product.datatable')->with('products',$products)->render();
        // $data['message'] = "";
        return $data;
    }*/

        $company_id =  \Auth::user()->company_id;
        $product_data = Product::where('product_name',$request->product_name)->where('company_id',$company_id)->get();
        $products = Product::select('*')->where('company_id',$company_id)->get();
        $c = Company::where('company_id',$company_id)->get();

        if(count($product_data)>0){
            $data['error'] = "product exists";
            $data['html'] = view('product.datatable')->with('products',$products)->with('c',$c)->render();
            $data['message'] = "";
            return $data;

        }else{
             $value = $this->product->create($request);
            $data['error'] = '';
            $data['html'] = view('product.datatable')->with('products',$products)->with('c',$c)->render();
            $data['message'] = "Products Added successfully.";
            return $data; 
        }

        
    }


    public function edit($id)
    {
      
       $product = Product::findOrFail($id);
        $type = 'edit';
    
        return view('product.edit')
            ->with('product',$product)->withClient($this->clients->find($id));
    }


    public function update($id,Request $request){


        $product_data = Product::find($id);
        $product_data->product_name = $request->product_name;
        $product_data->price = $request->price;
        $product_data->description =$request->description;
        $product_data->save();

        $company_id =  \Auth::user()->company_id;

        $products = Product::select('*')->where('company_id',$company_id)->get();
        $c = Company::where('company_id',$company_id)->limit(1)->get();
        $data['error'] = '';
        $data['html'] = view('product.datatable')->with('products',$products)->with('c',$c)->render();
        $data['message'] = "Products Updated successfully.";
        return $data;

    }
    
    public function destroy($id) {
        $product = Product::findOrFail($id);
        $product->delete();
        Session()->flash('flash_message', 'Product Successfully deleted');
        return back();
    }
    

}
