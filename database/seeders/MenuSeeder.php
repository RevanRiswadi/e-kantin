<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus semua data lama dulu agar tidak duplikat
        // Disable FK check sementara agar truncate bisa berjalan
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Menu::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $menus = [
            // ── Stand 1 - Makanan Utama ──────────────────────────────
            [
                'name'         => 'Kebab Daging Spesial',
                'category'     => 'makanan',
                'stand'        => 'Stand 1 - Makanan Utama',
                'price'        => 12000,
                'stock'        => 20,
                'is_available' => true,
            ],
            [
                'name'         => 'Kebab Ayam Keju',
                'category'     => 'makanan',
                'stand'        => 'Stand 1 - Makanan Utama',
                'price'        => 10000,
                'stock'        => 15,
                'is_available' => true,
            ],
            [
                'name'         => 'Nasi Goreng Spesial',
                'category'     => 'makanan',
                'stand'        => 'Stand 1 - Makanan Utama',
                'price'        => 11000,
                'stock'        => 10,
                'is_available' => true,
            ],

            // ── Stand 2 - Minuman ─────────────────────────────────────
            [
                'name'         => 'Es Teh Manis Jumbo',
                'category'     => 'minuman',
                'stand'        => 'Stand 2 - Minuman',
                'price'        => 3000,
                'stock'        => 30,
                'is_available' => true,
            ],
            [
                'name'         => 'Es Jeruk Peras',
                'category'     => 'minuman',
                'stand'        => 'Stand 2 - Minuman',
                'price'        => 4000,
                'stock'        => 25,
                'is_available' => true,
            ],
            [
                'name'         => 'Jus Alpukat',
                'category'     => 'minuman',
                'stand'        => 'Stand 2 - Minuman',
                'price'        => 7000,
                'stock'        => 8,
                'is_available' => true,
            ],

            // ── Stand 3 - Snack & Camilan ─────────────────────────────
            [
                'name'         => 'Cireng Bumbu Rujak',
                'category'     => 'makanan',
                'stand'        => 'Stand 3 - Snack & Camilan',
                'price'        => 5000,
                'stock'        => 40,
                'is_available' => true,
            ],
            [
                'name'         => 'Batagor Siram',
                'category'     => 'makanan',
                'stand'        => 'Stand 3 - Snack & Camilan',
                'price'        => 6000,
                'stock'        => 5,   // stok mepet — akan tampil warning
                'is_available' => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
