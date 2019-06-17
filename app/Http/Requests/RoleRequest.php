<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

class RoleRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'string|max:254|regex:/^[a-zA-Z]+$/u|unique:roles,name',
            'display_name' => 'string|max:254',
            'description' => 'string|max:254',
        ];


        if ($this->methodIsPostOrPut()) {
            $this->applyRequiredInRules($rules, ['display_name', 'description']);
        }


        if ($this->methodIsPutOrPatch() && !empty($this->role->id)) {
            $rules['name'] .= ',' . $this->role->id;
        }

        return $rules;
    }

}
