<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class DescriptionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = Route::current()->parameter('description_id') ?? null;

        return [
        'description_gp_id' => 'required|integer|exists:mo_description_gps,description_gp_id',
        'name' => [
            'required',
            'max:30',
            Rule::unique('mo_descriptions', 'name')
                ->where(function ($query) {
                    return $query->where('description_gp_id', request('description_gp_id'))
                                 ->whereNull('deleted_at');
                })
                ->ignore($id, 'description_id'),
            ],
        ];

    }

    /**
     * Description Attributes
     *
     * @return array
     */
    public function attributes():array
    {
        return [
            'description_gp_id' => 'အမျိုးအစား',
            'name' => "အကြောင်းအရာအမည်",
        ];
    }
}
