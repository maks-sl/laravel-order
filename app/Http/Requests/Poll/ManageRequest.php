<?php

namespace App\Http\Requests\Poll;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ManageRequest extends FormRequest
{
    const COMMAND_START = 1;
    const COMMAND_PAUSE = 2;
    const COMMAND_RESET = 3;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'command' => ['integer',
                Rule::in([self::COMMAND_START,self::COMMAND_PAUSE, self::COMMAND_RESET])
            ],
        ];
    }
}
