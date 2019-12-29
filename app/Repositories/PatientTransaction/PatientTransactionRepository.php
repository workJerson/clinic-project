<?php

namespace App\Repositories\PatientTransaction;

use App\Base\BaseRepository;
use App\PatientTransaction;
use App\Repositories\PatientTransaction\PatientTransactionRepositoryInterface;

class PatientTransactionRepository extends BaseRepository implements PatientTransactionRepositoryInterface
{
    protected $model;

    public function __construct(PatientTransaction $patientTransaction)
    {
        $this->model = $patientTransaction;
    }
}
