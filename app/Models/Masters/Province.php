<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'mst_province';

    public function country() 
    {
        return $this->belongsTo(Country::class)->select('id', 'code', 'name')->where('disabled', 0);
    }
}
