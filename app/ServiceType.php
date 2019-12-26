<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class ServiceType extends Model
{
    use Filterable;

    protected $fillable = [
        'name',
        'status',
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
