<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDetailDocumentApproval extends Model
{
    use HasFactory;

    protected $table = 'trx_course_detail_document_approval';

    public function course_detail_document()
    {
        return $this->belongsTo(CourseDetailDocument::class)->where('disabled', 0);
    }
    public function course_detail_document_approval()
    {
        return $this->belongsTo(CourseDetailDocument::class, 'course_detail_document_id', 'id')->where('disabled', 0);
    }
}