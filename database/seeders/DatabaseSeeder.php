<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\MasterCategory;
use App\Models\PaymentMethod;
use App\Models\RoleMembership;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=DatabaseSeeder
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

            PaymentMethod::insert([
                [
                    'id' => 1,
                    'name' => 'Upload Bukti Transfer',

                ]
            ]);

            $masterCategory = [
                [
                    'id' => 1,
                    'name' => 'Custom',

                ],
                [
                    'id' => 2,
                    'name' => 'Baju',
                ],
                [
                    'id' => 3,
                    'name' => 'Jaket',
                ],
                [
                    'id' => 4,
                    'name' => 'Sweeter',
                ],
                [
                    'id' => 5,
                    'name' => 'Kaos',
                ]
            ];
            MasterCategory::insert($masterCategory);


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

            $addresses = [
                [
                    "user_id" => 2,
                    "address_name" => "Rumah",
                    "is_main" => 1,
                    "full_address" => "Jl Mataram 100, Jawa Tengah, Yogyakarta",
                    "zip_code" => 8742917,
                    "lat" => "-158.265114",
                    "long" => "45.792650",
                ], [
                    "user_id" => 2,
                    "address_name" => "Kantor",
                    "is_main" => 0,
                    "full_address" => "Jl KH Hasyim Ashari 125 ITC Roxy Mas Lt 3 110,Cideng",
                    "zip_code" => 63374,
                    "lat" => "26.826999",
                    "long" => "-40.995129",
                ]
            ];
            foreach ($addresses as $key => $value) {
                Address::create($value);
            }
            $this->call([
                MasterSeeder::class
            ]);
        });
    }
}
