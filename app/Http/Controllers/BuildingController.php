<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\BuildingService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class  BuildingController extends Controller
{
    use ResponseTrait;
    public $buildingService;

    public function __construct()
    {
        $this->buildingService = new BuildingService;
    }

    public function allBuilding(Request $request)
    {
        $data['pageTitle'] = __("All Building");
        $data['navBuildingMMShowClass'] = 'mm-show';
        $data['subNavAllBuildingMMActiveClass'] = 'mm-active';
        $data['subNavAllBuildingActiveClass'] = 'active';
        if ($request->ajax()) {
            return $this->buildingService->getAllData();
        } else {
            $data['buildings'] = $this->buildingService->getAll();
        }
        return view('owner.building.all-building-list')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        return $this->buildingService->store($request);
    }

    public function details($id)
    {
        $data = $this->buildingService->getById($id);
        return $this->success($data);
    }

    public function destroy($id)
    {
        return $this->buildingService->destroy($id);
    }
}
