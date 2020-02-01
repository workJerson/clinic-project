<?php

namespace App;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use Filterable;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'title',
        'phone_number',
        'mobile_number',
        'city',
        'address',
        'zip_code',
        'image',
    ];

    public function searchable()
    {
        return [
            'first_name',
            'middle_name',
            'last_name',
            'title',
            'phone_number',
            'mobile_number',
            'city',
            'address',
            'zip_code',
        ];
    }

    public function patientServiceHistory()
    {
        return $this->hasMany(PatientServiceHistory::class);
    }
}
