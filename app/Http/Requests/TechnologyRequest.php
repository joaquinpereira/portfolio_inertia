<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechnologyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [];

        if($this->method() === 'POST'){
            $rules = [
                'technology_types_id' => 'required|integer|exists:technology_types,id',
                'active' => 'required|boolean',
                'name' => 'required|string|max:255|unique:technologies',
                'icon' => 'required|string',
                'description' => 'nullable|string',
            ];
        }

        if($this->method() === 'PUT' || $this->method() === 'PATCH'){
            $rules = [
                'technology_types_id' => 'sometimes|integer|exists:technology_types,id',
                'name' => 'sometimes|string|max:255|unique:technologies,name,'.$this->id,
                'active' => 'sometimes|boolean',
                'icon' => 'sometimes|string',
                'description' => 'nullable|string',
            ];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'technology_types_id' => 'Tipo de tecnología',
            'active' => 'Activo',
            'icon' => 'Icono',
            'description' => 'Descripción',
            'name' => 'Nombre',
        ];
    }
}
