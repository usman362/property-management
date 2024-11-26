<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Maintainer;
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
        $data['pageTitle'] = __('Dashboard');
        $data['totalProperties'] = Apartment::all()->count();
        $data['totalTenants'] = 1;
        $data['properties'] = Apartment::all();
        $data['totalMaintainers'] = Maintainer::where('owner_user_id', auth()->id())->count();
        return view('owner.dashboard')->with($data);
    }
}
