<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

class RecoveryChangerPasswordRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'password' => 'required|string|between:6,20',
        ];
    }

}
