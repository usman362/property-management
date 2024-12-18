<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TenantCloseRequest;
use App\Http\Requests\TenantRequest;
use App\Models\Apartment;
use App\Models\Building;
use App\Services\LocationService;
use App\Services\PropertyService;
use App\Services\TenantService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    use ResponseTrait;
    public $tenantService, $propertyService, $locationService, $invoiceTypeService;

    public function __construct()
    {
        $this->tenantService = new TenantService;
        $this->propertyService = new PropertyService;
        $this->locationService = new LocationService;
    }

    public function index(Request $request)
    {
        if (!auth()->user()->hasPermissionTo("view-tenants"))
            return back();

        $data['navTenantMMShowClass'] = 'mm-show';
        $data['subNavAllTenantMMActiveClass'] = 'mm-active';
        $data['subNavAllTenantActiveClass'] = 'active';
        $data['pageTitle'] = __('Tenants');
        $data['tenants'] = $this->tenantService->getAll();
        return view('owner.tenants.index', $data);
    }

    public function create()
    {
        if (!auth()->user()->hasPermissionTo("add-tenants"))
            throw new \Exception('Not allowed');

        $data['pageTitle'] = __('Add Tenant');
        $data['subNavAllTenantMMActiveClass'] = 'mm-active';
        $data['subNavAllTenantActiveClass'] = 'active';
        $data['apartments'] = Apartment::select('id', 'apartment_name')->get();
        $data['buildings'] = Building::select('id', 'name')->get();
        return view('owner.tenants.add', $data);
    }

    public function edit($id)
    {
        if (!auth()->user()->hasPermissionTo("edit-tenants"))
            throw new \Exception('Not allowed');

        $data['pageTitle'] = __('Edit Tenant');
        $data['subNavAllTenantMMActiveClass'] = 'mm-active';
        $data['subNavAllTenantActiveClass'] = 'active';
        $data['tenant'] = $this->tenantService->getDetailsById($id);
        $data['apartments'] = Apartment::select('id', 'apartment_name')->get();
        $data['buildings'] = Building::select('id', 'name')->get();
        return view('owner.tenants.add', $data);
    }

    public function store(TenantRequest $request)
    {
        if (!auth()->user()->hasPermissionTo("add-tenants"))
            throw new \Exception('Not allowed');

        return $this->tenantService->store($request);
    }

    public function details(Request $request, $id)
    {
        if (!auth()->user()->hasPermissionTo("view-tenants"))
            return back();

        $data['navTenantMMShowClass'] = 'mm-show';
        $data['subNavAllTenantMMActiveClass'] = 'mm-active';
        $data['subNavAllTenantActiveClass'] = 'active';
        $data['pageTitle'] = __('Profile');
        $data['navTenantProfileActiveClass'] = 'active';
        $data['tenant'] = $this->tenantService->getDetailsById($id);
        return view('owner.tenants.details.profile', $data);
    }

    public function closeHistoryStore(TenantCloseRequest $request, $id)
    {
        return $this->tenantService->closeHistoryStore($request, $id);
    }

    public function documentDestroy($id)
    {
        return $this->tenantService->documentDestroy($id);
    }

    public function delete($id)
    {
        if (!auth()->user()->hasPermissionTo("delete-tenants"))
            back();

        return $this->tenantService->delete($id);
    }
}
