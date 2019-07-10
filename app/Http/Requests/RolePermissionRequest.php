<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

class RolePermissionRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'permissions' => [
                'required',
                'array',
            ],
            'permissions.*' => [
                'integer',
                Rule::exists('permissions', 'id'),
            ],
        ];

        return $rules;
    }

}
