<?php

namespace Database\Seeders;

use App\Models\Goods;
use App\Models\GoodsColor;
use App\Models\GoodsSize;
use App\Models\MasterFaq;
use App\Models\MasterFileUpload;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        DB::transaction(function () {
            $goodsList = [
                [
                    "id" => 5,
                    "goods_name" => "T-Shirt Polos",
                    "description" => "Kaos polos dengan bahan Cotton Combed 30s.\nDengan warna Biru telur asin  dan hitam yang mempunyai ukuran yang berbagai.",
                    "category_id" => 5,
                    "is_active" => 1,
                    "base_price" => 40000,
                    "total_qty" => 0
                ],
                [
                    "id" => 6,
                    "goods_name" => "T-Shirt Kayser Nick",
                    "description" => "Kaos Kayser Nick dengan bahan NSA yang lembut dan halus.",
                    "category_id" => 5,
                    "is_active" => 1,
                    "base_price" => 80000,
                    "total_qty" => 0
                ],
                [
                    "id" => 7,
                    "goods_name" => "T-Shirt DEUS",
                    "description" => "KAOS T-SHIRT BAJU KEREN DEUS MACHINA",
                    "category_id" => 5,
                    "is_active" => 1,
                    "base_price" => 100000,
                    "total_qty" => 0
                ],
                [
                    "id" => 8,
                    "goods_name" => "T-SHIRT Jepang",
                    "description" => "Kaos T-Shirt Jepang Samurai Sakura",
                    "category_id" => 5,
                    "is_active" => 1,
                    "base_price" => 70000,
                    "total_qty" => 0
                ],
                [
                    "id" => 9,
                    "goods_name" => "Jaket Pria",
                    "description" => "Jaket Pria dengan HIGH Quality Impor Style",
                    "category_id" => 3,
                    "is_active" => 1,
                    "base_price" => 150000,
                    "total_qty" => 0
                ],
                [
                    "id" => 10,
                    "goods_name" => "Jaket Hoodie X-TRAIL",
                    "description" => "Jaket Hoodie X-TRAIL Material Baby Canvas Puring full dakron Trendy Nyaman Di Pakai Saku Bawah Double Simple Resleting + Button (Kancing)",
                    "category_id" => 3,
                    "is_active" => 1,
                    "base_price" => 150000,
                    "total_qty" => 0
                ],
                [
                    "id" => 11,
                    "goods_name" => "Sweeter Hoodie Pria",
                    "description" => "Sweater Hoodie Pria Cowok Jaket Keren Morte Sweater Hodie Fleece - Hitam di Kaguya Stuff. Promo khusus pengguna baru di aplikasi Jola!",
                    "category_id" => 4,
                    "is_active" => 1,
                    "base_price" => 100000,
                    "total_qty" => 0
                ],
                [
                    "id" => 12,
                    "goods_name" => "Trucker Pria",
                    "description" => "Jaket kasual nuansa earthy tone, - Warna krem, - Detail kerah, - Unlined, - Regular fit, - Kancing depan.",
                    "category_id" => 3,
                    "is_active" => 1,
                    "base_price" => 350000,
                    "total_qty" => 0
                ],
                [
                    "id" => 13,
                    "goods_name" => "Jaket Bomber Pria High",
                    "description" => "Jaket Bomber Pria FIGHTING SENSOR",
                    "category_id" => 3,
                    "is_active" => 1,
                    "base_price" => 120000,
                    "total_qty" => 0
                ],
                [
                    "id" => 14,
                    "goods_name" => "Kaos One Piece",
                    "description" => "Baju tshirt Kaos One Piece Shirohige Material Kaos Premium Cotton Combed, Bahan yang adem meskipun disiang hari dan menyerap keringat.",
                    "category_id" => 5,
                    "is_active" => 1,
                    "base_price" => 90000,
                    "total_qty" => 0
                ],
                [
                    "id" => 15,
                    "goods_name" => "Mauve Rick And Morty Hoddie",
                    "description" => "Mauve hoodie with a Rick and Morty print, drawstring hood and pouch pocket.",
                    "category_id" => 4,
                    "is_active" => 1,
                    "base_price" => 600000,
                    "total_qty" => 0
                ],
                [
                    "id" => 16,
                    "goods_name" => "Stranger Things Flame Sweatshirt",
                    "description" => "Stranger Things hoodie with a flame illustration print, a drawstring hood and long sleeves.",
                    "category_id" => 4,
                    "is_active" => 1,
                    "base_price" => 599000,
                    "total_qty" => 0
                ],
                [
                    "id" => 17,
                    "goods_name" => "California Varsity Sweatshirt",
                    "description" => "Long sleeve varsity sweatshirt with a California graphic and round neck.",
                    "category_id" => 4,
                    "is_active" => 1,
                    "base_price" => 299000,
                    "total_qty" => 0
                ],
                [
                    "id" => 18,
                    "goods_name" => "Panelled Brooklyn Varsity Sweatshirt",
                    "description" => "Long sleeve varsity sweatshirt with a Brooklyn graphic, contrast panelled design and round neck.",
                    "category_id" => 4,
                    "is_active" => 1,
                    "base_price" => 299000,
                    "total_qty" => 0
                ],
                [
                    "id" => 19,
                    "goods_name" => "Colour Block Corduroy Shirt",
                    "description" => "Colour block corduroy shirt with a front pocket, long sleeves and button fastening.",
                    "category_id" => 2,
                    "is_active" => 1,
                    "base_price" => 499000,
                    "total_qty" => 0
                ],
                [
                    "id" => 20,
                    "goods_name" => "Basic Check Shirt",
                    "description" => "This item has boys’ sizing. Girls who prefer an oversize fit should choose their usual size. For a regular fit, we recommend going down a size.",
                    "category_id" => 2,
                    "is_active" => 1,
                    "base_price" => 299000,
                    "total_qty" => 0
                ],
                [
                    "id" => 21,
                    "goods_name" => "Black Varsity Jacket",
                    "description" => "Black varsity jacket with a contrast slogan, ribbed round neck, button-up front and long sleeves.",
                    "category_id" => 3,
                    "is_active" => 1,
                    "base_price" => 399000,
                    "total_qty" => 0
                ],
                [
                    "id" => 22,
                    "goods_name" => "Faded Guns N’ Roses T-shirt",
                    "description" => "Faded black short sleeve T-shirt with a Guns N’ Roses logo and a round neck. Made of cotton.",
                    "category_id" => 5,
                    "is_active" => 1,
                    "base_price" => 199000,
                    "total_qty" => 0
                ],
                [
                    "id" => 23,
                    "goods_name" => "Cropped T-shirt With Contrasting Ribs",
                    "description" => "Cropped short sleeve T-shirt with a print on the front and contrast trim detail.",
                    "category_id" => 5,
                    "is_active" => 1,
                    "base_price" => 189000,
                    "total_qty" => 0
                ],
                [
                    "id" => 24,
                    "goods_name" => "Long Sleeve Shirt With Leaf Print",
                    "description" => "Collared shirt with long sleeves, a leaf print and button fastening.",
                    "category_id" => 2,
                    "is_active" => 1,
                    "base_price" => 249000,
                    "total_qty" => 0
                ]
            ];

            $faker = Faker::create('id_ID');
            $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
            $faker->addProvider(new \Bezhanov\Faker\Provider\Avatar($faker));
            foreach ($goodsList as $key => $goods) {
                $id = Goods::create($goods)->id;
                for ($j = 0; $j < $faker->numberBetween(1, 5); $j++) {
                    $idColor = GoodsColor::insertGetId([
                        "goods_id" => $id,
                        "color" => $faker->colorName,
                        "additional_price" => $faker->numberBetween(1, 5) * 1000,
                    ]);
                    $size = ["XS", "S", "M", "L", "XL", "XXL"];
                    for ($k = 0; $k < count($size); $k++) {
                        GoodsSize::insertGetId([
                            "goods_color_id" => $idColor,
                            "size" => $size[$k],
                            "additional_price" => $faker->numberBetween(1, 5) * 1000,
                            "qty" => $faker->numberBetween(2, 50),
                        ]);
                    }
                }
                Goods::where("id", $id)->update(array('total_qty' => GoodsSize::totalQty($id)));
            }


            $files = [
                [
                    "goods_id" => 5,
                    "url_path" => "product/1640267275-0.jpg",
                ], [
                    "goods_id" => 5,
                    "url_path" => "product/1640268953-0.jpg",
                ], [
                    "goods_id" => 6,
                    "url_path" => "product/1640270024-0.jpg",
                ], [
                    "goods_id" => 14,
                    "url_path" => "product/1640272813-0.jpg",
                ], [
                    "goods_id" => 15,
                    "url_path" => "product/1640273103-0.jpg",
                ], [
                    "goods_id" => 14,
                    "url_path" => "product/1640272766-0.jpg",
                ], [
                    "goods_id" => 13,
                    "url_path" => "product/1640272617-0.jpg",
                ], [
                    "goods_id" => 14,
                    "url_path" => "product/1640272753-0.jpg",
                ], [
                    "goods_id" => 7,
                    "url_path" => "product/1640270196-0.jpg",
                ], [
                    "goods_id" => 6,
                    "url_path" => "product/1640270567-0.jpg",
                ], [
                    "goods_id" => 13,
                    "url_path" => "product/1640272599-0.jpg",
                ], [
                    "goods_id" => 8,
                    "url_path" => "product/1640270615-0.jpg",
                ], [
                    "goods_id" => 12,
                    "url_path" => "product/1640272506-0.jpg",
                ], [
                    "goods_id" => 12,
                    "url_path" => "product/1640272500-0.jpg",
                ], [
                    "goods_id" => 9,
                    "url_path" => "product/1640270768-0.jpg",
                ], [
                    "goods_id" => 11,
                    "url_path" => "product/1640272436-0.jpg",
                ], [
                    "goods_id" => 10,
                    "url_path" => "product/1640270923-0.jpg",
                ], [
                    "goods_id" => 11,
                    "url_path" => "product/1640272421-0.jpg",
                ], [
                    "goods_id" => 11,
                    "url_path" => "product/1640272430-0.jpg",
                ], [
                    "goods_id" => 10,
                    "url_path" => "product/1640272355-0.jpg",
                ], [
                    "goods_id" => 11,
                    "url_path" => "product/1640271075-0.jpg",
                ], [
                    "goods_id" => 9,
                    "url_path" => "product/1640272284-0.jpg",
                ], [
                    "goods_id" => 10,
                    "url_path" => "product/1640272349-0.jpg",
                ], [
                    "goods_id" => 12,
                    "url_path" => "product/1640271239-0.jpg",
                ], [
                    "goods_id" => 8,
                    "url_path" => "product/1640272225-0.jpg",
                ], [
                    "goods_id" => 8,
                    "url_path" => "product/1640272234-0.jpg",
                ], [
                    "goods_id" => 7,
                    "url_path" => "product/1640272173-0.jpg",
                ], [
                    "goods_id" => 13,
                    "url_path" => "product/1640271495-0.jpg",
                ], [
                    "goods_id" => 7,
                    "url_path" => "product/1640272167-0.jpg",
                ], [
                    "goods_id" => 6,
                    "url_path" => "product/1640272115-0.jpg",
                ], [
                    "goods_id" => 14,
                    "url_path" => "product/1640271790-0.jpg",
                ], [
                    "goods_id" => 6,
                    "url_path" => "product/1640272107-0.jpg",
                ], [
                    "goods_id" => 15,
                    "url_path" => "product/1640273207-0.jpg",
                ], [
                    "goods_id" => 17,
                    "url_path" => "product/1640396958-0.jpg",
                ], [
                    "goods_id" => 17,
                    "url_path" => "product/1640396965-0.jpg",
                ], [
                    "goods_id" => 16,
                    "url_path" => "product/1640396346-0.jpg",
                ], [
                    "goods_id" => 16,
                    "url_path" => "product/1640395470-0.jpg",
                ], [
                    "goods_id" => 16,
                    "url_path" => "product/1640395678-0.jpg",
                ], [
                    "goods_id" => 17,
                    "url_path" => "product/1640396994-0.jpg",
                ], [
                    "goods_id" => 18,
                    "url_path" => "product/1640397578-0.jpg",
                ], [
                    "goods_id" => 18,
                    "url_path" => "product/1640397585-0.jpg",
                ], [
                    "goods_id" => 18,
                    "url_path" => "product/1640397571-0.jpg",
                ], [
                    "goods_id" => 19,
                    "url_path" => "product/1640398020-0.jpg",
                ], [
                    "goods_id" => 19,
                    "url_path" => "product/1640398004-0.jpg",
                ], [
                    "goods_id" => 19,
                    "url_path" => "product/1640398013-0.jpg",
                ], [
                    "goods_id" => 20,
                    "url_path" => "product/1640398210-0.jpg",
                ], [
                    "goods_id" => 20,
                    "url_path" => "product/1640398194-0.jpg",
                ], [
                    "goods_id" => 20,
                    "url_path" => "product/1640398203-0.jpg",
                ], [
                    "goods_id" => 21,
                    "url_path" => "product/1640398420-0.jpg",
                ], [
                    "goods_id" => 21,
                    "url_path" => "product/1640398406-0.jpg",
                ], [
                    "goods_id" => 21,
                    "url_path" => "product/1640398412-0.jpg",
                ], [
                    "goods_id" => 22,
                    "url_path" => "product/1640398606-0.jpg",
                ], [
                    "goods_id" => 22,
                    "url_path" => "product/1640398593-0.jpg",
                ], [
                    "goods_id" => 22,
                    "url_path" => "product/1640398599-0.jpg",
                ], [
                    "goods_id" => 23,
                    "url_path" => "product/1640398702-0.jpg",
                ], [
                    "goods_id" => 23,
                    "url_path" => "product/1640398709-0.jpg",
                ], [
                    "goods_id" => 23,
                    "url_path" => "product/1640398716-0.jpg",
                ], [
                    "goods_id" => 24,
                    "url_path" => "product/1640398938-0.jpg",
                ], [
                    "goods_id" => 24,
                    "url_path" => "product/1640398921-0.jpg",
                ], [
                    "goods_id" => 24,
                    "url_path" => "product/1640398929-0.jpg",
                ]
            ];
            foreach ($files as $key => $value) {
                MasterFileUpload::create($value);
            }


            $faqs = [
                [
                    "title" => "Bagaimana cara melakukan Login ke aplikasi JOLA?",
                    "body" => "Masukkan email dan password, jika belum ada akun, lakukan pendaftaran pada menu Sign Up",
                ], [
                    "title" => "Bagaimana cara melakukan Sign Up pada aplikasi JOLA?",
                    "body" => "Pilih menu Sign Up , lalu isikan data diri anda mulai dari nama, email, nomor telepon, dan password. Setelah itu klik Sign up, jika sudah maka akun JOLA sudah berhasil dibuat.",
                ], [
                    "title" => "Bagaimana cara melakukan pemesanan pada aplikasi JOLA?",
                    "body" => "Pada tampilan Home, pilih menu Catalog pada bar atas website, setelah itu Anda dapat memilih baju yang cocok untuk langsung dibeli atau dimasukkan ke keranjang terlebih dahulu.",
                ], [
                    "title" => "Bagaimana cara mengapus atau mengubah pesanan?",
                    "body" => "Pada menu keranjang, pilih pesanan yang ingin diubah ataupun dihapus, jika sudah klik OK.",
                ], [
                    "title" => "Bagaimana jika barang rusak saat sampai?",
                    "body" => "Kami berikan garansi 100% ganti baru atau uang kembali jika barang rusak saat pengiriman.",
                ], [
                    "title" => "Saya tidak cocok dengan barangnya, apakah boleh dikembalikan?",
                    "body" => "Barang yang sudah dibeli tidak dapat dikembalikan, karena kami tidak pernah menjual barang second. Harap pelanggan untuk dapat teliti sebelum membeli.",
                ]
            ];
            foreach ($faqs as $key => $value) {
                MasterFaq::create($value);
            }
        });
    }
}
