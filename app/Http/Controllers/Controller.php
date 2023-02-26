<?php

namespace App\Http\Controllers;

use App\Models\Settings\{
    Login,
    Menu,
    User,
};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // Global Variabel untuk Setting
        $this->login                = new Login();
        $this->menu                 = new Menu();
        $this->user                 = new User();
    }
}
