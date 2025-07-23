<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
        return [
            'department_name' => 'required|string|max:255',
            'max_clock_in_time' => 'required|date_format:H:i',
            'max_clock_out_time' => 'required|date_format:H:i',
        ];
    }

    public function messages(): array
    {
        return [
            'department_name.required' => 'The department name is required.',
            'max_clock_in_time.required' => 'The max clock in time is required.',
            'max_clock_out_time.required' => 'The max clock out time is required.',
            'max_clock_in_time.date_format' => 'The max clock in time must be in the format HH:MM.',
            'max_clock_out_time.date_format' => 'The max clock out time must be in the format HH:MM.',
        ];
    }
}
