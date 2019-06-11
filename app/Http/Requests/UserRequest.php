<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max: 254',
            'email' => 'required|email|unique:users,email',
        ];

        if ($this->password || $this->isMethod('POST'))
            $rules['password'] = 'required|string|between:6,20';

        if ($this->user)
            $rules['email'] .= ','.$this->user->id;

        return $rules;
    }
}
