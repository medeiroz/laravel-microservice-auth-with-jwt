<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

class RecoveryRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'url' => 'required|url',
        ];
    }

}
