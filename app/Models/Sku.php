<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $fillable = [
        'sku_code',
        'bar_code',
        'sku_name',
        'cost_price',
        'sell_price',
        'image',
        'sku_department_id',
        'sku_sub_department_id',
        'categorie_id',
        'brand_id',
        'supplier_id',
        'tax_id',
        'user_id',
        'negative_stock',
        'is_weighted',
        'case_count',
        'is_ecommerce',
        'is_featured',
        'is_sales',
        'is_parent',
        'specification',
        'shipping_payment',
        'description',
        'status',
        'rank',
    ];


       public function department()
       {
           return $this->belongsTo(SkuDepartment::class, 'sku_department_id');
       }

       public function subDepartment()
       {
           return $this->belongsTo(SkuSubDepartment::class, 'sku_sub_department_id');
       }

       public function category()
       {
           return $this->belongsTo(Category::class, 'categorie_id');
       }

       public function brand()
       {
           return $this->belongsTo(Brand::class, 'brand_id');
       }

       public function tax()
       {
           return $this->belongsTo(Tax::class, 'tax_id');
       }

       public function user()
       {
           return $this->belongsTo(User::class, 'user_id');
       }

       public function supplier()
       {
           return $this->belongsTo(Supplier::class, 'supplier_id');
       }

}
