<?php

namespace Database\Seeders\Masters;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class CompanionSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Masters/Companion.csv';
        $this->tablename = 'mst_companion';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'title'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
