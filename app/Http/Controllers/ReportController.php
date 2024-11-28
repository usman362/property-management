<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Repair;
use App\Models\Tenant;
use App\Services\PropertyService;
use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public $reportService, $propertyService;

    public function __construct()
    {
        $this->reportService =  new ReportService;
        $this->propertyService = new PropertyService;
    }

    public function earning(Request $request)
    {
        $data['pageTitle'] = __('Earning Report');
        if ($request->ajax()) {
            return $this->reportService->earning();
        }
        $data['properties'] = $this->propertyService->getAll();
        return view('owner.report.earning', $data);
    }

    public function lossProfitByMonth(Request $request)
    {
        $data['pageTitle'] = __('Loss Profit By Month Report');
        $data['lossProfits'] = $this->reportService->lossProfitByMonth();
        return view('owner.report.earning-by-month', $data);
    }

    public function expenses(Request $request)
    {
        $data['pageTitle'] = __('Expenses Report');
        if ($request->ajax()) {
            return $this->reportService->expenses();
        }
        $data['properties'] = $this->propertyService->getAll();
        return view('owner.report.expenses', $data);
    }

    public function lease(Request $request)
    {
        $data['pageTitle'] = __('Lease Report');
        if ($request->ajax()) {
            return $this->reportService->leases();
        }
        return view('owner.report.lease', $data);
    }

    public function occupancy(Request $request)
    {
        $data['pageTitle'] = __('Occupancy Report');
        if ($request->ajax()) {
            return $this->reportService->occupancy();
        }
        return view('owner.report.occupancy', $data);
    }

    public function maintenance(Request $request)
    {
        $data['pageTitle'] = __('Maintenance Report');
        $data['apartments'] = Apartment::select('id', 'apartment_name')->get();
        if ($request->ajax()) {
            return $this->reportService->maintenance($request);
        }
        return view('owner.report.maintenance', $data);
    }

    // public function tenant(Request $request)
    // {
    //     $data['pageTitle'] = __('Tenant Report');
    //     if ($request->ajax()) {
    //         return $this->reportService->tenant();
    //     }
    //     return view('owner.report.tenant', $data);
    // }

    public function tenant(Request $request)
    {
        if (!auth()->user()->hasPermissionTo("view-tenant-report"))
            return back();

        $data['pageTitle'] = __('Tenant Report');
        $data['apartments'] = Apartment::select('id', 'apartment_name')->get();
        if ($request->ajax()) {
            return $this->reportService->tenant($request);
        }
        return view('owner.report.tenant', $data);
    }

    public function apartment(Request $request)
    {
        if (!auth()->user()->hasPermissionTo("view-maintenance-report"))
            return back();

        $data['pageTitle'] = __('Apartment Report');
        $data['apartments'] = Apartment::select('id', 'apartment_name')->get();
        if ($request->ajax()) {
            return $this->reportService->apartment($request);
        }
        return view('owner.report.apartment', $data);
    }
}
