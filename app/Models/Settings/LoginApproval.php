<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginApproval extends Model
{
    use HasFactory;

    protected $table = 'stg_login_approval';

    public function user()
    {
        return $this->belongsTo(User::class)->where('disabled', 0);
    }
    public function user_approval()
    {
        return $this->belongsTo(UserApproval::class)->where('disabled', 0);
    }
}
