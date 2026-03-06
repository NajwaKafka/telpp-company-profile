<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            ['name' => 'Our Company', 'url' => '#', 'is_actived' => 1],
            ['name' => 'Product', 'url' => '#', 'is_actived' => 1],
            ['name' => 'News', 'url' => '#', 'is_actived' => 1],
            ['name' => 'Sustainability', 'url' => '#', 'is_actived' => 1],
            ['name' => 'Biodiversity', 'url' => '#', 'is_actived' => 1],
        ];

        foreach ($menus as $menu) {
            \App\Models\Menu::create($menu);
        }
    }
}
