<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\ApartmentComment;
use App\Models\ApartmentMedia;
use App\Models\Building;
use App\Models\Tenant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $galleries = ApartmentMedia::paginate(20);
        $buildings = Building::paginate(6);
        return view('frontend.pages.home',compact('galleries','buildings'));
    }

    public function apartments()
    {
        $apartments = Apartment::all();
        return view('frontend.pages.apartments',compact('apartments'));
    }

    public function apartmentDetail($id)
    {
        $apartment = Apartment::find($id);
        return view('frontend.pages.apartment-details',compact('apartment'));
    }

    public function buildings()
    {
        $buildings = Building::all();
        return view('frontend.pages.buildings',compact('buildings'));
    }

    public function buildingDetail($id)
    {
        $building = Building::find($id);
        $apartments = Apartment::where('building_id',$building->id)->whereIn('status',['occupied','empty'])->get();
        return view('frontend.pages.building-details',compact('building','apartments'));
    }

    public function storeApartmentComment(Request $request,$id)
    {
        $comment = new ApartmentComment();
        $comment->apartment_id = $id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->msg;
        $comment->save();
        return back();
    }

    public function applicationStore(Request $request)
    {
        DB::beginTransaction();
        try {
            DB::commit();
            if($request->tenant_id){
                $data = Tenant::findOrFail($request->tenant_id);
            }else{
                $data = new Tenant();
                $data->user_id = 0;
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
            return back();
        } catch (Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return $this->error([],  $message);
        }
    }
}
