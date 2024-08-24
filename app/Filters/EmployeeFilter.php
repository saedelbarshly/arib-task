<?php

namespace App\Filters;

class EmployeeFilter extends Filters
{
    public $var_filters = ['query','departmentId'];

    public function query($query)
    {
        $query = str_replace(" ", "%", $query);
        return $this->builder->whereAny([
            'name',
            'email',
            'phone',
            'salary',
        ], 'like' , "%$query%");
    }

    public function departmentId($departmentId)
    {
        return $this->builder->where('department_id', $departmentId);
    }
}