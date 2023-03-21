<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;

    protected $table = 'stg_submenu';

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id')->select('id', 'title', 'url', 'icon', 'parent', 'main_menu_id')->where('disabled', 0)->where('is_shown', 1);
    }

    public function menu_access()
    {
        return $this->belongsTo(MenuAccess::class, 'id', 'submenu_id')->select('id', 'main_menu_id', 'menu_id', 'submenu_id', 'role', 'view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)->where('role', session()->get('srole'));
    }
}
