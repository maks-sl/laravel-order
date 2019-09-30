<?php

namespace App\Http\Requests\Order;

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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:1023',
            'tariff' => ['required', 'integer', Rule::exists('tariffs', 'id')],
            'date' => 'required|date|after:today|checkDateForTariff:tariff',
        ];
    }
}
