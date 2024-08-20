<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Department;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use App\Filters\EmployeeFilter;
use App\Services\EmployeeService;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    use ImageTrait;

    public function __construct(
        protected EmployeeService $employeeService
      ) {
      }

    public function index()
    {
        return view('employee.index');
    }


    public function data(EmployeeFilter $filter)
    {
        $employees = $this->employeeService->getData($filter);
        $data = view('employee.data_table', compact('employees'))->render();
        $links = $employees->links()->render();
        return response()->json([
            'data' => $data,
            'links' => $links
        ]);
    }

    public function show($id)
    {
        $employee = $this->employeeService->showTasks($id);
        return view('employee.show', compact('employee'));

    }

    public function create()
    {
        $departments = Department::all(); 
        return view('employee.create',compact('departments'));
    }

    public function store(EmployeeRequest $request)
    {
        try {
            $this->employeeService->createEmployee($request);
            return redirect()->route('employee.index')->with('success','Employee created successfully');
        } catch (\Throwable $th) {
            return redirect()->route('employee.index')->with('faild','Tray again later');
        }
    }

    public function edit(User $employee)
    {   
        $nameParts = explode(' ', $employee->name);
        $first_name = $nameParts[0];
        $last_name = isset($nameParts[1]) ? $nameParts[1] : ''; 
        $departments = Department::all();
        return view('employee.edit',compact('employee','departments','first_name','last_name'));
    }

    public function update(EmployeeRequest $request,User $employee)
    {
        try {
            $this->employeeService->updateEmployee($request, $employee);
            return redirect()->route('employee.index')->with('success','Employee updated successfully');
        } catch (\Throwable $th) {
            return redirect()->route('employee.index')->with('faild','Tray again later');
        }
    }


    public function delete(User $employee)
    {
        try {
            $this->employeeService->deleteEmployee($employee);
            return redirect()->route('employee.index')->with('success','Employee deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->route('employee.index')->with('faild','Tray again later');
        }
    }

    public function myTasks()
    {
        $employee = auth()->user();
        return view('employee.mytasks',compact('employee'));
    }

    public function changeTaskStatus(Task $task,Request $request)
    {
        $task->update([
           'status' => $request->status
        ]);
        return redirect()->back()->with('success','Task status changed successfully');
    }
}
