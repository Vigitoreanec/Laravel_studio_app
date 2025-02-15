<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Client;
use App\Models\Comment;
use App\Models\Master;
use App\Models\Meeting;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'sergey',
            'email' => 'mail@mail.ru',
            'password' => Hash::make('password'),
            'is_admin' => true
        ]);
        $this->call(CategoriesTableSeeder::class);

        $this->call([
            //CategoriesTableSeeder::class,
            Client::factory(10)->create(),
            Master::factory(5)->create(),
            Service::factory(10)->create(),
            Meeting::factory(20)->create(),
            Comment::factory(5)->create(),

        ]);
        $this->call(MasterServiceSeeder::class);
    }
}
