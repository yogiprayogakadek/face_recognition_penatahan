<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class RuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // === Rule Absen Masuk ===
            'rules.masuk.tipe' => 'required|in:masuk',
            'rules.masuk.start_time' => 'required|date_format:H:i',
            'rules.masuk.end_time' => 'required|date_format:H:i|after:rules.masuk.start_time',
            'rules.masuk.late_after' => 'required|date_format:H:i|after_or_equal:rules.masuk.start_time|before_or_equal:rules.masuk.end_time',

            // === Rule Absen Pulang ===
            'rules.pulang.tipe' => 'required|in:pulang',
            'rules.pulang.start_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $masuk_start = request('rules.masuk.start_time');
                    $masuk_end = request('rules.masuk.end_time');

                    if ($masuk_start && $masuk_end && ($value < $masuk_start || $value < $masuk_end)) {
                        $fail('Start Time pulang tidak boleh lebih awal dari jam masuk.');
                    }
                }
            ],
            'rules.pulang.end_time' => [
                'nullable',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $masuk_start = request('rules.masuk.start_time');
                    $masuk_end = request('rules.masuk.end_time');
                    $start_pulang = request('rules.pulang.start_time');

                    if ($value && ($value < $masuk_start || $value < $masuk_end || $value < $start_pulang)) {
                        $fail('End Time pulang tidak valid (harus setelah start time dan jam masuk).');
                    }
                }
            ],
            'rules.pulang.late_after' => [
                'nullable',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $start_pulang = request('rules.pulang.start_time');
                    $end_pulang = request('rules.pulang.end_time');
                    $masuk_start = request('rules.masuk.start_time');
                    $masuk_end = request('rules.masuk.end_time');

                    if ($value) {
                        if ($value < $masuk_start || $value < $masuk_end) {
                            $fail('Late After pulang tidak boleh lebih awal dari jam masuk.');
                        }

                        if ($end_pulang && ($value <= $start_pulang || $value >= $end_pulang)) {
                            $fail('Late After pulang harus berada di antara start dan end time pulang.');
                        }
                    }
                }
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'tipe.required' => 'Tipe wajib diisi.',
            'tipe.in' => 'Tipe hanya boleh "masuk" atau "pulang".',

            'start_time.required' => 'Jam mulai wajib diisi.',
            'start_time.date_format' => 'Format jam mulai harus HH:ii (contoh: 08:00).',

            'end_time.required_if' => 'Jam selesai wajib diisi untuk tipe masuk.',
            'end_time.date_format' => 'Format jam selesai harus HH:ii.',
            'end_time.after' => 'Jam selesai harus setelah jam mulai.',

            'late_after.required_if' => 'Jam keterlambatan wajib diisi untuk tipe masuk.',
            'late_after.date_format' => 'Format jam keterlambatan harus HH:ii.',
            'late_after.after_or_equal' => 'Jam keterlambatan tidak boleh sebelum jam mulai.',
            'late_after.before_or_equal' => 'Jam keterlambatan tidak boleh setelah jam selesai.',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->sometimes('end_time', 'required|date_format:H:i|after:start_time', function ($input) {
            return $input->tipe === 'masuk';
        });

        $validator->sometimes('late_after', [
            'required',
            'date_format:H:i',
            'after_or_equal:start_time',
            'before_or_equal:end_time'
        ], function ($input) {
            return $input->tipe === 'masuk';
        });
    }
}
