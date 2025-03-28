<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = [
        'branch_id', 'name', 'addressline', 'city', 'postalcode', 'phone', 'fax', 'email', 'vatrn', 'status', 
        'is_default', 'is_due_invoice', 'is_special_discount', 'is_instant_discount'
    ];

    // Define the relationship between Zone and Branch
    public function branch()
    {
        return $this->belongsTo(Branch::class); // Each zone belongs to one branch
    }
}
