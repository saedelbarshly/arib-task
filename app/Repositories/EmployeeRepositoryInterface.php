<?php
namespace App\Repositories;

use App\Models\User;

interface EmployeeRepositoryInterface
{
    public function getData($filter);
    public function show($id);
    public function create(array $data);
    public function update(User $employee, array $data);
    public function delete(User $employee);

}