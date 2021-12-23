<?php

namespace Database\Seeders;

use App\Models\Goods;
use App\Models\GoodsColor;
use App\Models\GoodsSize;
use App\Models\MasterCategory;
use App\Models\MasterFaq;
use App\Models\MasterFileUpload;
use App\Models\PaymentMethod;
use App\Models\RoleMembership;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

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

            $faker = Faker::create('id_ID');
            $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
            $faker->addProvider(new \Bezhanov\Faker\Provider\Avatar($faker));

            $category = DB::select('SELECT id FROM master_categories ');
            $categoryArray = json_decode(json_encode($category), true);
            for ($i = 0; $i < 100; $i++) {
                $cat_id = (int)$faker->randomElement(collect($categoryArray)->flatten());
                $id = Goods::insertGetId([
                    "goods_name" => $faker->productName,
                    "description" => $faker->text,
                    "category_id" => $cat_id,
                    "is_active" => true,
                    "base_price" => $faker->numberBetween(50000, 250000),
                    "total_qty" => $faker->numberBetween(5, 20),
                ]);
                for ($j = 0; $j < $faker->numberBetween(1, 5); $j++) {
                    $idColor = GoodsColor::insertGetId([
                        "goods_id" => $id,
                        "color" => $faker->colorName,
                        "additional_price" => $faker->numberBetween(1000, 5000),
                    ]);
                    $size = ["XS", "S", "M", "L", "XL", "XXL"];
                    for ($k = 0; $k < count($size); $k++) {
                        GoodsSize::insertGetId([
                            "goods_color_id" => $idColor,
                            "size" => $size[$k],
                            "additional_price" => $faker->numberBetween(1000, 5000),
                            "qty" => $faker->numberBetween(1, 5),
                        ]);
                    }
                    Goods::where("id", $id)->update(array('total_qty' => GoodsSize::totalQty($id)));
                }

                // image
                for ($j = 0; $j < $faker->numberBetween(1, 5); $j++) {
                    MasterFileUpload::insertGetId([
                        "goods_id" => $id,
                        "url_path" => $faker->avatar
                    ]);
                }
            }

            // FAQ
            for ($j = 0; $j < 6; $j++) {
                MasterFaq::insertGetId([
                    "title" => $faker->realText(rand(10, 30)),
                    "body" => $faker->text
                ]);
            }
        });
    }
}
