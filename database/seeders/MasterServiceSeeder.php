<?php

namespace Database\Seeders;


use App\Models\Master;
use App\Models\Service;

use Illuminate\Database\Seeder;

class MasterServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $masters = Master::all();
        $services = Service::all();
        
        
        $masters->each(function ($master) use ($services) {
            $randomServices = $services->random(
                min(5, $services->count()) // Берем не больше чем есть
            );

            $master->services()->attach(
                $randomServices->pluck('id')->toArray()
            );
        });
    }
}
