<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillingDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function amount()
    {
        return $this->hasOne(BillingAmount::class, 'billing_detail_id');
    }
}
