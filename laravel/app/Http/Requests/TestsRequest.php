<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipe' => 'required|string|in:masuk,pulang',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'late_after' => 'required|date_format:H:i|after_or_equal:start_time|before_or_equal:end_time',
        ];
    }
}
