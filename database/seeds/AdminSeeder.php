<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $flag = User::where('email', 'admin.cardia.olympia@text.com')->count();
        if ($flag == 0) {
            $superAdmin = new User(
                [
                    'email' => 'admin.cardia.olympia@text.com',
                    'status' => 1, // Active
                ],
                [
                    'is_cms' => true,
                    'account_type' => 1, // Customer
                ]
            );
            $superAdmin->password = 'password';
            $superAdmin->save();
            if ($superAdmin->userDetails) {
                $superAdmin->userDetails()->update([
                    'first_name' => 'Admin',
                    'last_name' => 'Admin',
                    'title' => 'ADMIN',
                ]);
            } else {
                $superAdmin->userDetails()->create([
                    'first_name' => 'Admin',
                    'last_name' => 'Admin',
                    'title' => 'ADMIN',
                ]);
            }
        }
    }
}
