<?php

namespace Database\Seeders\Masters;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class ProvinceSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Masters/Province.csv';
        $this->tablename = 'mst_province';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'name', 'country_id'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
