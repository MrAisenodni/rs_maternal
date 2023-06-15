<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            // Seeder untuk Tabel Master
            // Masters\CountrySeeder::class,
            // Masters\ProvinceSeeder::class,
            // Masters\CitySeeder::class,
            // Masters\CompanionSeeder::class,
            // Masters\DistrictSeeder::class,
            // // Masters\WardSeeder::class, // Komentar sementara untuk mempercepat Migrasi
            // Masters\CategorySeeder::class,
            // Masters\LevelSeeder::class,
            // Masters\ReligionSeeder::class,
            // Masters\RoleSeeder::class,
            
            // // Seeder untuk Tabel Setting
            // Settings\ApplicationParameterSeeder::class,
            // Settings\LoginSeeder::class,
            // Settings\MainMenuSeeder::class,
            // Settings\MenuSeeder::class,
            // Settings\SubMenuSeeder::class,
            // Settings\MenuAccessSeeder::class,
            // Settings\ProviderSeeder::class,
            // Settings\ProviderSocialMediaSeeder::class,
            // Settings\UserSeeder::class,

            // // Seeder untuk Tabel Transaksi
            // Transactions\ArticleSeeder::class,
            // Transactions\CourseHeaderSeeder::class,
            // Transactions\CourseDetailSeeder::class,
            // Transactions\CourseDetailDocumentSeeder::class,
            Transactions\SectionHeaderSeeder::class,

            // // Seeder untuk Tabel Dashboard
            // Masters\HospitalSeeder::class,
            // Masters\ResultSeeder::class,
            // Masters\DetailResultSeeder::class,
            // Transactions\ClinicResultsSeeder::class,
        ]);
    }
}
