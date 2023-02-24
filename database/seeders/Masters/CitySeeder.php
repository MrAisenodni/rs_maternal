<?php

namespace Database\Seeders\Masters;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class CitySeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/City.csv';
        $this->tablename = 'mst_city';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'name', 'province_id'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
