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
        // Для каждого мастера добавляем уникальные услуги
        $masters->each(function ($master) use ($services) {
            $existingServices = $master->services()->pluck('service_id')->toArray();

            $availableServices = $services->whereNotIn('id', $existingServices);

            if ($availableServices->isNotEmpty()) {
                $randomServices = $availableServices->random(
                    min(2, $availableServices->count())
                );

                $master->services()->attach(
                    $randomServices->pluck('id')->toArray()
                );
            }
        });
    }
}
