<?php

namespace Database\Seeders\Settings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class MenuSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Settings/Menu.csv';
        $this->tablename = 'stg_menu';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'title', 'icon', 'url', 'parent', 'main_menu_id'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
