<?php

namespace App\Repositories\User;

use App\Base\BaseRepository;
use App\Repositories\UserDetails\UserDetailsRepositoryInterface;
use App\UserDetails;

class UserDetailsRepository extends BaseRepository implements UserDetailsRepositoryInterface
{
    protected $model;

    /**
     * UserDetailsRepository constructor.
     * @param Article $article
     */
    public function __construct(UserDetails $user)
    {
        $this->model = $user;
    }
}
