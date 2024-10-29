<?php

namespace App\Http\Requests\Owner\Property;

use Illuminate\Foundation\Http\FormRequest;

class PropertyInformationRequest extends FormRequest
{
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
        $rules =  [
            'building_id' => 'required',
            'apartment_name' => 'required',
            'floor' => 'required',
            'monthly_rental_price' => 'required',
            'balcony_area' => 'required',
            'living_room_area' => 'required',
            'dining_room_area' => 'required',
            'kitchen_area' => 'required',
            'alley_area' => 'required',
            'main_bedroom_area' => 'required',
            'second_bedroom_area' => 'required',
            'third_bedroom_area' => 'required',
            'bathroom_area' => 'required',
            'public_area' => 'required',
        ];

        return $rules;
    }
}
