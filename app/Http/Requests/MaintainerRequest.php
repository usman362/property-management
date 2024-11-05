<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class MaintainerRequest extends FormRequest
{
    use ResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'building_name' => 'required|string|max:255',
            'apartment_number' => 'required|string|max:100',
            'status' => 'required|in:Checked In,Checked Out',
            'maintenance_type' => 'required|in:Plumber,Electric,Structure,Other',
            'repair_fees' => 'nullable|numeric|min:0',
            'utensils_fees' => 'nullable|numeric|min:0',
            'repair_details' => 'nullable|string|max:1000',
            'monthly_maintenance_fees' => 'nullable|numeric|min:0',
            'services_included' => 'required|in:Included,Not Included',
        ];
        
        return $rules;
    }
}
