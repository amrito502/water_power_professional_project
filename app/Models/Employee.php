<?php

namespace App\Models;

use App\Models\Shift;
use App\Models\Department;
use App\Models\Designation;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_id', 'first_name', 'last_name', 'gender', 'date_of_birth', 'nationality', 'marital_status',
        'phone_number', 'email', 'emergency_contact_number', 'address', 'job_title', 'date_of_joining',
        'work_location', 'basic_salary', 'bank_name', 'account_number', 'ifsc_code', 'tax_id',
        'user_id', 'shift_id', 'department_id', 'designation_id', 'role_id', 'image', 'status'
    ];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
