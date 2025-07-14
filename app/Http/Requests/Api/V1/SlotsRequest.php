<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class SlotsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function validator()
    {
        return Validator::make(
            ['date' => $this->route('date')],
            ['date' => 'required|date|after:today']
        );
    }

    public function messages()
    {
        return [
            'date' => 'The date value is invalid. Please insert a date greater then today',
        ];
    }
}
