<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\Property\LocationRequest;
use App\Http\Requests\Owner\Property\PropertyInformationRequest;
use App\Http\Requests\Owner\Property\RentChargeRequest;
use App\Http\Requests\UnitRequest;
use App\Models\Building;
use App\Models\Property;
use App\Services\PropertyService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    use ResponseTrait;
    public $propertyService;

    public function __construct()
    {
        $this->propertyService = new PropertyService;
    }

    public function allProperty(Request $request)
    {
        $data['pageTitle'] = __("All Apartments");
        $data['navApartmentMMShowClass'] = 'mm-show';
        $data['subNavAllApartmentMMActiveClass'] = 'mm-active';
        $data['subNavAllApartmentActiveClass'] = 'active';
        if ($request->ajax()) {
            return $this->propertyService->getAllData();
        } else {
            $data['apartments'] = $this->propertyService->getAll();
        }
        return view('owner.property.all-property-list')->with($data);
    }

    public function allUnit()
    {
        $data['pageTitle'] = __("All Unit");
        $data['navPropertyMMShowClass'] = 'mm-show';
        $data['subNavAllUnitMMActiveClass'] = 'mm-active';
        $data['subNavAllUnitActiveClass'] = 'active';
        $data['units'] = $this->propertyService->allUnit();
        return view('owner.property.all-unit-list')->with($data);
    }

    public function ownProperty(Request $request)
    {
        $data['pageTitle'] = __("Own Property");
        $data['navPropertyMMShowClass'] = 'mm-show';
        $data['subNavOwnPropertyMMActiveClass'] = 'mm-active';
        $data['subNavOwnPropertyActiveClass'] = 'active';
        $data['propertiesCount'] = $this->propertyService->getByTypeCount(PROPERTY_TYPE_OWN);
        if (getOption('app_card_data_show', 1) == 1) {
            $data['properties'] = $this->propertyService->getByType(PROPERTY_TYPE_OWN);
        }
        if ($request->ajax()) {
            return $this->propertyService->getByTypeData(PROPERTY_TYPE_OWN);
        }
        return view('owner.property.own-property-list')->with($data);
    }

    public function leaseProperty(Request $request)
    {
        $data['pageTitle'] = __("Lease Property");
        $data['navPropertyMMShowClass'] = 'mm-show';
        $data['subNavLeasePropertyMMActiveClass'] = 'mm-active';
        $data['subNavLeasePropertyActiveClass'] = 'active';
        $data['propertiesCount'] = $this->propertyService->getByTypeCount(PROPERTY_TYPE_LEASE);
        if (getOption('app_card_data_show', 1) == 1) {
            $data['properties'] = $this->propertyService->getByType(PROPERTY_TYPE_LEASE);
        }
        if ($request->ajax()) {
            return $this->propertyService->getByTypeData(PROPERTY_TYPE_LEASE);
        }
        return view('owner.property.lease-property-list')->with($data);
    }

    public function add()
    {

        $data['pageTitle'] = __("Add Apartment");
        $data['navApartmentMMShowClass'] = 'mm-show';
        $data['subNavApartmentIndexMMActiveClass'] = 'mm-active';
        $data['subNavApartmentIndexActiveClass'] = 'active';
        $data['buildings'] = Building::all();
        return view('owner.property.add')->with($data);
    }

    public function show($id)
    {
        $data['pageTitle'] = __("Apartment Details");
        $data['navApartmentMMShowClass'] = 'mm-show';
        $data['subNavAllApartmentMMActiveClass'] = 'mm-active';
        $data['subNavAllApartmentActiveClass'] = 'active';
        $data['apartment'] = $this->propertyService->getDetailsById($id);
        return view('owner.property.show')->with($data);
    }

    public function edit($id)
    {
        $data['pageTitle'] = __("Edit Apartment");
        $data['navApartmentMMShowClass'] = 'mm-show';
        $data['subNavApartmentIndexMMActiveClass'] = 'mm-active';
        $data['subNavApartmentIndexActiveClass'] = 'active';
        $data['apartment'] = $this->propertyService->getById($id);
        $data['buildings'] = Building::all();
        return view('owner.property.add')->with($data);
    }

    public function propertyInformationStore(PropertyInformationRequest $request)
    {
        return $this->propertyService->propertyInformationStore($request);
    }

    public function locationStore(LocationRequest $request)
    {
        return $this->propertyService->locationStore($request);
    }

    public function unitStore(UnitRequest $request)
    {
        return $this->propertyService->unitStore($request);
    }

    public function unitDelete($id)
    {
        return $this->propertyService->unitDelete($id);
    }

    public function rentChargeStore(RentChargeRequest $request)
    {
        return $this->propertyService->rentChargeStore($request);
    }

    public function getImageDoc(Request $request)
    {
        $id = $request->get('id',0);
        $property = Property::where('owner_user_id', auth()->id())->findOrFail($id);
        $response['property'] = $property;
        $response['step'] = IMAGE_ACTIVE_CLASS;
        $response['view'] = view('owner.property.partial.render-image', $response)->render();
        return $this->success($response);
    }
    public function imageStore(Request $request, $id)
    {
        return $this->propertyService->imageStore($request, $id);
    }

    public function imageDelete($id)
    {
        return $this->propertyService->imageDelete($id);
    }

    public function thumbnailImageUpdate(Request $request, $id)
    {
        return $this->propertyService->thumbnailImageUpdate($request, $id);
    }

    public function getPropertyInformation(Request $request)
    {
        return $this->propertyService->getPropertyInformation($request);
    }

    public function getLocation(Request $request)
    {
        return $this->propertyService->getLocation($request);
    }

    public function getUnitByPropertyId(Request $request)
    {
        return $this->propertyService->getUnitByPropertyId($request);
    }

    public function getUnitByPropertyIds(Request $request)
    {
        return $this->propertyService->getUnitByPropertyIds($request);
    }

    public function getRentCharge(Request $request)
    {
        return $this->propertyService->getRentCharge($request);
    }

    public function destroy($id)
    {
        return $this->propertyService->destroy($id);
    }

    public function getPropertyUnits(Request $request)
    {
        return $this->propertyService->getUnitsByPropertyId($request->property_id);
    }

    public function getPropertyWithUnitsById(Request $request)
    {
        return $this->propertyService->getPropertyWithUnitsById($request->property_id);
    }

    public function ownPropertySearch(Request $request)
    {
        $searchItem = $request->search;
        $data['properties'] = $this->propertyService->getPropertySearch(PROPERTY_TYPE_OWN, $searchItem);
        return view('owner.property.lease-property-list')->with($data);
    }
}
