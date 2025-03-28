<?php

namespace App\Models;

use App\Models\User;
use App\Models\Customer;
use App\Models\SalesInvoiceItem;
use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    protected $fillable = [
        'invoice_no', 'customer_id', 'invoice_date', 'total_quantity',
        'total_tax', 'total_discount', 'total_amount', 'sub_total',
        'net_amount', 'instant_discount', 'transport_cost',
        'remarks', 'created_by', 'updated_by'
    ];

    // Customer Relationship
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Invoice Items Relationship (One-to-Many)
    public function items()
    {
        return $this->hasMany(SalesInvoiceItem::class);
    }

    // Created By Relationship
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Updated By Relationship
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
