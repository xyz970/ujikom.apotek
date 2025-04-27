<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasUlids;
    protected $keyType = 'string';
    protected $with = ['city'];
    protected $guarded = [];

    function city() {
        return $this->belongsTo(City::class);
    }

    function medicine() {
        return $this->hasMany(Medicine::class);
    }

    function purchase() {
        return $this->hasMany(Purchase::class);
    }
}
