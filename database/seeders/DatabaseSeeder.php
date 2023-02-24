<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            // Seeder untuk Tabel Setting
            Settings\ProviderSeeder::class,
    
            // Seeder untuk Tabel Master
            Masters\ReligionSeeder::class,
            Masters\CountrySeeder::class,
            Masters\ProvinceSeeder::class,
            Masters\CitySeeder::class,
            Masters\DistrictSeeder::class,
            // Masters\WardSeeder::class, // Komentar sementara untuk mempercepat Migrasi
        ]);
    }
}
