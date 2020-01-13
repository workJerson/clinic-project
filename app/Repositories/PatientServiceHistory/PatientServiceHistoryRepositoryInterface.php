<?php

namespace App\Repositories\PatientServiceHistory;

use App\Base\BaseRepositoryInterface;

interface PatientServiceHistoryRepositoryInterface extends BaseRepositoryInterface
{
    public function store(array $data);
}
