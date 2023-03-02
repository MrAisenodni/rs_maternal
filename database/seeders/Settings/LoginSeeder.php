<?php

namespace Database\Seeders\Settings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class LoginSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Settings/Login.csv';
        $this->tablename = 'stg_login';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'username', 'password', 'user_id'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
