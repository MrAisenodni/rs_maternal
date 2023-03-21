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
            return $this->hasMany(Menu::class)->select('id', 'title', 'url', 'icon', 'parent', 'is_login')->where('is_login', 0)->where('disabled', 0)->where('is_shown', 1);
        }
    }

    public function menu_access()
    {
        return $this->belongsTo(MenuAccess::class, 'id', 'main_menu_id')->select('id', 'main_menu_id', 'menu_id', 'submenu_id', 'role', 'view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)->where('role', session()->get('srole'));
    }
}
