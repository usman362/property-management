<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\Property\PropertyInformationRequest;
use App\Models\ApartmentComment;
use App\Models\Building;
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
        if (!auth()->user()->hasPermissionTo("view-apartments"))
            return back();

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


    public function comments(Request $request)
    {
        if (!auth()->user()->hasPermissionTo("view-apartment-comments"))
            return back();

        $data['pageTitle'] = __("Apartments Comments");
        $data['navApartmentMMShowClass'] = 'mm-show';
        $data['subNavAllApartmentCommentMMActiveClass'] = 'mm-active';
        $data['subNavAllApartmentCommentActiveClass'] = 'active';
        if ($request->ajax()) {
            $comments = ApartmentComment::all();
            return datatables($comments)
                ->addIndexColumn()
                // ->addColumn('image', function ($property) {
                //     return '<img src="' . $property->thumbnail_image . '"
                //     class="rounded-circle avatar-md tbl-user-image"
                //     alt="">';
                // })
                ->addColumn('status', function ($property) {
                    $status = $property->status;

                    if (auth()->user()->hasPermissionTo("action-apartment-comments")) {
                        $status = '<label class="switch">
                                <input type="checkbox" class="change-status" ' . ($property->status == true ? 'checked' : '') . ' data-id="' . $property->id . '">
                                <span class="slider round"></span>
                                </label>';
                    }
                    return $status;
                })
                // ->addColumn('action', function ($property) {
                //     return '<div class="tbl-action-btns d-inline-flex">
                //                 <a type="button" class="p-1 tbl-action-btn" href="' . route('property.edit', $property->id) . '" title="' . __('Edit') . '"><span class="iconify" data-icon="clarity:note-edit-solid"></span></a>
                //                 <a type="button" class="p-1 tbl-action-btn" href="' . route('property.show', $property->id) . '" title="' . __('View') . '"><span class="iconify" data-icon="carbon:view-filled"></span></a>
                //                 <button onclick="deleteItem(\'' . route('property.delete', $property->id) . '\', \'allDataTable\')" class="p-1 tbl-action-btn"   title="' . __('Delete') . '"><span class="iconify" data-icon="ep:delete-filled"></span></button>
                //             </div>';
                // })
                ->rawColumns(['status'])
                ->make(true);
        } else {
            $data['comments'] = ApartmentComment::all();
        }
        return view('owner.property.comments')->with($data);
    }

    public function commentStatus(Request $request)
    {
        if (!auth()->user()->hasPermissionTo("action-apartment-comments"))
            throw new \Exception('Not allowed');

        $apartment = ApartmentComment::find($request->id);
        if (!empty($apartment)) {
            $apartment->status = (int)$request->value;
            $apartment->save();
            return response()->json(['message' => 'Comment Status has been Changed!'], 201);
        } else {
            return response()->json(['message' => 'Comment Not Found!'], 404);
        }
    }

    public function add()
    {
        if (!auth()->user()->hasPermissionTo("add-apartments"))
            return back();

        $data['pageTitle'] = __("Add Apartment");
        $data['navApartmentMMShowClass'] = 'mm-show';
        $data['subNavApartmentIndexMMActiveClass'] = 'mm-active';
        $data['subNavApartmentIndexActiveClass'] = 'active';
        $data['buildings'] = Building::all();
        return view('owner.property.add')->with($data);
    }

    public function show($id)
    {
        if (!auth()->user()->hasPermissionTo("view-apartments"))
            return back();

        $data['pageTitle'] = __("Apartment Details");
        $data['navApartmentMMShowClass'] = 'mm-show';
        $data['subNavAllApartmentMMActiveClass'] = 'mm-active';
        $data['subNavAllApartmentActiveClass'] = 'active';
        $data['apartment'] = $this->propertyService->getDetailsById($id);
        return view('owner.property.show')->with($data);
    }

    public function edit($id)
    {
        if (!auth()->user()->hasPermissionTo("edit-apartments"))
            return back();

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
        if (!auth()->user()->hasPermissionTo("add-apartments"))
            throw new \Exception('Not allowed');

        return $this->propertyService->propertyInformationStore($request);
    }

    public function destroy($id)
    {
        if (!auth()->user()->hasPermissionTo("delete-apartments"))
            return back();

        return $this->propertyService->destroy($id);
    }
}
