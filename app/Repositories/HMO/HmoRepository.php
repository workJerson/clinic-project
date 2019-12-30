<?php

namespace App\Repositories\HMO;

use App\Base\BaseRepository;
use App\HMO;

class HmoRepository extends BaseRepository implements HmoRepositoryInterface
{
    protected $model;

    public function __construct(HMO $hmo)
    {
        $this->model = $hmo;
    }
}
