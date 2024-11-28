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
                $actionBtn = '';
                $actionBtn .= '<div class="tbl-action-btns d-inline-flex">';
                if (auth()->user()->hasPermissionTo("edit-buildings")) {
                    $actionBtn .= '<button type="button" class="p-1 tbl-action-btn edit" data-detailsurl="' . route('building.details', $building->id) . '" title="' . __('Edit') . '"><span class="iconify" data-icon="clarity:note-edit-solid"></span></button>';
                }
                if (auth()->user()->hasPermissionTo("delete-buildings")) {
                    $actionBtn .= '<button onclick="deleteItem(\'' . route('building.destroy', $building->id) . '\', \'buildingDatatable\')" class="p-1 tbl-action-btn"   title="' . __('Delete') . '"><span class="iconify" data-icon="ep:delete-filled"></span></button>';
                }
                $actionBtn .= '</div>';
                return $actionBtn;
            })
            ->rawColumns(['name', 'address', 'action'])
            ->make(true);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            if ($request->building_id) {
                $building = Building::findOrFail($request->building_id);
            } else {
                $building = new Building();
                $building->user_id = auth()->user()->id;
            }
            $building->name = $request->name;
            $building->address = $request->address;
            if ($building->save()) {
                if (!empty($request->images)) {
                    foreach ($request->images as $image) {
                        $buildingMedia = new BuildingMedia();
                        $buildingMedia->building_id = $building->id;

                        // Generate a unique name for the image
                        $uniqueName = uniqid() . '___' . str_replace(' ', '_', $image->getClientOriginalName());

                        // Define the target path in the public directory
                        $destinationPath = public_path('building/images');

                        // Ensure the directory exists
                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 0755, true);
                        }

                        // Move the uploaded file to the public directory
                        $image->move($destinationPath, $uniqueName);

                        // Save the relative path in the database
                        $filePath = "building/images/$uniqueName";
                        $buildingMedia->media = $filePath;
                        $buildingMedia->media_type = 'image';
                        $buildingMedia->save();
                    }
                }

                if (!empty($request->videos)) {
                    foreach ($request->videos as $video) {
                        $buildingMedia = new BuildingMedia();
                        $buildingMedia->building_id = $building->id;

                        // Generate a unique name for the video
                        $uniqueName = uniqid() . '___' . str_replace(' ', '_', $video->getClientOriginalName());

                        // Define the target path in the public directory
                        $destinationPath = public_path('building/videos');

                        // Ensure the directory exists
                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 0755, true);
                        }

                        // Move the uploaded video to the public directory
                        $video->move($destinationPath, $uniqueName);

                        // Save the relative path in the database
                        $filePath = "building/videos/$uniqueName";
                        $buildingMedia->media = $filePath;
                        $buildingMedia->media_type = 'video'; // Corrected type to 'video'
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

    public function getById($id)
    {
        $building = Building::findOrFail($id);
        return $building;
    }

    public function destroy($id)
    {
        $building = Building::findOrFail($id);
        return $building->delete();
    }
}
