<?php

namespace App\Models\Settings;

use App\Models\Masters\District;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderSocialMedia extends Model
{
    use HasFactory;

    protected $table = 'stg_provider_social_media';

    public function provider()
    {
        return $this->belongsTo(Provider::class)->where('disabled', 0);
    }
}
