<?php

namespace App;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use Filterable;

    protected $fillable = [];
}
