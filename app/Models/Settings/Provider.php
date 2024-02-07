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
        return $this->belongsTo(District::class, 'provider_district_id', 'id')->select('id', 'name', 'city_id')->where('disabled', 0);
    }

    public function owner_district()
    {
        return $this->belongsTo(District::class, 'owner_district_id', 'id')->select('id', 'name', 'city_id')->where('disabled', 0);
    }

    // public function social_media()
    // {
    //     return $this->hasMany(ProviderSocialMedia::class, 'provider_id', 'id')->where('disabled', 0);
    // }
}
