<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
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
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'partner_first_name' => 'nullable|string|max:255',
            'partner_last_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone_numbers' => 'nullable|string|max:255',
            'cellphone_numbers' => 'nullable|string|max:255',
            'working_place_name' => 'nullable|string|max:255',
            'working_place_address' => 'nullable|string|max:500',
            'working_place_contact' => 'nullable|string|max:255',
            'working_place_email' => 'nullable|email|max:255',
            'guarantor_first_name' => 'nullable|string|max:255',
            'guarantor_last_name' => 'nullable|string|max:255',
            'guarantor_address' => 'nullable|string|max:500',
            'guarantor_phone_numbers' => 'nullable|string|max:255',
            'guarantor_cellphone_numbers' => 'nullable|string|max:255',
            'guarantor_working_place_name' => 'nullable|string|max:255',
            'guarantor_working_place_address' => 'nullable|string|max:500',
            'guarantor_working_place_contact' => 'nullable|string|max:255',
            'guarantor_working_place_email' => 'nullable|email|max:255',
            'building_name' => 'nullable|string|max:255',
            'apartment_number' => 'nullable|string|max:50',
            'check_in_date' => 'nullable|date',
            'check_out_date' => 'nullable|date|after_or_equal:check_in_date',
            'contract_date' => 'nullable|date',
            'monthly_fees' => 'nullable|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            'deposit_type' => 'nullable|in:cash,deposit',
            'monthly_due_day' => 'nullable|integer|between:1,31',
            'late_fees' => 'nullable|numeric|min:0',
        ];

        return $rules;
    }

}
