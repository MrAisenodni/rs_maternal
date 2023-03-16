<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDetailDocument extends Model
{
    use HasFactory;

    protected $table = 'trx_course_detail_document';

    public function course_header()
    {
        return $this->belongsTo(CourseDetail::class)->where('disabled', 0);
    }
}