<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'stg_menu';

    public function submenus()
    {
        return $this->hasMany(SubMenu::class)->select('id', 'title', 'url', 'icon')->where('disabled', 0);
    }
}
