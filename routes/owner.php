<?php

use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\InformationController;
use App\Http\Controllers\Owner\MaintainerController;
use App\Http\Controllers\Owner\MaintenanceRequestController;
use App\Http\Controllers\Owner\PropertyController;
use App\Http\Controllers\Owner\BuildingController;
use App\Http\Controllers\Owner\ReportController;
use App\Http\Controllers\Owner\TenantController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'owner', 'as' => 'owner.', 'middleware' => ['auth', 'owner']], function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => 'property', 'as' => 'property.'], function () {
        Route::get('all-property', [PropertyController::class, 'allProperty'])->name('allProperty');
        Route::get('all-unit', [PropertyController::class, 'allUnit'])->name('allUnit');
        Route::get('own-property', [PropertyController::class, 'ownProperty'])->name('ownProperty');
        Route::get('lease-property', [PropertyController::class, 'leaseProperty'])->name('leaseProperty');
        Route::get('add', [PropertyController::class, 'add'])->name('add');
        Route::get('show/{id}', [PropertyController::class, 'show'])->name('show');
        Route::get('edit/{id}', [PropertyController::class, 'edit'])->name('edit');
        Route::delete('destroy/{id}', [PropertyController::class, 'destroy'])->name('destroy');
        Route::get('delete/{id}', [PropertyController::class, 'destroy'])->name('delete');
        Route::post('property-information/store', [PropertyController::class, 'propertyInformationStore'])->name('property-information.store');
        Route::post('location/store', [PropertyController::class, 'locationStore'])->name('location.store');
        Route::post('unit/store', [PropertyController::class, 'unitStore'])->name('unit.store');
        Route::delete('unit/delete/{id}', [PropertyController::class, 'unitDelete'])->name('unit.delete');
        Route::post('rent-charge/store', [PropertyController::class, 'rentChargeStore'])->name('rentCharge.store');
        Route::get('image/doc', [PropertyController::class, 'getImageDoc'])->name('image.doc');
        Route::post('image/store/{id?}', [PropertyController::class, 'imageStore'])->name('image.store');
        Route::get('image/delete/{id}', [PropertyController::class, 'imageDelete'])->name('image.delete');
        Route::post('thumbnail-image/update/{id}', [PropertyController::class, 'thumbnailImageUpdate'])->name('thumbnailImage.update');

        Route::get('get-property-information', [PropertyController::class, 'getPropertyInformation'])->name('getPropertyInformation');
        Route::get('get-location', [PropertyController::class, 'getLocation'])->name('getLocation');
        Route::get('get-unit', [PropertyController::class, 'getUnitByPropertyId'])->name('getUnitByPropertyId');
        Route::get('get-unit-by-property-ids', [PropertyController::class, 'getUnitByPropertyIds'])->name('getUnitByPropertyIds');
        Route::get('get-rent-charge', [PropertyController::class, 'getRentCharge'])->name('getRentCharge');
        Route::get('get-property-units', [PropertyController::class, 'getPropertyUnits'])->name('getPropertyUnits');
        Route::get('get-property-with-units-by-id', [PropertyController::class, 'getPropertyWithUnitsById'])->name('getPropertyWithUnitsById');
        Route::get('own-property-search', [PropertyController::class, 'ownPropertySearch'])->name('own-property-search');
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
    });
});
