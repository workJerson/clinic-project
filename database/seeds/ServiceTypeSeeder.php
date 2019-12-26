<?php

use Illuminate\Database\Seeder;
use App\ServiceType;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $serviceTypes = [
            [
                'id' => 1,
                'name' => 'Basic PT Package',
            ],
            [
                'id' => 2,
                'name' => 'Additional Services',
            ],
            [
                'id' => 3,
                'name' => 'Special Consultations',
            ],
        ];

        foreach ($serviceTypes as $key => $value) {
            $serviceTypeData = ServiceType::firstOrCreate(['id' => $value['id']], $value);

            if (!$serviceTypeData->wasRecentlyCreated) {
                $serviceTypeData->update(array_only($value, ['name']));
            }
        }
    }
}
