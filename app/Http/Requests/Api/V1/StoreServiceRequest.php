<?php

namespace App\Http\Requests\Api\V1;

class StoreServiceRequest extends BaseServiceRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'data' => 'required|array',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'required|string',
            'data.attributes.description' => 'required|string',
            'data.attributes.price' => 'required|string',
            'data.attributes.duration' => 'required|integer|gt:0',
        ];

        return $rules;
    }
}
