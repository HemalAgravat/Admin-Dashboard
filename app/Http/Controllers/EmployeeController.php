<?php
namespace App\Http\Controllers;

use App\Http\Requests\ComUpdateRequest;
use App\Http\Requests\EmpStorePostRequest;
use App\Http\Requests\EmpUpdateRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    /**
     * Summary of index
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $employees = Employee::query();

        if ($request->ajax()) { // Corrected method call
            return DataTables::of($employees)
                ->addIndexColumn()
                ->addColumn(('company'), function (Employee $employee) {
                    return $employee->company->name;
                })
                ->addColumn("action", function ($row) {
                    $btn = "<a class='btn btn-sm btn-info' href=" . route("employees.show", $row->id) . "> View </a>";
                    $btn .= "<a  class='btn btn-sm btn-primary 'href=" . route("employees.edit", $row->id) . "> Edit </a>";
                    $btn .= '<form action="' . route('employees.destroy', $row->id) . '" method="POST" class="d-inline">
                        ' . method_field('DELETE') . csrf_field() . '
                        <button type="submit" class="delete btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this employee?\')"> Delete</button>
                    </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('employees.index');
    }

    /**
     * Summary of create
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        // Assuming you have a form to create a new employee
        $com = Company::all();
        return view('employees.create', compact('com'));
    }

    /**
     * Summary of store
     * @param \App\Http\Requests\EmpStorePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EmpStorePostRequest $request)
    {
        $validatedData = $request->validated();

        Employee::create($validatedData);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully!');
    }

    /**
     * Summary of edit
     * @param string $employee
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(string $employee, Request $request)
    {

        $companies = Company::all();
        $employee = Employee::find($employee);
        return view('employees.edit', compact('employee', 'companies'));
    }
    /**
     * Summary of show
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $employee = Employee::where('id', $id)->first();
        return view('employees.show', compact('employee'));
    }

    /**
     * Summary of update
     * @param \App\Http\Requests\EmpUpdateRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EmpUpdateRequest $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validated();

        // Find the employee to be updated
        $employee = Employee::findOrFail($id);

        // Check if the provided email already exists for another employee
        $existingEmployee = Employee::where('email', $validatedData['email'])
            ->where('id', '!=', $id)
            ->first();

        // If an employee with the same email exists and has a different ID,
        // then return with an error message
        if ($existingEmployee) {
            return redirect()->back()->withErrors(['email' => 'The email address is already taken.'])->withInput();
        }

        // Update the employee record
        $employee->update($validatedData);

        return redirect()->route('employees.index')->with('edit', 'Employee updated successfully!');
    }

    /**
     * Summary of destroy
     * @param mixed $employee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($employee)
    {
        $employee = Employee::find($employee);
        $employee->delete();

        return redirect()->back()->with('delete', 'Employee deleted successfully!');
    }
}
