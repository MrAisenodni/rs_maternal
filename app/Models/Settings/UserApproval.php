<?php

namespace App\Models\Settings;

use App\Models\Masters\{
    Position,
    Religion,
};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApproval extends Model
{
    use HasFactory;

    protected $table = 'mst_user_approval';

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id', 'id')->select('id', 'name')->where('disabled', 0);
    }

    public function login()
    {
        return $this->belongsTo(Login::class, 'id', 'user_id')->select('id', 'user_id', 'username', 'password')->where('disabled', 0);
    }
    public function login_approval()
    {
        return $this->belongsTo(LoginApproval::class, 'id', 'user_id')->select('id', 'user_id', 'username', 'password')->where('disabled', 0);
    }
}
