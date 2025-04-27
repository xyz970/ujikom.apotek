<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasUlids;
    
    protected $guarded = [];
    protected $with = ['supplier','medicine_form_type'];
    
    function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    function medicine_form_type() {
        return $this->belongsTo(MedicineFormType::class);
    }
}
