<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Building;
use App\Models\Maintainer;
use App\Models\Tenant;
use App\Services\PropertyService;

class DashboardController extends Controller
{
    public $propertyService;
    public $ticketService;

    public function __construct()
    {
        $this->propertyService = new PropertyService;
    }

    public function dashboard()
    {
        if (!auth()->user()->hasPermissionTo("view-dashboard"))
                return back();

        $data['pageTitle'] = __('Dashboard');
        $data['totalProperties'] = Apartment::all()->count();
        $data['totalTenants'] = Tenant::all()->count();
        $data['properties'] = Apartment::paginate(5);
        $data['totalMaintainers'] = Maintainer::all()->count();
        $data['totalBuildings'] = Building::all()->count();
        $data['applications'] = Tenant::orderBy('created_at','desc')->paginate(5);
        return view('owner.dashboard')->with($data);
    }
}
