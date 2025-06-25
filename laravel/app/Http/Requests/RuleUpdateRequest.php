<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleUpdateRequest extends FormRequest
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

    public function messages(): array
    {
        return [
            'tipe.required' => 'Tipe wajib diisi.',
            'tipe.in' => 'Tipe hanya boleh "masuk" atau "pulang".',
            'start_time.required' => 'Jam mulai wajib diisi.',
            'start_time.date_format' => 'Format jam mulai harus HH:ii (contoh: 08:00).',
            'end_time.required' => 'Jam selesai wajib diisi.',
            'end_time.date_format' => 'Format jam selesai harus HH:ii.',
            'end_time.after' => 'Jam selesai harus setelah jam mulai.',
            'late_after.required' => 'Jam keterlambatan wajib diisi.',
            'late_after.date_format' => 'Format jam keterlambatan harus HH:ii.',
            'late_after.after_or_equal' => 'Jam keterlambatan tidak boleh sebelum jam mulai.',
            'late_after.before_or_equal' => 'Jam keterlambatan tidak boleh setelah jam selesai.',
        ];
    }
}
