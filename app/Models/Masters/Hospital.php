<?php

namespace App\Models\Masters;

use App\Models\Transactions\ClinicResults;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $table = 'mst_hospital';

    public function clinic_results() {
        return $this->hasMany(ClinicResults::class, 'hospital_id', 'id')->select('id', 'companion_id', 'hospital_id', 'result_id', 'detail_result_id', 'value')->where('disabled', 0);
    }
}
