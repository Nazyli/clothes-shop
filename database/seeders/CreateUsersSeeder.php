<?php

namespace Database\Seeders;

use App\Models\RoleMembership;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=CreateUsersSeeder
        DB::transaction(function () {

            RoleMembership::insert([
                [
                    'id' => 1,
                    'name' => 'Admin',

                ],
                [
                    'id' => 2,
                    'name' => 'User',
                ]

            ]);

            $user = [
                [
                    'first_name' => 'Admin',
                    'last_name' => 'Dummy',
                    'phone' => '085735906222',
                    'email' => 'admin@gmail.com',
                    'role_id' => '1',
                    'password' => bcrypt('123456'),
                ],
                [
                    'first_name' => 'User',
                    'last_name' => 'Dummy',
                    'phone' => '085735906222',
                    'email' => 'user@gmail.com',
                    'role_id' => '2',
                    'password' => bcrypt('123456'),
                ],
            ];

            foreach ($user as $key => $value) {
                User::create($value);
            }
        });
    }
}
