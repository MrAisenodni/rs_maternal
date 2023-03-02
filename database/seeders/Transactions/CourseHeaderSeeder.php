<?php

namespace Database\Seeders\Transactions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class CourseHeaderSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Transactions/CourseHeader.csv';
        $this->tablename = 'trx_course_header';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'title', 'picture', 'rating', 'description', 'category_id', 'level_id', 'duration'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
