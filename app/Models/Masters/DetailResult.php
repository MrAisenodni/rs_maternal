<?php

namespace App\Models\Masters;

use App\Models\Transactions\ClinicResults;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailResult extends Model
{
    use HasFactory;

    protected $table = 'mst_detail_result';

    public function clinic_results() {
        return $this->hasMany(ClinicResults::class)->select('id', 'companion_id', 'hospital_id', 'result_id', 'detail_result_id', 'value')->where('disabled', 0);
    }

    public function result() {
        return $this->belongsTo(Result::class)->select('id', 'title', 'subtitle')->where('disabled', 0);
    }
}
