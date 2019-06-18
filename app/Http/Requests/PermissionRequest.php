<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

class PermissionRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'string|max:254|regex:/^[a-zA-Z\_\.]+$/u|unique:permissions,name',
            'display_name' => 'string|max:254',
            'description' => 'string|max:254',
        ];


        if ($this->methodIsPostOrPut()) {
            $this->applyRequiredInRules($rules, ['display_name', 'description']);
        }


        if ($this->methodIsPutOrPatch() && !empty($this->permission->id)) {
            $rules['name'] .= ',' . $this->permission->id;
        }

        return $rules;
    }

}
