<?php

namespace Database\Seeders\Masters;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class CategorySeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Category.csv';
        $this->tablename = 'mst_category';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'name'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
