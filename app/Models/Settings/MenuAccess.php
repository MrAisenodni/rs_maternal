<?php

namespace App\Models\Settings;

use App\Models\Masters\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAccess extends Model
{
    use HasFactory;

    protected $table = 'stg_menu_access';

    public function main_menu()
    {
        return $this->belongsTo(MainMenu::class, 'main_menu_id', 'id')->select('id', 'title', 'icon', 'url', 'parent');
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id')->select('id', 'title', 'icon', 'url', 'parent');
    }
    public function submenu()
    {
        return $this->belongsTo(SubMenu::class, 'submenu_id', 'id')->select('id', 'title', 'icon', 'url', 'parent');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'role', 'role')->select('id', 'name', 'role');
    }
}
