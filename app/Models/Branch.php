<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'branchIdPrefix',
        'name',
        'addressline',
        'city',
        'postalcode',
        'phone',
        'fax',
        'email',
        'vatrn',
        'status',
        'isDefault',
        'isDueInvoice',
        'isSpecialDiscount',
        'isInstantDiscount',
    ];
}
