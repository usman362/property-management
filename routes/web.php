<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserEmailVerifyController;
use App\Http\Controllers\VersionUpdateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\MaintainerController;
use App\Http\Controllers\MaintenanceRequestController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TenantController;
use App\Models\Language;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::get('/local/{ln}', function ($ln) {
    $language = Language::where('code', $ln)->first();
    if (!$language) {
        $language = Language::where('default', 1)->first();
        if ($language) {
            $ln = $language->code;
        }
    }

    session(['local' => $ln]);
    Carbon::setLocale($ln);
    App::setLocale(session()->get('local'));
    return redirect()->back();
})->name('local');

// Route::group(['middleware' => ['version.update', 'addon.update', 'isFrontend']], function () {
//     Route::get('/', [CommonController::class, 'index'])->name('frontend');
//     Route::get('recurring-generate-invoice', [CommonController::class, 'generateInvoice'])->name('recurring.generate.invoice');
// });


// Frontend Pages

Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/apartments',[HomeController::class,'apartments'])->name('home.apartments');
Route::get('/apartment-details/{id}',[HomeController::class,'apartmentDetail'])->name('apartment.details');
Route::get('/buildings',[HomeController::class,'buildings'])->name('home.buildings');
Route::get('/building-details/{id}',[HomeController::class,'buildingDetail'])->name('building.show');
Route::post('/apartment-comment/{id}',[HomeController::class,'storeApartmentComment'])->name('store.ApartmentComment');
Route::post('/application-store', [HomeController::class, 'applicationStore'])->name('application.store');

Route::group(['middleware' => ['auth', 'version.update']], function () {
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::group(['middleware' => ['addon.update']], function () {
        Route::get('profile', [ProfileController::class, 'myProfile'])->name('profile');
        Route::post('profile', [ProfileController::class, 'profileUpdate'])->name('profile.update');
        Route::get('change-password', [ProfileController::class, 'changePassword'])->name('change-password');
        Route::post('change-password', [ProfileController::class, 'changePasswordUpdate'])->name('change-password.update');
        Route::post('delete-my-account', [ProfileController::class, 'deleteMyAccount'])->name('delete-my-account');

        Route::get('notification-status/{id}', [NotificationController::class, 'status'])->name('notification.status');
    });
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('email/verified/{token}', [UserEmailVerifyController::class, 'emailVerified'])->name('email.verified');
    Route::get('email/verify/{token}', [UserEmailVerifyController::class, 'emailVerify'])->name('email.verify');
    Route::post('email/verify/resend/{token}', [UserEmailVerifyController::class, 'emailVerifyResend'])->name('email.verify.resend');
});

Route::group(['prefix' => 'payment'], function () {
    Route::post('/', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::match(array('GET', 'POST'), 'verify', [PaymentController::class, 'verify'])->name('payment.verify');
    Route::match(array('GET', 'POST'), 'failed', [PaymentController::class, 'failed'])->name('payment.failed');
    Route::get('verify-redirect/{type?}', [PaymentController::class, 'verifyRedirect'])->name('payment.verify.redirect');
});

Route::get('version-update', [VersionUpdateController::class, 'versionUpdate'])->name('version-update');
Route::post('process-update', [VersionUpdateController::class, 'processUpdate'])->name('process-update');
Route::get('version-check', [VersionUpdateController::class, 'versionCheck'])->name('versionCheck');


// New Routes

Route::group(['middleware' => ['auth', 'owner']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => 'apartments', 'as' => 'property.'], function () {
        Route::get('all-apartments', [PropertyController::class, 'allProperty'])->name('allProperty');
        Route::get('add', [PropertyController::class, 'add'])->name('add');
        Route::get('show/{id}', [PropertyController::class, 'show'])->name('show');
        Route::get('edit/{id}', [PropertyController::class, 'edit'])->name('edit');
        Route::delete('destroy/{id}', [PropertyController::class, 'destroy'])->name('destroy');
        Route::get('delete/{id}', [PropertyController::class, 'destroy'])->name('delete');
        Route::post('property-information/store', [PropertyController::class, 'propertyInformationStore'])->name('property-information.store');
        Route::get('comments', [PropertyController::class, 'comments'])->name('comments');
        Route::get('apartment-comment-status', [PropertyController::class, 'commentStatus'])->name('apartmentComments.status');
    });

    Route::group(['prefix' => 'building', 'as' => 'building.'], function () {
        Route::get('all-building', [BuildingController::class, 'allBuilding'])->name('allBuilding');
        Route::post('store', [BuildingController::class, 'store'])->name('store');
        Route::get('edit/{id}', [BuildingController::class, 'edit'])->name('edit');
        Route::get('details/{id}', [BuildingController::class, 'details'])->name('details');
        Route::get('destroy/{id}', [BuildingController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'tenant', 'as' => 'tenant.'], function () {
        Route::get('/', [TenantController::class, 'index'])->name('index');
        Route::get('create', [TenantController::class, 'create'])->name('create');
        Route::get('edit/{id}', [TenantController::class, 'edit'])->name('edit');
        Route::post('store', [TenantController::class, 'store'])->name('store');
        Route::get('details/{id}', [TenantController::class, 'details'])->name('details');
        Route::get('delete/{id}', [TenantController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'applications', 'as' => 'applications.'], function () {
        Route::get('/', [ApplicationController::class, 'index'])->name('index');
        Route::get('status', [ApplicationController::class, 'changeStatus'])->name('status');
    });

    Route::group(['prefix' => 'information', 'as' => 'information.'], function () {
        Route::get('/', [InformationController::class, 'index'])->name('index');
        Route::post('store', [InformationController::class, 'store'])->name('store');
        Route::get('get-info', [InformationController::class, 'getInfo'])->name('get.info'); // ajax
        Route::get('delete/{id}', [InformationController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'maintainer', 'as' => 'maintainer.'], function () {
        Route::get('/', [MaintainerController::class, 'index'])->name('index');
        Route::post('store', [MaintainerController::class, 'store'])->name('store');
        Route::get('get-info', [MaintainerController::class, 'getInfo'])->name('get.info'); // ajax
        Route::get('delete/{id}', [MaintainerController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'maintenance-request', 'as' => 'maintenance-request.'], function () {
        Route::get('/', [MaintenanceRequestController::class, 'index'])->name('index');
        Route::post('store', [MaintenanceRequestController::class, 'store'])->name('store');
        Route::get('get-info', [MaintenanceRequestController::class, 'getInfo'])->name('get.info'); // ajax
        Route::post('status-change', [MaintenanceRequestController::class, 'statusChange'])->name('status.change');
        Route::get('delete/{id}', [MaintenanceRequestController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        Route::get('earning', [ReportController::class, 'earning'])->name('earning');
        Route::get('loss-profit', [ReportController::class, 'lossProfitByMonth'])->name('loss-profit.by.month');
        Route::get('expenses', [ReportController::class, 'expenses'])->name('expenses');
        Route::get('lease', [ReportController::class, 'lease'])->name('lease');
        Route::get('occupancy', [ReportController::class, 'occupancy'])->name('occupancy');
        Route::get('maintenance', [ReportController::class, 'maintenance'])->name('maintenance');
        Route::get('tenant', [ReportController::class, 'tenant'])->name('tenant');
        Route::get('apartment', [ReportController::class, 'apartment'])->name('apartment');
    });

    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
        Route::get('general-setting', [SettingController::class, 'generalSetting'])->name('general-setting');
        Route::post('general-settings-update', [SettingController::class, 'generalSettingUpdate'])->name('general-setting.update');
        Route::get('color-setting', [SettingController::class, 'colorSetting'])->name('color-setting');
        Route::get('smtp-setting', [SettingController::class, 'smtpSetting'])->name('smtp.setting');
        Route::get('recaptcha-setting', [SettingController::class, 'recaptchaSetting'])->name('recaptcha.setting');
        Route::get('map-box-setting', [SettingController::class, 'mapBoxSetting'])->name('map-box.setting')->middleware('isDemo');
        Route::post('general-settings-env-update', [SettingController::class, 'generalSettingEnvUpdate'])->name('general-setting-env.update');
        Route::get('sms-setting', [SettingController::class, 'smsSetting'])->name('sms.setting');
        Route::get('tenancy-setting', [SettingController::class, 'tenancySetting'])->name('tenancy.setting');
        Route::get('frontend-setting', [SettingController::class, 'frontendSetting'])->name('frontend.setting');
        Route::get('listing-setting', [SettingController::class, 'listingSetting'])->name('listing.setting');
        Route::get('agreement-setting', [SettingController::class, 'agreementSetting'])->name('agreement.setting');
        Route::get('reminder-setting', [SettingController::class, 'reminderSetting'])->name('reminder.setting');
        Route::get('cron-setting', [SettingController::class, 'cronSetting'])->name('cron.setting');
    });
});
