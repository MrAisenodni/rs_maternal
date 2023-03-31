<?php

namespace Database\Seeders\Masters;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class ResultSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Masters/Result.csv';
        $this->tablename = 'mst_result';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'title', 'subtitle'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
