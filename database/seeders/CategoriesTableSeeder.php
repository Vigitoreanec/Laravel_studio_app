<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'маникюр'],
            ['name' => 'классический маникюр'],
            ['name' => 'аппаратный маникюр'],
            ['name' => 'комбинированный маникюр'],
            ['name' => 'препаратный маникюр'],
            ['name' => 'педикюр'],
            ['name' => 'классический педикюр'],
            ['name' => 'аппаратный педикюр'],
            ['name' => 'комбинированный педикюр'],
            ['name' => 'ремонт ногтей']
        ];
        DB::table('categories')->insert($categories);
    }
}
