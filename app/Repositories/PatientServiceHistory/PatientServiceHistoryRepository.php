<?php

namespace App\Repositories\PatientServiceHistory;

use App\Base\BaseRepository;
use App\PatientServiceHistory;

class PatientServiceHistoryRepository extends BaseRepository implements PatientServiceHistoryRepositoryInterface
{
    protected $model;

    public function __construct(PatientServiceHistory $patientServiceHistory)
    {
        $this->model = $patientServiceHistory;
    }
}
