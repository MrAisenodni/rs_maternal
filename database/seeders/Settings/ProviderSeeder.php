<?php

namespace Database\Seeders\Settings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class ProviderSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Settings/Provider.csv';
        $this->tablename = 'stg_provider';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = [
            'provider_npwp', 'provider_name', 'provider_birth_place', 'provider_birth_date', 'provider_email', 'provider_logo', 
            'provider_picture'
        ];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
