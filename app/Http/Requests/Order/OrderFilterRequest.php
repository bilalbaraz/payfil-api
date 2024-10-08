<?php

namespace App\Http\Requests\Order;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderFilterRequest extends FormRequest
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
            'payment_provider_ids' => 'array|nullable',
            'payment_provider_ids.*' => 'exists:payment_providers,id',
            'starts_at' => 'nullable|date|before_or_equal:ends_at',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
            'currencies' => 'nullable',
            'currencies.*' => 'in:EUR,USD,TRY',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'success' => false,
                    'data' => $validator->errors(),
                ],
                400
            )
        );
    }
}
