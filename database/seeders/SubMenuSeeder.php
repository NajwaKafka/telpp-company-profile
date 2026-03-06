<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class SubMenuSeeder extends Seeder
{
    public function run(): void
    {
        // Find a parent menu (e.g., 'About Us' or similar)
        $parent = Menu::where('name', 'like', '%About%')->first();

        if ($parent) {
            Menu::create([
                'name' => 'Vision & Mission',
                'url' => '#creed',
                'is_actived' => 1,
                'parent_id' => $parent->id,
            ]);

            Menu::create([
                'name' => 'Our History',
                'url' => '#our-company',
                'is_actived' => 1,
                'parent_id' => $parent->id,
            ]);
            
            Menu::create([
                'name' => 'Management',
                'url' => '#',
                'is_actived' => 1,
                'parent_id' => $parent->id,
            ]);
        }
    }
}
