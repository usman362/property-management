<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->hasPermissionTo("view-applications"))
            return back();

        $data['pageTitle'] = __('Applications');
        $data['navApplicationMMShowClass'] = 'mm-show';
        $data['subNavAllApplicationMMActiveClass'] = 'mm-active';
        $data['subNavAllApplicationActiveClass'] = 'active';
        if ($request->ajax()) {
            $application = Tenant::all();
            return datatables($application)
                ->addIndexColumn()
                ->addColumn('status', function ($application) {
                    $status = $application->status;
                    if (auth()->user()->hasPermissionTo("action-applications")) {
                        $status = '
                    <select class="change_status" data-id="' . $application->id . '">
                    <option value="pending" ' . ($application->status == 'pending' ? 'selected' : '') . '>Pending</option>
                    <option value="approved" ' . ($application->status == 'approved' ? 'selected' : '') . '>Approved</option>
                    <option value="rejected" ' . ($application->status == 'rejected' ? 'selected' : '') . '>Rejected</option>
                    </select>';
                    }
                    return $status;
                })
                // ->addColumn('action', function ($maintainer) {
                //     $id = $maintainer->id;
                //     return '<div class="tbl-action-btns d-inline-flex">
                //                 <button type="button" class="p-1 tbl-action-btn edit" data-id="' . $id . '" title="' . __('Edit') . '"><span class="iconify" data-icon="clarity:note-edit-solid"></span></button>
                //                 <button onclick="deleteItem(\'' . route('maintainer.delete', $id) . '\', \'allMaintainerDataTable\')" class="p-1 tbl-action-btn"   title="' . __('Delete') . '"><span class="iconify" data-icon="ep:delete-filled"></span></button>
                //             </div>';
                // })
                ->rawColumns(['status'])
                ->make(true);
        }
        return view('owner.applications.application', $data);
    }

    public function changeStatus(Request $request)
    {
        if (!auth()->user()->hasPermissionTo("action-applications"))
            return back();

        $app = Tenant::find($request->id);
        if (!empty($app)) {
            $app->status = $request->status;
            $app->save();
            return response()->json(['message' => 'Status has been Changed!'], 201);
        }
        return response()->json(['message' => 'Something Went Wrong!'], 403);
    }
}
