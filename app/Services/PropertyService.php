<?php

namespace App\Services;

use App\Models\Apartment;
use App\Models\ApartmentMedia;
use App\Models\FileManager;
use App\Models\Property;
use App\Models\PropertyDetail;
use App\Models\PropertyImage;
use App\Models\PropertyUnit;
use App\Models\Tenant;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class PropertyService
{
    use ResponseTrait;

    public function getAll()
    {
        $data = Apartment::all();
        return $data?->makeHidden(['updated_at', 'created_at', 'deleted_at']);
    }

    public function getAllData()
    {
        $properties = $this->getAll();

        return datatables($properties)
            ->addIndexColumn()
            ->addColumn('image', function ($property) {
                return '<img src="' . $property->thumbnail_image . '"
                class="rounded-circle avatar-md tbl-user-image"
                alt="">';
            })
            ->addColumn('name', function ($property) {
                return $property->name;
            })
            ->addColumn('address', function ($property) {
                return $property->propertyDetail?->address;
            })
            ->addColumn('unit', function ($property) {
                return $property->number_of_unit;
            })
            ->addColumn('rooms', function ($property) {
                return propertyTotalRoom($property->id);
            })
            ->addColumn('available', function ($property) {
                return $property->available_unit;
            })

            ->addColumn('action', function ($property) {
                return '<div class="tbl-action-btns d-inline-flex">
                            <a type="button" class="p-1 tbl-action-btn" href="' . route('property.edit', $property->id) . '" title="' . __('Edit') . '"><span class="iconify" data-icon="clarity:note-edit-solid"></span></a>
                            <a type="button" class="p-1 tbl-action-btn" href="' . route('property.show', $property->id) . '" title="' . __('View') . '"><span class="iconify" data-icon="carbon:view-filled"></span></a>
                            <button onclick="deleteItem(\'' . route('property.delete', $property->id) . '\', \'allDataTable\')" class="p-1 tbl-action-btn"   title="' . __('Delete') . '"><span class="iconify" data-icon="ep:delete-filled"></span></button>
                        </div>';
            })
            ->rawColumns(['name', 'address', 'unit', 'rooms', 'image', 'available', 'action'])
            ->make(true);
    }

    public function getById($id)
    {
        return Apartment::findOrFail($id);
    }

    public function getDetailsById($id)
    {
        $data = Apartment::findOrFail($id);
        return $data?->makeHidden(['updated_at', 'created_at', 'deleted_at']);
    }

    public function propertyInformationStore($request)
    {
        DB::beginTransaction();
        try {
            if ($request->apartment_id) {
                $apartment = Apartment::where('id', $request->apartment_id)->firstOrFail();
            } else {

                $apartment = new Apartment();
                $apartment->user_id = auth()->user()->id;
            }
            $apartment->building_id = $request->building_id;
            $apartment->apartment_name = $request->apartment_name;
            $apartment->floor = $request->floor;
            $apartment->monthly_rental_price = $request->monthly_rental_price;
            $apartment->balcony_area = $request->balcony_area;
            $apartment->living_room_area = $request->living_room_area;
            $apartment->dining_room_area = $request->dining_room_area;
            $apartment->kitchen_area = $request->kitchen_area;
            $apartment->alley_area = $request->alley_area;
            $apartment->main_bedroom_area = $request->main_bedroom_area;
            $apartment->second_bedroom_area = $request->second_bedroom_area;
            $apartment->third_bedroom_area = $request->third_bedroom_area;
            $apartment->bathroom_area = $request->bathroom_area;
            $apartment->public_area = $request->public_area;
            $apartment->status = $request->status;
            $apartment->save();

            if (!empty($request->images)) {
                foreach ($request->images as $image) {
                    $apartmentMedia = new ApartmentMedia();
                    $apartmentMedia->apartment_id = $apartment->id;
                    $uniqueName = uniqid() . '___' . str_replace(' ', '_', $image->getClientOriginalName());
                    $filePath = $image->storeAs("/apartment/images", $uniqueName, "public");
                    $apartmentMedia->media = $filePath;
                    $apartmentMedia->media_type = 'image';
                    $apartmentMedia->save();
                }
            }

            if (!empty($request->videos)) {
                foreach ($request->videos as $videos) {
                    $apartmentMedia = new ApartmentMedia();
                    $apartmentMedia->apartment_id = $apartment->id;
                    $uniqueName = uniqid() . '___' . str_replace(' ', '_', $videos->getClientOriginalName());
                    $filePath = $videos->storeAs("/apartment/videos", $uniqueName, "public");
                    $apartmentMedia->media = $filePath;
                    $apartmentMedia->media_type = 'videos';
                    $apartmentMedia->save();
                }
            }

            DB::commit();
            $response['apartment'] = $apartment;
            $response['message'] = $request->apartment_id ? __(UPDATED_SUCCESSFULLY) : __(CREATED_SUCCESSFULLY);
            return $this->success($response);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error([], $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $media = ApartmentMedia::where('apartment_id',$id)->delete();
            $apartment = Apartment::find($id)->delete();
            DB::commit();
            return redirect()->back()->with('success', __(DELETED_SUCCESSFULLY));
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
