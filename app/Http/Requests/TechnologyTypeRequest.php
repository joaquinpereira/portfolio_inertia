<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechnologyTypeRequest extends FormRequest
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
        $rules = [];

        if($this->method() === 'POST'){
            $rules = [
                'name' => 'required|string|max:255|unique:technology_types',
                'icon' => 'required|string',
                'description' => 'nullable|string',
            ];
        }

        if($this->method() === 'PUT' || $this->method() === 'PATCH'){
            $rules = [
                'name' => 'required|string|max:255|unique:technology_types,name,'.$this->id,
                'icon' => 'required|string',
                'description' => 'nullable|string',
            ];
        }

        return $rules;
    }
}
