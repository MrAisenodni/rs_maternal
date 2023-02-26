<?php

namespace App\Models\Settings;

use App\Models\Settings\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    protected $table = 'stg_login';

    public function user()
    {
        return $this->belongsTo(User::class)->where('disabled', 0);
    }
}
