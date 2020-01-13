<?php

namespace App;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class PatientTransaction extends Model
{
    use Filterable;

    protected $fillable = [
        'patient_service_history_id',
        'service_id',
        'service_rate_id',
    ];

    public function serviceHistory()
    {
        return $this->belongsTo(PatientServiceHistory::class, 'patient_service_history_id');
    }
    public function rate()
    {
        return $this->belongsTo(ServiceRate::class, 'service_rate_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
