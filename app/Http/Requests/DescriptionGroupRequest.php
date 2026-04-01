<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class DescriptionGroupRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = Route::current()->parameter('description_gp_id') ?? null;
        $validTypes = implode(',', array_values(config('constants.description_type_key')));

        $rules = [
            'gp_name' =>  "required|max:30|unique:mo_description_gps,gp_name,{$id},description_gp_id,deleted_at,NULL",
            'description_type'=> 'required|integer|in:'.$validTypes,
        ];

        return $rules;
    }

    /**
     * Attributes
     *
     * @return array
     */
    public function attributes():array
    {
        return [
            'gp_name' => "အကြောင်းအရာအမည်",
            'description_type' => "အမျိုးအစား",
        ];
    }
}
