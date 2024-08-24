<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function getEmployeeDependonDepartment()
    {
        $departments = Department::get();
        return view('support.index',compact('departments'));
    }
}
