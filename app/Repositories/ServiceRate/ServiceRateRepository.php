<?php

namespace App\Repositories\ServiceRate;

use App\Base\BaseRepository;
use App\ServiceRate;

class ServiceRateRepository extends BaseRepository implements ServiceRateRepositoryInterface
{
    protected $model;

    /**
     * ArticlesRepository constructor.
     *
     * @param Article $article
     */
    public function __construct(ServiceRate $serviceRate)
    {
        $this->model = $serviceRate;
    }
}
