<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('department')
            ->when(request('search'), function ($query) {
                $query->where('name', 'like', '%'.request('search').'%');
            })
            ->latest()->paginate(5);

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();

        return view('employees.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        try {
            $data = $request->validated();
            $data['employee_id'] = 'EMP-'.Str::random(10);
            Employee::create($data);

            return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
        } catch (\Throwable $th) {
            Log::error('Failed to create employee', ['exception' => $th]);

            return redirect()->back()->withErrors(['error' => 'Failed to create employee. Please try again later.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $departments = Department::all();

        return view('employees.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        try {
            $data = $request->validated();
            $employee->update($data);

            return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
        } catch (\Throwable $th) {
            Log::error('Failed to update employee', ['exception' => $th]);

            return redirect()->back()->withErrors(['error' => 'Failed to update employee. Please try again later.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();

            return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
        } catch (\Throwable $th) {
            Log::error('Failed to delete employee', ['exception' => $th]);

            return redirect()->back()->withErrors(['error' => 'Failed to delete employee. Please try again later.']);
        }
    }
}
