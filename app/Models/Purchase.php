<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasUlids;
    protected $guarded = [];

    function supplier() {
        return $this->belongsTo(Supplier::class);
    }
}
