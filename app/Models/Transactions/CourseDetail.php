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

    public function course_detail_document()
    {
        return $this->hasMany(CourseDetailDocument::class, 'course_detail_id', 'id')->select('id', 'course_detail_id', 'title', 'file', 'description')->where('disabled', 0);
    }
}