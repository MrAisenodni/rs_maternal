<?php

namespace Database\Seeders\Transactions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class SectionHeaderSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Transactions/SectionHeader.csv';
        $this->tablename = 'trx_section_header';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'menu_id', 'title', 'title_color', 'picture', 'picture_name', 'picture_header', 'picture_header_name'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
