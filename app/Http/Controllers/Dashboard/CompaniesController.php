<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\CompanyRequest;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Traits\UploadFiles;
use App\Http\Controllers\Controller;

class CompaniesController extends Controller
{

    use UploadFiles;
    protected $repository;

    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = $this->repository->paginate(10, ['id', 'name', 'email', 'website', 'created_at']);

        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CompanyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {

        $data = $request->all();
        // Check if a profile image has been uploaded
        if ($request->has('logo')) {
            $companyLogo = $request->file('logo');
            $companyLogoName = $request->file('logo') . time() . uniqid();
            // Upload image
            $logo = $this->storeFileAs(
                $companyLogo,
                '/',
                $companyLogoName
            );
            $data['logo'] = $logo;
        }

        $CompanyCreated = $this->repository->create($data);

        if ($CompanyCreated) {
            return redirect()->route('companies.index')->with('success', 'Company has been created Successfully');
        }
        return redirect()->route('companies.index')->with('error', 'Error in creating Company.');

    }

    /**  view of company data to update
     * @param $company_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($company_id)
    {
        $company = $this->repository->findOneOrFail($company_id, ['id', 'name', 'logo', 'email', 'website']);
        return view('admin.companies.edit', compact('company'));
    }

    /** Update company data after validation success
     * @param CompanyRequest $request
     * @param $company_id
     * @return $this
     */
    public function update($company_id ,CompanyRequest $request )
    {
        $data = $request->all();
        // Check if a profile image has been uploaded
        if ($request->has('logo') && isset($request->logo)) {
            $companyLogo = $request->file('logo');
            $companyLogoName = $request->file('logo') . time() . uniqid();
            // Upload image
            $logo = $this->updateFileAs(
                $companyLogo,
                '/',
                $companyLogoName,
                $request->old_logo,
                true
            );
            $data['logo'] = $logo;
        }

        $isUpdated = $this->repository->update($company_id, $data);

        if ($isUpdated) {
            return redirect()->route('companies.index')->with('success', 'Company has been updated Successfully');
        }
        return redirect()->route('companies.index')->with('error', 'No data has been updated of Company.');

    }

    /** Remove company by id.
     * @param $id
     * @return $this
     */
    public function destroy($id)
    {
        $CompanyDeleted = $this->repository->delete($id);

        if ($CompanyDeleted) {
            return redirect()->route('companies.index')->with('success', 'Company has been deleted Successfully');
        }
        return redirect()->route('companies.index')->with('error', 'Error in deleting Company.');
    }
}
