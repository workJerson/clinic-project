<?php

namespace App\Repositories\Patient;

use App\Base\BaseRepository;
use App\Patient;

class PatientRepository extends BaseRepository implements PatientRepositoryInterface
{
    protected $model;

    /**
     * PatientRepository constructor.
     *
     * @param Article $article
     */
    public function __construct(Patient $patient)
    {
        $this->model = $patient;
    }
}
