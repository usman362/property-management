<?php

namespace App\Services;

use App\Models\Building;
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
                            <a type="button" class="p-1 tbl-action-btn" href="' . route('owner.property.edit', $building->id) . '" title="' . __('Edit') . '"><span class="iconify" data-icon="clarity:note-edit-solid"></span></a>
                            <button onclick="deleteItem(\'' . route('owner.property.delete', $building->id) . '\', \'allDataTable\')" class="p-1 tbl-action-btn"   title="' . __('Delete') . '"><span class="iconify" data-icon="ep:delete-filled"></span></button>
                        </div>';
            })
            ->rawColumns(['name', 'address','action'])
            ->make(true);
    }

}
