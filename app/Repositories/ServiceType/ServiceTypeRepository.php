<?php

namespace App\Repositories\Service;

use App\Base\BaseRepository;
use App\ServiceType;

class ServiceTypeRepository extends BaseRepository implements ServiceTypeRepositoryInterface
{
    protected $model;

    /**
     * ArticlesRepository constructor.
     *
     * @param Article $article
     */
    public function __construct(ServiceType $serviceType)
    {
        $this->model = $serviceType;
    }
}
