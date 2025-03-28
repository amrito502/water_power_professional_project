<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkuSubDepartment extends Model
{

    protected $fillable = ['sku_department_id', 'name', 'status', 'rank'];

    public function department()
    {
        return $this->belongsTo(SkuDepartment::class, 'sku_department_id');
    }

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }
}
