<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class HMO extends Model
{
    use Filterable;
    protected $fillable = [
       'name',
       'status',
   ];

    public function patientHmo()
    {
        return $this->hasMany(PatientHmo::class);
    }
}
