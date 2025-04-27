<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineFormType extends Model
{
    protected $guarded = [];

    function medicine() {
        return $this->hasMany(Medicine::class);
    }
}
