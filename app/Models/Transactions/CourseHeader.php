<?php

namespace App\Models\Transactions;

use App\Models\Masters\{
    Category,
    Level,
};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseHeader extends Model
{
    use HasFactory;

    protected $table = 'trx_course_header';

    public function category()
    {
        return $this->belongsTo(Category::class)->select('id', 'name')->where('disabled', 0);
    }

    public function level()
    {
        return $this->belongsTo(Level::class)->select('id', 'name')->where('disabled', 0);
    }

    public function course_detail()
    {
        return $this->hasMany(CourseDetail::class, 'course_header_id', 'id')->select('id', 'course_header_id', 'title', 'video', 'description')->where('disabled', 0);
    }
}
