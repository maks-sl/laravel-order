<?php

namespace App\Http\Requests\Cabinet\Parsers;

use Illuminate\Foundation\Http\FormRequest;

class SingleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:1023',
            'css_path' => 'required|string|max:511',
            'regex' => 'nullable|string|max:255',
            'match_group' => 'nullable|integer',
            'strip_tags' => 'string|max:16',
            'period' => 'required|integer|min:5|max:120',
        ];
    }
}
