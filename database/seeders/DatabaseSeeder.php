<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            // Seeder untuk Tabel Master
            Masters\CountrySeeder::class,
            Masters\ProvinceSeeder::class,
            Masters\CitySeeder::class,
            Masters\DistrictSeeder::class,
            // Masters\WardSeeder::class, // Komentar sementara untuk mempercepat Migrasi
            Masters\CategorySeeder::class,
            Masters\LevelSeeder::class,
            Masters\ReligionSeeder::class,
            Masters\RoleSeeder::class,
            
            // Seeder untuk Tabel Setting
            Settings\LoginSeeder::class,
            Settings\MainMenuSeeder::class,
            Settings\MenuSeeder::class,
            Settings\MenuAccessSeeder::class,
            Settings\ProviderSeeder::class,
            Settings\UserSeeder::class,

            // Seeder untuk Tabel Transaksi
            Transactions\CourseHeaderSeeder::class,
            Transactions\CourseDetailSeeder::class,
            Transactions\CourseDetailDocumentSeeder::class,
        ]);
    }
}
