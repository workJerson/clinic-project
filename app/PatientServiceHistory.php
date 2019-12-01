<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class PatientServiceHistory extends Model
{
    use Filterable;
    protected $fillable = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
