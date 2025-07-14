<?php

namespace App\Http\Requests\Api\V1;

class StoreBookingRequest extends BaseBookingRequest
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
            'data.attributes.date' => 'required|date',
            'data.attributes.time' => 'required|regex:/^[0-9]{2}:[0-9]{2}$/i',
            'data.attributes.payed' => 'sometime|boolean',
            'data.attributes.user' => 'required|exist:user,id',
            'data.attributes.service' => 'required|exist:service,id',
        ];

        return $rules;
    }
}
