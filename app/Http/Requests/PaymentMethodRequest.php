<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class PaymentMethodRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = Route::current()->parameter('payment_method_id') ?? null;
        return [
            'method_name' => "required|max:30|unique:payment_methods,method_name,{$id},payment_method_id,deleted_at,NULL",
            'account_type' => 'nullable|in:' . implode(',', array_column(config('payments'), 'account_type')),
            'account_name' => "required_with:account_type|max:255",
            'account_no' => "required_with:account_type|max:150",
        ];
    }

    /**
     * Attributes
     *
     * @return array
     */
    public function attributes():array
    {
        return [
            'method_name' => "ငွေပေးချေမှုအမျိုးအစား",
        ];
    }
}
