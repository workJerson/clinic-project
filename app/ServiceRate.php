<?php

namespace App;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class ServiceRate extends Model
{
    use Filterable;
    protected $fillable = [
        'total_rate',
        'h_m_o_id',
        'service_id',
    ];

    public function hmo()
    {
        return $this->belongsTo(HMO::class, 'h_m_o_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
