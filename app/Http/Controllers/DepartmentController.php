<?php

namespace App\Http\Controllers;

use App\Filters\DepartmentFilter;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('department.index');
    }

    public function data(DepartmentFilter $filter)
    {
        $departments = Department::filter($filter)->get();
        return view('department.data_table',compact('departments'));
    }

    public function create(){
        return view('department.create');
    }

    public function store(DepartmentRequest $request){
        try {
            Department::create([
                'name' => $request->name,
            ]);
            return redirect()->route('department.index')->with('success','Department created successfully');
        } catch (\Throwable $th) {
            return redirect()->route('department.index')->with('faild','Tray again later');
        }
    }

    public function edit(Department $department)
    {
        return view('department.edit',compact('department'));
    }

    public function update(DepartmentRequest $request,Department $department)
    {
        try {
            $department->update([
                'name' => $request->name,
            ]);
            return redirect()->route('department.index')->with('success','Department updated successfully');
        } catch (\Throwable $th) {
            return redirect()->route('department.index')->with('faild','Tray again later');
        }
    }

    public function delete(Department $department)
    {
        try {
            $department->delete();
            return redirect()->route('department.index')->with('success','Department deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->route('department.index')->with('faild','Tray again later');
        }
       
    }
}
