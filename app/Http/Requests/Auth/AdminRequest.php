<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use App\Rules\Password;
use App\Rules\PhoneNumber;
use App\Rules\Username;
use Illuminate\Validation\Rule;

class AdminRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', Rule::unique('m_admins', 'username'), 'max:50', new Username],
            'password' => ['required', 'string', 'min:8', 'max:20', new Password],
            'confirm_password' => ['required', 'string', 'same:password'],
            'phone' => ['nullable', 'max:20', new PhoneNumber]
        ];
        if ($this->isUpdate()) {
            $id = $this->route('admin_id');
            $rules['username'] = ['required', 'string', 'max:50', Rule::unique('m_admins', 'username')->ignore($id, 'admin_id'), new Username];
            $rules['password'] = ['nullable', 'string', 'min:8', 'max:20', new Password];
            $rules['confirm_password'] = ['nullable', 'string', 'same:password'];
        }
        return $rules;
    }

    /**
     * Change Attribute
     */
    public function attributes()
    {
        return [
            'name' => 'အမည်',
            'username' => 'အသုံးပြုသူ၏ ID',
            'password' => 'စကားဝှက်',
            'confirm_password' => 'စကားဝှက်အတည်ပြု',
            'phone' => 'ဖုန်းနံပါတ်'
        ];
    }
}
