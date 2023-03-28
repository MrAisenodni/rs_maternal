<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'mst_city';

    public function province() 
    {
        return $this->belongsTo(Province::class)->select('id', 'code', 'name')->where('disabled', 0);
    }
}
