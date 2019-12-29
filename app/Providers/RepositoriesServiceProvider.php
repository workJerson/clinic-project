<?php

namespace App\Providers;

use App\Repositories\User\UserRepository;
use App\Base\BaseRepository;
use App\Base\BaseRepositoryInterface;
use App\Repositories\Region\RegionRepositoryInterface;
use App\Repositories\Region\RegionRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\Province\ProvinceRepositoryInterface;
use App\Repositories\City\CityRepository;
use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\HMO\HmoRepository;
use App\Repositories\HMO\HmoRepositoryInterface;
use App\Repositories\Patient\PatientRepository;
use App\Repositories\Patient\PatientRepositoryInterface;
use App\Repositories\PatientHmo\PatientHmoRepository;
use App\Repositories\PatientHmo\PatientHmoRepositoryInterface;
use App\Repositories\PatientServiceHistory\PatientServiceHistoryRepository;
use App\Repositories\PatientServiceHistory\PatientServiceHistoryRepositoryInterface;
use App\Repositories\PatientTransaction\PatientTransactionRepository;
use App\Repositories\PatientTransaction\PatientTransactionRepositoryInterface;
use App\Repositories\Personnel\PersonnelRepository;
use App\Repositories\Personnel\PersonnelRepositoryInterface;
use App\Repositories\Service\ServiceRepository;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\Service\ServiceTypeRepository;
use App\Repositories\Service\ServiceTypeRepositoryInterface;
use App\Repositories\ServiceRate\ServiceRateRepository;
use App\Repositories\ServiceRate\ServiceRateRepositoryInterface;
use App\Repositories\User\UserDetailsRepository;
use App\Repositories\UserDetails\UserDetailsRepositoryInterface;
use App\UserDetails;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RegionRepositoryInterface::class, RegionRepository::class);
        $this->app->bind(ProvinceRepositoryInterface::class, ProvinceRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(HmoRepositoryInterface::class, HmoRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(PatientHmoRepositoryInterface::class, PatientHmoRepository::class);
        $this->app->bind(PatientTransactionRepositoryInterface::class, PatientTransactionRepository::class);
        $this->app->bind(PatientServiceHistoryRepositoryInterface::class, PatientServiceHistoryRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(ServiceRateRepositoryInterface::class, ServiceRateRepository::class);
        $this->app->bind(ServiceTypeRepositoryInterface::class, ServiceTypeRepository::class);
        $this->app->bind(UserDetailsRepositoryInterface::class, UserDetailsRepository::class);
        $this->app->bind(PersonnelRepositoryInterface::class, PersonnelRepository::class);
    }
}
