<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class PatientHmo extends Model
{
    use Filterable;

    protected $fillable = [
        'hmo_id',
        'account_number',
        'patient_id',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function hmo()
    {
        return $this->belongsTo(HMO::class, 'hmo_id', 'id');
    }
}
