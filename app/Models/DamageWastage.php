<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DamageWastage extends Model
{
    protected $table = 'damage_wastages';

    protected $fillable = [
        'dw_no',
        'type',
        'branch_id',
        'sku_id',
        'dam_date',
        'qty',
        'cost_price',
        'total_amount',
        'status',
        'rank',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    
    public function sku()
    {
        return $this->belongsTo(Sku::class, 'sku_id');
    }

    /**
     * Get the user who created the stock.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
