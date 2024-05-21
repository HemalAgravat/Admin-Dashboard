<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComUpdateRequest;
use App\Http\Requests\StorePostRequest;
use App\Mail\WelcomeEmail;
use App\Mail\WelcomeMail;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use app\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class CompanyController extends Controller
{
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $companies = Company::withTrashed()->paginate(10);// Paginate the companies, with 10   companies per page
        $com = $companies->firstItem();
        return view('companies.index', compact('companies', 'com'));
    }

    /**
     * Summary of create
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {

        return view('companies.create');
    }

    /**
     * Summary of store
     * @param \App\Http\Requests\StorePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePostRequest $request)
    {
        // Validate the request data
        $validator = $request->validated();
        $existingNameCompany = Company::where('name', $validator['name'])
            ->first();
        if ($existingNameCompany) {
            return redirect()->back()->withErrors(['name' => 'The company name is already taken.'])->withInput();
        }
        $filestore = 'logo' . time() . '.' . $request->logo->getClientOriginalExtension();
        $request->logo->storeAs('public/logo', $filestore);


        $validator['logo'] = $filestore; // Store the filename in the 'logo' column
        Company::create($validator);


        $mailData = [
            'name' => $validator['name'],
            'email' => $validator['email'],
        ];
        Mail::to($validator['email'])->send(new WelcomeEmail($mailData));

        return redirect()->route('companies.index')->with('success', 'Company added successfully');

    }

    /**
     * Summary of show
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $company = DB::table('companies')
            ->join('employees', 'companies.id', '=', 'employees.company_id')
            ->where('company_id', $id)
            ->where('employees.deleted_at', null)
            ->get();
        return view('companies.show', compact('company'));

    }

    /**
     * Summary of edit
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    /**
     * Summary of update
     * @param \App\Http\Requests\ComUpdateRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ComUpdateRequest $request, $id)
    {
        $validator = $request->validated();
        $company = Company::findOrFail($id);
        $existingCompany = Company::where('email', $validator['email'])
            ->where('id', '!=', $id)
            ->first();

        // If an employee with the same email exists and has a different ID,
        // then return with an error message
        if ($existingCompany) {
            return redirect()->back()->withErrors(['email' => 'The email address is already taken.'])->withInput();
        }

        // Validation may be added here
        if ($request->hasFile('logo')) {
            $filestore = 'logo' . time() . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->storeAs('public/logo', $filestore);
            $validator['logo'] = $filestore;
        }
        // Store the filename in the 'logo' column
        $company->update($validator);
        return redirect()->route('companies.index')->with('edit', 'Company updated successfully');
    }

    /**
     * Summary of destroy
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        $company->status = 'inactive';
        $company->save();
        return redirect()->back()->with('delete', 'Company Deleted successfully');
    }

    /**
     * Summary of showTrashedCompanies
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showTrashedCompanies($id)
    {
        $company = Company::withTrashed()->findOrFail($id);
        $company->restore();
        $company->status = 'active';
        $company->save();
        return redirect()->back()->with('Restore', 'Company Restore successfully');
    }
}
