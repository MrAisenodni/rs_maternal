<?php

namespace Database\Seeders\Settings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class MenuAccessSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Settings/MenuAccess.csv';
        $this->tablename = 'stg_menu_access';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['role', 'menu_id', 'main_menu_id', 'submenu_id', 'view', 'add', 'edit', 'delete', 'detail', 'approval'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
