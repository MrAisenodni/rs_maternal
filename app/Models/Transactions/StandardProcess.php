<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandardProcess extends Model
{
    use HasFactory;

    protected $table = 'trx_standard_process';

    public function companion()
    {
        return $this->belongsTo(Companion::class)->select('id', 'title')->where('disabled', 0);
    }
}
