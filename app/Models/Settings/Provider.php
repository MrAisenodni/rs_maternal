<?php

namespace App\Models\Settings;

use App\Models\Masters\District;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $table = 'stg_provider';

    public function provider_district()
    {
        return $this->belongsTo(District::class, 'provider_district_id', 'id')->select('id', 'name')->where('disabled', 0);
    }
}
