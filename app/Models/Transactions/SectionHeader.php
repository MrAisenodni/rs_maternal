<?php

namespace App\Models\Transactions;

use App\Models\Settings\Menu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionHeader extends Model
{
    use HasFactory;

    protected $table = 'trx_section_header';

    public function menu()
    {
        return $this->belongsTo(Menu::class)->where('disabled', 0)->where('parent', 0);
    }
}