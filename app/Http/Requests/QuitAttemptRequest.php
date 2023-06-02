<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuitAttemptRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => 'required|date',
            'cigarettes_per_day' => 'required|integer|min:0',
            'cost_per_pack' => 'required|numeric|min:0',
            'nicotine_per_cigarette' => 'required|numeric|min:0',
            'tar_per_cigarette' => 'required|numeric|min:0',
            'cigarettes_per_pack' => 'required|integer|min:0',
        ];
    }
}
