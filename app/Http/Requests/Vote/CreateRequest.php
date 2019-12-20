<?php

namespace App\Http\Requests\Vote;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'department' => ['required', 'integer', Rule::exists('departments', 'id')],
            'winner' => 'required|integer|checkCountryForDept:department',
            'finger_hash' => ['required', 'string'],
        ];
    }
}
