<?php

namespace App\Http\Controllers;

use App\Models\Masters\{
    Category,
    City,
    Country,
    District,
    Level,
    Province,
    Religion,
    Role,
    Ward,
};
use App\Models\Settings\{
    Login,
    Menu,
    MenuAccess,
    Provider,
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
        $this->menu_access              = new MenuAccess();
        $this->provider                 = new Provider();
        $this->user                     = new User();

        // Global Variabel untuk Master
        $this->category                 = new Category();
        $this->city                     = new City();
        $this->country                  = new Country();
        $this->district                 = new District();
        $this->level                    = new Level();
        $this->province                 = new Province();
        $this->religion                 = new Religion();
        $this->role                     = new Role();
        $this->ward                     = new Ward();

        // Global Variabel untuk Transaction
        $this->course_detail            = new CourseDetail();
        $this->course_header            = new CourseHeader();
    }
}
