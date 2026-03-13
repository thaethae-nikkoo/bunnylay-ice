<?php

namespace App\Http\Requests\Auth;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

class AdminManagementRequest  extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'admin_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if (!Admin::withTrashed()->where('admin_id', $value)->exists()) {
                        $fail(__('messages.login_fail'));
                    }
                }
            ],
            'action' => ['required', 'in:ban,delete,restore']
        ];
    }
}
