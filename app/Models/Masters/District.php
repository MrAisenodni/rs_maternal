<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'mst_district';

    public function city() 
    {
        return $this->belongsTo(City::class)->select('id', 'code', 'name')->where('disabled', 0);
    }
}
