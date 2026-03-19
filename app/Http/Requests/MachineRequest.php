<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MachineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $productTypes = array_values(config('constants.machine_product_type'));
        $rules = [
            'machine_name' => 'required|string|max:100',
            'product_type' => 'required|integer|in:' . implode(',', $productTypes),
            'code' => 'nullable|string|max:20',
            'capacity_mode' => 'required|string|in:hour,shift,day,night,whole_day',
            'capacity_value' => 'required|numeric',
            'location' => 'nullable|string|max:150',
            'remark' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_photo' => 'nullable|integer|in:0,1',
        ];

        return $rules;
    }
}
