<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillingAmount extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function getBillDetail()
    {
        return $this->belongsTo(BillingDetail::class, 'billing_detail_id');
    }
    public function products()
    {
        return $this->hasMany(OrderedProduct::class, 'billing_amount_id');
    }
}
