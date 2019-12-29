<?php

namespace App;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class PatientTransaction extends Model
{
    use Filterable;

    protected $fillable = [];

    public function serviceHistory()
    {
        return $this->belongsTo(PatientServiceHistory::class, 'patient_service_history_id');
    }
}
