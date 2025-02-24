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
        $clients = Client::factory(5)->create();
        $masters = Master::factory()->count(5)->create();
        
        foreach ($clients as $client) {
            User::factory()->create([
                'name' => $client->name,
                'email' => $client->email,
                'password' => Hash::make('password' . $client->id), 
            ]);
        }

        foreach ($masters as $master) {
            User::factory()->create([
                'name' => $master->name,
                'email' => $master->email,
                'password' => Hash::make('password' . $master->id), 
                'is_admin' => 'master'
            ]);
        }

        User::factory()->create([
            'name' => 'sergey',
            'email' => 'mail@mail.ru',
            'password' => Hash::make('password'),
            'is_admin' => 'admin'
        ]);
        
        $this->call(CategoriesTableSeeder::class);

        $this->call([
            //CategoriesTableSeeder::class,
            //Master::factory(5)->create(),
            
            Service::factory(10)->create(),
            Meeting::factory(20)->create(),
            Comment::factory(35)->create(),

        ]);
        //$this->call(MasterServiceSeeder::class);
    }
}
