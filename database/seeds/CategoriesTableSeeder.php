<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::query()->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Category::query()->insert([
            ['title' => 'PHP'],
            ['title' => 'JavaScript'],
        ]);
    }
}
