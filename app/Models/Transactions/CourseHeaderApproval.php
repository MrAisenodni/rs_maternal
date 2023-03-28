<?php

namespace App\Models\Transactions;

use App\Models\Masters\{
    Category,
    Level,
};
use App\Models\Settings\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseHeaderApproval extends Model
{
    use HasFactory;

    protected $table = 'trx_course_header_approval';

    public function category()
    {
        return $this->belongsTo(Category::class)->select('id', 'name')->where('disabled', 0);
    }

    public function level()
    {
        return $this->belongsTo(Level::class)->select('id', 'name')->where('disabled', 0);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'course_teacher_id', 'id')->select('id', 'nik', 'full_name', 'biography', 'facebook', 'twitter', 'instagram', 'github', 'picture', 'picture_name')->where('disabled', 0)->where('role', 'tec');
    }

    public function course_header()
    {
        return $this->belongsTo(CourseHeader::class, 'course_header_id', 'id')->where('disabled', 0);
    }

    public function course_detail()
    {
        return $this->hasMany(CourseDetail::class, 'course_header_id', 'id')->select('id', 'course_header_id', 'title', 'video', 'description')->where('disabled', 0);
    }
    
    public function min_course_detail()
    {
        return $this->hasMany(CourseDetail::class, 'course_header_id', 'id')->selectRaw('MIN(id) AS id')->where('disabled', 0);
    }
}
