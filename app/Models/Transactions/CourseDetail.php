<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDetail extends Model
{
    use HasFactory;

    protected $table = 'trx_course_detail';

    public function course_header()
    {
        return $this->belongsTo(CourseHeader::class)->where('disabled', 0);
    }
}