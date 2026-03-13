<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class ProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'max:20'],
            'phone' => ['nullable', 'max:20']
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'အမည်',
            'username' => 'အသုံးပြုသူ၏ ID'
        ];
    }
}
