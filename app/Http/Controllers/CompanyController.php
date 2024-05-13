<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $companies = Company::paginate(10);// Paginate the companies, with 10   companies per page
        $com=$companies->firstItem();
        return view('companies.index', compact('companies','com'));
    }

    public function create()
    {
        
        return view('companies.create');
    }

    public function store(Request $request)
    {
         // Validate the request data
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:companies',
        'logo' => 'required|image|mimes:jpeg,png,jpg|dimensions:min_width=100,min_height=100', // Adjust maximum file size as needed
        'website' => 'nullable|url|max:255',
        'status' => 'required|in:active,inactive',
        'created_Date' => 'required|date',
    ]);

    // If validation fails, return the validation errors
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
        // Validation may be added here

        $filestore = 'logo' . time() . '.' . $request->logo->getClientOriginalExtension();
        $request->logo->storeAs('public/logo', $filestore);

        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo = $filestore; // Store the filename in the 'logo' column
        $company->website = $request->website;
        $company->status = $request->status;
        $company->save();
        
        $mailData = [
            'name' => $company->name,
            'email' => $company->email,
        ];
        Mail::to($company->email)->send(new WelcomeEmail($mailData));
        return redirect()->route('companies.index')->with('success', 'Company added successfully');
        
    }

    public function show($id)
{
    $company = DB::table('companies')
    ->join('employees','companies.id','=','employees.company_id')
    ->where('company_id', $id)
    ->get();
    return view('companies.show', compact('company'));

}

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->name = $request->name;
        $company->email = $request->email;
        // Validation may be added here
        if ($request->hasFile('logo')) {
            $filestore = 'logo' . time() . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->storeAs('public/logo', $filestore);
            $company->logo = $filestore;
        }
        // Store the filename in the 'logo' column
        $company->website = $request->website;
        $company->status = $request->status;
        $company->update();

        return redirect()->route('companies.index')->with('edit', 'Company updated successfully');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        $company->status = 'inactive';
        $company->save();
        return redirect()->route('companies.index')->with('delete', 'Company Deleted successfully');
    }
}
