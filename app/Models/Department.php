<?php

namespace App\Models;

use App\Filters\DepartmentFilter;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];

    public function employees(): HasMany
    {
        return $this->hasMany(User::class);
    }

    
    public function scopeFilter($query, DepartmentFilter $filter)
    {
        return $filter->apply($query);
    }
}
