<?php

namespace App;

use App\Traits\Filterable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use Filterable;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'city',
        'address',
        'zip_code',
        'home_phone_number',
        'mobile_number',
        'email_address',
        'birth_date',
        'gender',
        'civil_status',
        'occupation',
        'contact_person',
        'contact_person_number',
        'senior_id',
    ];

    public function searchable()
    {
        return [
            'first_name',
            'middle_name',
            'last_name',
            'city',
            'address',
            'zip_code',
            'home_phone_number',
            'mobile_number',
            'email_address',
            'birth_date',
            'gender',
            'civil_status',
            'occupation',
            'contact_person',
            'contact_person_number',
            'senior_id',
        ];
    }

    public function serviceHistories()
    {
        return $this->hasMany(PatientServiceHistory::class);
    }

    public function hmos()
    {
        return $this->hasMany(PatientHmo::class);
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = Carbon::parse($value);
    }
}
