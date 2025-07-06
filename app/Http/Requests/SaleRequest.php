<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'product_id' => ['required', 'exists:products,id'],
            'customer_id' => ['required', 'exists:customers,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'unit_price' => ['required', 'numeric', 'gt:0'],
            'total' => ['required', 'numeric', 'gt:0'],
            'payment' => ['required', 'in:A vista,Personalizado'],

            'quota_qtd' => ['nullable', 'integer', 'min:1'],
            'payment_date' => ['nullable', 'date'],
            'quota_details' => ['nullable', 'string'],
        ];
    }
}
