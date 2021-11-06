<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'lat' => ['required'],
            'lng' => ['required'],
            'number-of-students' => ['required'],
            'start-time' => ['required'],
            'end-time' => ['required'],
            'price' => ['required'],
            'require-certificate' => [],
            'id' => ['required']
        ];
    }
}
