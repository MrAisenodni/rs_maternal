<?php

namespace Database\Seeders\Masters;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class DetailResultSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Masters/DetailResult.csv';
        $this->tablename = 'mst_detail_result';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'result_id', 'title'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
