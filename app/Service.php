<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class Service extends Model
{
    use Filterable;

    protected $fillable = [
        'name',
        'status',
        'service_type_id',
    ];

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }
}
