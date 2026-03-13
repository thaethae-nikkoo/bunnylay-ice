<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
     /**
     * check update request or not
     *
     * @return boolean
     */
    public function isUpdate(): bool
    {
        return $this->method() == 'PATCH';
    }
}
