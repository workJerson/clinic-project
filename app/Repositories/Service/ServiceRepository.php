<?php

namespace App\Repositories\Service;

use App\Base\BaseRepository;
use App\Service;

class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    protected $model;

    /**
     * ArticlesRepository constructor.
     *
     * @param Article $article
     */
    public function __construct(Service $service)
    {
        $this->model = $service;
    }
}
