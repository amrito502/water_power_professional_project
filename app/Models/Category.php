<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['sku_sub_department_id', 'name', 'status', 'rank'];

    public function subDepartment()
    {
        return $this->belongsTo(SkuSubDepartment::class, 'sku_sub_department_id');
    }

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }
}
