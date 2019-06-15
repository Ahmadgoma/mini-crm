<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\EmployeeRequest;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Http\Controllers\Controller;

class EmployeesController extends Controller
{

    protected $repository , $companyRepository;

    public function __construct(EmployeeRepositoryInterface $repository, CompanyRepositoryInterface $companyRepository)
    {
        $this->repository = $repository;
        $this->companyRepository = $companyRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->repository->paginate(10 , ['id' , 'first_name' , 'last_name','email' ,'phone','created_at']);

        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = $this->companyRepository->all(['id','name']);
        return view('admin.employees.create' , compact('companies'));
    }

    /** Store a newly created resource in storage.
     * @param EmployeeRequest $request
     * @return $this
     */
    public function store(EmployeeRequest $request)
    {
        $employeeCreated =  $this->repository->create($request->all());

        if($employeeCreated){
            return redirect()->route('employees.index')->with('success', 'employee has been created Successfully');
        }
        return redirect()->route('employees.index')->with('error', 'Error in creating employee.');

    }

    /** view of employee data to update
     * @param employee $employee_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($employee_id)
    {
        $companies = $this->companyRepository->all(['id','name']);
        $employee = $this->repository->findOneOrFail($employee_id , ['id','first_name' , 'last_name' , 'email' , 'phone' , 'company_id']);
        return view('admin.employees.edit',compact('companies' , 'employee'));
    }

    /** update employee data after validation success
     * @param EmployeeRequest $request
     * @param $employee_id
     * @return $this
     */
    public function update(EmployeeRequest $request,$employee_id)
    {
        $isUpdated = $this->repository->update($employee_id ,
            $request->all()
        );

        if($isUpdated){
            return redirect()->route('employees.index')->with('success', 'employee has been updated Successfully');
        }
        return redirect()->route('employees.index')->with('error', 'No data has been updated of employee.');
    }

    /** remove employee by id
     * @param $id
     * @return $this
     */
    public function destroy($id)
    {
        $employeeDeleted = $this->repository->delete($id);

        if($employeeDeleted){
            return redirect()->route('employees.index')->with('success', 'employee has been deleted Successfully');
        }
        return redirect()->route('employees.index')->with('error', 'Error in deleting employee.');
    }
}
