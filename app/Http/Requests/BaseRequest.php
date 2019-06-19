<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    abstract public function rules(): array;

    /**
     * Check request method is Post or Put
     * @return bool
     */
    public function methodIsPostOrPut(): bool
    {
        return in_array($this->getMethod(), ['POST', 'PUT']);
    }

    /**
     * Check request methos is not Put or Patch
     * @return bool
     */
    public function methodIsPutOrPatch(): bool
    {
        return in_array($this->getMethod(), ['PUT', 'PATCH']);
    }

    /**
     * Let all roles as required
     * @param array $rules
     * @param array $excepts
     */
    public function applyRequiredInRules(array &$rules, array $excepts = []): void
    {
        array_walk($rules, function(&$rule, $key, $excepts) {

            if (is_string($rule) && !in_array($key, $excepts)) {
                $rule = 'required|' . $rule;

            } elseif (is_array($rule) && !in_array($key, $excepts)) {
                array_unshift($rule, 'required');

            } elseif (is_object($rule) && !in_array($key, $excepts)) {
                $rule = ['required', $rule];

            }

        }, $excepts);
    }
}
