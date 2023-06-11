<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountHistory extends Model
{
    use HasFactory;

    protected $table = 'trx_count_history';

    public function course_detail()
    {
        return $this->belongsTo(CourseDetail::class, 'foreign_id', 'id')->select('id', 'course_header_id', 'title', 'video', 'video_name', 'description', 'playtime', 'duration')->where('disabled', 0)->where('type', 'video');
    }

    public function course_detail_document()
    {
        return $this->belongsTo(CourseDetailDocument::class, 'foreign_id', 'id')->select('id', 'course_detail_id', 'title', 'file', 'file_name', 'description')->where('disabled', 0)->where('type', 'document');
    }
}
