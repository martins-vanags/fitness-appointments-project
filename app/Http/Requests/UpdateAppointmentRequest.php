<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'student_count' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'price' => ['required'],
            'certificate_needed' => ['sometimes'],
            'description' => ['required'],
            'id' => ['required']
        ];
    }
}
