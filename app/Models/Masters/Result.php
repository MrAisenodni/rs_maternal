<?php

namespace App\Models\Masters;

use App\Models\Transactions\ClinicResults;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $table = 'mst_result';

    public function clinic_results() {
        return $this->hasMany(ClinicResults::class, 'id', 'result_id')->where('disabled', 0);
    }
    
    public function detail_result() {
        return $this->hasMany(DetailResult::class)->select('id', 'result_id', 'title')->where('disabled', 0);
    }
}
