<?php

namespace App\Models;

use App\Filters\TaskFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name','status','employee_id'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function scopeFilter($query, TaskFilter $filter)
    {
        return $filter->apply($query);
    }

}
