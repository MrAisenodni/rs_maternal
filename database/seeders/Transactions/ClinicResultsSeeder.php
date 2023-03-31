<?php

namespace Database\Seeders\Transactions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class ClinicResultsSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Transactions/ClinicResults.csv';
        $this->tablename = 'trx_clinic_results';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['companion_id', 'hospital_id', 'result_id', 'detail_result_id', 'value'];
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
