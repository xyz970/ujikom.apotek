<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    function supplier() {
        return $this->hasMany(Supplier::class);
    }

    function customer() {
        return $this->hasMany(Supplier::class);
    }
}
