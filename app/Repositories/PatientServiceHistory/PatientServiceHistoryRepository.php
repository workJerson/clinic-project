<?php

namespace App\Repositories\PatientServiceHistory;

use App\Base\BaseRepository;
use App\PatientServiceHistory;
use Exception;

class PatientServiceHistoryRepository extends BaseRepository implements PatientServiceHistoryRepositoryInterface
{
    protected $model;
    protected $_REQUEST;
    protected $message;
    public function __construct(PatientServiceHistory $patientServiceHistory)
    {
        $this->model = $patientServiceHistory;
    }

    public function store(array $data)
    {
        if ($this->preStoringCheck($data)) {
            return $this->create($data);
        } else {
            return [
                'error' => $this->message,
            ];
        }
    }

    public function preStoringCheck($data)
    {
        // List of validations before creating Patient Service History
        $flag = false;

        if (!$this->hasPendingService($data)) {
            $this->message = 'Patient has a pending transaction';
            return $flag;
        }

        return true;
    }

    public function hasPendingService($data)
    {
        return $this->model
            ->where('patient_id', $data['patient_id'])
            ->where('transaction_status', 1)
            ->count('id') <= 0;
    }
}
