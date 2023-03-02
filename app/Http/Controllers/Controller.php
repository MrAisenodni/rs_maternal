<?php

namespace App\Http\Controllers;

use App\Models\Masters\{
    Category,
    Level,
    Religion,
    Role,
};
use App\Models\Settings\{
    Login,
    Menu,
    User,
};
use App\Models\Transactions\{
    CourseDetail,
    CourseHeader,
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
        $this->login                    = new Login();
        $this->menu                     = new Menu();
        $this->user                     = new User();

        // Global Variabel untuk Master
        $this->category                 = new Category();
        $this->level                    = new Level();
        $this->religion                 = new Religion();
        $this->role                     = new Role();

        // Global Variabel untuk Transaction
        $this->course_detail            = new CourseDetail();
        $this->course_header            = new CourseHeader();
    }
}
