<?php

namespace App\Filters;

class DepartmentFilter extends Filters
{
    public $var_filters = ['query'];

    public function query($query)
    {
        $query = str_replace(" ", "%", $query);
        return $this->builder->where('name', 'like' , "%$query%");
    }
}