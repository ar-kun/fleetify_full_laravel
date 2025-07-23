<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::latest()
            ->when(request('search'), function ($query) {
                $query->where('department_name', 'like', '%'.request('search').'%');
            })
            ->paginate(5);

        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        try {
            Department::create($request->validated());

            return redirect()->route('departments.index')->with('success', 'Department created successfully.');
        } catch (\Throwable $th) {
            Log::error('Failed to create department', ['exception' => $th]);

            return redirect()->back()->withErrors(['error' => 'Failed to create department. Please try again later.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        try {
            $department->update($request->validated());

            return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
        } catch (\Throwable $th) {
            Log::error('Failed to update department: '.$th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors(['error' => 'Failed to update department. Please try again later.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        try {
            $department->delete();

            return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
        } catch (\Throwable $th) {
            Log::error('Failed to delete department', ['exception' => $th]);

            return redirect()->back()->withErrors(['error' => 'Failed to delete department. Please try again later.']);
        }
    }
}
