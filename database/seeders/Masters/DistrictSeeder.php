<?php

namespace Database\Seeders\Masters;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class DistrictSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Masters/District.csv';
        $this->tablename = 'mst_district';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'name', 'city_id'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
