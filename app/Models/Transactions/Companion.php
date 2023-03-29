<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companion extends Model
{
    use HasFactory;

    protected $table = 'trx_companion';

    public function standard_process()
    {
        return $this->hasMany(StandardProcess::class, 'companion_id', 'id')->select('id', 'companion_id', 'description', 'standard', 'process')->where('disabled', 0);
    }
}
