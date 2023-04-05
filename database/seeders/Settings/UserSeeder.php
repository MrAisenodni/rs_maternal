<?php

namespace Database\Seeders\Settings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class UserSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Settings/User.csv';
        $this->tablename = 'mst_user';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'nik', 'full_name', 'gender', 'religion_id', 'email', 'role', 'picture', 'picture_name'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
