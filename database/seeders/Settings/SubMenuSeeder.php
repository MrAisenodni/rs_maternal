<?php

namespace Database\Seeders\Settings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class SubMenuSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Settings/SubMenu.csv';
        $this->tablename = 'stg_submenu';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'title', 'icon', 'url', 'parent', 'menu_id', 'is_login', 'is_shown', 'order_no'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
