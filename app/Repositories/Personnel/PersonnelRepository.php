<?php

namespace App\Repositories\Personnel;

use App\Base\BaseRepository;
use App\Personnel;

class PersonnelRepository extends BaseRepository implements PersonnelRepositoryInterface
{
    protected $model;

    public function __construct(Personnel $hmo)
    {
        $this->model = $hmo;
    }
}
