<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $table = 'mst_ward';

    public function district() 
    {
        return $this->belongsTo(District::class)->select('id', 'name')->where('disabled', 0);
    }
}
