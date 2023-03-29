<?php

namespace Database\Seeders\Transactions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class StandardProcessSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Transactions/StandardProcess.csv';
        $this->tablename = 'trx_standard_process';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['id', 'companion_id', 'description', 'standard', 'process'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
