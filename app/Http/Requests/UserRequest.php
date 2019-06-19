<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

class UserRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'string|max:254',
            'email' => 'email|unique:users,email',
            'password' => 'string|between:6,20',
        ];

        if ($this->methodIsPostOrPut()) {
            $this->applyRequiredInRules($rules);
        }

        if ($this->methodIsPutOrPatch() && !empty($this->user->id)) {
            $rules['email'] .= ',' . $this->user->id;
        }

        return $rules;
    }

}
