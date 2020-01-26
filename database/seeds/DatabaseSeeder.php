<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);

        //Transactional
        $this->call(ServiceTypeSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(HMOSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
