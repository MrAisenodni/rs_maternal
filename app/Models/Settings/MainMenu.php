<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainMenu extends Model
{
    use HasFactory;

    protected $table = 'stg_main_menu';

    public function menus()
    {
        if (session()->get('suser_id')) {
            return $this->hasMany(Menu::class)->select('id', 'title', 'url', 'icon', 'parent')->where('disabled', 0)->where('is_shown', 1);
        } else {
            return $this->hasMany(Menu::class)->select('id', 'title', 'url', 'icon', 'parent')->where('is_login', 0)->where('disabled', 0)->where('is_shown', 1);
        }
    }
}
