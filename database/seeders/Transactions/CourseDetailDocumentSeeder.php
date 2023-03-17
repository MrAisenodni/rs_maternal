<?php

namespace Database\Seeders\Transactions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class CourseDetailDocumentSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Transactions/CourseDetailDocument.csv';
        $this->tablename = 'trx_course_detail_document';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'course_detail_id', 'title', 'file', 'description', 'file_name'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
