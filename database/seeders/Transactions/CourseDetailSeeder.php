<?php

namespace Database\Seeders\Transactions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class CourseDetailSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Transactions/CourseDetail.csv';
        $this->tablename = 'trx_course_detail';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'course_header_id', 'title', 'video', 'video_name', 'description', 'playtime', 'duration'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
