<?php

namespace App\Repositories\PatientHmo;

use App\Base\BaseRepository;
use App\PatientHmo;

class PatientHmoRepository extends BaseRepository implements PatientHmoRepositoryInterface
{
    protected $model;

    public function __construct(PatientHmo $hmo)
    {
        $this->model = $hmo;
    }
}
