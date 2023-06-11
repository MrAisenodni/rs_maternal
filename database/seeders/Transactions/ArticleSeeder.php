<?php

namespace Database\Seeders\Transactions;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class ArticleSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/Transactions/Article.csv';
        $this->tablename = 'trx_article';
        $this->defaults = [
            'created_by'    => 'Migrasi'
        ];
        $this->mapping = ['title', 'description', 'side_description', 'type'];
        $this->delimiter = '|';
        $this->header = false;
    }

    public function run()
    {
        parent::run();
    }
}
