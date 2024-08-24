<?php

namespace App\Http\Controllers;

use App\Filters\EmployeeFilter;
use App\Models\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getEmployee(EmployeeFilter $employeeFilter)
    {
        $employees = User::select('id','name')->filter($employeeFilter)->get();
        return response()->json($employees, 200);
    }
}
