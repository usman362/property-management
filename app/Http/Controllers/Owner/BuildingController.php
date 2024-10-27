<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\BuildingMedia;
use App\Services\BuildingService;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // dd($request->all());
        DB::beginTransaction();
        try {
            $building = new Building();
            $building->name = $request->name;
            $building->address = $request->address;
            if ($building->save()) {
                if (!empty($request->images)) {
                    foreach ($request->images as $image) {
                        $buildingMedia = new BuildingMedia();
                        $buildingMedia->building_id = $building->id;
                        $uniqueName = uniqid() . '___' . str_replace(' ', '_', $image->getClientOriginalName());
                        $filePath = $image->storeAs("/building/images", $uniqueName, "public");
                        $buildingMedia->media = $filePath;
                        $buildingMedia->media_type = 'image';
                        $buildingMedia->save();
                    }
                }

                if (!empty($request->videos)) {
                    foreach ($request->videos as $videos) {
                        $buildingMedia = new BuildingMedia();
                        $buildingMedia->building_id = $building->id;
                        $uniqueName = uniqid() . '___' . str_replace(' ', '_', $videos->getClientOriginalName());
                        $filePath = $videos->storeAs("/building/videos", $uniqueName, "public");
                        $buildingMedia->media = $filePath;
                        $buildingMedia->media_type = 'videos';
                        $buildingMedia->save();
                    }
                }
            }
            DB::commit();
            $message = $request->id ? __(UPDATED_SUCCESSFULLY) : __(CREATED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([],  $message);
        }
    }
}
