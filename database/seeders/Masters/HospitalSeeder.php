<?php

namespace Database\Seeders\Masters;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class HospitalSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Masters/Hospital.csv';
        $this->tablename = 'mst_hospital';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['name', 'type'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
