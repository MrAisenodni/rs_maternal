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

    public function menu_access()
    {
        return $this->belongsTo(MenuAccess::class, 'id', 'menu_id')->select('id', 'role', 'view', 'add', 'edit', 'delete')->where('disabled', 0)->where('role', session()->get('srole'));
    }
}
