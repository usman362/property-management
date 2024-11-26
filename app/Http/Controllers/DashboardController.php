<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Maintainer;
use App\Models\Notification;
use App\Models\Property;
use App\Services\OwnerService;
use App\Services\PropertyService;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public $propertyService;
    public $ticketService;

    public function __construct()
    {
        $this->propertyService = new PropertyService;
        $this->ticketService = new TicketService;
    }

    public function dashboard()
    {
        $data['pageTitle'] = __('Dashboard');
        $data['totalProperties'] = Property::where('owner_user_id', auth()->id())->count();
        $data['totalTenants'] = 1;
        $data['properties'] = Property::all();
        $data['totalMaintainers'] = Maintainer::where('owner_user_id', auth()->id())->count();

        // Chart Rent overview
        $data['months'] = array_values(month());

        return view('owner.dashboard')->with($data);
    }

    public function notification()
    {
        $data['pageTitle'] = __('Notification');
        Notification::query()
            ->where(function ($q) {
                $q->where('notifications.user_id', auth()->id())
                    ->orWhere('notifications.user_id', null);
            })
            ->update(['is_seen' => ACTIVE]);
        return view('owner.notification')->with($data);
    }

    public function topSearch(Request $request)
    {
        $data['status'] = false;
        if ($request->keyword) {
            $ownerService = new OwnerService;
            $searchContent = $ownerService->topSearch($request);
            $data['data'] = view('owner.top-search-append', $searchContent)->render();
            $data['status'] = $searchContent['status'];
        }
        return response()->json($data);
    }
}
