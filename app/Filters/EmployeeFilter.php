<?php

namespace App\Filters;

class EmployeeFilter extends Filters
{
    public $var_filters = ['query'];

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
}