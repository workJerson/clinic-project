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
                'name' => 'Asianlife',
            ],
            [
                'id' => 2,
                'name' => 'AVEGA',
            ],
            [
                'id' => 3,
                'name' => 'Cocolife',
            ],
            [
                'id' => 4,
                'name' => 'Generali',
            ],
            [
                'id' => 5,
                'name' => 'HPPI',
            ],
            [
                'id' => 6,
                'name' => 'Insular Healthcare',
            ],
            [
                'id' => 7,
                'name' => 'Intellicare',
            ],
            [
                'id' => 8,
                'name' => 'Medicard',
            ],
            [
                'id' => 9,
                'name' => 'Voyager',
            ],
            [
                'id' => 10,
                'name' => 'PLDT',
            ],
            [
                'id' => 12,
                'name' => 'Mediaque',
            ],
            [
                'id' => 13,
                'name' => 'Smart',
            ],
            [
                'id' => 14,
                'name' => 'Paymaya',
            ],
            [
                'id' => 15,
                'name' => 'PGN',
            ],
            [
                'id' => 16,
                'name' => 'Valucare',
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
