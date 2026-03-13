<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|<string></string>
     */
    public function rules() : array
    {
        $rules = [
           'newPassword' => ['required','min:8', 'max:20'],
           'confirmPassword' => ['required', 'same:newPassword'],
        ];
        //Authenticated user, to validate oldPassword
        if (Auth::check())
        {
            $rules['oldPassword'] =  ['required', 'string'];
        }
        //Unauthenticated user, to validate username
        else {
            $rules['username'] = ['required'];
        }
        return $rules;
    }

    /**
     * Change Attribute
     *
     * @return void
     */
    public function attributes()
    {
        return [
            'oldPassword' => 'စကားဝှက်အဟောင်း',
            'newPassword' => 'စကားဝှက်အသစ်',
            'confirmPassword' => 'စကားဝှက် အတည်ပြုရန်',
            'username' => 'အသုံးပြုသူ ID'
        ];
    }

    /**
     * Validator
     *
     * @param \Illuminate\Contracts\Validation\Validatior $validator
     * @return void
     */
    public function withValidator($validator)
    {
        // If user is authenticated, to check if the oldPassword matches
        if (Auth::check())
        {
            $validator->after(function ($validator){
                $currentPassword = Auth::user()->password;
                if (!Hash::check($this->input('oldPassword'), $currentPassword)){
                    $validator->errors()->add('oldPassword', 'စကားဝှက်အဟောင်း မှားယွင်းနေပါသည်');
                };
            });
        }
    }
}
