<?php

namespace App;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use Filterable;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'title',
        'birth_date',
        'phone_number',
        'mobile_number',
        'city',
        'address',
        'zip_code',
        'image',
        'user_id',
    ];

    /**
     *
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
