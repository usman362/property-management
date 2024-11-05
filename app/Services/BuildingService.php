<?php

namespace App\Services;

use App\Models\Building;
use App\Models\BuildingMedia;
use App\Models\FileManager;
use App\Models\Tenant;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class BuildingService
{
    use ResponseTrait;

    public function getAll()
    {
        $data = Building::all();
        return $data?->makeHidden(['updated_at', 'created_at', 'deleted_at']);
    }

    public function getAllData()
    {
        $buildings = $this->getAll();

        return datatables($buildings)
            ->addIndexColumn()
            ->addColumn('name', function ($building) {
                return $building->name;
            })
            ->addColumn('address', function ($building) {
                return $building->address;
            })
            ->addColumn('action', function ($building) {
                return '<div class="tbl-action-btns d-inline-flex">
                <button type="button" class="p-1 tbl-action-btn edit" data-detailsurl="' . route('building.details', $building->id) . '" title="' . __('Edit') . '"><span class="iconify" data-icon="clarity:note-edit-solid"></span></button>
                <button onclick="deleteItem(\'' . route('building.destroy', $building->id) . '\', \'buildingDatatable\')" class="p-1 tbl-action-btn"   title="' . __('Delete') . '"><span class="iconify" data-icon="ep:delete-filled"></span></button>
            </div>';
            })
            ->rawColumns(['name', 'address', 'action'])
            ->make(true);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            if($request->building_id){
                $building = Building::findOrFail($request->building_id);
            }else{
                $building = new Building();
            }
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

    public function getById($id){
        $building = Building::findOrFail($id);
        return $building;
    }

    public function destroy($id){
        $building = Building::findOrFail($id);
        return $building->delete();
    }
}
