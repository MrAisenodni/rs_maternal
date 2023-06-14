<?php

namespace App\Http\Controllers;

use App\Models\Masters\{
    Category,
    City,
    Companion,
    Country,
    DetailResult,
    District,
    Hospital,
    Level,
    Province,
    Religion,
    Result,
    Role,
    Ward,
};
use App\Models\Settings\{
    ApplicationParameter,
    Login,
    Menu,
    MenuAccess,
    Provider,
    ProviderSocialMedia,
    SubMenu,
    User,
    UserApproval,
    LoginApproval,
};
use App\Models\Transactions\{
    Article,
    ClinicResults,
    CountHistory,
    CourseDetail,
    CourseDetailApproval,
    CourseDetailDocument,
    CourseDetailDocumentApproval,
    CourseHeader,
    CourseHeaderApproval,
    SectionHeader,
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
        $this->application_parameter            = new ApplicationParameter();
        $this->login                            = new Login();
        $this->login_approval                   = new LoginApproval();
        $this->menu                             = new Menu();
        $this->menu_access                      = new MenuAccess();
        $this->provider                         = new Provider();
        $this->provider_social_media            = new ProviderSocialMedia();
        $this->submenu                          = new SubMenu();
        $this->user                             = new User();
        $this->user_approval                    = new UserApproval();

        // Global Variabel untuk Master
        $this->category                         = new Category();
        $this->city                             = new City();
        $this->country                          = new Country();
        $this->detail_result                    = new DetailResult();
        $this->district                         = new District();
        $this->hospital                         = new Hospital();
        $this->level                            = new Level();
        $this->province                         = new Province();
        $this->religion                         = new Religion();
        $this->result                           = new Result();
        $this->role                             = new Role();
        $this->ward                             = new Ward();

        // Global Variabel untuk Transaction
        $this->article                          = new Article();
        $this->clinic_results                   = new ClinicResults();
        $this->companion                        = new Companion();
        $this->count_history                    = new CountHistory();
        $this->course_detail                    = new CourseDetail();
        $this->course_detail_approval           = new CourseDetailApproval();
        $this->course_detail_document           = new CourseDetailDocument();
        $this->course_detail_document_approval  = new CourseDetailDocumentApproval();
        $this->course_header                    = new CourseHeader();
        $this->course_header_approval           = new CourseHeaderApproval();
        $this->section_header                   = new SectionHeader();

        // Additional plugins
        $this->getID3                           = new getID3;
    }
}
