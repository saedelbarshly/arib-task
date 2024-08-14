<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getData($filter)
    {
        return User::where('manager_id', auth()->user()->id)->filter($filter)->get();
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(User $employee, array $data)
    {
        return $employee->update($data);
    }
    
    public function delete(User $employee)
    {
        return $employee->delete();
    }
}