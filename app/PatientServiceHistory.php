<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class PatientServiceHistory extends Model
{
    use Filterable;
    protected $fillable = [
        'patient_id',
        'patient_hmo_id',
        'personnel_id',
        'approval_code',
        'total_charges',
        'transaction_status',
        'discounted_charges',
        'discount_rate',
        'payment_type',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function patientHmo()
    {
        return $this->belongsTo(PatientHmo::class, 'patient_hmo_id');
    }
    public function transactions()
    {
        return $this->hasMany(PatientTransaction::class);
    }
    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'personnel_id');
    }
}
