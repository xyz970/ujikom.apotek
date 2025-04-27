<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasUlids;
    protected $guarded = [];

    function customer() {
        return $this->belongsTo(Customer::class,'costumer_id');
    }
}

