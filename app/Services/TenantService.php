<?php
namespace App\Services;
use App\Models\FileManager;
use App\Models\Tenant;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;
class TenantService
{
    use ResponseTrait;
    public function getAll()
    {
        $data = Tenant::all();
        return $data?->makeHidden(['created_at', 'updated_at', 'deleted_at']);
    }
    public function getActiveAll()
    {
        return Tenant::query()
            ->join('users', 'tenants.user_id', '=', 'users.id')
            ->whereNull('users.deleted_at')
            ->select(['tenants.*', 'users.first_name', 'users.last_name', 'users.contact_number', 'users.email'])
            ->where('tenants.status', TENANT_STATUS_ACTIVE)
            ->where('tenants.owner_user_id', auth()->id())
            ->get();
    }
    public function getAllData()
    {
        $tenants = Tenant::query()
            ->join('users', 'tenants.user_id', '=', 'users.id')
            ->whereNull('users.deleted_at')
            ->leftJoin('properties', 'tenants.property_id', '=', 'properties.id')
            ->leftJoin('property_units', 'tenants.unit_id', '=', 'property_units.id')
            ->leftJoin(DB::raw('(select tenant_id, SUM(amount) as due from invoices where status = 0 AND deleted_at IS NULL group By tenant_id) as inv'), ['inv.tenant_id' => 'tenants.id'])
            ->leftJoin(DB::raw('(select tenant_id, MAX(updated_at) as last_payment from invoices where status = 1 AND deleted_at IS NULL group By tenant_id) as inv_last'), ['inv_last.tenant_id' => 'tenants.id'])
            ->select(['tenants.*', 'inv.due', 'inv_last.last_payment', 'users.first_name', 'users.last_name', 'users.status as userStatus', 'users.contact_number', 'users.email', 'property_units.unit_name', 'properties.name as property_name'])
            ->where('tenants.owner_user_id', auth()->id());
        return datatables($tenants)
            ->addIndexColumn()
            ->addColumn('name', function ($tenant) {
                return '<div class="tenants-tbl-info-object d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="' . $tenant->image . '"
                            class="rounded-circle avatar-md tbl-user-image"
                            alt="">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6>' . $tenant->first_name . ' ' . $tenant->last_name . '</h6>
                            <p class="font-13">' . $tenant->email . '</p>
                        </div>
                    </div>';
            })
            ->addColumn('property', function ($tenant) {
                return $tenant->property_name;
            })
            ->addColumn('contact', function ($tenant) {
                return $tenant->contact_number;
            })
            ->addColumn('last_payment', function ($tenant) {
                return $tenant->last_payment ? date('Y-m-d', strtotime($tenant->last_payment)) : 'N/A';
            })
            ->addColumn('due', function ($tenant) {
                return currencyPrice($tenant->due);
            })
            ->addColumn('general_rent', function ($tenant) {
                return currencyPrice($tenant->general_rent);
            })
            ->addColumn('unit', function ($tenant) {
                return $tenant->unit_name;
            })
            ->addColumn('status', function ($tenant) {
                $html = '';
                if ($tenant->userStatus == USER_STATUS_DELETED) {
                    $html = ' <div class="status-btn status-btn-orange font-13 radius-4">' . __('Deleted') . '</div>';
                } else {
                    if ($tenant->status == TENANT_STATUS_ACTIVE) {
                        $html = ' <div class="status-btn status-btn-green font-13 radius-4">' . __('Active') . '</div>';
                    } elseif ($tenant->status == TENANT_STATUS_INACTIVE) {
                        $html = ' <div class="status-btn status-btn-orange font-13 radius-4">' . __('Deactivate') . '</div>';
                    } elseif ($tenant->status == TENANT_STATUS_DRAFT) {
                        $html = ' <div class="status-btn status-btn-blue font-13 radius-4">' . __('Draft') . '</div>';
                    } elseif ($tenant->status == TENANT_STATUS_CLOSE) {
                        $html = ' <div class="status-btn status-btn-red font-13 radius-4">' . __('Close') . '</div>';
                    }
                }
                return $html;
            })
            ->addColumn('action', function ($tenant) {
                return '<div class="tbl-action-btns d-inline-flex">
                        <a href="' . route('tenant.details', [$tenant->id, 'tab' => 'profile']) . '" class="p-1 tbl-action-btn" title="' . __('Edit') . '"><span class="iconify" data-icon="carbon:view-filled"></span></a>
                    </div>';
            })
            ->rawColumns(['name', 'property', 'status', 'action'])
            ->make(true);
    }
    public function getAllHistoryData()
    {
        $tenants = Tenant::query()
            ->join('users', 'tenants.user_id', '=', 'users.id')
            ->whereNull('users.deleted_at')
            ->leftJoin('properties', 'tenants.property_id', '=', 'properties.id')
            ->leftJoin('property_units', 'tenants.unit_id', '=', 'property_units.id')
            ->select(['tenants.*', 'users.first_name', 'users.last_name', 'users.status as userStatus', 'users.contact_number', 'users.email', 'property_units.unit_name', 'properties.name as property_name'])
            ->where('tenants.owner_user_id', auth()->id());
        return datatables($tenants)
            ->addIndexColumn()
            ->addColumn('name', function ($tenant) {
                return '<div class="tenants-tbl-info-object d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="' . $tenant->image . '"
                            class="rounded-circle avatar-md tbl-user-image"
                            alt="">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6>' . $tenant->first_name . ' ' . $tenant->last_name . '</h6>
                            <p class="font-13">' . $tenant->email . '</p>
                        </div>
                    </div>';
            })
            ->addColumn('property', function ($tenant) {
                return $tenant->property_name;
            })
            ->addColumn('unit', function ($tenant) {
                return $tenant->unit_name;
            })
            ->addColumn('status', function ($tenant) {
                $html = '';
                if ($tenant->userStatus == USER_STATUS_DELETED) {
                    $html = ' <div class="status-btn status-btn-orange font-13 radius-4">' . __('Deleted') . '</div>';
                } else {
                    if ($tenant->status == TENANT_STATUS_ACTIVE) {
                        $html = ' <div class="status-btn status-btn-green font-13 radius-4">' . __('Active') . '</div>';
                    } elseif ($tenant->status == TENANT_STATUS_INACTIVE) {
                        $html = ' <div class="status-btn status-btn-orange font-13 radius-4">' . __('Inactive') . '</div>';
                    } elseif ($tenant->status == TENANT_STATUS_DRAFT) {
                        $html = ' <div class="status-btn status-btn-blue font-13 radius-4">' . __('Draft') . '</div>';
                    } elseif ($tenant->status == TENANT_STATUS_CLOSE) {
                        $html = ' <div class="status-btn status-btn-red font-13 radius-4">' . __('Close') . '</div>';
                    }
                }
                return $html;
            })
            ->addColumn('action', function ($tenant) {
                return '<div class="tbl-action-btns d-inline-flex">
                        <a href="' . route('tenant.details', [$tenant->id, 'tab' => 'profile']) . '" class="p-1 tbl-action-btn" title="Edit"><span class="iconify" data-icon="carbon:view-filled"></span></a>
                    </div>';
            })
            ->rawColumns(['name', 'property', 'status', 'action'])
            ->make(true);
    }
    public function getById($id)
    {
        $data = Tenant::where('owner_user_id', auth()->id())->findOrFail($id);
        return $data?->makeHidden(['created_at', 'updated_at', 'deleted_at']);
    }
    public function getDetailsById($id)
    {
        $data = Tenant::findOrFail($id);
        return $data?->makeHidden(['created_at', 'updated_at', 'deleted_at']);
    }
    public function closingStatusHistory($id)
    {
        return Tenant::query()->where('owner_user_id', auth()->id())->where('status', TENANT_STATUS_CLOSE)->findOrFail($id);
    }
    public function documentDestroy($id)
    {
        $document = FileManager::where('origin_type', 'App\Models\Tenant')->where('id', $id)->first();
        $tenantExists = Tenant::where('id', $document->origin_id)->where('owner_user_id', auth()->id())->exists();
        if (!is_null($document) && $tenantExists) {
            $document->delete();
        } else {
            $message = __("Document not found");
            return $this->error([], $message);
        }
        return $this->success([], __(DELETED_SUCCESSFULLY));
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            DB::commit();
            if($request->tenant_id){
                $data = Tenant::findOrFail($request->tenant_id);
                if($data->user_id == 0 || $data->user_id == null){
                    $data->user_id = auth()->user()->id;
                }
            }else{
                $data = new Tenant();
                $data->user_id = auth()->user()->id;
            }
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->partner_first_name = $request->partner_first_name;
            $data->partner_last_name = $request->partner_last_name;
            $data->address = $request->address;
            $data->phone_number = $request->phone_number;
            $data->cellphone_number = $request->cellphone_number;
            $data->working_place_name = $request->workplace_name;
            $data->working_place_address = $request->workplace_address;
            $data->working_place_contact = $request->workplace_contact;
            $data->working_place_email = $request->workplace_email;
            $data->guarantor_first_name = $request->guarantor_first_name;
            $data->guarantor_last_name = $request->guarantor_last_name;
            $data->guarantor_address = $request->guarantor_address;
            $data->guarantor_phone_number = $request->guarantor_phone_number;
            $data->guarantor_cellphone_number = $request->guarantor_cellphone_number;
            $data->guarantor_working_place_name = $request->guarantor_workplace_name;
            $data->guarantor_working_place_address = $request->guarantor_workplace_address;
            $data->guarantor_working_place_contact = $request->guarantor_workplace_contact;
            $data->guarantor_working_place_email = $request->guarantor_workplace_email;
            $data->building_id = $request->building_id;
            $data->apartment_id = $request->apartment_id;
            $data->check_in_date = $request->check_in_date;
            $data->check_out_date = $request->check_out_date;
            $data->contract_date = $request->contract_date;
            $data->monthly_fees = $request->monthly_fees;
            $data->deposit_amount = $request->deposit_amount;
            $data->deposit_type = $request->payment_type;
            $data->monthly_due_date = $request->monthly_due_date;
            $data->late_fees = $request->late_fees;
            $data->date = $request->date;
            $data->status = $request->status ?? 'pending';
            $data->save();
            $message = $request->tenant_id ? __(UPDATED_SUCCESSFULLY) : __(CREATED_SUCCESSFULLY);
            return $this->success($data, $message);
        } catch (Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([],  $message);
        }
    }
    public function closeHistoryStore($request, $id)
    {
        DB::beginTransaction();
        try {
            $tenant = Tenant::where('owner_user_id', auth()->id())->findOrFail($id);
            $tenant->status = TENANT_STATUS_CLOSE;
            $tenant->close_refund_amount = $request->close_refund_amount;
            $tenant->close_charge = $request->close_charge;
            $tenant->close_date = $request->close_date;
            $tenant->close_reason = $request->close_reason;
            $tenant->save();
            DB::commit();
            $message = __(UPDATED_SUCCESSFULLY);
            return $this->success([], $message);
        } catch (Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([],  $message);
        }
    }
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $tenant = Tenant::findOrFail($id);
            $tenant->delete();
            DB::commit();
            $message = __(DELETED_SUCCESSFULLY);
            // return $this->success([], $message);
            return redirect()->route('tenant.index');
        } catch (Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([],  $message);
        }
    }
}
