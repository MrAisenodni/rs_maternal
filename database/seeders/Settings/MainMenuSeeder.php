<?php

namespace Database\Seeders\Settings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class MainMenuSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Settings/MainMenu.csv';
        $this->tablename = 'stg_main_menu';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'title', 'icon', 'url', 'parent', 'is_login', 'order_no'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
