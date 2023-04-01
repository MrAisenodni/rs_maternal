<?php

namespace App\Models\Transactions;

use App\Models\Masters\{ Companion, DetailResult, Hospital, Result };
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicResults extends Model
{
    use HasFactory;

    protected $table = 'trx_clinic_results';

    public function companion()
    {
        return $this->belongsTo(Companion::class)->select('id', 'title')->where('disabled', 0);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class)->select('id', 'name', 'type')->where('disabled', 0)->where('type', 'int');
    }

    public function result()
    {
        return $this->belongsTo(Result::class)->select('id', 'title', 'subtitle')->where('disabled', 0);
    }

    public function detail_result()
    {
        return $this->belongsTo(DetailResult::class)->select('id', 'result_id', 'title')->where('disabled', 0);
    }
}
