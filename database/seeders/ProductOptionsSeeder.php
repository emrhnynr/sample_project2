<?php

namespace Database\Seeders;

use App\Models\Products\GoldPurity;
use App\Models\Products\MineralColour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GoldPurity::create([ 'name' => '10K', 'slug' => '10k' ]);
        GoldPurity::create([ 'name' => '14K', 'slug' => '14k' ]);
        GoldPurity::create([ 'name' => '18K', 'slug' => '18k' ]);
        GoldPurity::create([ 'name' => '24K', 'slug' => '24K' ]);

        MineralColour::create([ 'name' => 'Kırmızı-Beyaz', 'slug' => 'kirmizi-beyaz', 'color_icon' => 'https://uploads-ssl.webflow.com/655623cecb95618fee215784/65673c3b0a964019ae45bda4_Rose-White-Gold.svg']);
        MineralColour::create([ 'name' => 'Yeşil-Beyaz', 'slug' => 'yesil-beyaz', 'color_icon' => 'https://uploads-ssl.webflow.com/655623cecb95618fee215784/65673c4aaa31c95dfbabe6fa_Yellow-White-Gold.svg']);
        MineralColour::create([ 'name' => 'Kırmızı', 'slug' => 'kirmizi', 'color_icon' => 'https://uploads-ssl.webflow.com/655623cecb95618fee215784/65673c572650912f271c3789_Rose-Gold.svg' ]);
        MineralColour::create([ 'name' => 'Yeşil', 'slug' => 'yesil', 'color_icon' => 'https://uploads-ssl.webflow.com/655623cecb95618fee215784/65673c6272289fd24dda4e73_Yellow-Gold.svg' ]);
        MineralColour::create([ 'name' => 'Beyaz', 'slug' => 'beyaz', 'color_icon' => 'https://uploads-ssl.webflow.com/655623cecb95618fee215784/65673c6edbf6d08fe9652c2d_White-Gold.svg' ]);
    }
}
