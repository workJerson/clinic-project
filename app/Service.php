<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class Service extends Model
{
    use Filterable;

    protected $fillable = [];

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }
}
