<?php

namespace App\Repositories\HMO;

use App\Base\BaseRepository;
use App\Repositories\Patient\PatientRepositoryInterface;
use App\HMO;

class HmoRepository extends BaseRepository implements PatientRepositoryInterface
{
    protected $model;

    public function __construct(HMO $hmo)
    {
        $this->model = $hmo;
    }
}
