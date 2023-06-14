<?php

namespace App\Models\Settings;

use App\Models\Transactions\SectionHeader;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'stg_menu';

    public function main_menu()
    {
        return $this->belongsTo(MainMenu::class, 'main_menu_id', 'id')->select('id', 'title', 'url', 'icon', 'parent')->where('disabled', 0)->where('is_shown', 1)->orderBy('order_no');
    }

    public function submenus()
    {
        if (session()->get('suser_id')) {
            return $this->hasMany(SubMenu::class)->select('id', 'title', 'url', 'icon', 'parent')->where('disabled', 0)->where('is_shown', 1)->orderBy('order_no');
        } else {
            return $this->hasMany(SubMenu::class)->select('id', 'title', 'url', 'icon', 'parent', 'is_login')->where('is_login', 0)->where('disabled', 0)->where('is_shown', 1)->orderBy('order_no');
        }
    }

    public function menu_access()
    {
        return $this->belongsTo(MenuAccess::class, 'id', 'menu_id')->select('id', 'main_menu_id', 'menu_id', 'submenu_id', 'role', 'view', 'add', 'edit', 'delete', 'detail', 'approval')->where('disabled', 0)->where('role', session()->get('srole'));
    }

    public function section_header()
    {
        return $this->belongsTo(SectionHeader::class, 'id', 'menu_id')->select('id', 'title', 'menu_id', 'picture_header', 'picture_header_name', 'picture', 'picture_name')->where('disabled', 0);
    }
}
