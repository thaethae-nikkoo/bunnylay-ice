<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DescriptionGroupDeleteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description_gp_id' => ['required','exists:mo_description_gps,description_gp_id'],
        ];
    }
}
