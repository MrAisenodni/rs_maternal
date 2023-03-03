<?php

namespace App\Models\Settings;

use App\Models\Masters\District;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $table = 'stg_provider';

    public function provider_ward()
    {
        return $this->belongsTo(District::class, 'provider_ward_id', 'id')->select('id', 'name', 'post_code')->where('disabled', 0);
    }
}
