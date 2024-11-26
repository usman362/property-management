<?php

namespace App\Services;

use App\Models\EmailTemplate;
use App\Models\FileManager;
use App\Models\Maintainer;
use App\Models\Property;
use App\Models\Repair;
use App\Models\User;
use App\Services\SmsMail\MailService;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MaintainerService
{
    use ResponseTrait;

    public function getAllData()
    {
        $maintainer = Repair::all();
        return datatables($maintainer)
            ->addIndexColumn()
            ->addColumn('building_name',function($row){
                return $row->building->name ?? '';
            })
            ->addColumn('apartment_number',function($row){
                return $row->apartment->apartment_name ?? '';
            })
            ->addColumn('status', function ($maintainer) {
                if ($maintainer->status == 'Checked In') {
                    return '<div class="status-btn status-btn-green font-13 radius-4">Checked In</div>';
                } else {
                    return '<div class="status-btn status-btn-orange font-13 radius-4">Checked Out</div>';
                }
            })
            ->addColumn('action', function ($maintainer) {
                $id = $maintainer->id;
                return '<div class="tbl-action-btns d-inline-flex">
                            <button type="button" class="p-1 tbl-action-btn edit" data-id="' . $id . '" title="' . __('Edit') . '"><span class="iconify" data-icon="clarity:note-edit-solid"></span></button>
                            <button onclick="deleteItem(\'' . route('maintainer.delete', $id) . '\', \'allMaintainerDataTable\')" class="p-1 tbl-action-btn"   title="' . __('Delete') . '"><span class="iconify" data-icon="ep:delete-filled"></span></button>
                        </div>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function allData()
    {
        $maintainers = Repair::all();

        return $maintainers;
    }

    public function getAll()
    {
        return  Maintainer::all();
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            if($request->repair_id){
                $repair = Repair::findOrFail($request->repair_id);
            }else{
                $repair = new Repair();
                $repair->user_id = auth()->user()->id;
            }
            $repair->building_id = $request->building_id;
            $repair->apartment_id = $request->apartment_id;
            $repair->status = $request->status;
            $repair->maintenance_type = $request->maintenance_type;
            $repair->date = $request->date;
            $repair->repair_fees = $request->repair_fees ?? 0;
            $repair->utensils_fees = $request->utensils_fees ?? 0;
            $repair->repair_details = $request->repair_details ?? '';
            $repair->monthly_maintenance_fees = $request->monthly_maintenance_fees ?? 0;
            $repair->services_included = $request->services_included;
            $repair->save();
            DB::commit();
            $message = $request->repair_id ? __(UPDATED_SUCCESSFULLY) : __(CREATED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([],  $message);
        }
    }

    public function getById($id)
    {
        return Repair::findOrFail($id);
    }

    public function getInfo($id)
    {
        $maintainer = Repair::findOrFail($id);
        return $maintainer;
    }

    public function details($id)
    {
        $maintainer = Repair::findOrFail($id);
        return $maintainer;
    }

    public function deleteById($id)
    {
        DB::beginTransaction();
        try {
            $maintainer = Repair::findOrFail($id);
            $maintainer->delete();
            DB::commit();
            $message = __(DELETED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (\Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([],  $message);
        }
    }
}
