<?php
namespace App\Http\Controllers;

use Session;
use App\Models\Department;
use App\Http\Requests;
use Datatables;
use App\Http\Requests\Department\StoreDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Repositories\Department\DepartmentRepositoryContract;

class DepartmentsController extends Controller
{

    protected $departments;

    /**
     * DepartmentsController constructor.
     * @param DepartmentRepositoryContract $departments
     */
    public function __construct(DepartmentRepositoryContract $departments)
    {
        $this->departments = $departments;
        $this->middleware('user.is.admin', ['only' => ['create', 'destroy']]);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $departmentsDetails = Department::all();

        return view('departments.index')->withDepartments($this->departments)
        ->with('departmentsDetails',$departmentsDetails);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * @param StoreDepartmentRequest $request
     * @return mixed
     */
    public function store(StoreDepartmentRequest $request)
    {
        $this->departments->create($request);
        $departmentsDetails = Department::all();

        $data['error'] = '';
        $data['html'] = view('departments.datatable')->with('departmentsDetails',$departmentsDetails)->render();
        $data['message'] = "Departments Added successfully.";
        return $data;
    }

    public function edit($id)
    {
        $department = Department::find($id);
        return view('departments.edit')->with('department',$department);
        
    }

     public function update($id, UpdateDepartmentRequest $request)
    {
        $this->departments->update($id, $request);
        $departmentsDetails = Department::all();

        $data['error'] = '';
        $data['html'] = view('departments.datatable')->with('departmentsDetails',$departmentsDetails)->render();
        $data['message'] = "Departments Updated successfully.";
        return $data;
    }


    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->departments->destroy($id);

        return back();
    }
}
