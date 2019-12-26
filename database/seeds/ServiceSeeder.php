<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $services = [
            // Basic PT Package
            [
                'id' => 1,
                'name' => '(1-2 areas)',
                'service_type_id' => 1,
            ],
            [
                'id' => 2,
                'name' => '(3-4 areas)',
                'service_type_id' => 1,
            ],
            [
                'id' => 3,
                'name' => '(5-6 areas)',
                'service_type_id' => 1,
            ],
            [
                'id' => 4,
                'name' => '(7-8 areas)',
                'service_type_id' => 1,
            ],
            [
                'id' => 5,
                'name' => '(9-10 areas)',
                'service_type_id' => 1,
            ],
            //Additional Services
            [
                'id' => 6,
                'name' => 'Advanced Therapeutic Exercise',
                'service_type_id' => 2,
            ],
            [
                'id' => 7,
                'name' => 'Lumbar/Cervical Traction',
                'service_type_id' => 2,
            ],
            [
                'id' => 8,
                'name' => 'Treadmill',
                'service_type_id' => 2,
            ],
            [
                'id' => 9,
                'name' => 'Upright Exercise Bike',
                'service_type_id' => 2,
            ],
            [
                'id' => 10,
                'name' => 'IASTM only',
                'service_type_id' => 2,
            ],
            [
                'id' => 11,
                'name' => 'as add on IASTM',
                'service_type_id' => 2,
            ],
            [
                'id' => 12,
                'name' => 'Kinesiotape Application',
                'service_type_id' => 2,
            ],
            [
                'id' => 13,
                'name' => 'Shockwave Therapy',
                'service_type_id' => 2,
            ],
            [
                'id' => 14,
                'name' => 'High Intensity Laser Therapy',
                'service_type_id' => 2,
            ],
            [
                'id' => 15,
                'name' => 'EECP',
                'service_type_id' => 2,
            ],
            //Special Consultations
            [
                'id' => 16,
                'name' => 'Orthopedic Surgeon (Spine & Sports)',
                'service_type_id' => 3,
            ],
            [
                'id' => 17,
                'name' => 'Rehabilitation Medicine',
                'service_type_id' => 3,
            ],
        ];

        foreach ($services as $key => $value) {
            $serviceData = Service::firstOrCreate(['id' => $value['id']], $value);

            if (!$serviceData->wasRecentlyCreated) {
                $serviceData->update(array_only($value, ['name']));
            }
        }
    }
}
