<?php

namespace Database\Seeders\Settings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class ProviderSocialMediaSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Settings/ProviderSocialMedia.csv';
        $this->tablename = 'stg_provider_social_media';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'provider_id', 'title', 'icon_1', 'icon_2', 'link'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
