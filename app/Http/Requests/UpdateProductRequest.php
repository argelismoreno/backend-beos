<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
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
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'currency_id' => ['sometimes', 'required', 'exists:currencies,id'],
            'tax_cost' => ['sometimes', 'required', 'numeric', 'min:0'],
            'manufacturing_cost' => ['sometimes', 'required', 'numeric', 'min:0'],
        ];
    }
}
