<?php

use Illuminate\Database\Seeder;
use App\HMO;

class HMOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $hmo = [
            [
                'id' => 1,
                'name' => 'COCOLIFE',
            ],
            [
                'id' => 2,
                'name' => 'ETIQA',
            ],
            [
                'id' => 3,
                'name' => 'INTELLICARE',
            ],
            [
                'id' => 4,
                'name' => 'VALUCARE',
            ],
            [
                'id' => 5,
                'name' => 'HPPI',
            ],
            [
                'id' => 6,
                'name' => 'AVEGA',
            ],
            [
                'id' => 7,
                'name' => 'INLIFE',
            ],
            [
                'id' => 8,
                'name' => 'PLDT',
            ],
            [
                'id' => 9,
                'name' => 'MEDICARD',
            ],
            [
                'id' => 10,
                'name' => 'GENERAL',
            ],
            [
                'id' => 11,
                'name' => 'CASH',
            ],
        ];

        foreach ($hmo as $key => $value) {
            $hmoData = HMO::firstOrCreate(['id' => $value['id']], $value);

            if (!$hmoData->wasRecentlyCreated) {
                $hmoData->update(array_only($value, ['name']));
            }
        }
    }
}
