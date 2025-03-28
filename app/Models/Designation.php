<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = [
        'name',
        'department_id',
        'status'
    ];

    /**
     * Get the department the designation belongs to.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
