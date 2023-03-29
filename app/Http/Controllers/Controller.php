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
    SubMenu,
    User,
    UserApproval,
};
use App\Models\Transactions\{
    Companion,
    CourseDetail,
    CourseDetailApproval,
    CourseDetailDocument,
    CourseDetailDocumentApproval,
    CourseHeader,
    CourseHeaderApproval,
    StandardProcess,
};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use getID3;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // Global Variabel untuk Setting
        $this->login                            = new Login();
        $this->menu                             = new Menu();
        $this->menu_access                      = new MenuAccess();
        $this->provider                         = new Provider();
        $this->submenu                          = new SubMenu();
        $this->user                             = new User();
        $this->user_approval                    = new UserApproval();

        // Global Variabel untuk Master
        $this->category                         = new Category();
        $this->city                             = new City();
        $this->country                          = new Country();
        $this->district                         = new District();
        $this->level                            = new Level();
        $this->province                         = new Province();
        $this->religion                         = new Religion();
        $this->role                             = new Role();
        $this->ward                             = new Ward();

        // Global Variabel untuk Transaction
        $this->companion                        = new Companion();
        $this->course_detail                    = new CourseDetail();
        $this->course_detail_approval           = new CourseDetailApproval();
        $this->course_detail_document           = new CourseDetailDocument();
        $this->course_detail_document_approval  = new CourseDetailDocumentApproval();
        $this->course_header                    = new CourseHeader();
        $this->course_header_approval           = new CourseHeaderApproval();
        $this->standard_process                 = new StandardProcess();

        // Additional plugins
        $this->getID3                           = new getID3;
    }
}
